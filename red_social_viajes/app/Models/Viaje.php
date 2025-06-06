<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    use HasFactory;

protected $fillable = ['user_id', 'destino_id', 'titulo', 'descripcion', 'foto'];

    // Relaciones, por ejemplo:
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function destino()
    {
        return $this->belongsTo(Destino::class);
    }
}
