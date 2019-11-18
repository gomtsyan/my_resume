<header class="topbar navbar navbar-inverse navbar-fixed-top inner">
    <div class="container">
        <div class="navbar-header">
            <a class="sb-toggle-left hidden-md hidden-lg" href="#main-navbar">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div class="topbar-tools">
            <ul class="nav navbar-right">
                <li class="dropdown current-user">
                    <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                        <img src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/{{ config('settings.logo_path') }}/apple-touch-icon.png" class="img-circle" alt="user" height="30px">
                        <span class="username hidden-xs">{{ auth()->user()->name ?? '' }}</span>
                        <i class="fa fa-caret-down "></i>
                    </a>
                    <ul class="dropdown-menu dropdown-dark">
                        <li>
                            <a href="javascript:void(0);" id="logout">
                                <i class="fa fa-power-off"></i>
                                <span class="margin-left-5">{{ __('admin.logout') }}</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</header>