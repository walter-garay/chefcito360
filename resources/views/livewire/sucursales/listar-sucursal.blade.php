<div class="relative overflow-x-auto">
    <table class="table_id min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th scope="col" class="px-6 py-3">Nombre</th>
                <th scope="col" class="px-6 py-3">Tipo de Sucursal</th>
                <th scope="col" class="px-6 py-3">Telefono</th>
                <th scope="col" class="px-6 py-3">Dirección</th>
                <th scope="col" class="px-6 py-3">WhatsApp</th>
                <th scope="col" class="px-6 py-3">Serie</th>
                <th scope="col" class="px-6 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if ($sucursales->count() > 0)
                @foreach ($sucursales as $sucursal)
                    <tr class="bg-white border-b">
                        <td scope="rol" class="px-6 py-4 font-medium whitespace-nowrap">{{ $sucursal->nombre }}</td>
                        <td scope="rol" class="px-6 py-4 whitespace-nowrap">{{ $sucursal->tipo_sucursal }}</td>
                        <td scope="rol" class="px-6 py-4 whitespace-nowrap">{{ $sucursal->celular }}</td>
                        <td scope="rol" class="px-6 py-4 whitespace-nowrap">{{ $sucursal->direccion }}</td>
                        <td scope="rol" class="px-6 py-4 whitespace-nowrap ">{{ $sucursal->whatsapp }}</td>
                        <td scope="rol" class="px-6 py-4 whitespace-nowrap ">{{ $sucursal->serie }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <x-icon class="px-2 h-7 bg-cyan-800">
                                <i class="fa-sharp-duotone fa-solid fa-eye"></i>
                            </x-icon>
                            <x-icon class="px-2 h-7 bg-violet-900">
                                <i class="fa-sharp-duotone fa-solid fa-pencil"></i>
                            </x-icon>
                            <x-icon class="px-2 h-7 bg-red-800">
                                <i class="fa-sharp-duotone fa-solid fa-trash-can"></i>
                            </x-icon>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center">No hay sucursales registradas</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>