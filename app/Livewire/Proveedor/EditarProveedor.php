<?php

namespace App\Livewire\Proveedor;

use Livewire\Component;
use App\Models\Proveedores;

class EditarProveedor extends Component
{
    public $showModal = false;
    public $proveedor;
    public $nombre;
    public $celular;
    public $direccion;
    public $correo;

    protected $listeners = ['editar'];

    protected $rules = [
        'nombre' => ['required', 'string', 'max:250'],
        'celular' => ['required', 'max:9'], // Ajusta el max de celular según tus necesidades
        'direccion' => ['nullable', 'string', 'max:250'],
        'correo' => ['nullable', 'email', 'max:250'],
    ];

    public function mount()
    {
        $this->proveedor = new Proveedores();
    }

    public function editar($id)
    {
        $this->abrirModal();
        $this->proveedor = Proveedores::find($id);
        $this->nombre = $this->proveedor->nombre;
        $this->celular = $this->proveedor->celular;
        $this->direccion = $this->proveedor->direccion;
        $this->correo = $this->proveedor->correo;
    }

    public function actualizarProveedor()
    {
        $this->validate();
        $proveedor = Proveedores::find($this->proveedor->id);
        $proveedor->nombre = $this->nombre;
        $proveedor->celular = $this->celular;
        $proveedor->direccion = $this->direccion;
        $proveedor->correo = $this->correo;
        $proveedor->save();
        
        $this->dispatch('proveedorActualizado');
        $this->cerrarModal();
    }

    public function abrirModal()
    {
        $this->showModal = true;
    }

    public function cerrarModal()
    {
        $this->resetValidation();
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.proveedor.editar-proveedor');
    }
}
