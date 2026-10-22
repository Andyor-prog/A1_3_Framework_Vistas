@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <section class="intro">
        <p class="eyebrow">GESTIÓN</p>
        <h1>Panel de administración</h1>
        <p>Administra los usuarios, carritos y transacciones del sistema.</p>
    </section>

    <section class="module-grid" aria-label="Tablas disponibles">
        @foreach ([
            ['label' => 'Usuarios', 'description' => 'Perfiles y datos de contacto', 'route' => 'usuarios.index', 'number' => '01'],
            ['label' => 'Carritos', 'description' => 'Carritos asociados a usuarios', 'route' => 'carritos.index', 'number' => '02'],
            ['label' => 'Detalle de carrito', 'description' => 'Productos, cantidades y precios', 'route' => 'carrito-detalles.index', 'number' => '03'],
            ['label' => 'Historial de transacciones', 'description' => 'Movimientos y estados de pago', 'route' => 'historial-transacciones.index', 'number' => '04'],
            ['label' => 'Users', 'description' => 'Cuentas de acceso de Laravel', 'route' => 'users.index', 'number' => '05'],
        ] as $module)
            <a class="module" href="{{ route($module['route']) }}">
                <span class="module-number">{{ $module['number'] }}</span>
                <span class="module-copy">
                    <strong>{{ $module['label'] }}</strong>
                    <small>{{ $module['description'] }}</small>
                </span>
                <span class="module-arrow" aria-hidden="true">&#8594;</span>
            </a>
        @endforeach
    </section>
@endsection
