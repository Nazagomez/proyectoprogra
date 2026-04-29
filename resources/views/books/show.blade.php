@extends('layouts.app')

@section('title', $book->title)

@section('content')
    <nav class="breadcrumb" aria-label="Miga de pan">
        <a href="{{ route('home') }}">Inicio</a> ›
        <a href="{{ route('categories.show', $book->category) }}">{{ $book->category->name }}</a> ›
        <span>{{ $book->title }}</span>
    </nav>
    <article class="book-detail">
        <div class="book-detail__cover">
            <img src="{{ $book->cover_url }}" alt="Portada: {{ $book->title }}" width="400" height="600" onerror="this.onerror=null;this.src='{{ asset('images/books/placeholder.svg') }}';">
        </div>
        <div>
            <h1 class="book-title">{{ $book->title }}</h1>
            <p class="book-card__author" style="font-size:1rem">por {{ $book->author }}</p>
            <p class="book-detail__price">{{ $book->formatted_price }}</p>
            <p>{{ $book->description }}</p>
            <table class="meta-table">
                <tbody>
                    <tr><th>Editorial</th><td>{{ $book->publisher }}</td></tr>
                    <tr><th>ISBN</th><td>{{ $book->isbn }}</td></tr>
                    <tr><th>Año</th><td>{{ $book->publication_year }}</td></tr>
                    <tr><th>Idioma</th><td>{{ $book->language }}</td></tr>
                    <tr><th>Formato</th><td>{{ $book->format }}</td></tr>
                    <tr><th>Páginas</th><td>{{ $book->pages }}</td></tr>
                    <tr><th>Stock</th><td>{{ $book->stock }} uds.</td></tr>
                    <tr><th>Estado</th><td>{{ $book->status }}</td></tr>
                    @if ($book->image_filename)
                        <tr><th>Archivo imagen</th><td><code>{{ $book->image_filename }}</code></td></tr>
                    @endif
                </tbody>
            </table>
            <div class="crud-actions">
                <a class="btn btn--secondary" href="{{ route('categories.show', $book->category) }}">← Volver a {{ $book->category->name }}</a>
                <a class="btn btn--primary" href="{{ route('books.edit', $book) }}">Editar libro</a>
                <form action="{{ route('books.destroy', $book) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn--danger" type="submit">Eliminar</button>
                </form>
            </div>
        </div>
    </article>
@endsection
