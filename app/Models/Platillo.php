<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platillo extends Model
{
    use HasFactory;

    public $timestamps = false;

    // Permitir estos campos para la asignación masiva
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen', // Agregar el campo de la imagen
        'categoria',
        'sucursal_id',
    ];

    public function sucursal()
    {
        return $this->belongsTo(Sucursales::class, 'sucursal_id');
    }

}
