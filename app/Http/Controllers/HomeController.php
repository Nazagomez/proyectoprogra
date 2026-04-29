<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Storefront home: categories and featured titles.
     */
    public function index(): View
    {
        $categories = Category::query()
            ->withCount('books')
            ->orderBy('name')
            ->get();
        $featuredBooks = Book::query()
            ->with('category')
            ->inRandomOrder()
            ->limit(8)
            ->get();
        return view('home', [
            'categories' => $categories,
            'featuredBooks' => $featuredBooks,
        ]);
    }
}
