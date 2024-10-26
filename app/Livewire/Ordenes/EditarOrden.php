<?php

namespace App\Livewire\Ordenes;

use Livewire\Component;
use App\Models\Ordenes;
use App\Models\Mesa;

class EditarOrden extends Component
{

    public $showModal = false;
    public $orden; // Almacena la orden a editar
    public $numero;
    public $total;
    public $mesa_id;
    public $mesero_id;
    public $mesas; 

    protected $listeners = ['editar'];

    protected $rules = [
        'numero' => ['required', 'string', 'max:100'],
        'total' => ['required', 'numeric'], // Asegúrate de que sea numérico
        'mesa_id' => ['required', 'integer', 'exists:mesas,id'],
        'mesero_id' => ['required'],
    ];

    public function mount()
    {
        $this->mesas = Mesa::all(); // Cargar las mesas al iniciar
    }

    public function editar($id)
    {
        $this->abrirModal();
        $this->orden = Ordenes::find($id);
        $this->numero = $this->orden->numero;
        $this->total = $this->orden->total;
        $this->mesa_id = $this->orden->mesa_id;
        $this->mesero_id = $this->orden->mesero_id;

    }

    public function actualizarOrden()
    {
        $this->validate();

        $orden = Ordenes::find($this->orden->id); // Encuentra la orden a actualizar
        $orden->numero = $this->numero;
        $orden->total = $this->total;
        $orden->mesa_id = $this->mesa_id;
        $orden->mesero_id = $this->mesero_id;
        $orden->save();

        $this->dispatch('ordenActualizada'); // Dispara un evento al guardar
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
        return view('livewire.ordenes.editar-orden', [
            'mesas' => $this->mesas,
        ]);
    }
}
