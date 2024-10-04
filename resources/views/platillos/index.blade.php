<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Platillos') }}
        </h2>
    </x-slot>

    <!-- Incluir el componente Livewire para la tabla de platillos -->
    @livewire('platillos.platillo-table')
</x-app-layout>
