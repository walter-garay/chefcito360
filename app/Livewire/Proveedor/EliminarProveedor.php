<?php

namespace App\Livewire\Proveedor;

use Livewire\Component;
use App\Models\Proveedores;

class EliminarProveedor extends Component
{
    public $showModal = false;
    public $proveedor;

    protected $listeners = ['eliminar'];

    public function mount()
    {
        $this->proveedor = new Proveedores();
    }

    public function eliminar($id)
    {
        $this->abrirModal();
        $this->proveedor = Proveedores::find($id);
    }

    public function confirmarEliminar()
    {
        // Cambiar el estado del proveedor a 0 en lugar de eliminarlo
        $this->proveedor->prov_estado = 0;
        $this->proveedor->save();

        $this->dispatch('proveedorEliminado');
        $this->cerrarModal();
    }

    public function cerrarModal()
    {
        $this->showModal = false;
    }

    public function abrirModal()
    {
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.proveedor.eliminar-proveedor');
    }

}
