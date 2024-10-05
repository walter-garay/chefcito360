<?php

namespace App\Livewire\Role;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesTable extends Component
{
    public $roles, $users, $verPermissions, $permissions, $allRoles;
    public $roleName, $userName, $userEmail, $userPassword;

    // Control de modales
    public $showModalRole = false;
    public $showModalUser = false;
    public $showModalPermissions = false;

    public $isEditingRole = false;
    public $isEditingUser = false;

    public $roleId, $userId;

    public $selectedPermissions = [], $selectedRoles = [];

    public function render(){
        $this->roles = Role::all();
        $this->users = User::all();
        if (empty($this->permissions)) {
            $this->permissions = Permission::all();
        }
        $this->allRoles = Role::all();

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

    public function deleteRole($id){
        Role::findOrFail($id)->delete();
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
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->userName = $user->name;
        $this->userEmail = $user->email;
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

    public function storeUser(){
        $this->validate([
            'userName' => 'required|string|max:255',
            'userEmail' => 'required|email|max:255|unique:users,email',
            'userPassword' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $this->userName,
            'email' => $this->userEmail,
            'password' => Hash::make($this->userPassword),
        ]);

        $roles = Role::whereIn('id', $this->selectedRoles)->pluck('name')->toArray();
        $user->syncRoles($roles);

        $this->closeUserModal();
        session()->flash('message', 'Usuario agregado con éxito.');
    }

    public function deleteUser($id){
        User::findOrFail($id)->delete();
        session()->flash('message', 'Usuario eliminado con éxito.');
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
