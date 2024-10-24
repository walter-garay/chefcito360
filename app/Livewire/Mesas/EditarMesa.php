<?php

namespace App\Livewire\Mesas;

use Livewire\Component;
use App\Models\Mesa;
use App\Models\Sucursal;
use App\Models\Sucursales;

class EditarMesa extends Component
{
    public $showModal = false;
    public $showConfirmModal = false; // Modal de confirmación
    public $mesa;
    public $numero;
    public $mesas_estado;
    public $sucursal_id;
    public $sucursales;

    const ESTADO_DISPONIBLE = 1;
    const ESTADO_OCUPADA = 2;
    const ESTADO_RESERVADA = 3;

    protected $listeners = ['editar'];

    protected $rules = [
        'numero' => ['required', 'integer', 'min:1', 'unique:mesas,numero'],
        'mesas_estado' => ['required', 'in:1,2,3'],
        'sucursal_id' => ['required', 'exists:sucursales,id'],
    ];

    public function mount()
    {
        $this->sucursales = Sucursales::all();
    }

    public function editar($id)
    {
        $this->mesa = Mesa::find($id);

        if ($this->mesa) {
            $this->numero = $this->mesa->numero;
            $this->mesas_estado = $this->mesa->mesas_estado;
            $this->sucursal_id = $this->mesa->sucursal_id;
            $this->abrirModal();
        }
    }

    // Mostrar modal de confirmación antes de guardar cambios
    public function confirmarEdicion()
    {
        $this->showConfirmModal = true; // Abre el modal de confirmación
    }

    // Guardar los cambios después de confirmar
    public function actualizarMesa()
    {
        $this->validate([
            'numero' => ['required', 'integer', 'min:1', 'unique:mesas,numero,' . $this->mesa->id],
            'mesas_estado' => ['required', 'in:' . self::ESTADO_DISPONIBLE . ',' . self::ESTADO_OCUPADA . ',' . self::ESTADO_RESERVADA],
            'sucursal_id' => ['required', 'exists:sucursales,id'],
        ]);

        // Guardar los cambios
        $this->mesa->update([
            'numero' => $this->numero,
            'mesas_estado' => $this->mesas_estado,
            'sucursal_id' => $this->sucursal_id,
        ]);

        session()->flash('message', 'Mesa actualizada correctamente.');

        // Cambiar emit a dispatch
        $this->dispatch('mesaActualizada');
        $this->cerrarModal();
        $this->cerrarConfirmModal(); // Cierra el modal de confirmación
    }

    // Abrir modal de edición
    public function abrirModal()
    {
        $this->showModal = true;
    }

    // Cerrar modal de edición
    public function cerrarModal()
    {
        $this->resetValidation();
        $this->showModal = false;
    }

    // Cerrar modal de confirmación
    public function cerrarConfirmModal()
    {
        $this->showConfirmModal = false;
    }

    public function render()
    {
        return view('livewire.mesas.editar-mesa', [
            'sucursales' => $this->sucursales,
        ]);
    }
}
