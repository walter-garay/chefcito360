<?php

namespace App\Livewire\Ordenes;

use Livewire\Component;
use App\Models\Mesa;
use App\Models\Ordenes;
use Illuminate\Support\Facades\Auth;

class CrearOrden extends Component
{
    public $showModal = false;
    public $numero;
    public $total;
    public $mesa_id;
    public $mesero_id;
    public $mesas; 

    protected $rules = [
        'numero' => ['required', 'string', 'max:100'],
        'total' => ['required'],
        'mesa_id' => ['required', 'integer', 'exists:mesas,id'],
        'mesero_id' => ['required'],
    ];

    public function abrirModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->mesero_id = Auth::id(); 
        $this->mesas = Mesa::all();
        $this->showModal = true;
    }

    public function guardarOrden()
    {
        $this->validate();

        $orden = new Ordenes();
        $orden->numero = $this->numero;
        $orden->total = $this->total;
        $orden->mesa_id = $this->mesa_id; // Guarda la mesa seleccionada
        $orden->mesero_id = $this->mesero_id;
        $orden->save();

        $this->dispatch('guardado');
        $this->cerrarModal();
    }

    public function cerrarModal()
    {
        $this->showModal = false;
    }

    public function mount()
    {
        $this->reset();
    }
    public function render()
    {

        $this->mesas = Mesa::select('id', 'numero')->get();

        return view('livewire.ordenes.crear-orden', [
            'mesas' => Mesa::all(),
        ]);

    }
}
