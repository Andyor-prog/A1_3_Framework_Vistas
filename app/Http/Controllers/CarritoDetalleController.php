<?php

namespace App\Http\Controllers;

use App\Models\CarritoDetalle;

class CarritoDetalleController extends BaseResourceController
{
    protected string $modelClass = CarritoDetalle::class;
    protected string $title = 'Detalle de carrito';
    protected string $routeName = 'carrito-detalles';

    protected array $fields = [
        'carrito_id' => ['label' => 'ID de carrito', 'type' => 'number'],
        'producto' => ['label' => 'Producto', 'type' => 'text'],
        'cantidad' => ['label' => 'Cantidad', 'type' => 'number'],
        'precio_unitario' => ['label' => 'Precio unitario', 'type' => 'number', 'step' => '0.01'],
    ];

    protected array $createRules = [
        'carrito_id' => ['required', 'integer', 'exists:carritos,id'],
        'producto' => ['required', 'string', 'max:255'],
        'cantidad' => ['required', 'integer', 'min:1'],
        'precio_unitario' => ['required', 'numeric', 'min:0'],
    ];

    protected array $updateRules = [
        'carrito_id' => ['required', 'integer', 'exists:carritos,id'],
        'producto' => ['required', 'string', 'max:255'],
        'cantidad' => ['required', 'integer', 'min:1'],
        'precio_unitario' => ['required', 'numeric', 'min:0'],
    ];
}