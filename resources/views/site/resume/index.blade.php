@extends('layouts.site')

@section('styles')
    @include(config('settings.theme') . '.partials.styles')
@endsection

@section('header')
    {!! $header ?? '' !!}
@endsection

@section('content')
    {!! $content ?? '' !!}
@endsection

@section('scroll_to_top')
    @include(config('settings.theme') . '.partials.scroll_to_top')
@endsection

@section('contact_form')
    @include(config('settings.theme') . '.partials.contact_form')
@endsection

@section('footer')
    @include(config('settings.theme') . '.partials.footer')
@endsection

@section('scripts')
    @include(config('settings.theme') . '.partials.scripts')
    <script src="{{ asset('js/site/resumeScripts.js') }}" type="text/javascript"></script>
@endsection
