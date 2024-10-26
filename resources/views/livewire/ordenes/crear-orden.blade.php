<div>
    <div class="flex justify-center">
        <x-button class="px-3 py-3 uppercase" wire:click="abrirModal" wire:loading.attr="disabled">
            Agregar Orden
        </x-button>
    </div>
    
    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            Agregar Orden
        </x-slot>

        <x-slot name="content">
            <section>
                <form wire:submit.prevent="guardarOrden">
                    <div class="mt-4">
                        <x-label for="numero" value="Número de Orden" />
                        <x-input id="numero" wire:model="numero" type="text" class="mt-1 block w-full" />
                        <x-input-error for="numero" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-label for="total" value="Total" />
                        <x-input id="total" wire:model="total" type="number" step="0.01" class="mt-1 block w-full" />
                        <x-input-error for="total" class="mt-2" />
                    </div>

                    <!-- Campo de selección de Mesa -->
                    <div class="mt-4">
                        <x-label for="mesa_id" value="Mesa" />
                        <select id="mesa_id" wire:model="mesa_id" class="block w-full mt-1">
                            <option value="">Seleccione una mesa</option>
                            @foreach($mesas as $mesa)
                                <option value="{{ $mesa->id }}">{{ $mesa->numero }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="mesa_id" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-label for="mesero_id" value="ID del Mesero" />
                        <x-input id="mesero_id" wire:model="mesero_id" type="text" class="mt-1 block w-full bg-gray-100" disabled />
                        <x-input-error for="mesero_id" class="mt-2" />
                    </div>
                </form>
            </section>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="cerrarModal">
                Cancelar
            </x-secondary-button>
            <x-button class="ml-2" wire:click="guardarOrden" wire:loading.attr="disabled">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>