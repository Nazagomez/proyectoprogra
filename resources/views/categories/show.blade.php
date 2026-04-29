@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <nav class="breadcrumb" aria-label="Miga de pan">
        <a href="{{ route('home') }}">Inicio</a> › <span>{{ $category->name }}</span>
    </nav>
    <div class="page-head">
        <h1>{{ $category->name }}</h1>
        <p>{{ $books->total() }} títulos en esta categoría</p>
    </div>
    @if ($books->isEmpty())
        <p class="empty-state">No hay libros en esta categoría. <a href="{{ route('books.create') }}">Añadir un libro</a></p>
    @else
        <div class="book-grid">
            @foreach ($books as $book)
                @include('partials.book-card', ['book' => $book])
            @endforeach
        </div>
        {{ $books->links() }}
    @endif
@endsection
