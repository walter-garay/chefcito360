<div class="mx-auto mt-8 max-w-7xl sm:px-6 lg:px-8">
    <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
        @if (session()->has('message'))
            <div class="mb-4 text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <div class="flex items-center justify-between mb-4">
            <!-- Botón para abrir el modal de agregar platillo -->
            <x-button wire:click="openModal" class="mr-2 bg-blue-600 hover:bg-blue-700">
                Agregar platillo
            </x-button>
        </div>

        <!-- Tabla de platillos -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3">#</th>
                        <th class="px-6 py-3">Foto</th>
                        <th class="px-6 py-3">Nombre</th>
                        <th class="px-6 py-3">Precio</th>
                        <th class="px-6 py-3">Categoría</th>
                        <th class="px-6 py-3">Estado</th>
                        <th class="px-6 py-3">Sucursal</th>
                        <th class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($platillos as $platillo)
                        <tr>
                            <td class="px-6 py-4">{{ $platillo->id }}</td>
                            <td class="px-6 py-4">
                                @if ($platillo->imagen)
                                    <img src="{{ asset('storage/' . $platillo->imagen) }}" alt="Foto del platillo" class="w-16 h-16 rounded">
                                @else
                                    <span>No hay imagen</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $platillo->nombre }}</td>
                            <td class="px-6 py-4">S/. {{ number_format($platillo->precio, 2) }}</td>
                            <td class="px-6 py-4 capitalize">{{ $platillo->categoria }}</td>
                            <td class="px-6 py-4 capitalize">{{ $platillo->estado }}</td>
                            <td class="px-6 py-4">{{ $platillo->sucursal->nombre }}</td>
                            <td class="px-6 py-4">
                                <!-- Botón Editar -->
                                <x-icon wire:click="editPlatillo({{ $platillo->id }})" class="px-2 h-7 bg-violet-900" >
                                    <i class="fa-sharp-duotone fa-solid fa-pencil"></i>
                                </x-icon>

                                <!-- Botón Eliminar -->
                                <x-icon wire:click="confirmDelete({{ $platillo->id }})" class="px-2 h-7 bg-red-900" >
                                    <i class="fa-sharp-duotone fa-solid fa-trash-can"></i>
                                </x-icon>
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
            <form>
                <x-label for="nombre" value="Nombre del Platillo" />
                <x-input id="nombre" type="text" wire:model="nombre" class="block w-full mt-1" />
                <x-input-error for="nombre" />

                <x-label for="descripcion" value="Descripción / Ingredientes" class="mt-4" />
                <x-input id="descripcion" type="text" wire:model="descripcion" class="mt-1 block w-full" />
                <x-input-error for="descripcion" />

                <x-label for="precio" value="Precio" class="mt-4" />
                <x-input id="precio" type="number" step="0.01" wire:model="precio" class="block w-full mt-1" />
                <x-input-error for="precio" />

                <x-label for="imagen" value="Foto del Platillo" class="mt-4" />
                <input type="file" wire:model="imagen" id="imagen" class="block w-full mt-1">
                <x-input-error for="imagen" />
                @if ($imagen && is_object($imagen))
                    <img src="{{ $imagen->temporaryUrl() }}" alt="Vista previa" class="mt-2 w-16 h-16 rounded">
                @elseif ($isEditing && $imagenActual)
                    <img src="{{ asset('storage/' . $imagenActual) }}" alt="Imagen actual" class="w-16 h-16 mt-2 rounded">
                @endif

                <x-label for="categoria" value="Categoría" class="mt-4" />
                <x-dropdown width="full" wire:model="categoria" dropdownClasses="mt-2">
                    <x-slot name="trigger">
                        <x-input id="categoria_input" type="text" wire:model="categoria" readonly class="block w-full mt-1 cursor-pointer" placeholder="Seleccione una categoría" />
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link wire:click="$set('categoria', 'principal')">Principal</x-dropdown-link>
                        <x-dropdown-link wire:click="$set('categoria', 'entrada')">Entrada</x-dropdown-link>
                        <x-dropdown-link wire:click="$set('categoria', 'postre')">Postre</x-dropdown-link>
                        <x-dropdown-link wire:click="$set('categoria', 'bebida')">Bebida</x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                <x-input-error for="categoria" />

                <!-- Estado del Platillo -->
                <x-label for="estado" value="Estado" class="mt-4" />
                <x-dropdown width="full" wire:model="estado" dropdownClasses="mt-2">
                    <x-slot name="trigger">
                        <x-input id="estado_input" type="text" wire:model="estado" readonly class="block w-full mt-1 cursor-pointer" placeholder="Seleccione el estado" />
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link wire:click="$set('estado', 'Disponible')">Disponible</x-dropdown-link>
                        <x-dropdown-link wire:click="$set('estado', 'No disponible')">No disponible</x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                <x-input-error for="estado" />

                <!-- Sucursal usando dropdown -->
                <x-label for="sucursal_id" value="Sucursal" class="mt-4" />
                <x-dropdown width="full" wire:model.defer="sucursal_id" dropdownClasses="mt-2">
                    <x-slot name="trigger">
                        <x-input id="sucursal_input" type="text" value="{{ $sucursales->find($sucursal_id)->nombre ?? 'Seleccione una sucursal' }}" readonly class="cursor-pointer mt-1 block w-full" />
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


    <x-confirmation-modal wire:model="showConfirmModal">
        <x-slot name="title">
            ¿Estás seguro de esta acción?
        </x-slot>

        <x-slot name="content">
            El platillo será eliminado permanentemente.
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showConfirmModal')">
                Cancelar
            </x-secondary-button>

            <x-danger-button wire:click="deleteConfirmed" class="ml-2">
                Eliminar
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
