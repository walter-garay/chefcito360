<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        @if (session()->has('message'))
            <div class="mb-4 text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <!-- Botón para abrir el modal de agregar platillo -->
            <x-button wire:click="openModal">
                Agregar Platillo
            </x-button>
        </div>

        <!-- Tabla de platillos -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Nombre</th>
                        <th class="px-6 py-3">Descripción</th>
                        <th class="px-6 py-3">Precio</th>
                        <th class="px-6 py-3">Categoría</th>
                        <th class="px-6 py-3">Sucursal</th>
                        <th class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($platillos as $platillo)
                        <tr>
                            <td class="px-6 py-4">{{ $platillo->id }}</td>
                            <td class="px-6 py-4">{{ $platillo->nombre }}</td>
                            <td class="px-6 py-4">{{ $platillo->descripcion }}</td>
                            <td class="px-6 py-4">S/. {{ number_format($platillo->precio, 2) }}</td>
                            <td class="px-6 py-4 capitalize">{{ $platillo->categoria }}</td>
                            <td class="px-6 py-4">{{ $platillo->sucursal->nombre }}</td>
                            <td class="px-6 py-4">
                                <!-- Botón Editar -->
                                <x-button wire:click="editPlatillo({{ $platillo->id }})" class="mr-2 bg-blue-500 hover:bg-blue-600">
                                    Editar
                                </x-button>

                                <!-- Botón Eliminar -->
                                <x-button wire:click="deletePlatillo({{ $platillo->id }})" class="bg-red-500 hover:bg-red-600">
                                    Eliminar
                                </x-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para agregar y editar un platillo -->
    <x-dialog-modal wire:model="showModal" id="platilloModal" maxWidth="2xl">
        <x-slot name="title">
            {{ $isEditing ? 'Editar Platillo' : 'Agregar Platillo' }}
        </x-slot>

        <x-slot name="content">
            <!-- Formulario para agregar o editar platillo -->
            <form>
                <!-- Nombre -->
                <x-label for="nombre" value="Nombre del Platillo" />
                <x-input id="nombre" type="text" wire:model="nombre" class="mt-1 block w-full" />
                <x-input-error for="nombre" />

                <!-- Descripción -->
                <x-label for="descripcion" value="Descripción" class="mt-4" />
                <x-input id="descripcion" type="text" wire:model="descripcion" class="mt-1 block w-full" />
                <x-input-error for="descripcion" />

                <!-- Precio -->
                <x-label for="precio" value="Precio" class="mt-4" />
                <x-input id="precio" type="number" step="0.01" wire:model="precio" class="mt-1 block w-full" />
                <x-input-error for="precio" />

                <!-- Categoría usando dropdown -->
                <x-label for="categoria" value="Categoría" class="mt-4" />
                <x-dropdown width="48" wire:model="categoria" dropdownClasses="mt-2">
                    <x-slot name="trigger">
                        <x-input id="categoria_input" type="text" wire:model="categoria" readonly class="cursor-pointer mt-1 block w-full" placeholder="Seleccione una categoría" />
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link wire:click="$set('categoria', 'entrada')">
                            Entrada
                        </x-dropdown-link>
                        <x-dropdown-link wire:click="$set('categoria', 'principal')">
                            Principal
                        </x-dropdown-link>
                        <x-dropdown-link wire:click="$set('categoria', 'postre')">
                            Postre
                        </x-dropdown-link>
                        <x-dropdown-link wire:click="$set('categoria', 'bebida')">
                            Bebida
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                <x-input-error for="categoria" />

                <!-- Sucursal usando dropdown -->
                <x-label for="sucursal_id" value="Sucursal" class="mt-4" />
                <x-dropdown width="48" wire:model="sucursal_id" dropdownClasses="mt-2">
                    <x-slot name="trigger">
                        <x-input id="sucursal_input" type="text" wire:model="sucursal_id" readonly class="cursor-pointer mt-1 block w-full" placeholder="Seleccione una sucursal" />
                    </x-slot>
                    <x-slot name="content">
                        @foreach ($sucursales as $sucursal)
                            <x-dropdown-link wire:click="$set('sucursal_id', {{ $sucursal->id }})">
                                {{ $sucursal->nombre }}
                            </x-dropdown-link>
                        @endforeach
                    </x-slot>
                </x-dropdown>
                <x-input-error for="sucursal_id" />
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal">
                Cancelar
            </x-secondary-button>

            <x-button wire:click="{{ $isEditing ? 'update' : 'store' }}" class="ml-2">
                {{ $isEditing ? 'Guardar Cambios' : 'Guardar' }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
