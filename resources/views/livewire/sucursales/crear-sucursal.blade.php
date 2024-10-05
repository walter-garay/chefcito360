<div>
    <div class="flex justify-center">
        <x-button class="px-3 py-3 uppercase" wire:click="abrirModal" wire:loading.attr="disabled">
            Agregar Sucursal
        </x-button>
    </div>
    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            Agregar Sucursal
        </x-slot>
        <x-slot name="content">
            <section>
                <form wire:submit.prevent="guardarSucursal">
                    <div class="mt-4">
                        <x-label for="nombre" value="Nombre" />
                        <x-input id="nombre" wire:model="nombre" type="text" class="mt-1 block w-full" />
                        <x-input-error for="nombre" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-label for="tipo_sucursal" value="Tipo de Sucursal" class="mb-2" />
                        <x-select wire:model="tipo_sucursal" class="w-full">
                            <option value="">Seleccione...</option>
                            <option value="Central">Sucursal Central</option>
                            <option value="Secundaria">Sucursal Secundaria</option>
                        </x-select>
                        <x-input-error for="tipo_sucursal" class="mt-2" />
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center">
                        <div class="sm:w-1/2">
                            <x-label for="celular" value="Telefono" />
                            <x-input id="celular" wire:model="celular" type="text" class="block mt-1 w-full" />
                            <x-input-error for="celular" class="mt-2" />
                        </div>
                        <div class="sm:w-1/2">
                            <x-label for="direccion" value="Dirección" />
                            <x-input id="direccion" wire:model="direccion" type="text" class="block mt-1  w-full" />
                            <x-input-error for="direccion" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center ">
                        <div class="sm:w-1/2">
                            <x-label for="whatsapp" value="WhatsApp" />
                            <x-input id="whatsapp" wire:model="whatsapp" type="text" class="mt-1 block w-full" />
                            <x-input-error for="whatsapp" class="mt-2" />
                        </div>
                        <div class="sm:w-1/2">
                            <x-label for="serie" value="Serie" />
                            <x-input id="serie" wire:model="serie" type="text" class="mt-1 block w-full" />
                            <x-input-error for="serie" class="mt-2" />
                        </div>
                    </div>
                </form>
            </section>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="cerrarModal">
                Cancelar
            </x-secondary-button>
            <x-button class="ml-2" wire:click="guardarSucursal" wire:loading.attr="disabled">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
