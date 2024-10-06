<div>
    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            Editar Proveedor
        </x-slot>
        <x-slot name="content">
            <section>
                <form wire:submit.prevent="actualizarProveedor">
                    <div class="mt-4">
                        <x-label for="nombre" value="Nombre" />
                        <x-input id="nombre" wire:model="nombre" type="text" class="mt-1 block w-full" />
                        <x-input-error for="nombre" class="mt-2" />
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center">
                        <div class="sm:w-1/2">
                            <x-label for="celular" value="Teléfono" />
                            <x-input id="celular" wire:model="celular" type="text" class="block mt-1 w-full" />
                            <x-input-error for="celular" class="mt-2" />
                        </div>
                        <div class="sm:w-1/2">
                            <x-label for="direccion" value="Dirección" />
                            <x-input id="direccion" wire:model="direccion" type="text" class="block mt-1  w-full" />
                            <x-input-error for="direccion" class="mt-2" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-label for="correo" value="Correo Electrónico" />
                        <x-input id="correo" wire:model="correo" type="email" class="mt-1 block w-full" />
                        <x-input-error for="correo" class="mt-2" />
                    </div>
                </form>
            </section>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="cerrarModal">
                Cancelar
            </x-secondary-button>
            <x-button class="ml-2" wire:click="actualizarProveedor" wire:loading.attr="disabled">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
