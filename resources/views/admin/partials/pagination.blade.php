<div class="center">
    @if($pagination->lastPage() > 1)
        <ul class="pagination pagination-green">
            @if($pagination->currentPage() !== 1)
                <li>
                    <a href="{{ $pagination->url($pagination->currentPage() - 1) }}"><i class="fa fa-chevron-left"></i></a>
                </li>
            @endif
            @for($i = 1; $i <= $pagination->lastPage(); $i++)
                <li class="{{ ($pagination->currentPage() == $i) ? 'active disabled' : '' }}">
                    <a href="{{ $pagination->url($i) }}">
                        {{ $i }}
                    </a>
                </li>
            @endfor
            @if($pagination->currentPage() !== $pagination->lastPage())
                <li>
                    <a href="{{ $pagination->url($pagination->currentPage() + 1) }}"><i class="fa fa-chevron-right"></i></a>
                </li>
            @endif
        </ul>
    @endif
</div>