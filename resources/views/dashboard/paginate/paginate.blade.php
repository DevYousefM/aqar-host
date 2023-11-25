@if ($paginator->hasPages())
    <div class="card-footer clearfix">

        <ul class="pagination pagination-sm m-0 float-right">
            @if ($paginator->onFirstPage())
                <li class="page-item"><span class="page-link">«</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{$paginator->previousPageUrl()}}">«</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item"><span class="page-link">{{ $element }}</span></li>

                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item"><span class="page-link"
                                                        style="background-color: blue;color: white">{{ $page }}</span>
                            </li>

                        @else
                            <li class="page-item"><a class="page-link"
                                                     href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{$paginator->nextPageUrl()}}">»</a></li>

            @else
                <li class="page-item"><span class="page-link">»</span></li>
            @endif
        </ul>
    </div>
@endif
