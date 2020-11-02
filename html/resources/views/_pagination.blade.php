<ul class="pagination no-gap flex-justify-end mb-0">
    {{-- Previous Page Link --}}
    <li class="page-item @if ($paginator->onFirstPage()) disabled @endif">
        <a href="{{ $paginator->previousPageUrl() }}" class="page-link">
            <i class="mif-chevron-left"></i>
        </a>
    </li>

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="page-item no-link">
                <a class="page-link">
                    {{ $element }}
                </a>
            </li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                <li class="page-item @if ($page == $paginator->currentPage()) active @endif">
                    <a class="page-link" href="{{ $url }}">
                        {{ $page }}
                    </a>
                </li>
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    <li class="page-item @unless ($paginator->hasMorePages()) disabled @endunless">
        <a href="{{ $paginator->nextPageUrl() }}" class="page-link">
            <i class="mif-chevron-right"></i>
        </a>
    </li>
</ul>
