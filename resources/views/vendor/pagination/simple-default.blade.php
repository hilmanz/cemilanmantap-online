@if ($paginator->hasPages())
<ul class="pagination seratus">
    {{-- Previous Page Link --}}
    {{--   @if ($paginator->onFirstPage())
    <li class="disabled"><span>&laquo;</span></li>
    @else
    <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
    @endif --}}
    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <li>
        <p style="cursor: pointer;margin:30px 0;">
            <a class="js-link btn-centap" href="{{ $paginator->nextPageUrl() }}" rel="next">Load More</a>
        </p>
    </li>
    @else
    <li class="disabled"><p style="margin:30px 0;"><a class="js-link-disable btn-centap">No More</a></p></li>
    @endif
</ul>
@endif