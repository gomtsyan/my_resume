@if($pageData)
    <header class="head">
        <div class="container">
            <div class="row">
                <div class="col-xs-9 col-sm-11 col-lg-11">
                    <img class="logo-page"
                         src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/{{ config('settings.menu_path') }}/{{ $pageData->img->small ?? config('settings.mini_logo_page') }}"
                         alt="contactImage">
                    <h2 class="title">{{ $pageData->title ?? '' }}</h2>
                    <h4 class="sub-title">{{ $pageData->sub_title ?? '' }}</h4>
                </div>
                <div class="col-xs-3 col-sm-1 col-lg-1 text-right">
                    <a href="{{ route('index') }}" class="btn-close hover-animate"></a>
                </div>
            </div>
        </div>
    </header>
@endif