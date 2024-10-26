<x-confirmation-modal wire:model="showModal">
    <x-slot name="title">
        Eliminar Orden
    </x-slot>
    <x-slot name="content">
        <section>
            <p class="font-medium">
                ¿Estás seguro de que deseas eliminar una Orden 
                <b class="text-red-800 font-bold">{{ $orden->nombre }}</b>?
            </p>
        </section>
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="cerrarModal">
            Cancelar
        </x-secondary-button>
        <x-button class="ml-2" wire:click="confirmarEliminar" wire:loading.attr="disabled">
            Eliminar
        </x-button>
    </x-slot>
</x-confirmation-modal>
