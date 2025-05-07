@if ($paginator->hasPages())
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center mb-0">
        {{-- Previous Page Link --}}
        <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link border-0 rounded-pill shadow-sm px-3 mx-1" href="{{ $paginator->previousPageUrl() }}">
                <i class="bi bi-chevron-left"></i>
            </a>
        </li>

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link border-0 rounded-pill shadow-sm px-3 mx-1">{{ $element }}</span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                        <a class="page-link border-0 rounded-pill shadow-sm px-3 mx-1" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
            <a class="page-link border-0 rounded-pill shadow-sm px-3 mx-1" href="{{ $paginator->nextPageUrl() }}">
                <i class="bi bi-chevron-right"></i>
            </a>
        </li>
    </ul>
</nav>
@endif
