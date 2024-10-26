<?php

namespace App\Livewire\Ordenes;

use Livewire\Component;
use App\Models\Ordenes;
use App\Models\Platillo;
use App\Models\Mesa;

class EditarOrden extends Component
{
    public $showModal = false;
    public $orden; 
    public $numero;
    public $total = 0; // Inicializa en 0
    public $mesa_id;
    public $mesero_id;
    public $platillos = [];
    
    public $todosPlatillos = [];
    public $mesas; 

    protected $listeners = ['editar']; 

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

        $this->platillos = $this->orden->platillos()->get()->map(function ($platillo) {
            return [
                'id' => $platillo->id,
                'cantidad' => $platillo->pivot->cantidad,
            ];
        })->toArray();

        // Calcula el total inicial al abrir el modal
        $this->calcularTotal();

        $this->showModal = true;
    }
    
    public function updatedPlatillos()
    {
        $this->calcularTotal();
    }

    public function agregarPlatillo()
    {
        $this->platillos[] = ['id' => null, 'cantidad' => 1, 'subtotal' => 0]; // Asegúrate de que 'id' sea null inicialmente
    }

    public function eliminarPlatillo($index)
    {
        unset($this->platillos[$index]);
        $this->platillos = array_values($this->platillos); // Reindexa el array
        $this->calcularTotal(); // Recalcula el total
    }

    public function calcularTotal()
    {
        $this->total = 0; // Asegúrate de restablecer el total a 0
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
        $orden->total = $this->total; // Asegúrate de que el total esté actualizado
        $orden->mesa_id = $this->mesa_id;
        $orden->mesero_id = $this->mesero_id;
        $orden->save();

        foreach ($this->platillos as $platillo) {
            if ($platillo['cantidad'] > 0) {
                $orden->platillos()->updateExistingPivot($platillo['id'], ['cantidad' => $platillo['cantidad']]);
            }
        }

        // Mensaje de éxito opcional
        session()->flash('message', 'Orden actualizada con éxito.');

        $this->dispatch('ordenActualizada');
        $this->cerrarModal();
    }

    public function cerrarModal()
    {
        $this->reset(['numero', 'total', 'mesa_id', 'mesero_id', 'platillos']); // Resetea todo
        $this->resetValidation();
        $this->showModal = false;
        $this->dispatch('cerrarModal');
    }

    public function render()
    {
        return view('livewire.ordenes.editar-orden', [
            'mesas' => $this->mesas,
            'todosPlatillos' => $this->todosPlatillos,
        ]);
    }
}
