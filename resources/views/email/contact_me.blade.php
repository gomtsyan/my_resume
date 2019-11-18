@extends('layouts.email')

@section('email_header')
    @include(config('settings.email_theme') . '.partials.header')
@endsection

@section('email_content')
    {!! $content !!}
@endsection

@section('email_footer')
    @include(config('settings.email_theme') . '.partials.footer')
@endsection