<?php

namespace App\Livewire\Platillos;

use Livewire\Component;
use App\Models\Platillo;
use App\Models\Sucursales;

class PlatilloTable extends Component
{
    public $platillos, $sucursales;
    public $nombre, $descripcion, $precio, $categoria, $sucursal_id;
    public $showModal = false;
    public $isEditing = false;
    public $platilloId;

    public function render()
    {
        $this->platillos = Platillo::with('sucursal')->get();
        $this->sucursales = Sucursales::all();
        return view('livewire.platillos.platillo-table');
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->nombre = '';
        $this->descripcion = '';
        $this->precio = '';
        $this->categoria = '';
        $this->sucursal_id = '';
        $this->isEditing = false;
        $this->platilloId = null;
    }

    public function editPlatillo($id)
    {
        $platillo = Platillo::findOrFail($id);
        $this->platilloId = $id;
        $this->nombre = $platillo->nombre;
        $this->descripcion = $platillo->descripcion;
        $this->precio = $platillo->precio;
        $this->categoria = $platillo->categoria;
        $this->sucursal_id = $platillo->sucursal_id;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function update()
    {
        $platillo = Platillo::findOrFail($this->platilloId);
        $platillo->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'categoria' => $this->categoria,
            'sucursal_id' => $this->sucursal_id,
        ]);

        $this->closeModal();
        session()->flash('message', 'Platillo actualizado con éxito.');
    }

    public function store()
    {
        Platillo::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'categoria' => $this->categoria,
            'sucursal_id' => $this->sucursal_id,
        ]);

        $this->closeModal();
        session()->flash('message', 'Platillo agregado con éxito.');
    }

    public function deletePlatillo($id)
    {
        Platillo::findOrFail($id)->delete();
        session()->flash('message', 'Platillo eliminado con éxito.');
    }
}
