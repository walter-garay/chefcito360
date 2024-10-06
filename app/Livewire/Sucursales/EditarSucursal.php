<?php

namespace App\Livewire\Sucursales;

use Livewire\Component;
use App\Models\Sucursales;

class EditarSucursal extends Component
{
    public $showModal=false;
    public $sucursal;
    public $nombre;
    public $tipo_sucursal;
    public $celular;
    public $direccion;
    public $whatsapp;
    public $serie;

    protected $listeners = ['editar'];

    protected $rules=[
        'nombre' => ['required','string','max:250'],
        'tipo_sucursal' => ['required'],
        'celular' => ['required','max:7'],
        'direccion' => ['required','string','max:250'],
        'whatsapp' => ['required','max:9'],
        'serie' => ['required','string','max:5'],
    ];

    public function mount()
    {
        $this->sucursal = new Sucursales();
    }
    public function editar($id)
    {
        $this->abrirModal();
        $this->sucursal = Sucursales::find($id);
        $this->nombre = $this->sucursal->nombre;
        $this->tipo_sucursal = $this->sucursal->tipo_sucursal;
        $this->celular = $this->sucursal->celular;
        $this->direccion = $this->sucursal->direccion;
        $this->whatsapp = $this->sucursal->whatsapp;
        $this->serie = $this->sucursal->serie;
        
    }
    public function actualizarSucursal()
    {
        $this->validate();
        $sucursal = Sucursales::find($this->sucursal->id);
        $sucursal->nombre = $this->nombre;
        $sucursal->tipo_sucursal = $this->tipo_sucursal;
        $sucursal->celular = $this->celular;
        $sucursal->direccion = $this->direccion;
        $sucursal->whatsapp = $this->whatsapp;
        $sucursal->serie = $this->serie;
        $sucursal->save();
        $this->dispatch('sucursalActualizado');
        $this->closeModal();
        
    }

    public function abrirModal()
    {
        $this->showModal = true;
    }
    public function closeModal()
    {
        $this->resetValidation();
        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.sucursales.editar-sucursal');
    }
}
