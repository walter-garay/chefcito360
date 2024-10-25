<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        @if (session()->has('message'))
            <div class="mb-4 text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <x-button wire:click="openModal" class="mr-2 bg-blue-600 hover:bg-blue-700">
                Agregar Producto
            </x-button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3">#</th>
                        <th class="px-6 py-3">Nombre</th>
                        <th class="px-6 py-3">Descripción</th>
                        <th class="px-6 py-3">Precio Compra</th>
                        <th class="px-6 py-3">Precio Venta</th>
                        <th class="px-6 py-3">Stock</th>
                        <th class="px-6 py-3">Categoría</th>
                        <th class="px-6 py-3">Sucursal</th>
                        <th class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if($productos->count() > 0)
                        @foreach ($productos as $producto)
                            <tr>
                                <td class="px-6 py-4">{{ $producto->id }}</td>
                                <td class="px-6 py-4">{{ $producto->nombre }}</td>
                                <td class="px-6 py-4">{{ $producto->descripcion }}</td>
                                <td class="px-6 py-4">S/. {{ number_format($producto->precio_c, 2) }}</td>
                                <td class="px-6 py-4">S/. {{ number_format($producto->precio_v, 2) }}</td>
                                <td class="px-6 py-4">{{ $producto->stock }}</td>
                                <td class="px-6 py-4">{{ $producto->categoria }}</td>
                                <td class="px-6 py-4">{{ $producto->sucursal->nombre }}</td>
                                <td class="px-6 py-6 flex">
                                    <x-button wire:click="editProducto({{ $producto->id }})" class="w-8 h-8 flex justify-center">
                                        <i class="fa-sharp-duotone fa-solid fa-pencil"></i>
                                    </x-button>
                                    <x-danger-button wire:click="confirmDelete({{ $producto->id }})" class="w-8 h-8 flex justify-center">
                                        <i class="fa-sharp-duotone fa-solid fa-trash-can"></i>
                                    </x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center">No se ha registrado ningún producto</td>
                        </tr>
                    @endif
                </tbody>

            </table>
        </div>
    </div>

    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            {{ $isEditing ? 'Editar Producto' : 'Agregar Producto' }}
        </x-slot>

        <x-slot name="content">
            <form>
                <x-label for="nombre" value="Nombre del Producto" />
                <x-input id="nombre" type="text" wire:model="nombre" class="mt-1 block w-full" />
                <x-input-error for="nombre" />

                <x-label for="descripcion" value="Descripción" class="mt-4" />
                <x-input id="descripcion" type="text" wire:model="descripcion" class="mt-1 block w-full" />
                <x-input-error for="descripcion" />

                <x-label for="precio_c" value="Precio de Compra" class="mt-4" />
                <x-input id="precio_c" type="number" step="0.01" wire:model="precio_c" class="mt-1 block w-full" />
                <x-input-error for="precio_c" />

                <x-label for="precio_v" value="Precio de Venta" class="mt-4" />
                <x-input id="precio_v" type="number" step="0.01" wire:model="precio_v" class="mt-1 block w-full" />
                <x-input-error for="precio_v" />

                <x-label for="stock" value="Stock" class="mt-4" />
                <x-input id="stock" type="number" wire:model="stock" class="mt-1 block w-full" />
                <x-input-error for="stock" />

                <x-label for="categoria" value="Categoría" class="mt-4" />
                <x-input id="categoria" type="text" wire:model="categoria" class="mt-1 block w-full" />
                <x-input-error for="categoria" />

                <x-label for="sucursal_id" value="Sucursal" class="mt-4" />
                <x-dropdown width="full" wire:model="sucursal_id">
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
            El producto será eliminado permanentemente.
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
