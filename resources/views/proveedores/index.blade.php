<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Proveedores
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    @livewire('proveedor.crear-proveedor')
                </div>
                @livewire('proveedor.listar-proveedor')
            </div>
        </div>
    </div>
    @livewire('proveedor.editar-proveedor')
    @livewire('proveedor.eliminar-proveedor')
</x-app-layout>
