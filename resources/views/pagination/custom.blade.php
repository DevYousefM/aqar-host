@if ($paginator->hasPages())
    <ul class="pagination p-0 px-2 justify-content-center flex-wrap">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item">
                <span class="pagin page-link">السابق</span>
            </li>
        @else
            <li class="page-item">
                <a href="{{ $paginator->previousPageUrl() }}" class="pagin page-link" rel="prev">السابق</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item"><span class="pagin page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item"><span class="pagin page-link"
                                style="background-color: red;color:white">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="pagin page-link"
                                href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <span class="pagin page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">التالى</span>
            </li>
        @else
            <li class="page-item">
                <span class="pagin page-link">التالى</span>
            </li>
        @endif
    </ul>
@endif
