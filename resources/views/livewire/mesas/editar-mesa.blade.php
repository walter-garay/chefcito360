<div>
    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            Editar Mesa
        </x-slot>
        <x-slot name="content">
            <section>
                <form wire:submit.prevent="actualizarMesa"> <!-- Cambié a actualizarMesa -->
                    <div class="mt-4">
                        <x-label for="numero" value="Número de la Mesa" />
                        <x-input id="numero" wire:model="numero" type="text" class="mt-1 block w-full" />
                        <x-input-error for="numero" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-label for="mesas_estado" value="Estado de la Mesa" class="mb-2" />
                        <x-select wire:model="mesas_estado" class="w-full">
                            <option value="">Seleccione...</option>
                            <option value="1" {{ $mesas_estado == 1 ? 'selected' : '' }}>Disponible</option>
                            <option value="2" {{ $mesas_estado == 2 ? 'selected' : '' }}>Ocupada</option>
                            <option value="3" {{ $mesas_estado == 3 ? 'selected' : '' }}>Reservada</option>
                        </x-select>
                        <x-input-error for="mesas_estado" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-label for="sucursal_id" value="Sucursal" />
                        <x-select wire:model="sucursal_id" class="w-full">
                            <option value="">Seleccione una sucursal...</option>
                            @foreach($sucursales as $sucursal)
                                <option value="{{ $sucursal->id }}" {{ $sucursal->id == $sucursal_id ? 'selected' : '' }}>{{ $sucursal->nombre }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="sucursal_id" class="mt-2" />
                    </div>
                </form>
            </section>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="cerrarModal"> <!-- Cambié a cerrarModal -->
                Cancelar
            </x-secondary-button>
            <x-button class="ml-2" wire:click="actualizarMesa" wire:loading.attr="disabled">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
