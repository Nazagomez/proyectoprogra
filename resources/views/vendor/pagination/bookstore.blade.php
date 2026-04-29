@if ($paginator->hasPages())
    <nav class="pagination-nav" aria-label="Paginación de resultados">
        <p class="pagination-nav__info">
            Mostrando <strong>{{ $paginator->firstItem() }}</strong> a <strong>{{ $paginator->lastItem() }}</strong>
            de <strong>{{ $paginator->total() }}</strong> resultados
        </p>
        <ul class="pagination-nav__list">
            @if ($paginator->onFirstPage())
                <li><span class="pagination-nav__link is-disabled" aria-disabled="true">‹ Anterior</span></li>
            @else
                <li><a class="pagination-nav__link" href="{{ $paginator->previousPageUrl() }}" rel="prev">‹ Anterior</a></li>
            @endif
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li><span class="pagination-nav__ellipsis">{{ $element }}</span></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><span class="pagination-nav__link is-current" aria-current="page">{{ $page }}</span></li>
                        @else
                            <li><a class="pagination-nav__link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li><a class="pagination-nav__link" href="{{ $paginator->nextPageUrl() }}" rel="next">Siguiente ›</a></li>
            @else
                <li><span class="pagination-nav__link is-disabled" aria-disabled="true">Siguiente ›</span></li>
            @endif
        </ul>
    </nav>
@endif
