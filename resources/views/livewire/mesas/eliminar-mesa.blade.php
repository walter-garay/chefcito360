<div>
    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            Confirmar Eliminación
        </x-slot>
        <x-slot name="content">
            <p>¿Está seguro de que desea eliminar la mesa <strong>{{ $mesa->numero }}</strong>?</p>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="cerrarModal">
                Cancelar
            </x-secondary-button>
            <x-button class="ml-2" wire:click="confirmarEliminar" wire:loading.attr="disabled">
                Confirmar
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
