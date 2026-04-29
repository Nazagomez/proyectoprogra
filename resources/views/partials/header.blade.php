<header class="site-header">
    <div class="site-header__bar">
        <a class="site-logo" href="{{ route('home') }}">Libro<span>Store</span></a>
        <form class="header-search" action="{{ route('books.index') }}" method="get" role="search">
            <input class="header-search__input" type="search" name="q" value="{{ request('q') }}" placeholder="Buscar por título, autor, ISBN…" aria-label="Buscar libros">
            <button class="header-search__submit" type="submit">Buscar</button>
        </form>
        <div class="header-actions">
            <a href="{{ route('books.index') }}">Catálogo</a>
            <a href="{{ route('books.create') }}">Añadir libro</a>
        </div>
    </div>
    <div class="secondary-nav">
        <nav class="secondary-nav__inner" aria-label="Categorías">
            <span class="secondary-nav__label">Categorías:</span>
            @foreach ($navCategories as $cat)
                <a href="{{ route('categories.show', $cat) }}">{{ $cat->name }}<span class="secondary-nav__count"> ({{ $cat->books_count }})</span></a>
            @endforeach
        </nav>
    </div>
</header>
