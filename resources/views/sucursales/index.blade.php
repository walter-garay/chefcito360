<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Sucursales
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    @livewire('sucursales.crear-sucursal')
                </div>
                @livewire('sucursales.listar-sucursal')
            </div>
        </div>
    </div>
    
</x-app-layout>
