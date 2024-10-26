<?php

namespace App\Exports;

use App\Models\Productos;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Productos::select('id', 'nombre', 'descripcion', 'precio_c', 'precio_v', 'stock', 'categoria', 'sucursal_id', 'proveedor_id', 'created_at')->get();
    }
}
