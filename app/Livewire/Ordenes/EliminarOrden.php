<?php

namespace App\Livewire\Ordenes;

use Livewire\Component;
use App\Models\Ordenes;

class EliminarOrden extends Component
{
    public $showModal = false;
    public $orden; // Almacena la orden a eliminar

    protected $listeners = ['eliminar'];

    public function mount()
    {
        $this->orden = new Ordenes();
    }

    public function eliminar($id)
    {
        $this->abrirModal();
        $this->orden = Ordenes::find($id);
    }

    public function confirmarEliminar()
    {
        
        $this->orden->ord_estado = 0; 
        $this->orden->save();

        $this->dispatch('ordenEliminada'); 
        $this->cerrarModal();
    }

    public function cerrarModal()
    {
        $this->resetValidation();
        $this->showModal = false;
        $this->dispatch('cerrarModal'); // Emitir el evento cerrarModal
    }

    public function abrirModal()
    {
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.ordenes.eliminar-orden');
    }
}
