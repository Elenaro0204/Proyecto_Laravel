<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Viaje;
use App\Models\Destino;

use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',  // Añade este campo
        'telefono',
        'direccion',
        'fecha_nacimiento',
        'avatar',
        'ciudad',
        'pais',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean', // añade esto
    ];

    public function isAdmin(): bool
    {
        return $this->is_admin === true;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function viajes(): HasMany
    {
        return $this->hasMany(Viaje::class);
    }

    public function destinosVisitados()
    {
        return $this->hasMAny(Destino::class);
    }
}
