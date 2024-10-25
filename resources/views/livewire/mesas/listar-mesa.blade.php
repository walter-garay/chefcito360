<div>
    @if(session()->has('message'))
        <div class="bg-green-500 text-white p-3 rounded-lg mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="relative overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th scope="col" class="px-6 py-4 text-left">Número</th>
                    <th scope="col" class="px-6 py-4 text-left">Estado</th>
                    <th scope="col" class="px-6 py-4 text-left">Sucursal</th>
                    <th scope="col" class="px-6 py-4 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if($mesas->count() > 0)
                    @foreach ($mesas as $mesa)
                        <tr class="bg-white border-b">
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">{{ $mesa->numero }}</td>
                            <td scope="row" class="px-6 py-4 whitespace-nowrap">
                                @switch($mesa->mesas_estado)
                                    @case(1)
                                        Disponible
                                        @break
                                    @case(2)
                                        Ocupada
                                        @break
                                    @case(3)
                                        Reservada
                                        @break
                                @endswitch
                            </td>
                            <td scope="row" class="px-6 py-4 whitespace-nowrap">
                                {{ $mesa->sucursal->nombre ?? 'Sucursal no asignada' }}
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                <x-icon class="px-2 h-7 bg-violet-900 cursor-pointer" wire:click="editar({{ $mesa->id }})" title="Editar">
                                    <i class="fa-solid fa-pencil"></i>
                                </x-icon>
                                <x-icon class="px-2 h-7 bg-red-800 cursor-pointer" wire:click="eliminar({{ $mesa->id }})" title="Eliminar">
                                    <i class="fa-solid fa-trash-can"></i>
                                </x-icon>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="px-6 py-4 text-center" colspan="4">No se ha registrado ninguna mesa</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
