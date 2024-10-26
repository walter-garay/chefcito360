<?php

namespace App\Imports;

use App\Models\Productos;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Productos([
            'nombre' => $row[0],            // Nombre del producto
            'descripcion' => $row[1],       // Descripción
            'precio_c' => is_numeric($row[2]) ? $row[2] : 0,  // Precio de compra
            'precio_v' => is_numeric($row[3]) ? $row[3] : 0,  // Precio de venta
            'stock' => is_numeric($row[4]) ? $row[4] : 0,     // Stock
            'categoria' => $row[5],         // Categoría
            'sucursal_id' => is_numeric($row[6]) ? $row[6] : null,  // ID de la sucursal
            'proveedor_id' => is_numeric($row[7]) ? $row[7] : null, // ID del proveedor
        ]);
    }


}
