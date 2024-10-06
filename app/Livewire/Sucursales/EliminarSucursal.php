<?php

namespace App\Livewire\Sucursales;

use Livewire\Component;
use App\Models\Sucursales;

class EliminarSucursal extends Component
{
    public $showModal=false;
    public $sucursal;

    protected $listeners=['eliminar'];
    
    public function mount()
    {
        $this->sucursal = new Sucursales();
    }
    public function eliminar($id)
    {
        $this->abrirModal();
        $this->sucursal = Sucursales::find($id);
    }
    public function confirmarEliminar()
    {
        $this->sucursal->suc_estado =0;
        $this->sucursal->save();
        $this->dispatch('eliminado');
        $this->closeModal();     
    }
    public function closeModal()
    {
        $this->showModal = false;
    }
    public function abrirModal()
    {
        $this->showModal = true;
    }
    public function render()
    {
        return view('livewire.sucursales.eliminar-sucursal');
    }
}
