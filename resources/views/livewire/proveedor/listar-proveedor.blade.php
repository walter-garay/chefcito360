<div class="relative overflow-x-auto">
    <table class="table_id min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th scope="col" class="px-6 py-4">Nombre</th>
                <th scope="col" class="px-6 py-4">Teléfono</th>
                <th scope="col" class="px-6 py-4">Dirección</th>
                <th scope="col" class="px-6 py-4">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if($proveedores->count() > 0)
                @foreach ($proveedores as $proveedor)
                    <tr class="bg-white border-b text-center">
                        <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">{{ $proveedor->nombre }}</td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ $proveedor->celular }}</td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ $proveedor->direccion }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <x-icon class="px-2 h-7 bg-violet-900" wire:click="editar({{ $proveedor->id }})">
                                <i class="fa-sharp-duotone fa-solid fa-pencil"></i>
                            </x-icon>
                            <x-icon class="px-2 h-7 bg-red-800" wire:click="eliminar({{ $proveedor->id }})">
                                <i class="fa-sharp-duotone fa-solid fa-trash-can"></i>
                            </x-icon>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="px-6 py-4 text-center" colspan="7">No se ha registrado ningún proveedor</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
