<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LibroStore') — Tienda de libros</title>
    <link rel="stylesheet" href="{{ asset('css/bookstore.css') }}">
</head>
<body>
@include('partials.header')

<main class="site-main">
    @if (session('success'))
        <p class="flash" role="status">{{ session('success') }}</p>
    @endif
    @yield('content')
</main>

@include('partials.footer')
</body>
</html>
