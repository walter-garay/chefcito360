<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursales extends Model
{
    use HasFactory;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function users() {
    	return $this->belongsToMany(User::class, 'user_sucursal', 'sucursal_id', 'empleado_id');
    }
}
