<style>
    .pagination {
        --pagination-size: 35px;
        gap: 5px;
    }
    .page-link {
        width: var(--pagination-size);
        height: var(--pagination-size);
        padding: 0 !important;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px !important;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
        background: var(--card-bg);
        color: var(--text-primary);
    }
    .page-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.15);
        color: var(--primary-color);
        background: var(--hover-bg);
    }
    .page-item.active .page-link {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.3);
    }
    .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
        background: var(--card-bg);
    }
    .page-link:focus {
        box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.25);
    }
</style>

@if ($paginator->hasPages())
<nav aria-label="Page navigation" class="mt-4">
    <ul class="pagination justify-content-center mb-0">
        {{-- Previous Page Link --}}
        <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                <i class="bi bi-chevron-left"></i>
            </a>
        </li>

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link">{{ $element }}</span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}" aria-label="Page {{ $page }}">{{ $page }}</a>
                    </li>
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                <i class="bi bi-chevron-right"></i>
            </a>
        </li>
    </ul>
</nav>
@endif
