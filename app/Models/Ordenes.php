<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordenes extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function platillos()
    {
        return $this->belongsToMany(Platillo::class, 'platillos_ordenes', 'orden_id', 'platillo_id')
                    ->withPivot('cantidad');
    }
}
