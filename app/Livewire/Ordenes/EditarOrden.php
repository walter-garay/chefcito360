<?php

namespace App\Livewire\Ordenes;

use Livewire\Component;
use App\Models\Ordenes;
use App\Models\Platillo;
use App\Models\Mesa;

class EditarOrden extends Component
{
    public $showModal = false;
    public $orden; // To hold the order being edited
    public $numero;
    public $total;
    public $mesa_id;
    public $mesero_id;
    public $platillos = [];
    
    public $todosPlatillos = [];
    public $mesas; 

    protected $listeners = ['editar']; // Listener for editing an order

    protected $rules = [
        'numero' => ['required', 'string', 'max:100'],
        'total' => ['required'],
        'mesa_id' => ['required', 'integer', 'exists:mesas,id'],
        'mesero_id' => ['required'],
        'platillos.*.id' => ['required', 'exists:platillos,id'],
        'platillos.*.cantidad' => ['required', 'integer', 'min:1'],
    ];

    public function mount()
    {
        $this->todosPlatillos = Platillo::all();
        $this->mesas = Mesa::all();
    }

    public function editar($id)
    {
        $this->orden = Ordenes::find($id);
        $this->numero = $this->orden->numero;
        $this->total = $this->orden->total;
        $this->mesa_id = $this->orden->mesa_id;
        $this->mesero_id = $this->orden->mesero_id;

        // Load the platillos for the order
        $this->platillos = $this->orden->platillos()->get()->map(function ($platillo) {
            return [
                'id' => $platillo->id,
                'cantidad' => $platillo->pivot->cantidad,
            ];
        })->toArray();

        $this->showModal = true;
    }

    public function updatedPlatillos()
    {
        $this->calcularTotal();
    }

    private function calcularTotal()
    {
        $this->total = 0;
        foreach ($this->platillos as $platillo) {
            if ($platillo['id'] && $platillo['cantidad']) {
                $item = Platillo::find($platillo['id']);
                $this->total += $item->precio * $platillo['cantidad'];
            }
        }
    }

    public function actualizarOrden()
    {
        $this->validate();

        $orden = Ordenes::find($this->orden->id);
        $orden->numero = $this->numero;
        $orden->total = $this->total;
        $orden->mesa_id = $this->mesa_id;
        $orden->mesero_id = $this->mesero_id;
        $orden->save();

        // Update the platillos associated with the order
        foreach ($this->platillos as $platillo) {
            if ($platillo['cantidad'] > 0) {
                $orden->platillos()->updateExistingPivot($platillo['id'], ['cantidad' => $platillo['cantidad']]);
            }
        }

        $this->dispatch('ordenActualizada');
        $this->cerrarModal();
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
            'todosPlatillos' => $this->todosPlatillos,
        ]);
    }
}
