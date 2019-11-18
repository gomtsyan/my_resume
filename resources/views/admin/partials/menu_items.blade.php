@if($items)
    @foreach($items as $item)
        <li class="{{ in_array(class_basename(request()->route()->controller), $item->data('controllers')) ? 'active open' : '' }}"
        >
            <a href="{{ $item->url() }}">
                <i class="{{ $item->data('icon') }}"></i>
                <span class="title"> {{ $item->title }} </span>
                @if($item->hasChildren())
                    <i class="icon-arrow"></i>
                @endif
            </a>
            @if($item->hasChildren())
                <ul class="sub-menu">
                    @include(config('settings.admin_theme').'.partials.menu_items', ['items' => $item->children()])
                </ul>
            @endif
        </li>
    @endforeach
@endif