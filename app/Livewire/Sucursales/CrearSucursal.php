<?php

namespace App\Livewire\Sucursales;

use App\Models\Sucursales;
use Livewire\Component;

class CrearSucursal extends Component
{
    public $showModal = false;
    public $sucursal;
    public $nombre;
    public $tipo_sucursal;
    public $celular;
    public $direccion;
    public $whatsapp;
    public $serie;
    public $gerente_id;

    protected $rules = [
        'nombre' => ['required','string','max:250'],
        'tipo_sucursal' => ['required'],
        'celular' => ['required','string','max:7'],
        'direccion' => ['required','string','max:250'],
        'whatsapp' => ['required','string','max:9'],
        'serie' => ['required','string','max:5'],
        'gerente_id' => ['required'],
    ];
    public function abrirModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->showModal = true;
    }
    public function guardarSucursal()
    {
        $this->validate();
        $sucursal = new Sucursales();
        $sucursal->nombre = $this->nombre;
        $sucursal->tipo_sucursal = $this->tipo_sucursal;
        $sucursal->celular = $this->celular;
        $sucursal->direccion = $this->direccion;
        $sucursal->whatsapp = $this->whatsapp;
        $sucursal->serie = $this->serie;
        $sucursal->gerente_id = $this->gerente_id;
        $sucursal->save();

        $this->dispatch('guardado');
        

    }
    public function cerrarModal()
    {
        $this->showModal = false;
    }
    public function mount()
    {
        $this->sucursal = new Sucursales();
    }
    public function render()
    {
        return view('livewire.sucursales.crear-sucursal');
    }
}
