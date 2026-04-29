@extends('layouts.app')

@section('title', 'Editar: '.$book->title)

@section('content')
    <nav class="breadcrumb" aria-label="Miga de pan">
        <a href="{{ route('home') }}">Inicio</a> ›
        <a href="{{ route('books.show', $book) }}">{{ $book->title }}</a> ›
        <span>Editar</span>
    </nav>
    <div class="page-head">
        <h1>Editar libro</h1>
    </div>
    <div class="form-panel">
        <form action="{{ route('books.update', $book) }}" method="post" enctype="multipart/form-data">
            @include('books._form', ['book' => $book, 'categories' => $categories, 'cancelUrl' => route('books.show', $book), 'method' => 'PUT'])
        </form>
    </div>
@endsection
