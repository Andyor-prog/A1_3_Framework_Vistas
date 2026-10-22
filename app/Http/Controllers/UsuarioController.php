<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class UsuarioController extends BaseResourceController
{
    protected string $modelClass = Usuario::class;
    protected string $title = 'Usuarios';
    protected string $routeName = 'usuarios';

    protected array $fields = [
        'nombre' => ['label' => 'Nombre', 'type' => 'text'],
        'email' => ['label' => 'Correo electrónico', 'type' => 'email'],
        'telefono' => ['label' => 'Teléfono', 'type' => 'tel'],
        'direccion' => ['label' => 'Dirección', 'type' => 'text'],
    ];

    protected array $createRules = [
        'nombre' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:usuarios,email'],
        'telefono' => ['nullable', 'string', 'max:30'],
        'direccion' => ['nullable', 'string', 'max:255'],
    ];

    protected array $updateRules = [
        'nombre' => ['required', 'string', 'max:255'],
        'telefono' => ['nullable', 'string', 'max:30'],
        'direccion' => ['nullable', 'string', 'max:255'],
    ];

    protected function rulesForUpdate(Model $record): array
    {
        return array_merge($this->updateRules, [
            'email' => ['required', 'email', 'max:255', Rule::unique('usuarios', 'email')->ignore($record->getKey())],
        ]);
    }
}