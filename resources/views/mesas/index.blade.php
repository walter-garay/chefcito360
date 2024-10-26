<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Mesas
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    @livewire('mesas.crear-mesa') <!-- Componente para crear mesas -->
                </div>
                @livewire('mesas.listar-mesa') <!-- Componente para listar mesas -->
            </div>
        </div>
    </div>
    @livewire('mesas.editar-mesa') <!-- Componente para editar mesas -->
    @livewire('mesas.eliminar-mesa') <!-- Componente para eliminar mesas -->
</x-app-layout>
