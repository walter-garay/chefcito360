<?php

namespace App\Livewire\Productos;

use App\Models\Productos;
use App\Models\Sucursales;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductoTable extends Component
{
    use WithFileUploads;

    public $producto_id, $productos, $nombre, $descripcion, $precio_c, $precio_v, $stock, $categoria, $sucursal_id, $imagen, $imagenActual;
    public $isEditing = false;
    public $showModal = false;
    public $showConfirmModal = false;
    public $sucursales;
    public $productoIdToDelete;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:500',
        'precio_c' => 'nullable|numeric',
        'precio_v' => 'nullable|numeric',
        'stock' => 'required|integer|min:0',
        'categoria' => 'required|string',
        'sucursal_id' => 'required|exists:sucursales,id',
        'imagen' => 'nullable|image|max:1024',
    ];

    public function mount()
    {
        $this->productos = Productos::all();
        $this->sucursales = Sucursales::all();
    }

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
        $this->isEditing = false;
    }

    public function editProducto($id)
    {
        $producto = Productos::findOrFail($id);
        $this->producto_id = $producto->id;
        $this->fill($producto->toArray());
        $this->imagenActual = $producto->imagen;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function confirmDelete($id)
    {
        $this->productoIdToDelete = $id;
        $this->showConfirmModal = true;
    }

    public function deleteConfirmed()
    {
        Productos::findOrFail($this->productoIdToDelete)->delete();
        $this->showConfirmModal = false;
        $this->productos = Productos::all();  // Recargar los productos
        session()->flash('message', 'Producto eliminado con éxito.');
    }

    public function store()
    {
        $this->validate();
        $imagenPath = $this->imagen ? $this->imagen->store('productos', 'public') : null;

        Productos::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio_c' => $this->precio_c,
            'precio_v' => $this->precio_v,
            'stock' => $this->stock,
            'categoria' => $this->categoria,
            'sucursal_id' => $this->sucursal_id,
            'imagen' => $imagenPath,
        ]);

        session()->flash('message', 'Producto creado con éxito.');
        $this->closeModal();
        $this->productos = Productos::all();
    }

    public function update()
    {
        $this->validate();

        $producto = Productos::findOrFail($this->producto_id);
        $imagenPath = $this->imagen ? $this->imagen->store('productos', 'public') : $this->imagenActual;

        $producto->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio_c' => $this->precio_c,
            'precio_v' => $this->precio_v,
            'stock' => $this->stock,
            'categoria' => $this->categoria,
            'sucursal_id' => $this->sucursal_id,
            'imagen' => $imagenPath,
        ]);

        session()->flash('message', 'Producto actualizado con éxito.');
        $this->closeModal();
        $this->productos = Productos::all();
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
        $this->precio_c = '';
        $this->precio_v = '';
        $this->stock = '';
        $this->categoria = '';
        $this->sucursal_id = '';
        $this->imagen = null;
        $this->imagenActual = null;
    }

    public function render()
    {
        return view('livewire.productos.producto-table');
    }
}
