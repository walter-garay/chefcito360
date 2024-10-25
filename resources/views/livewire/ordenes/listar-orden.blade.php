<div class="relative overflow-x-auto">
    <table class="table_id min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th scope="col" class="px-6 py-4">Número de Orden</th>
                <th scope="col" class="px-6 py-4">Total</th>
                <th scope="col" class="px-6 py-4">Mesa</th>
                <th scope="col" class="px-6 py-4">Mesero</th>
                <th scope="col" class="px-6 py-4">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if($ordenes->count() > 0)
                @foreach ($ordenes as $orden)
                    <tr class="bg-white border-b text-center">
                        <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">{{ $orden->numero }}</td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ number_format($orden->total, 2) }}</td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ $orden->numero_mesa }}</td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ $orden->usuario }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <x-icon class="px-2 h-7 bg-violet-900" wire:click="editar({{ $orden->id }})">
                                <i class="fa-sharp-duotone fa-solid fa-pencil"></i>
                            </x-icon>
                            <x-icon class="px-2 h-7 bg-red-800" wire:click="eliminar({{ $orden->id }})">
                                <i class="fa-sharp-duotone fa-solid fa-trash-can"></i>
                            </x-icon>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="px-6 py-4 text-center" colspan="5">No se ha registrado ninguna orden</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
