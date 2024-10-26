<?php

namespace App\Livewire\Ordenes;

use Livewire\Component;
use App\Models\Mesa;
use App\Models\Ordenes;
use Illuminate\Support\Facades\Auth;
use App\Models\Platillo;

class CrearOrden extends Component
{
    public $showModal = false;
    public $numero;
    public $total = 0;
    public $mesa_id;
    public $mesero_id;
    public $platillos = []; 
    public $todosPlatillos =[];
    public $mesas; 
    public $estado;
    public $estados = ['Pedido', 'Servido', 'Cancelado', 'Pagado']; 


    protected $rules = [
        'numero' => ['required', 'string', 'max:100'],
        'total' => ['required'],
        'mesa_id' => ['required', 'integer', 'exists:mesas,id'],
        'mesero_id' => ['required'],
        'platillos.*.id' => ['required', 'exists:platillos,id'], // Validar platillos seleccionados
        'platillos.*.cantidad' => ['required', 'integer', 'min:1'], // Validar cantidades
    ];

    public function mount()
    {
        $this->reset();
        $this->todosPlatillos = Platillo::all(); // Carga todos los platillos
        $this->mesas = $this->obtenerMesasDisponibles(); // Carga las mesas disponibles
        $this->estado = 'Pedido';
    }
    

    public function abrirModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->mesero_id = Auth::id(); 
        $this->mesas = $this->obtenerMesasDisponibles();
        $this->showModal = true;
    }

    private function obtenerMesasDisponibles()
    {
        return Mesa::whereDoesntHave('ordenes', function($query) {
            $query->whereIn('estado', ['Pagado', 'Cancelado']);
        })->get();
    }


    public function agregarPlatillo()
    {
        $this->platillos[] = ['id' => null, 'cantidad' => 1, 'subtotal' => 0]; // Asegúrate de que 'id' sea null inicialmente
    }
    

    public function updatedPlatillos($value, $name)
{
    $this->calcularTotal();
}

    public function eliminarPlatillo($index)
    {
        unset($this->platillos[$index]);
        $this->platillos = array_values($this->platillos); // Reindexa el array
        $this->calcularTotal(); // Recalcula el total
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

    public function guardarOrden()
    {
        $this->validate();

        $orden = new Ordenes();
        $orden->numero = $this->numero;
        $orden->total = $this->total;
        $orden->mesa_id = $this->mesa_id;
        $orden->mesero_id = $this->mesero_id;
        $orden->estado = $this->estado;
        $orden->save();

        foreach ($this->platillos as $platillo) {
            if ($platillo['cantidad'] > 0) {
                $orden->platillos()->attach($platillo['id'], ['cantidad' => $platillo['cantidad']]);
            }
        }

        $this->dispatch('guardado');
        $this->cerrarModal();
    }

    public function cerrarModal()
    {
        $this->showModal = false;
    }

    public function render()
{
    $this->mesas = $this->obtenerMesasDisponibles();
    $this->todosPlatillos = Platillo::all(); // Asegúrate de que esto esté en el render también

    return view('livewire.ordenes.crear-orden', [
        'mesas' => $this->mesas,
        'platillos' => $this->todosPlatillos, // Asegúrate de que sea esto
    ]);
}
}