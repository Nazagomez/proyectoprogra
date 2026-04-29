<article class="book-card">
    <a href="{{ route('books.show', $book) }}">
        <div class="book-card__cover-wrap">
            <img class="book-card__cover" src="{{ $book->cover_url }}" alt="Portada: {{ $book->title }}" width="200" height="300" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('images/books/placeholder.svg') }}';">
        </div>
        <div class="book-card__body">
            <h3 class="book-card__title">{{ $book->title }}</h3>
            <p class="book-card__author">{{ $book->author }}</p>
            <p class="book-card__price">{{ $book->formatted_price }}</p>
        </div>
    </a>
</article>
