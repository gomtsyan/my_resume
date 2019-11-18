@if($items)
    <nav class="menu-style1">
        <!-- start container -->
        <div class="container">
            <!-- start row -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-12">

                    @foreach($items as $item)
                        <a href="{{ $item->url() ?? '' }}" class="menu-li">
                            <!-- img menu block -->
                            <span class="foto">
                            <img src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/{{ config('settings.menu_path') }}/{{ $item->img->medium ?? '' }}" class="menu-img" data-img-name="{{ $item->title ?? '' }}" alt="{{ $item->title ?? '' }}" />
                        </span>
                            <!-- name menu block -->
                            <span class="name">{{ $item->title ?? '' }}</span>
                        </a>
                    @endforeach

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </nav>
@endif
