@extends('layouts.site')

@section('styles')
    @include(config('settings.theme') . '.partials.styles')
@endsection

@section('content')
    <section class="content padding-block">
        <!-- start container -->
        <div class="container">
            <!-- start row -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-12 text-center">
                    <img src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/404.gif" alt="404">
                    <h3 class="title1">{{ __('app.page_not_found') }}</h3>
                    <p>{{ __('app.page_not_found_text') }}</p>
                    <a href="{{ route('index') }}" class="btn btn-color">{{ __('app.go_home') }}</a>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
@endsection

@section('scripts')
    @include(config('settings.theme') . '.partials.scripts')
@endsection