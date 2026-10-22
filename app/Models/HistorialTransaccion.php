<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistorialTransaccion extends Model
{
    use HasFactory;

    protected $table = 'historial_transacciones';

    protected $fillable = ['usuario_id', 'carrito_id', 'tipo', 'estado', 'monto', 'descripcion'];

    protected function casts(): array
    {
        return ['monto' => 'decimal:2'];
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    }

    public function carrito(): BelongsTo
    {
        return $this->belongsTo(Carrito::class);
    }
}