<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Books in this category with pagination.
     */
    public function show(Category $category): View
    {
        $books = $category->books()
            ->orderBy('title')
            ->paginate(12);
        return view('categories.show', [
            'category' => $category,
            'books' => $books,
        ]);
    }
}
