<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Ordenes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    @livewire('ordenes.crear-orden')
                </div>
                @livewire('ordenes.listar-orden')
            </div>
        </div>
    </div>  

    @livewire('ordenes.editar-orden')
    @livewire('ordenes.eliminar-orden')

</x-app-layout>
