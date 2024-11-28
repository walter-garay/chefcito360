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

            <div class="flex gap-x-2">
                <!-- Select para filtrar por categoría -->
                <div>
                    <select wire:model="categoriaSeleccionada" class="px-3 py-1 border border-gray-300 rounded-md">
                        <option value="">CategorÍas</option>
                        <option value="Bebidas">Bebidas</option>
                        <option value="Alimentos">Alimentos</option>
                        <option value="Utensilios">Utensilios</option>
                    </select>
                </div>

                <x-button  wire:click="exportar" class="bg-green-600 hover:bg-green-700">
                    Exportar
                </x-button>

                <!-- Formulario de Importación -->
                <form wire:submit.prevent="importar" enctype="multipart/form-data" class="flex items-center gap-2">
                    <!-- Input de archivo oculto -->
                    <input type="file" wire:model="file" id="fileInput" class="hidden" />

                    <!-- Botón de Importación -->
                    <x-button type="submit" class="bg-purple-500 hover:bg-purple-600">
                        Importar
                    </x-button>

                    <!-- Ícono para abrir el explorador de archivos -->
                    <label for="fileInput" class="cursor-pointer">
                        <div class="bg-violet-400 hover:bg-violet-500 flex items-center justify-center p-2 rounded">
                            <i class="fas fa-plus"></i>
                        </div>
                    </label>
                </form>
            </div>

        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Nombre</th>
                    <th class="px-6 py-3">Compra</th>
                    <th class="px-6 py-3">Venta</th>
                    <th class="px-6 py-3">Stock</th>
                    <th class="px-6 py-3">Categoría</th>
                    <th class="px-6 py-3">Sucursal</th>
                    <th class="px-6 py-3">Proveedor</th> <!-- Nueva columna -->
                    <th class="px-6 py-3">Ingreso</th>
                    <th class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if($productos->count() > 0)
                    @foreach ($productos as $producto)
                        <tr>
                            <td class="px-6 py-4">{{ $producto->id }}</td>
                            <td class="px-6 py-4">{{ $producto->nombre }}</td>
                            <td class="px-6 py-4">S/. {{ number_format($producto->precio_c, 2) }}</td>
                            <td class="px-6 py-4">S/. {{ number_format($producto->precio_v, 2) }}</td>
                            <td class="px-6 py-4">{{ $producto->stock }}</td>
                            <td class="px-6 py-4">{{ $producto->categoria }}</td>
                            <td class="px-6 py-4">{{ $producto->sucursal->nombre }}</td>
                            <td class="px-6 py-4">{{ $producto->proveedor->nombre ?? 'Sin asignar' }}</td> <!-- Mostrar proveedor -->
                            <td class="px-6 py-4">{{ date('d/m/Y', strtotime($producto->created_at)) }}</td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                <x-icon class="px-2 h-7 bg-violet-900" wire:click="editProducto({{ $producto->id }})">
                                    <i class="fa-sharp-duotone fa-solid fa-pencil"></i>
                                </x-icon>
                                <x-icon class="px-2 h-7 bg-red-900" wire:click="confirmDelete({{ $producto->id }})">
                                    <i class="fa-sharp-duotone fa-solid fa-trash-can"></i>
                                </x-icon>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10" class="px-6 py-4 text-center">No se ha registrado ningún producto</td>
                    </tr>
                @endif
            </tbody>

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

                <!-- Agrupación de Precio de Compra, Precio de Venta y Stock -->
                <div class="mt-4 grid grid-cols-3 gap-4">
                    <!-- Precio de Compra -->
                    <div>
                        <x-label for="precio_c" value="Precio de Compra" />
                        <x-input id="precio_c" type="number" step="0.01" wire:model="precio_c" class="mt-1 block w-full" />
                        <x-input-error for="precio_c" />
                    </div>

                    <!-- Precio de Venta -->
                    <div>
                        <x-label for="precio_v" value="Precio de Venta" />
                        <x-input id="precio_v" type="number" step="0.01" wire:model="precio_v" class="mt-1 block w-full" />
                        <x-input-error for="precio_v" />
                    </div>

                    <!-- Stock -->
                    <div>
                        <x-label for="stock" value="Stock" />
                        <x-input id="stock" type="number" wire:model="stock" class="mt-1 block w-full" />
                        <x-input-error for="stock" />
                    </div>
                </div>

                <x-label for="categoria" value="Categoría" class="mt-4" />
                <x-input id="categoria" type="text" wire:model="categoria" class="mt-1 block w-full" />
                <x-input-error for="categoria" />

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

                <x-label for="proveedor_id" value="Proveedor" class="mt-4" />
                <x-dropdown width="full" wire:model="proveedor_id">
                    <x-slot name="trigger">
                        <x-input id="proveedor_input" type="text" value="{{ $proveedores->find($proveedor_id)->nombre ?? 'Seleccione un proveedor' }}" readonly class="cursor-pointer mt-1 block w-full" />
                    </x-slot>
                    <x-slot name="content">
                        @foreach ($proveedores as $proveedor)
                            <x-dropdown-link wire:click="$set('proveedor_id', {{ $proveedor->id }})">
                                {{ $proveedor->nombre }}
                            </x-dropdown-link>
                        @endforeach
                    </x-slot>
                </x-dropdown>
                <x-input-error for="proveedor_id" />

                <!-- Fecha de ingreso -->
                @if ($isEditing)
                    <x-label for="fecha_ingreso" value="Fecha de Ingreso" class="mt-4" />
                    <x-input id="fecha_ingreso" type="text" wire:model="fecha_ingreso" class="mt-1 block w-full" readonly />
                @endif

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
