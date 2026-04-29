@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <section class="hero">
        <h1>Tu próxima lectura te espera</h1>
        <p>Explora por categorías, consulta fichas detalladas y administra el catálogo con operaciones completas sobre cada título.</p>
    </section>

    <h2 class="section-title">Categorías</h2>
    <div class="category-chips">
        @foreach ($categories as $category)
            <a class="chip" href="{{ route('categories.show', $category) }}">
                {{ $category->name }}
                <span class="chip__meta">· {{ $category->books_count }} títulos</span>
            </a>
        @endforeach
    </div>

    <h2 class="section-title">Selección destacada</h2>
    <div class="book-grid">
        @foreach ($featuredBooks as $book)
            @include('partials.book-card', ['book' => $book])
        @endforeach
    </div>
@endsection
