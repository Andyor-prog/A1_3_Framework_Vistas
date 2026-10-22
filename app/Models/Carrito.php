<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carrito extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_id', 'estado', 'total'];

    protected function casts(): array
    {
        return ['total' => 'decimal:2'];
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(CarritoDetalle::class);
    }

    public function historialTransacciones(): HasMany
    {
        return $this->hasMany(HistorialTransaccion::class);
    }
}