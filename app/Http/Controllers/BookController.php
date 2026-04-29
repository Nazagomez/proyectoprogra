<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * List all books with optional keyword search and pagination.
     */
    public function index(Request $request): View
    {
        $query = Book::query()->with('category')->orderByDesc('id');
        $keyword = $request->string('q')->trim()->value();
        if ($keyword !== '') {
            $query->where(function ($sub) use ($keyword): void {
                $like = '%'.$keyword.'%';
                $sub->where('title', 'like', $like)
                    ->orWhere('author', 'like', $like)
                    ->orWhere('description', 'like', $like)
                    ->orWhere('isbn', 'like', $like)
                    ->orWhere('publisher', 'like', $like);
            });
        }
        $books = $query->paginate(12)->withQueryString();
        return view('books.index', [
            'books' => $books,
            'keyword' => $keyword,
        ]);
    }

    /**
     * Show the form for creating a new book.
     */
    public function create(): View
    {
        return view('books.create', [
            'categories' => Category::query()->orderBy('name')->get(),
            'book' => new Book,
        ]);
    }

    /**
     * Store a newly created book.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['image_filename'] = $this->resolveImageFilename([
            'request' => $request,
            'currentImageFilename' => null,
            'manualImageFilename' => $data['image_filename'] ?? null,
        ]);
        $data['inventory_value'] = $data['price'] * $data['stock'];
        $book = Book::query()->create($data);
        return redirect()
            ->route('books.show', $book)
            ->with('success', 'Libro creado correctamente.');
    }

    /**
     * Display the specified book (CRUD actions available from this view).
     */
    public function show(Book $book): View
    {
        $book->load('category');
        return view('books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit(Book $book): View
    {
        return view('books.edit', [
            'book' => $book,
            'categories' => Category::query()->orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified book.
     */
    public function update(Request $request, Book $book): RedirectResponse
    {
        $data = $this->validated($request);
        $data['image_filename'] = $this->resolveImageFilename([
            'request' => $request,
            'currentImageFilename' => $book->image_filename,
            'manualImageFilename' => $data['image_filename'] ?? null,
        ]);
        $data['inventory_value'] = $data['price'] * $data['stock'];
        $book->update($data);
        return redirect()
            ->route('books.show', $book)
            ->with('success', 'Libro actualizado correctamente.');
    }

    /**
     * Remove the specified book.
     */
    public function destroy(Book $book): RedirectResponse
    {
        $category = $book->category;
        $book->delete();
        return redirect()
            ->route('categories.show', $category)
            ->with('success', 'Libro eliminado. La lista de la categoría fue actualizada.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'currency' => ['required', 'string', 'max:8'],
            'language' => ['required', 'string', 'max:32'],
            'format' => ['required', 'string', 'max:32'],
            'pages' => ['required', 'integer', 'min:1'],
            'isbn' => ['required', 'string', 'max:32'],
            'publication_year' => ['required', 'integer', 'min:-3000', 'max:2100'],
            'stock' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'string', 'max:32'],
            'image_filename' => ['nullable', 'string', 'max:255'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'description' => ['required', 'string'],
        ]);
    }

    /**
     * Resolve final image filename using uploaded file first, then manual input.
     *
     * @param array{
     *     request: Request,
     *     currentImageFilename: string|null,
     *     manualImageFilename: mixed
     * } $params
     */
    private function resolveImageFilename(array $params): ?string
    {
        $request = $params['request'];
        $currentImageFilename = $params['currentImageFilename'];
        $manualImageFilename = $params['manualImageFilename'];
        if (! $request->hasFile('cover_image')) {
            return is_string($manualImageFilename) && $manualImageFilename !== ''
                ? $manualImageFilename
                : $currentImageFilename;
        }
        /** @var UploadedFile $coverImage */
        $coverImage = $request->file('cover_image');
        $extension = strtolower($coverImage->getClientOriginalExtension());
        $filename = Str::uuid()->toString().'.'.$extension;
        $coverImage->move(public_path('images/books'), $filename);
        return $filename;
    }
}
