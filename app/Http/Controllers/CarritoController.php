<?php

namespace App\Http\Controllers;

use App\Models\Carrito;

class CarritoController extends BaseResourceController
{
    protected string $modelClass = Carrito::class;
    protected string $title = 'Carritos';
    protected string $routeName = 'carritos';

    protected array $fields = [
        'usuario_id' => ['label' => 'ID de usuario', 'type' => 'number'],
        'estado' => ['label' => 'Estado', 'type' => 'select', 'options' => ['activo' => 'Activo', 'finalizado' => 'Finalizado', 'abandonado' => 'Abandonado']],
        'total' => ['label' => 'Total', 'type' => 'number', 'step' => '0.01'],
    ];

    protected array $createRules = [
        'usuario_id' => ['required', 'integer', 'exists:usuarios,id'],
        'estado' => ['required', 'in:activo,finalizado,abandonado'],
        'total' => ['required', 'numeric', 'min:0'],
    ];

    protected array $updateRules = [
        'usuario_id' => ['required', 'integer', 'exists:usuarios,id'],
        'estado' => ['required', 'in:activo,finalizado,abandonado'],
        'total' => ['required', 'numeric', 'min:0'],
    ];
}