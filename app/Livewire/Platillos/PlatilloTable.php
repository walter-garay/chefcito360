<?php

namespace App\Livewire\Platillos;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Platillo;
use App\Models\Sucursales;

class PlatilloTable extends Component
{
    use WithFileUploads;

    public $platillos, $nombre, $descripcion, $precio, $categoria, $sucursal_id, $imagen, $imagenActual, $estado, $comentario;
    public $isEditing = false;
    public $showModal = false;
    public $showConfirmModal = false;
    public $sucursales;
    public $platilloIdToDelete;
    public $platilloId;


    protected $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string|max:500',
        'precio' => 'required|numeric',
        'categoria' => 'required|string',
        'sucursal_id' => 'required|exists:sucursales,id',
        'imagen' => 'nullable|image|max:1024',
        'estado' => 'nullable',
        'comentario' => 'nullable|string|max:500',
    ];

    public function mount()
    {
        if (Auth::user()->hasRole('ADMINISTRADOR')) {
            // Filtra los platillos de la sucursal asignada al administrador
            $this->platillos = Platillo::where('sucursal_id', Auth::user()->sucursal_id)->get();
        } else {
            // Muestra todos los platillos para otros roles
            $this->platillos = Platillo::all();
        }

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
        $this->platilloId = $id;
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
            'estado' => $this->estado,
            'comentario' => $this->comentario,
        ]);

        session()->flash('message', 'Platillo creado con éxito.');
        $this->closeModal();
        $this->platillos = Platillo::all();
    }

    public function update()
    {
        $this->validate($this->rules);

        $platillo = Platillo::findOrFail($this->platilloId);

        // Si hay una nueva imagen, la cargamos, de lo contrario, mantenemos la actual
        $imagenPath = $this->imagen ? $this->imagen->store('platillos', 'public') : $this->imagenActual;

        $platillo->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'categoria' => $this->categoria,
            'sucursal_id' => $this->sucursal_id,
            'imagen' => $imagenPath,
            'estado' => $this->estado,
            'comentario' => $this->comentario,
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
        $this->estado = '';
        $this->comentario = '';
        $this->platilloId = null;
    }

    public function render()
    {
        return view('livewire.platillos.platillo-table');
    }
}
