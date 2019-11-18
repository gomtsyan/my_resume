<a class="closedbar inner hidden-sm hidden-xs" href="javascript:void(0);"></a>

<nav id="pageslide-left" class="pageslide inner">
    <div class="navbar-content">
        <!-- start: SIDEBAR -->
        <div class="main-navigation left-wrapper transition-left">
            <div class="navigation-toggler hidden-sm hidden-xs">
                <a href="#main-navbar" class="sb-toggle-left">
                </a>
            </div>
            <div class="user-profile border-top padding-horizontal-10 block">
                <div class="inline-block">
                    <img src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/{{ config('settings.logo_path') }}/apple-touch-icon.png" alt="avatar">
                </div>
                <div class="inline-block">
                    <h5 class="no-margin"> {{ __('admin.welcome') }} </h5>
                    <h4 class="no-margin"> {{ auth()->user()->name ?? '' }} </h4>
                    <a class="btn user-options sb_toggle">
                        <i class="fa fa-cog"></i>
                    </a>
                </div>
            </div>
            @if($menu)
                <!-- start: MAIN NAVIGATION MENU -->
                <ul class="main-navigation-menu">
                    @include(config('settings.admin_theme').'.partials.menu_items', ['items' => $menu->roots()])
                </ul>
                <!-- end: MAIN NAVIGATION MENU -->
            @endif
        </div>
        <!-- end: SIDEBAR -->
    </div>

    <div class="slide-tools">
        <div class="col-xs-6 text-left no-padding">
            <a class="btn btn-sm status" href="javascript:void(0);">
                {{ __('admin.status') }} <i class="fa fa-dot-circle text-green"></i> <span>{{ __('admin.online') }}</span>
            </a>
        </div>
        <div class="col-xs-6 text-right no-padding">
            <a class="btn btn-sm" href="{{ route('index') }}" target="_blank">
                <i class="fas fa-address-card text-green"></i> <span>{{ __('admin.go_to_site') }}</span>
            </a>
        </div>
    </div>

</nav>