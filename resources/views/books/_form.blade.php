@csrf
@isset($method)
    @method($method)
@endisset

<div class="form-row">
    <label for="category_id">Categoría</label>
    <select id="category_id" name="category_id" required>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id) == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category_id')<p class="form-error">{{ $message }}</p>@enderror
</div>
<div class="form-row">
    <label for="title">Título</label>
    <input id="title" name="title" type="text" value="{{ old('title', $book->title) }}" required maxlength="255">
    @error('title')<p class="form-error">{{ $message }}</p>@enderror
</div>
<div class="form-row">
    <label for="author">Autor</label>
    <input id="author" name="author" type="text" value="{{ old('author', $book->author) }}" required maxlength="255">
    @error('author')<p class="form-error">{{ $message }}</p>@enderror
</div>
<div class="form-row">
    <label for="publisher">Editorial</label>
    <input id="publisher" name="publisher" type="text" value="{{ old('publisher', $book->publisher) }}" required maxlength="255">
    @error('publisher')<p class="form-error">{{ $message }}</p>@enderror
</div>
<div class="form-row">
    <label for="price">Precio (CRC, entero)</label>
    <input id="price" name="price" type="number" min="0" step="1" value="{{ old('price', $book->price) }}" required>
    @error('price')<p class="form-error">{{ $message }}</p>@enderror
</div>
<div class="form-row">
    <label for="currency">Moneda</label>
    <input id="currency" name="currency" type="text" value="{{ old('currency', $book->currency ?? 'CRC') }}" maxlength="8" required>
    @error('currency')<p class="form-error">{{ $message }}</p>@enderror
</div>
<div class="form-row">
    <label for="language">Idioma</label>
    <input id="language" name="language" type="text" value="{{ old('language', $book->language) }}" maxlength="32" required>
    @error('language')<p class="form-error">{{ $message }}</p>@enderror
</div>
<div class="form-row">
    <label for="format">Formato</label>
    <select id="format" name="format" required>
        @foreach (['Físico', 'Digital', 'Audiolibro'] as $formatOption)
            <option value="{{ $formatOption }}" @selected(old('format', $book->format) === $formatOption)>{{ $formatOption }}</option>
        @endforeach
    </select>
    @error('format')<p class="form-error">{{ $message }}</p>@enderror
</div>
<div class="form-row">
    <label for="pages">Páginas</label>
    <input id="pages" name="pages" type="number" min="1" step="1" value="{{ old('pages', $book->pages) }}" required>
    @error('pages')<p class="form-error">{{ $message }}</p>@enderror
</div>
<div class="form-row">
    <label for="isbn">ISBN</label>
    <input id="isbn" name="isbn" type="text" value="{{ old('isbn', $book->isbn) }}" maxlength="32" required>
    @error('isbn')<p class="form-error">{{ $message }}</p>@enderror
</div>
<div class="form-row">
    <label for="publication_year">Año de publicación</label>
    <input id="publication_year" name="publication_year" type="number" step="1" value="{{ old('publication_year', $book->publication_year) }}" required>
    @error('publication_year')<p class="form-error">{{ $message }}</p>@enderror
</div>
<div class="form-row">
    <label for="stock">Unidades en stock</label>
    <input id="stock" name="stock" type="number" min="0" step="1" value="{{ old('stock', $book->stock ?? 0) }}" required>
    @error('stock')<p class="form-error">{{ $message }}</p>@enderror
</div>
<div class="form-row">
    <label for="status">Estado</label>
    <select id="status" name="status" required>
        @foreach (['Disponible', 'Agotado', 'Próximamente'] as $statusOption)
            <option value="{{ $statusOption }}" @selected(old('status', $book->status ?? 'Disponible') === $statusOption)>{{ $statusOption }}</option>
        @endforeach
    </select>
    @error('status')<p class="form-error">{{ $message }}</p>@enderror
</div>
<div class="form-row">
    <label for="image_filename">Nombre archivo imagen (opcional)</label>
    <input id="image_filename" name="image_filename" type="text" value="{{ old('image_filename', $book->image_filename) }}" maxlength="255" placeholder="ej. mi_libro.jpg">
    @error('image_filename')<p class="form-error">{{ $message }}</p>@enderror
</div>
<div class="form-row">
    <label for="cover_image">Subir portada (opcional)</label>
    <input id="cover_image" name="cover_image" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
    <small>Si subes un archivo, reemplaza el nombre de archivo manual.</small>
    @error('cover_image')<p class="form-error">{{ $message }}</p>@enderror
</div>
<div class="form-row">
    <label for="description">Descripción</label>
    <textarea id="description" name="description" required>{{ old('description', $book->description) }}</textarea>
    @error('description')<p class="form-error">{{ $message }}</p>@enderror
</div>
<div class="crud-actions">
    <button class="btn btn--primary" type="submit">Guardar</button>
    <a class="btn btn--secondary" href="{{ $cancelUrl }}">Cancelar</a>
</div>
