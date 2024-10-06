<?php

namespace App\Livewire\Proveedor;

use Livewire\Component;
use App\Models\Proveedores;

class ListarProveedor extends Component
{
    public $proveedores;

    protected $listeners = [
        'guardado' => 'getProveedores',
        'proveedorActualizado' => 'getProveedores',
        'proveedorEliminado' => 'getProveedores',
    ];

    public function mount()
    {
        $this->getProveedores();
    }

    public function getProveedores()
    {
        // Obtener todos los proveedores activos (prov_estado = 1)
        $this->proveedores = Proveedores::where('prov_estado', 1)->get();
    }

    public function eliminar($id)
    {
        // Disparar evento de eliminación de proveedor
        $this->dispatch('eliminar', $id);
    }

    public function editar($id)
    {
        // Disparar evento de edición de proveedor
        $this->dispatch('editar', $id);
    }

    public function render()
    {
        return view('livewire.proveedor.listar-proveedor', [
            'proveedor' => $this->proveedores
        ]);
    }
}
