<div>
    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            Editar Orden
        </x-slot>
        <x-slot name="content">
            <section>
                <form wire:submit.prevent="actualizarOrden">
                    <div class="mt-4">
                        <x-label for="numero" value="Número de Orden" />
                        <x-input id="numero" wire:model="numero" type="text" class="mt-1 block w-full" />
                        <x-input-error for="numero" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-label for="total" value="Total" />
                        <x-input id="total" wire:model="total" type="number" class="mt-1 block w-full" step="0.01" readonly />
                        <x-input-error for="total" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-label for="mesa_id" value="Mesa" />
                        <select id="mesa_id" wire:model="mesa_id" class="mt-1 block w-full">
                            <option value="">Seleccione una mesa</option>
                            @foreach($mesas as $mesa)
                                <option value="{{ $mesa->id }}">{{ $mesa->numero }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="mesa_id" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-label for="mesero_id" value="Mesero" />
                        <x-input id="mesero_id" wire:model="mesero_id" type="text" class="mt-1 block w-full" readonly />
                        <x-input-error for="mesero_id" class="mt-2" />
                    </div>

                    <!-- Selección de Platillos -->
                    <div class="mt-4">
                        <x-label value="Platillos" />
                        @foreach($platillos as $index => $platillo)
                            <div class="flex items-center mb-2">
                                <select wire:model="platillos.{{ $index }}.id" class="block w-3/5 mt-1 mr-2">
                                    <option value="">Seleccione un platillo</option>
                                    @foreach($todosPlatillos as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }} - ${{ number_format($item->precio, 2) }}</option>
                                    @endforeach
                                </select>

                                <x-input type="number" wire:model="platillos.{{ $index }}.cantidad" min="1" class="w-1/5" />
                            </div>
                        @endforeach

                        <!-- Botón para agregar otro platillo -->
                        <x-button class="mt-4" wire:click.prevent="agregarPlatillo">Agregar Platillo</x-button>
                    </div>
                </form>
            </section>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="cerrarModal">
                Cancelar
            </x-secondary-button>
            <x-button class="ml-2" wire:click="actualizarOrden" wire:loading.attr="disabled">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
