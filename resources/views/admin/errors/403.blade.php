@extends('layouts.admin')

@section('styles')
    @include(config('settings.admin_theme') . '.partials.styles')
@endsection

@section('header')
    @include(config('settings.admin_theme') . '.partials.header')
@endsection

@section('content')
    <div class="container">
        <div class="toolbar row">
            <div class="col-sm-6 hidden-xs">
                <div class="page-header">
                    <h1>{{ __('errors.error_403') }}<small>{{ $title ?? '' }}</small></h1>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 padding-20">
                <div class="page-error animated shake">
                    <div class="error-number text-azure">
                        {{ __('errors.403') }}
                    </div>

                    .
                    <div class="error-details col-sm-6 col-sm-offset-3">
                        <h3>{{ __('errors.forbidden') }}</h3>
                        <p>
                            {{ __('errors.user_is_authenticated') }}
                            <br>
                            {{ __('errors.not_have_the_permissions') }}
                            <br>
                            <a href="{{ route('dashboard') }}" class="btn btn-red btn-return">
                                {{ __('errors.return_home') }}
                            </a>
                            <br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include(config('settings.admin_theme') . '.partials.footer')
@endsection

@section('scripts')
    @include(config('settings.admin_theme') . '.partials.scripts')
@endsection