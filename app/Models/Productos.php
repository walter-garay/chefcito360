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
        'precio_c', // Precio de compra
        'precio_v', // Precio de venta
        'prod_estado',
        'stock',
        'categoria',
        'sucursal_id',
        'cocinero_id', // Este campo puede ser null
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
}
