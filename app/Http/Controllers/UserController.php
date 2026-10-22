<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class UserController extends BaseResourceController
{
    protected string $modelClass = User::class;
    protected string $title = 'Users';
    protected string $routeName = 'users';

    protected array $fields = [
        'name' => ['label' => 'Nombre', 'type' => 'text'],
        'email' => ['label' => 'Correo electrónico', 'type' => 'email'],
        'password' => ['label' => 'Contraseña', 'type' => 'password'],
    ];

    protected array $createRules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string', 'min:8'],
    ];

    protected array $updateRules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'password' => ['nullable', 'string', 'min:8'],
    ];

    protected function rulesForUpdate(Model $record): array
    {
        return array_merge($this->updateRules, [
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($record->getKey())],
        ]);
    }
}