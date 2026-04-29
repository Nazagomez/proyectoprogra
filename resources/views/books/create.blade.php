@extends('layouts.app')

@section('title', 'Añadir libro')

@section('content')
    <div class="page-head">
        <h1>Añadir libro al catálogo</h1>
        <p>Complete los datos del artículo. El valor de inventario se calcula como precio × stock.</p>
    </div>
    <div class="form-panel">
        <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
            @include('books._form', ['book' => $book, 'categories' => $categories, 'cancelUrl' => route('books.index')])
        </form>
    </div>
@endsection
