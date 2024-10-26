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
    public $total = 0;
    public $mesa_id;
    public $mesero_id;
    public $platillos = [];
    public $todosPlatillos = [];
    public $mesas;
    public $estado;
    public $estados = ['Pedido', 'Servido', 'Cancelado', 'Pagado'];

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
        $this->mesas = $this->obtenerMesasDisponibles();
    }

    private function obtenerMesasDisponibles()
    {
        return Mesa::whereDoesntHave('ordenes', function($query) {
            $query->whereIn('estado', ['Pedido', 'Servido']);
        })->get();
    }

    public function editar($id)
    {
        $this->orden = Ordenes::find($id);
        $this->numero = $this->orden->numero;
        $this->total = $this->orden->total;
        $this->mesa_id = $this->orden->mesa_id;
        $this->mesero_id = $this->orden->mesero_id;
        $this->estado = $this->orden->estado;

        $this->platillos = $this->orden->platillos()->get()->map(function ($platillo) {
            return [
                'id' => $platillo->id,
                'cantidad' => $platillo->pivot->cantidad,
                'subtotal' => $platillo->pivot->cantidad * $platillo->precio,
            ];
        })->toArray();

        $this->calcularTotal();
        $this->showModal = true;
    }

    public function updatedPlatillos()
    {
        $this->calcularTotal();
    }

    public function agregarPlatillo()
    {
        $this->platillos[] = ['id' => null, 'cantidad' => 1, 'subtotal' => 0];
    }

    public function eliminarPlatillo($index)
    {
        unset($this->platillos[$index]);
        $this->platillos = array_values($this->platillos);
        $this->calcularTotal();
    }

    public function calcularTotal()
    {
        $this->total = 0;

        foreach ($this->platillos as &$platillo) {
            if (isset($platillo['id']) && $platillo['id'] && isset($platillo['cantidad']) && $platillo['cantidad']) {
                $item = Platillo::find($platillo['id']);
                $platillo['subtotal'] = $item->precio * $platillo['cantidad'];
                $this->total += $platillo['subtotal'];
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
        $orden->estado = $this->estado;
        $orden->save();

        $orden->platillos()->detach();
        foreach ($this->platillos as $platillo) {
            if ($platillo['cantidad'] > 0) {
                $orden->platillos()->attach($platillo['id'], ['cantidad' => $platillo['cantidad']]);
            }
        }

        session()->flash('message', 'Orden actualizada con éxito.');
        $this->dispatch('ordenActualizada');
        $this->cerrarModal();
    }

    public function cerrarModal()
    {
        $this->reset(['numero', 'total', 'mesa_id', 'mesero_id', 'platillos', 'estado']);
        $this->resetValidation();
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.ordenes.editar-orden', [
            'mesas' => $this->mesas,
            'todosPlatillos' => $this->todosPlatillos,
            'estados' => $this->estados,
        ]);
    }
}
