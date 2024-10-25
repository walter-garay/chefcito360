<?php

namespace App\Livewire\Mesas;

use Livewire\Component;
use App\Models\Mesa;

class EliminarMesa extends Component
{
    public $showModal = false; // Para mostrar/ocultar el modal
    public $mesa; // Objeto de la mesa a eliminar

    protected $listeners = ['eliminar']; // Escucha el evento de eliminación

    public function mount()
    {
        // Inicializa el objeto Mesa
        $this->mesa = new Mesa();
    }

    public function eliminar($id)
    {
            $this->abrirModal(); // Abre el modal
            $this->mesa = Mesa::find($id); // Obtiene la mesa a eliminar
    }

    public function confirmarEliminar()
    {
        // Cambia el estado de la mesa a "inactiva" 
       /* $this->mesa->mesas_estado = 0; // Usa el valor numérico para inactiva
        $this->mesa->save(); // Guarda el cambio en la base de datos

        // Emite el evento de eliminación completada
        $this->dispatch('eliminado');
        $this->cerrarModal(); // Cierra el modal */

        $this->mesa->delete();
        $this->dispatch('eliminado');
        $this->cerrarModal();
    }

    public function cerrarModal()
    {
        // Cierra el modal
        $this->showModal = false;
    }

    public function abrirModal()
    {
        // Abre el modal
        $this->showModal = true;
    }

    public function render()
    {
        // Renderiza la vista del componente
        return view('livewire.mesas.eliminar-mesa');
    }
}
