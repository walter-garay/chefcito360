<div>
    <div class="flex justify-center">
        <x-button class="px-3 py-3 uppercase" wire:click="abrirModal" wire:loading.attr="disabled">
            Agregar Mesa
        </x-button>
    </div>

    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            Agregar Mesa
        </x-slot>
        <x-slot name="content">
            <section>
                <form wire:submit.prevent="guardarMesa">
                    <div class="mt-4">
                        <x-label for="numero" value="Número de Mesa" />
                        <x-input id="numero" wire:model="numero" type="text" class="mt-1 block w-full" />
                        <x-input-error for="numero" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-label for="mesas_estado" value="Estado" class="mb-2" />
                        <x-select wire:model="mesas_estado" class="w-full">
                            <option value="">Seleccione...</option>
                            <option value="{{ \App\Livewire\Mesas\CrearMesa::ESTADO_DISPONIBLE }}">Disponible</option>
                            <option value="{{ \App\Livewire\Mesas\CrearMesa::ESTADO_OCUPADA }}">Ocupada</option>
                            <option value="{{ \App\Livewire\Mesas\CrearMesa::ESTADO_RESERVADA }}">Reservada</option>
                        </x-select>
                        <x-input-error for="mesas_estado" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-label for="sucursal_id" value="Sucursal" />
                        <x-select wire:model="sucursal_id" class="w-full">
                            <option value="">Seleccione una sucursal...</option>
                            @foreach($sucursales as $sucursal)
                                <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="sucursal_id" class="mt-2" />
                    </div>
                </form>
            </section>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="cerrarModal">
                Cancelar
            </x-secondary-button>
            <x-button class="ml-2" wire:click="guardarMesa" wire:loading.attr="disabled">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
