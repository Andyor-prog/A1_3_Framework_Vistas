<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarritoDetalle extends Model
{
    use HasFactory;

    protected $table = 'carrito_detalles';

    protected $fillable = ['carrito_id', 'producto', 'cantidad', 'precio_unitario'];

    protected function casts(): array
    {
        return [
            'cantidad' => 'integer',
            'precio_unitario' => 'decimal:2',
        ];
    }

    public function carrito(): BelongsTo
    {
        return $this->belongsTo(Carrito::class);
    }
}