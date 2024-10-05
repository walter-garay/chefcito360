<?php

namespace App\Livewire\Platillos;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Platillo;
use App\Models\Sucursales;

class PlatilloTable extends Component
{
    use WithFileUploads;

    public $platillos, $nombre, $descripcion, $precio, $categoria, $sucursal_id, $imagen, $imagenActual;
    public $isEditing = false;
    public $showModal = false;
    public $showConfirmModal = false;
    public $sucursales;
    public $platilloIdToDelete;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string|max:500',
        'precio' => 'required|numeric',
        'categoria' => 'required|string',
        'sucursal_id' => 'required|exists:sucursales,id',
        'imagen' => 'nullable|image|max:1024',
    ];

    public function mount()
    {
        $this->platillos = Platillo::all();
        $this->sucursales = Sucursales::all();
    }

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
        $this->isEditing = false;
    }

    public function editPlatillo($id)
    {
        $platillo = Platillo::findOrFail($id);
        $this->fill($platillo->toArray());
        $this->imagenActual = $platillo->imagen;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function confirmDelete($id)
    {
        $this->platilloIdToDelete = $id;
        $this->showConfirmModal = true;
    }

    public function deleteConfirmed()
    {
        Platillo::findOrFail($this->platilloIdToDelete)->delete();
        $this->showConfirmModal = false;
        $this->platillos = Platillo::all();  // Solo recargamos los platillos
        session()->flash('message', 'Platillo eliminado con éxito.');
    }

    public function store()
    {
        $this->validate();
        $imagenPath = $this->imagen ? $this->imagen->store('platillos', 'public') : null;

        Platillo::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'categoria' => $this->categoria,
            'sucursal_id' => $this->sucursal_id,
            'imagen' => $imagenPath,
        ]);

        session()->flash('message', 'Platillo creado con éxito.');
        $this->closeModal();
        $this->platillos = Platillo::all();
    }

    public function update()
    {
        $this->validate();

        $platillo = Platillo::findOrFail($this->id);
        $imagenPath = $this->imagen ? $this->imagen->store('platillos', 'public') : $this->imagenActual;

        $platillo->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'categoria' => $this->categoria,
            'sucursal_id' => $this->sucursal_id,
            'imagen' => $imagenPath,
        ]);

        session()->flash('message', 'Platillo actualizado con éxito.');
        $this->closeModal();
        $this->platillos = Platillo::all();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetFields();
    }

    private function resetFields()
    {
        $this->nombre = '';
        $this->descripcion = '';
        $this->precio = '';
        $this->categoria = '';
        $this->sucursal_id = '';
        $this->imagen = null;
        $this->imagenActual = null;
    }

    public function render()
    {
        return view('livewire.platillos.platillo-table');
    }
}
