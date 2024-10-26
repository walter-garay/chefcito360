<div class="py-5 mx-auto sm:px-6 lg:px-8">
    <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
        @if (session()->has('message'))
            <div class="mb-4 text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ __('Administrando Accesos') }}</h2>
            <x-button wire:click="openUserModal">Agregar Usuario</x-button>
            <x-button wire:click="openRoleModal">Agregar Rol</x-button>
        </div>

        <!-- Tabla de Empleados -->
        <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-2">
            <div class="col-span-2 p-6 bg-white border border-gray-100 rounded-md shadow-md">
                <h3 class="font-medium">Lista de Empleados</h3>
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Nombre</th>
                            <th class="px-6 py-3">Correo</th>
                            <th class="px-6 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-6 py-4">{{ $user->id }}</td>
                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <x-button wire:click="editUser({{ $user->id }})"
                                        class="mr-2 bg-blue-500">Editar</x-button>
                                    <!-- Botón Eliminar -->
                                    <x-danger-button wire:click="confirmDeleteU({{ $user->id }})">
                                        Eliminar
                                    </x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Tabla de Roles -->
            <div class="col-span-2 p-6 bg-white border border-gray-100 rounded-md shadow-md">
                <h3 class="font-medium">Lista de Roles</h3>
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Rol</th>
                            <th class="px-6 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td class="px-6 py-4">{{ $role->id }}</td>
                                <td class="px-6 py-4">{{ $role->name }}</td>
                                <td class="px-6 py-4">
                                    <x-button wire:click="editRole({{ $role->id }})"
                                        class="mr-2 bg-blue-500">Editar</x-button>
                                    <!-- Botón Eliminar -->
                                    <x-danger-button wire:click="confirmDeleteR({{ $role->id }})">
                                        Eliminar
                                    </x-danger-button>
                                    <x-button wire:click="showPermissions({{ $role->id }})"
                                        class="bg-green-500">Mostrar Permisos</x-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para agregar/editar Rol -->
    <x-dialog-modal wire:model="showModalRole" maxWidth="2xl">
        <x-slot name="title">
            {{ $isEditingRole ? 'Editar Rol' : 'Agregar Rol' }}
        </x-slot>

        <x-slot name="content">
            <form>
                <!-- Nombre del Rol -->
                <x-label for="name" value="Nombre del Rol" />
                <x-input id="name" type="text" wire:model="roleName" class="block w-full mt-1" />
                <x-input-error for="roleName" />

                <!-- Permisos -->
                <div class="mt-4">
                    <x-label value="Permisos" />
                    @if ($permissions)
                        <!-- Solo mostrar si hay permisos -->
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                            @foreach ($permissions as $permission)
                                <label class="flex items-center">
                                    <input type="checkbox" value="{{ $permission->id }}"
                                        wire:model="selectedPermissions" />
                                    <span class="ml-2 text-sm text-gray-600">{{ $permission->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    @else
                        <p>No hay permisos disponibles.</p>
                    @endif
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeRoleModal">Cancelar</x-secondary-button>
            <x-button wire:click="{{ $isEditingRole ? 'updateRole' : 'storeRole' }}" class="ml-2">
                {{ $isEditingRole ? 'Actualizar' : 'Registrar' }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Modal para agregar/editar Usuario -->
    <x-dialog-modal wire:model="showModalUser" maxWidth="2xl">
        <x-slot name="title">{{ $isEditingUser ? 'Editar Usuario' : 'Agregar Usuario' }}</x-slot>
        <x-slot name="content">
            <form>
                <!-- Nombre del Usuario -->
                <x-label for="name" value="Nombre del Usuario" />
                <x-input id="name" type="text" wire:model="userName" class="block w-full mt-1" />
                <x-input-error for="userName" />

                <!-- Correo Electrónico -->
                <x-label for="email" value="Correo Electrónico" class="mt-4" />
                <x-input id="email" type="email" wire:model="userEmail" class="block w-full mt-1" />
                <x-input-error for="userEmail" />

                <!-- Contraseña -->
                @if (!$isEditingUser)
                    <x-label for="password" value="Contraseña" class="mt-4" />
                    <x-input id="password" type="password" wire:model="userPassword" class="block w-full mt-1" />
                    <x-input-error for="userPassword" />
                @endif

                <!-- Sucursal -->
                <x-label for="sucursal" value="Sucursal" class="mt-4" />
                <x-select id="sucursal" wire:model="userSucursal" class="block w-full mt-1">
                    <option value="null">Seleccione una sucursal</option>
                    @foreach ($sucursales as $sucursal)
                        <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="userSucursal" />

                <!-- Roles -->
                <x-label for="roles" value="Roles" class="mt-4" />
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($allRoles as $role)
                        <label class="flex items-center">
                            <input type="checkbox" value="{{ $role->id }}" wire:model="selectedRoles" />
                            <span class="ml-2 text-sm text-gray-600">{{ $role->name }}</span>
                        </label>
                    @endforeach
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="closeUserModal">Cancelar</x-secondary-button>
            <x-button wire:click="{{ $isEditingUser ? 'updateUser' : 'storeUser' }}"
                class="ml-2">{{ $isEditingUser ? 'Actualizar' : 'Registrar' }}</x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Modal para mostrar permisos -->
    <x-dialog-modal wire:model="showModalPermissions" maxWidth="2xl">
        <x-slot name="title">{{ __('Permisos del Rol') }}</x-slot>
        <x-slot name="content">
            @if ($verPermissions && $verPermissions->isNotEmpty())
                <ul>
                    @foreach ($verPermissions as $permission)
                        <li>{{ $permission }}</li>
                    @endforeach
                </ul>
            @else
                <p>No hay permisos asignados a este rol.</p>
            @endif
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="closePermissionsModal">Cerrar</x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <x-confirmation-modal wire:model="showConfirmModalCR">
        <x-slot name="title">
            ¿Estás seguro de esta acción?
        </x-slot>

        <x-slot name="content">
            El Rol será eliminado permanentemente.
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showConfirmModalCR')">
                Cancelar
            </x-secondary-button>

            <x-danger-button wire:click="deleteRole" class="ml-2">
                Eliminar
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>

    <x-confirmation-modal wire:model="showConfirmModalCU">
        <x-slot name="title">
            ¿Estás seguro de esta acción?
        </x-slot>

        <x-slot name="content">
            El Usuario será eliminado permanentemente.
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showConfirmModalCU')">
                Cancelar
            </x-secondary-button>

            <x-danger-button wire:click="deleteUser" class="ml-2">
                Eliminar
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
