<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categorias/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/libros', [BookController::class, 'index'])->name('books.index');
Route::get('/libros/crear', [BookController::class, 'create'])->name('books.create');
Route::post('/libros', [BookController::class, 'store'])->name('books.store');
Route::get('/libros/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('/libros/{book}/editar', [BookController::class, 'edit'])->name('books.edit');
Route::put('/libros/{book}', [BookController::class, 'update'])->name('books.update');
Route::delete('/libros/{book}', [BookController::class, 'destroy'])->name('books.destroy');
