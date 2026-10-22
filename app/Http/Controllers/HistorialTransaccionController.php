<?php

namespace App\Http\Controllers;

use App\Models\HistorialTransaccion;

class HistorialTransaccionController extends BaseResourceController
{
    protected string $modelClass = HistorialTransaccion::class;
    protected string $title = 'Historial de transacciones';
    protected string $routeName = 'historial-transacciones';

    protected array $fields = [
        'usuario_id' => ['label' => 'ID de usuario', 'type' => 'number'],
        'carrito_id' => ['label' => 'ID de carrito', 'type' => 'number'],
        'tipo' => ['label' => 'Tipo', 'type' => 'text'],
        'estado' => ['label' => 'Estado', 'type' => 'select', 'options' => ['pendiente' => 'Pendiente', 'completada' => 'Completada', 'fallida' => 'Fallida']],
        'monto' => ['label' => 'Monto', 'type' => 'number', 'step' => '0.01'],
        'descripcion' => ['label' => 'Descripción', 'type' => 'textarea'],
    ];

    protected array $createRules = [
        'usuario_id' => ['nullable', 'integer', 'exists:usuarios,id'],
        'carrito_id' => ['nullable', 'integer', 'exists:carritos,id'],
        'tipo' => ['required', 'string', 'max:100'],
        'estado' => ['required', 'in:pendiente,completada,fallida'],
        'monto' => ['required', 'numeric', 'min:0'],
        'descripcion' => ['nullable', 'string'],
    ];

    protected array $updateRules = [
        'usuario_id' => ['nullable', 'integer', 'exists:usuarios,id'],
        'carrito_id' => ['nullable', 'integer', 'exists:carritos,id'],
        'tipo' => ['required', 'string', 'max:100'],
        'estado' => ['required', 'in:pendiente,completada,fallida'],
        'monto' => ['required', 'numeric', 'min:0'],
        'descripcion' => ['nullable', 'string'],
    ];
}