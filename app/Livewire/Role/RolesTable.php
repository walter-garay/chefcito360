<?php

namespace App\Livewire\Role;

use App\Models\Sucursales;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RolesTable extends Component
{
    public $roles, $users, $verPermissions, $permissions, $allRoles;
    public $roleName, $userName, $userEmail, $userPassword;
    public $roleIdToDelete, $userIdToDelete;

    // Control de modales
    public $showModalRole = false;
    public $showModalUser = false;
    public $showModalPermissions = false;
    public $showModalCR = false;
    public $showConfirmModalCR = false;
    public $showModalCU = false;
    public $showConfirmModalCU = false;

    public $isEditingRole = false;
    public $isEditingUser = false;

    public $roleId, $userId;

    public $selectedPermissions = [], $selectedRoles = [];

    public $sucursales;
    public $userSucursal;

    public function render(){
        $this->roles = Role::all();
        $this->users = User::all();
        if (empty($this->permissions)) {
            $this->permissions = Permission::all();
        }
        $this->allRoles = Role::all();
        $this->sucursales = Sucursales::all();
        return view('livewire.role.roles-table');
    }

    // Métodos para manejar los roles
    public function openRoleModal(){
        $this->resetRoleForm();
        $this->showModalRole = true;
    }

    public function closeRoleModal(){
        $this->showModalRole = false;
        $this->resetRoleForm();
    }

    public function resetRoleForm(){
        $this->roleName = '';
        $this->isEditingRole = false;
        $this->roleId = null;
    }

    public function editRole($id){
        $role = Role::findOrFail($id);
        $this->roleId = $id;
        $this->roleName = $role->name;
        $this->permissions = Permission::all();

        $this->isEditingRole = true;

        // Obtener los permisos del rol actual
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();

        $this->showModalRole = true;
    }

    public function storeRole(){
        // Validar el nombre del rol
        $this->validate([
            'roleName' => 'required|string|max:255',
        ]);

        // Crear el nuevo rol
        $role = Role::create([
            'name' => $this->roleName,
        ]);

        // Asignar los permisos seleccionados al rol
        $role->syncPermissions($this->selectedPermissions);

        $this->closeRoleModal();

        session()->flash('message', 'Rol creado con éxito.');
    }

    public function updateRole(){
        // Validar el nombre del rol
        $this->validate([
            'roleName' => 'required|string|max:255',
        ]);

        // Buscar el rol y actualizar su nombre
        $role = Role::findOrFail($this->roleId);
        $role->update([
            'name' => $this->roleName,
        ]);

        // Asignar los permisos seleccionados al rol
        $role->syncPermissions($this->selectedPermissions);

        $this->closeRoleModal();

        session()->flash('message', 'Rol actualizado con éxito.');
    }

    public function confirmDeleteR($id)
    {
        $this->roleIdToDelete = $id;
        $this->showConfirmModalCR = true;
    }

    public function deleteRole(){
        Role::findOrFail($this->roleIdToDelete)->delete();
        $this->showConfirmModalCR = false;
        session()->flash('message', 'Rol eliminado con éxito.');
    }

    // Métodos para manejar los usuarios
    public function openUserModal(){
        $this->resetUserForm();
        $this->showModalUser = true;
    }

    public function closeUserModal(){
        $this->showModalUser = false;
        $this->resetUserForm();
    }

    public function resetUserForm(){
        $this->userName = '';
        $this->userEmail = '';
        $this->userPassword = '';
        $this->selectedRoles = [];
        $this->isEditingUser = false;
        $this->userId = null;
    }

    public function editUser($id){
        //$user = User::findOrFail($id);
        $user = User::with('roles')->find($id); // reemplaza $userId con el ID del usuario que deseas obtener
        $this->userId = $id;
        $this->userName = $user->name;
        $this->userEmail = $user->email;
        $this->userSucursal = $user->sucursales->first()->id;
        $this->selectedRoles = $user->roles->pluck('id')->toArray();
        $this->isEditingUser = true;
        $this->showModalUser = true;
    }

    public function updateUser(){
        $this->validate([
            'userName' => 'required|string|max:255',
            'userEmail' => 'required|email|max:255|unique:users,email,' . $this->userId,
        ]);

        $user = User::findOrFail($this->userId);
        $user->update([
            'name' => $this->userName,
            'email' => $this->userEmail,
        ]);

        $roles = Role::whereIn('id', $this->selectedRoles)->pluck('name')->toArray();
        $user->syncRoles($roles);

        $this->closeUserModal();
        session()->flash('message', 'Usuario actualizado con éxito.');
    }

    public function storeUser() {
        $this->validate([
            'userName' => 'required|string|max:255',
            'userEmail' => 'required|email|max:255|unique:users,email',
            'userPassword' => 'required|string|min:6',
            'userSucursal' => 'required|exists:sucursales,id', // Validar que la sucursal existe
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $this->userName,
            'email' => $this->userEmail,
            'password' => Hash::make($this->userPassword),
        ]);

        // Asignar roles
        $roles = Role::whereIn('id', $this->selectedRoles)->pluck('name')->toArray();
        $user->syncRoles($roles);

        // Enlazar el usuario con la sucursal en la tabla 'user_sucursal'
        DB::table('user_sucursal')->insert([
            'empleado_id' => $user->id, // ID del usuario recién creado
            'sucursal_id' => $this->userSucursal, // ID de la sucursal seleccionada
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Cerrar modal o realizar acciones posteriores
        $this->closeUserModal();
        session()->flash('message', 'Usuario agregado con éxito y asociado a la sucursal.');
    }

    public function confirmDeleteU($id)
    {
        $this->userIdToDelete = $id;
        $this->showConfirmModalCU = true;
    }

    public function deleteUser(){
        Role::findOrFail($this->userIdToDelete)->delete();
        $this->showConfirmModalCU = false;
        session()->flash('message', 'Rol eliminado con éxito.');
    }

    // Permisos
    public function showPermissions($id){
        $role = Role::findOrFail($id);
        $this->roleId = $id;
        $this->verPermissions = $role->permissions()->pluck('name');
        $this->showModalPermissions = true;
    }

    public function closePermissionsModal(){
        $this->showModalPermissions = false;
    }
}
