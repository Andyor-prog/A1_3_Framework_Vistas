@extends('layouts.app')

@section('title', ($record ? 'Editar ' : 'Nuevo ') . $title)

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">{{ $record ? 'EDICIÓN' : 'ALTA' }}</p>
            <h1>{{ $record ? 'Editar ' : 'Nuevo ' }}{{ $title }}</h1>
        </div>
        <a class="button secondary" href="{{ route($routeName . '.index') }}">Volver al listado</a>
    </div>

    <form class="form-panel" method="POST" action="{{ $record ? route($routeName . '.update', $record->getKey()) : route($routeName . '.store') }}">
        @csrf
        @if ($record)
            @method('PUT')
        @endif

        @foreach ($fields as $fieldName => $field)
            <div class="field">
                <label for="{{ $fieldName }}">{{ $field['label'] }}</label>
                @if (($field['type'] ?? 'text') === 'textarea')
                    <textarea id="{{ $fieldName }}" name="{{ $fieldName }}">{{ old($fieldName, $record?->{$fieldName}) }}</textarea>
                @elseif (($field['type'] ?? 'text') === 'select')
                    <select id="{{ $fieldName }}" name="{{ $fieldName }}">
                        @foreach ($field['options'] as $optionValue => $optionLabel)
                            <option value="{{ $optionValue }}" @selected((string) old($fieldName, $record?->{$fieldName}) === (string) $optionValue)>{{ $optionLabel }}</option>
                        @endforeach
                    </select>
                @else
                    <input
                        id="{{ $fieldName }}"
                        name="{{ $fieldName }}"
                        type="{{ $field['type'] ?? 'text' }}"
                        value="{{ ($field['type'] ?? '') === 'password' ? '' : old($fieldName, $record?->{$fieldName}) }}"
                        @if (($field['type'] ?? '') === 'number') step="{{ $field['step'] ?? '1' }}" min="{{ $field['min'] ?? '0' }}" @endif
                        @if (($field['type'] ?? '') === 'password' && $record) placeholder="Dejar vacío para conservar la contraseña" @endif
                    >
                @endif
                @error($fieldName)
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        @endforeach

        <button type="submit">{{ $record ? 'Guardar cambios' : 'Crear registro' }}</button>
    </form>
@endsection