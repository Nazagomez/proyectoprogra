@extends('layouts.app')

@section('title', 'Catálogo')

@section('content')
    <div class="page-head">
        <h1>Catálogo</h1>
        @if ($keyword !== '')
            <p>Resultados para «{{ $keyword }}» — {{ $books->total() }} coincidencias</p>
        @else
            <p>Todos los libros disponibles</p>
        @endif
    </div>
    @if ($books->isEmpty())
        <p class="empty-state">No se encontraron libros. <a href="{{ route('home') }}">Volver al inicio</a> o <a href="{{ route('books.create') }}">crear uno nuevo</a>.</p>
    @else
        <div class="book-grid">
            @foreach ($books as $book)
                @include('partials.book-card', ['book' => $book])
            @endforeach
        </div>
        {{ $books->links() }}
    @endif
@endsection
