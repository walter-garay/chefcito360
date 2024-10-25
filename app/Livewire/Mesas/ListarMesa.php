<?php

namespace App\Livewire\Mesas;

use Livewire\Component;
use App\Models\Mesa;

class ListarMesa extends Component
{
    public $mesas;

    protected $listeners = [
        'guardado' => 'getMesas', 
        'mesaActualizada'=>'getMesas',
        'eliminado'=>'getMesas',
    ];

    public function mount()
    {
        $this->getMesas();
    }

    public function getMesas()
    {
        $this->mesas = Mesa::all();
    }

    public function eliminar($id)
    {
        $this->dispatch('eliminar',$id);
    }
    
    public function editar($id)
    {
        $this->dispatch('editar',$id);
    }
    public function render()
    {
        return view('livewire.mesas.listar-mesa', [
            'mesas' => $this->mesas,
        ]);
    }
}
