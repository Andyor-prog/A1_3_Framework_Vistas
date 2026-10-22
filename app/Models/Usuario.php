<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = ['nombre', 'email', 'telefono', 'direccion'];

    public function carritos(): HasMany
    {
        return $this->hasMany(Carrito::class);
    }

    public function historialTransacciones(): HasMany
    {
        return $this->hasMany(HistorialTransaccion::class);
    }
}