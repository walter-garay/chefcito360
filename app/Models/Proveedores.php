<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'direccion',
        'celular',
        'correo',
        'prov_estado',
    ];

    // Relación con la tabla Productos
    public function productos()
    {
        return $this->hasMany(Productos::class, 'proveedor_id');
    }
}
