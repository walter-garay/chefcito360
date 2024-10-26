<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function ordenes()
    {
        return $this->hasMany(Ordenes::class);
    }



    protected $fillable = [
        'numero',
        'mesas_estado',
        'sucursal_id',
    ];

    const ESTADO_DISPONIBLE = 1;
    const ESTADO_RESERVADA = 2;
    const ESTADO_OCUPADA = 3;

    public function sucursal()
    {

        return $this->belongsTo(Sucursales::class, 'sucursal_id');
    }
}
