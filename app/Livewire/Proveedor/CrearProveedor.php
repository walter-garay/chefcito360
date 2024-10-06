<?php

namespace App\Livewire\Proveedor;

use Livewire\Component;
use App\Models\Proveedores;

class CrearProveedor extends Component
{
    public $showModal = false;
    public $nombre;
    public $direccion;
    public $celular;
    public $correo;

    protected $rules = [
        'nombre' => ['required', 'string', 'max:250'],
        'direccion' => ['nullable', 'string', 'max:250'],
        'celular' => ['required', 'integer', 'digits:9'], // Si el celular es de 9 dígitos
        'correo' => ['nullable', 'email', 'max:250'],
    ];

    public function abrirModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->showModal = true;
    }

    public function guardarProveedor()
    {
        $this->validate();
        
        $proveedor = new Proveedores();
        $proveedor->nombre = $this->nombre;
        $proveedor->direccion = $this->direccion;
        $proveedor->celular = $this->celular;
        $proveedor->correo = $this->correo;
        // El campo 'prov_estado' no se guarda ya que tiene un valor por defecto en la base de datos
        $proveedor->save();

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
        return view('livewire.proveedor.crear-proveedor');
    }
       
}
