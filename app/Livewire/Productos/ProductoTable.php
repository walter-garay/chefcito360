<?php

namespace App\Livewire\Productos;

use App\Models\Productos;
use App\Models\Sucursales;
use App\Models\Proveedores;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Exports\ProductosExport;
use App\Imports\ProductosImport;
use Maatwebsite\Excel\Facades\Excel;


class ProductoTable extends Component
{
    use WithFileUploads;

    public $producto_id, $productos, $nombre, $descripcion, $precio_c, $precio_v, $stock, $categoria, $sucursal_id, $proveedor_id, $imagen, $imagenActual, $fecha_ingreso;

    public $isEditing = false;
    public $showModal = false;
    public $showConfirmModal = false;
    public $sucursales, $proveedores;
    public $productoIdToDelete;
    public $file; // Variable para almacenar el archivo de importación
    public $categoriaSeleccionada = ''; // Propiedad para el filtro de categoría



    protected $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:500',
        'precio_c' => 'nullable|numeric',
        'precio_v' => 'nullable|numeric',
        'stock' => 'required|integer|min:0',
        'categoria' => 'required|string',
        'sucursal_id' => 'required|exists:sucursales,id',
        'proveedor_id' => 'nullable|exists:proveedores,id', // Validación de proveedor_id
        'imagen' => 'nullable|image|max:1024',
    ];

    public function mount()
    {
        $this->productos = Productos::all();
        $this->sucursales = Sucursales::all();
        $this->proveedores = Proveedores::all();
        $this->actualizarProductos();

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
        $this->fecha_ingreso = date('d/m/Y', strtotime($producto->created_at));
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
            'proveedor_id' => $this->proveedor_id,
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
            'proveedor_id' => $this->proveedor_id,
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
        $this->proveedor_id = '';
        $this->imagen = null;
        $this->imagenActual = null;
    }


    public function updatedCategoriaSeleccionada()
    {
        $this->actualizarProductos();
    }

    public function actualizarProductos()
    {
        $this->productos = Productos::when($this->categoriaSeleccionada, function ($query) {
            $query->where('categoria', $this->categoriaSeleccionada);
        })->get();
    }


    public function exportar()
    {
        return Excel::download(new ProductosExport, 'productos.xlsx');
    }

    public function importar()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,csv', // Validación del archivo
        ]);

        Excel::import(new ProductosImport, $this->file->path());

        session()->flash('message', 'Productos importados exitosamente.');
        $this->file = null; 
        $this->productos = Productos::all();
    }


    public function render()
    {
        return view('livewire.productos.producto-table');
    }
}
