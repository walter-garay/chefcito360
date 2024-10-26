<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_c',
        'precio_v',
        'prod_estado',
        'stock',
        'categoria',
        'sucursal_id',
        'cocinero_id',
        'proveedor_id',
    ];

    // Relación con la tabla Sucursales
    public function sucursal()
    {
        return $this->belongsTo(Sucursales::class, 'sucursal_id');
    }

    // Relación con la tabla Users (Cocinero)
    public function cocinero()
    {
        return $this->belongsTo(User::class, 'cocinero_id');
    }

    // Relación con la tabla Proveedores
    public function proveedor()
    {
        return $this->belongsTo(Proveedores::class, 'proveedor_id');
    }
}
