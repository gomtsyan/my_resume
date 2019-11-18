<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> <!--<![endif]-->

<head>
    <meta charset="utf-8"/>
    <title>{{ $title }}</title>
    <meta name="author" content="{{ config('settings.author') ?? 'A.Gomtsyan' }}"/>
    <meta name="keywords" content="{{ $keywords }}"/>
    <meta name="description" content="{{ $metaDesc }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <!-- Styles -->
    @yield('styles')
    <!--End styles -->
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset(config('settings.theme')) }}/img/favicons/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset(config('settings.theme')) }}/img/favicons/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset(config('settings.theme')) }}/img/favicons/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" href="{{ asset(config('settings.theme')) }}/img/favicons/apple-touch-icon.png" />
    <link rel="shortcut icon" href="{{ asset(config('settings.theme')) }}/img/favicons/favicon.png" />
</head>
    <body>
        <!-- Load page -->
        @yield('loader')
        <!-- End load page -->

        <div id="wraper">

            <!-- Start Head section -->
            @yield('header')
            <!-- End Head section -->

            <!-- Start Home-header section -->
            @yield('content')
            <!-- End Home-header section -->

            <!-- Start Menu section -->
            @yield('navigation')
            <!-- End Menu section -->

            <!-- Start Footer section -->
            @yield('footer')
            <!-- End Footer section -->

        </div>

        <!-- Scroll to Top -->
        @yield('scroll_to_top')
        <!-- End Scroll to Top -->

        <!-- Style Contact Form -->
        @yield('contact_form')
        <!-- End Style Contact Form -->

        <!-- Scripts -->
        @yield('scripts')
    </body>
</html>