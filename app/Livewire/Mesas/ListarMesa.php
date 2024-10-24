<?php

namespace App\Livewire\Mesas;

use Livewire\Component;
use App\Models\Mesa;

class ListarMesa extends Component
{
    public $mesas;

    protected $listeners = [
        'mesaAgregada' => 'getMesas', // Escuchar el evento emitido
    ];

    public function mount()
    {
        $this->getMesas();
    }

    public function getMesas()
    {
        $this->mesas = Mesa::all();
    }

    public function render()
    {
        return view('livewire.mesas.listar-mesa', [
            'mesas' => $this->mesas,
        ]);
    }
}
