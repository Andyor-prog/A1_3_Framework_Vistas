<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestión') | Laravel</title>
    <style>
        :root {
            color-scheme: light;
            --ink: #1b2b40;
            --muted: #5d6d80;
            --paper: #f2f5f9;
            --surface: #ffffff;
            --line: #d6dee8;
            --navy: #17365d;
            --blue: #245a8d;
            --blue-dark: #19466f;
            --blue-light: #e8eff7;
            --red: #a33d43;
            --shadow: 0 5px 16px rgba(27, 43, 64, .06);
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            color: var(--ink);
            background: var(--paper);
            font-family: "Segoe UI", Tahoma, sans-serif;
            line-height: 1.5;
        }
        a { color: inherit; }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            width: 100%;
            padding: 1rem max(calc((100% - 1120px) / 2), 1.5rem);
            background: var(--navy);
        }
        .brand { color: white; font-size: .95rem; font-weight: 700; text-decoration: none; }
        .topbar nav { display: flex; gap: 1rem; }
        .topbar nav a { color: #dbe6f2; font-size: .9rem; text-decoration: none; }
        .topbar nav a:hover { color: white; text-decoration: underline; }
        main { width: min(1120px, 100%); min-height: calc(100vh - 56px); margin: auto; padding: 2.6rem 1.5rem 4rem; }
        .intro { max-width: 700px; margin-bottom: 1.8rem; }
        .eyebrow { margin: 0 0 .55rem; color: var(--blue); font-size: .75rem; font-weight: 700; }
        h1 { margin: 0; font-size: 2.2rem; line-height: 1.2; }
        .intro > p:last-child { margin: .65rem 0 0; color: var(--muted); }
        .module-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: .65rem; }
        .module {
            display: flex;
            align-items: center;
            gap: .85rem;
            min-height: 78px;
            padding: 1rem 1.1rem;
            border: 1px solid var(--line);
            border-radius: 4px;
            background: var(--surface);
            text-decoration: none;
        }
        .module:hover { border-color: #91aac5; background: #f9fbfd; }
        .module-number { color: var(--blue); font-size: .78rem; font-weight: 700; }
        .module-copy { display: grid; gap: .18rem; flex: 1; min-width: 0; }
        .module-copy strong { font-size: 1rem; }
        .module-copy small { color: var(--muted); font-size: .85rem; }
        .module-arrow { color: var(--blue); font-size: 1.1rem; }
        .page-heading { display: flex; align-items: end; justify-content: space-between; gap: 1rem; margin-bottom: 1.2rem; }
        .page-heading h1 { font-size: 2rem; }
        .page-heading p { margin: .4rem 0 0; color: var(--muted); }
        .button, button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 38px;
            padding: .5rem .8rem;
            border: 1px solid var(--blue);
            border-radius: 4px;
            background: var(--blue);
            color: white;
            cursor: pointer;
            font: inherit;
            font-size: .88rem;
            font-weight: 600;
            text-decoration: none;
        }
        .button:hover, button:hover { background: var(--blue-dark); }
        .button.secondary { background: white; color: var(--blue-dark); }
        .button.secondary:hover { background: var(--blue-light); }
        .table-wrap { overflow-x: auto; border: 1px solid var(--line); border-radius: 4px; background: var(--surface); box-shadow: var(--shadow); }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th, td { padding: .75rem .9rem; border-bottom: 1px solid var(--line); vertical-align: middle; }
        th { color: #455a72; background: #eaf0f6; font-size: .76rem; text-transform: uppercase; }
        tr:last-child td { border-bottom: 0; }
        td { font-size: .9rem; }
        .actions { display: flex; align-items: center; gap: .55rem; white-space: nowrap; }
        .actions form { margin: 0; }
        .link-button { padding: 0; border: 0; background: none; color: var(--blue); cursor: pointer; font: inherit; font-size: .88rem; font-weight: 600; }
        .link-button:hover { background: none; color: var(--blue-dark); text-decoration: underline; }
        .link-button.danger { color: var(--red); }
        .empty { padding: 2.5rem; color: var(--muted); text-align: center; }
        .form-panel { max-width: 680px; padding: 1.35rem; border: 1px solid var(--line); border-radius: 4px; background: var(--surface); box-shadow: var(--shadow); }
        .field { display: grid; gap: .35rem; margin-bottom: .95rem; }
        .field label { font-size: .88rem; font-weight: 700; }
        input, select, textarea { width: 100%; min-height: 38px; padding: .5rem .65rem; border: 1px solid #b9c7d7; border-radius: 3px; background: white; color: var(--ink); font: inherit; }
        textarea { min-height: 90px; resize: vertical; }
        input:focus, select:focus, textarea:focus { outline: 2px solid rgba(36, 90, 141, .2); border-color: var(--blue); }
        .error { color: var(--red); font-size: .82rem; }
        .notice { margin-bottom: 1.2rem; padding: .75rem .9rem; border-left: 3px solid var(--blue); background: var(--blue-light); color: var(--navy); }
        .pagination { margin-top: 1rem; }
        @media (max-width: 700px) {
            main { padding: 2rem 1rem 3rem; }
            .topbar { padding: .9rem 1rem; }
            .module-grid { grid-template-columns: 1fr; }
            .page-heading { align-items: start; flex-direction: column; }
            .form-panel { padding: 1rem; }
            h1 { font-size: 1.9rem; }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <a class="brand" href="{{ route('home') }}">Panel de administración</a>
        <nav aria-label="Navegación principal">
            <a href="{{ route('home') }}">Inicio</a>
        </nav>
    </header>
    <main>
        @if (session('success'))
            <div class="notice" role="status">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>