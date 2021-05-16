<ul class="pagination pagination-sm m-0 float-right">
    <!-- Previous Page Link -->
    @if ($paginator->onFirstPage())
        <li class="disabled page-item"><a href="" class="page-link"><i class="fas fa-angle-left"></i></a></li>
    @else
        <li><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fas fa-angle-left"></i></a></li>
    @endif

    <!-- Pagination Elements -->
    @foreach ($elements as $element)
        <!-- "Three Dots" Separator -->
        @if (is_string($element))
            <li class="page-link" class="disabled"><span>{{ $element }}</span></li>
        @endif

        <!-- Array Of Links -->
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    <!-- Next Page Link -->
    @if ($paginator->hasMorePages())
        <li><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fas fa-angle-right"></i></a></li>
    @else
        <li class="disabled page-item"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a></li>
    @endif
</ul>

 {{-- <ul class="pagination pagination-sm m-0 float-right">

    <li class="page-item active"><a class="page-link">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a></li>
    <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a>
    </li>
    @include('admin.templates.pagination')
</ul> --}}
