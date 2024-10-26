<?php

namespace App\Livewire\Ordenes;

use Livewire\Component;
use App\Models\Ordenes;

class ListarOrden extends Component
{

    public $ordenes;

    protected $listeners = [
        'guardado' => 'getOrdenes',
        'ordenActualizada' => 'getOrdenes',
        'ordenEliminada' => 'getOrdenes',
        'cerrarModal' => 'getOrdenes',
    ];


    public function getOrdenes()
    {
        $this->ordenes = Ordenes::where('ord_estado', 1)
        ->join('users', 'ordenes.mesero_id', '=', 'users.id')
        ->join('mesas', 'ordenes.mesa_id', '=', 'mesas.id')
        ->select('ordenes.*', 'users.name as usuario', 'mesas.numero as numero_mesa')
        ->get();
    }

    public function eliminar($id)
    {
        $this->dispatch('eliminar', $id);
    }

    public function editar($id)
    {
        $this->dispatch('editar', $id);
    }

    

    public function render()
    {
        $this->getOrdenes();

        return view('livewire.ordenes.listar-orden', [
            'ordenes' => $this->ordenes,

        ]);
    }
}
