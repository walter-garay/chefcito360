<?php

namespace App\Livewire\Sucursales;

use Livewire\Component;
use App\Models\Sucursales;



class ListarSucursal extends Component
{
   
    public $sucursales;

    protected $listeners = [
        'guardado'=>'getSucursales',
        'sucursalActualizado'=>'getSucursales',
        'eliminado'=>'getSucursales'];

    public function mount()
    {
        $this->getSucursales();
    }
    public function getSucursales()
    {
       $this->sucursales =Sucursales::where('suc_estado',1)->get();
    }
    public function eliminar($id)
    {
        $this->dispatch('eliminar',$id);
    }
    
    public function editar($id)
    {
        $this->dispatch('editar',$id);
    }
    public function render()
    {
        return view('livewire.sucursales.listar-sucursal',[
            'sucursales'=>$this->sucursales]);
    }
}
