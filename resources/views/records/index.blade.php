@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">TABLA</p>
            <h1>{{ $title }}</h1>
            <p>{{ $records->total() }} registros</p>
        </div>
        <a class="button" href="{{ route($routeName . '.create') }}">Nuevo registro</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    @foreach ($fields as $fieldName => $field)
                        @if (($field['type'] ?? '') !== 'password')
                            <th>{{ $field['label'] }}</th>
                        @endif
                    @endforeach
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($records as $record)
                    <tr>
                        <td>{{ $record->getKey() }}</td>
                        @foreach ($fields as $fieldName => $field)
                            @if (($field['type'] ?? '') !== 'password')
                                <td>{{ $record->{$fieldName} ?? '—' }}</td>
                            @endif
                        @endforeach
                        <td>
                            <div class="actions">
                                <a class="link-button" href="{{ route($routeName . '.edit', $record->getKey()) }}">Editar</a>
                                <form method="POST" action="{{ route($routeName . '.destroy', $record->getKey()) }}" onsubmit="return confirm('¿Eliminar este registro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="link-button danger" type="submit">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="empty" colspan="{{ count(array_filter($fields, fn ($field) => ($field['type'] ?? '') !== 'password')) + 2 }}">Aún no hay registros en esta tabla.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination">{{ $records->links() }}</div>
@endsection