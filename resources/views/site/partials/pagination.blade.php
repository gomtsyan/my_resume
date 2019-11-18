<div class="pagination">
    @if($pagination->lastPage() > 1)

        @if($pagination->currentPage() !== 1)
            <a href="{{ $pagination->url($pagination->currentPage() - 1) }}"
               class="previous page-numbers">{!! __('pagination.previous') !!}</a>
        @endif

        @for($i = 1; $i <= $pagination->lastPage(); $i++)
            <a href="{{ $pagination->url($i) }}"
               class="page-numbers {{ ($pagination->currentPage() == $i) ? 'current disabled' : '' }}">{{ $i }}</a>
        @endfor

        @if($pagination->currentPage() !== $pagination->lastPage())
            <a href="{{ $pagination->url($pagination->currentPage() + 1) }}"
               class="next page-numbers">{!! __('pagination.next') !!}</a>
        @endif

    @endif
</div>