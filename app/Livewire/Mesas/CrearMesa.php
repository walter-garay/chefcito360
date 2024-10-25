<?php

namespace App\Livewire\Mesas;

use Livewire\Component;
use App\Models\Mesa;
use App\Models\Sucursales;

class CrearMesa extends Component
{
    public $showModal = false;
    public $numero;
    public $mesas_estado;
    public $sucursal_id;
    public $sucursales;

    //ESTO ESTA MAL- FIJATE EN EL TIPO DEL CAMPO MESAS_ESTADO en la migración

    const ESTADO_DISPONIBLE = 1;
    const ESTADO_OCUPADA = 2;
    const ESTADO_RESERVADA = 3;
    //

    protected $rules = [
        'numero' => 'required|integer|min:1|unique:mesas,numero',
        'mesas_estado' => 'required|in:' . self::ESTADO_DISPONIBLE . ',' . self::ESTADO_OCUPADA . ',' . self::ESTADO_RESERVADA,
        'sucursal_id' => 'required|exists:sucursales,id',
    ];

    public function mount()
    {
        $this->sucursales = Sucursales::all();
    }

    public function abrirModal()
    {
        $this->reset(['numero', 'mesas_estado', 'sucursal_id']);
        $this->showModal = true;
    }

    public function cerrarModal()
    {
        $this->showModal = false;
    }

    public function guardarMesa()
    {
        $this->validate();

        Mesa::create([
            'numero' => $this->numero,
            'mesas_estado' => $this->mesas_estado,
            'sucursal_id' => $this->sucursal_id,
        ]);

        $this->dispatch('guardado');
        session()->flash('message', 'Mesa guardada correctamente.');

        $this->cerrarModal();
    }


    public function render()
    {
        return view('livewire.mesas.crear-mesa');
    }
}
