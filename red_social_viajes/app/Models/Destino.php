<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Destino extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'pais', 'descripcion', 'imagen'];

    public function viajes()
    {
        return $this->hasMany(Viaje::class);
    }
}
