<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        @if (session()->has('message'))
            <div class="mb-4 text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-4">
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
                        <th class="px-6 py-3">Descripción</th>
                        <th class="px-6 py-3">Precio</th>
                        <th class="px-6 py-3">Categoría</th>
                        <th class="px-6 py-3">Estado</th>
                        <th class="px-6 py-3">Sucursal</th>
                        <th class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if($platillos->count() > 0)
                        @foreach ($platillos as $platillo)
                            <tr class="bg-white border-b">
                                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">{{ $platillo->id }}</td>
                                <td scope="row" class="px-6 py-4 whitespace-nowrap">
                                    @if ($platillo->imagen)
                                        <img src="{{ asset('storage/' . $platillo->imagen) }}" alt="Foto del platillo" class="w-16 h-16 rounded">
                                    @else
                                        <span>No hay imagen</span>
                                    @endif
                                </td>
                                <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ $platillo->nombre }}</td>
                                <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ $platillo->descripcion }}</td>
                                <td scope="row" class="px-6 py-4 whitespace-nowrap">S/. {{ number_format($platillo->precio, 2) }}</td>
                                <td scope="row" class="px-6 py-4 capitalize whitespace-nowrap">{{ $platillo->categoria }}</td>
                                <td scope="row" class="px-6 py-4 capitalize whitespace-nowrap">{{ $platillo->estado }}</td>
                                <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ $platillo->sucursal->nombre }}</td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <x-button wire:click="editPlatillo({{ $platillo->id }})">
                                        Editar
                                    </x-button>
                                    <x-danger-button wire:click="confirmDelete({{ $platillo->id }})">
                                        Eliminar
                                    </x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="px-6 py-4 text-center" colspan="10">No se ha registrado ningún platillo</td>
                        </tr>
                    @endif
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
                <x-input id="nombre" type="text" wire:model="nombre" class="mt-1 block w-full" />
                <x-input-error for="nombre" />

                <x-label for="descripcion" value="Descripción / Ingredientes" class="mt-4" />
                <x-input id="descripcion" type="text" wire:model="descripcion" class="mt-1 block w-full" />
                <x-input-error for="descripcion" />

                <x-label for="precio" value="Precio" class="mt-4" />
                <x-input id="precio" type="number" step="0.01" wire:model="precio" class="mt-1 block w-full" />
                <x-input-error for="precio" />

                <x-label for="imagen" value="Foto del Platillo" class="mt-4" />
                <input type="file" wire:model="imagen" id="imagen" class="mt-1 block w-full">
                <x-input-error for="imagen" />
                @if ($imagen && is_object($imagen))
                    <img src="{{ $imagen->temporaryUrl() }}" alt="Vista previa" class="mt-2 w-16 h-16 rounded">
                @elseif ($isEditing && $imagenActual)
                    <img src="{{ asset('storage/' . $imagenActual) }}" alt="Imagen actual" class="mt-2 w-16 h-16 rounded">
                @endif

                <x-label for="categoria" value="Categoría" class="mt-4" />
                <x-dropdown width="full" wire:model="categoria" dropdownClasses="mt-2">
                    <x-slot name="trigger">
                        <x-input id="categoria_input" type="text" wire:model="categoria" readonly class="cursor-pointer mt-1 block w-full" placeholder="Seleccione una categoría" />
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link wire:click="$set('categoria', 'principal')">Principal</x-dropdown-link>
                        <x-dropdown-link wire:click="$set('categoria', 'entrada')">Entrada</x-dropdown-link>
                        <x-dropdown-link wire:click="$set('categoria', 'postre')">Postre</x-dropdown-link>
                        <x-dropdown-link wire:click="$set('categoria', 'bebida')">Bebida</x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                <x-input-error for="categoria" />

                <x-label for="estado" value="Estado" class="mt-4" />
                <x-dropdown width="full" wire:model="estado" dropdownClasses="mt-2">
                    <x-slot name="trigger">
                        <x-input id="estado_input" type="text" wire:model="estado" readonly class="cursor-pointer mt-1 block w-full" placeholder="Seleccione el estado" />
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link wire:click="$set('estado', 'Disponible')">Disponible</x-dropdown-link>
                        <x-dropdown-link wire:click="$set('estado', 'No disponible')">No disponible</x-dropdown-link>
                    </x-slot>
                </x-dropdown>

                <x-input-error for="estado" />

                <x-label for="comentario" value="Comentario" class="mt-4" />
                <textarea id="comentario" wire:model="comentario" class="mt-1 block w-full" rows="3"></textarea>
                <x-input-error for="comentario" />

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
