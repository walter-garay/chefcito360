<?php

namespace App\Livewire\Sucursales;

use Livewire\Component;
use App\Models\Sucursales;

class ListarSucursal extends Component
{
    protected $listeners = ['guardado'=>'getSucursales'];

    public function mount()
    {
        return $this->getSucursales();
    }
    public function getSucursales()
    {
       $sucursales = Sucursales::where('suc_estado',1)->orderBy('id','desc')->paginate(10);
       return $sucursales??[];
    }
    
    public function render()
    {
        return view('livewire.sucursales.listar-sucursal',[
            'sucursales'=>$this->getSucursales()]);
    }
}
