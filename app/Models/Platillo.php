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
        'imagen',
        'categoria',
        'estado',
        'comentario',
        'sucursal_id',
    ];

    public function sucursal()
    {
        return $this->belongsTo(Sucursales::class, 'sucursal_id');
    }

    public function ordenes()
    {
        return $this->belongsToMany(Ordenes::class, 'platillos_ordenes', 'platillo_id', 'orden_id')
                    ->withPivot('cantidad');
    }

}
