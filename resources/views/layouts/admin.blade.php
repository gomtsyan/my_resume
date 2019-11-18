<!DOCTYPE html>
<!-- Template Name: Rapido - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.0 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- start: HEAD -->
<head>
    <title>{{ $title ?? '' }}</title>
    <!-- start: META -->
    <meta charset="utf-8" />
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" />
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- end: META -->

    <!-- Styles -->
    @yield('styles')
    <!--End styles -->

    <!-- end: CORE CSS -->
    <link rel="shortcut icon" href="{{ asset(config('settings.theme').'/img/favicons/favicon.png') }}">

</head>
<!-- end: HEAD -->
<!-- start: BODY -->
<body class="{{ $fullScreenClass ?? '' }}">

    <!-- start: SLIDING BAR (SB) -->
    @yield('sliding_bar')
    <!-- end: SLIDING BAR -->

    <div class="main-wrapper">
        <!-- start: TOPBAR -->
        @yield('header')
        <!-- end: TOPBAR -->

        <!-- start: PAGESLIDE LEFT -->
        @yield('side_bar')
        <!-- end: PAGESLIDE LEFT -->

        <!-- start: MAIN CONTAINER -->
        <div class="main-container inner">
            <div class="main-content">
                <div class="container">

                    <!-- start: PAGE HEADER -->
                    @yield('page_header')
                    <!-- end: PAGE HEADER -->

                    <!-- start: BREADCRUMB -->
                    @yield('breadcrumbs')
                    <!-- end: BREADCRUMB -->

                    <!-- start: ALERT MESSAGES -->
                    @yield('alert_messages')
                    <!-- end: ALERT MESSAGES -->

                    <!-- start: PAGE CONTENT -->
                    @yield('content')
                    <!-- end: PAGE CONTENT-->

                </div>

                @yield('subviews_container')

            </div>
        </div>
        <!-- end: MAIN CONTAINER -->

        <!-- start: FOOTER -->
        @yield('footer')
        <!-- end: FOOTER -->
    </div>

    <!-- Styles -->
    @yield('scripts')
    <!--End styles -->

</body>
<!-- end: BODY -->
</html>