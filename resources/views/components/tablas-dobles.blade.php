<div>
    <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-2">
        <div class="col-span-2 p-6 bg-white border border-gray-100 rounded-md shadow-md shadow-black/5">
            <div class="flex items-start justify-between mb-4">
                <div class="font-medium">{{ $title }}</div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3">ID </th>
                            <th class="px-6 py-3">name</th>
                            <th class="px-6 py-3">correo</th>
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
                                    <!-- Botón Editar -->
                                    <x-button wire:click="editUser({{ $user->id }})" class="mr-2 bg-blue-500 hover:bg-blue-600">
                                        Editar
                                    </x-button>

                                    <!-- Botón Eliminar -->
                                    <x-button wire:click="deleteUser({{ $user->id }})" class="bg-red-500 hover:bg-red-600">
                                        Eliminar
                                    </x-button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $tabla }}
            </div>
        </div>
        <div class="col-span-2 p-6 bg-white border border-gray-100 rounded-md shadow-md shadow-black/5">
            <div class="flex items-start justify-between mb-4">
                <div class="font-medium">{{ $title }} Lista de Roles</div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">name</th>
                            <th class="px-6 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td class="px-6 py-4">{{ $role->id }}</td>
                                <td class="px-6 py-4">{{ $role->name }}</td>
                                <td class="px-6 py-4">
                                    <!-- Botón Editar -->
                                    <x-button wire:click="editRole({{ $role->id }})" class="mr-2 bg-blue-500 hover:bg-blue-600">
                                        Editar
                                    </x-button>

                                    <!-- Botón Eliminar -->
                                    <x-button wire:click="deleteRole({{ $role->id }})" class="bg-red-500 hover:bg-red-600">
                                        Eliminar
                                    </x-button>

                                    <!-- Botón Mostrar Permisos -->
                                    <x-button wire:click="$emit('showPermissions', {{ $role->id }})" class="bg-green-500 hover:bg-green-600">
                                        Mostrar Permisos
                                    </x-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $tabla }}
            </div>
        </div>
    </div>
</div>
