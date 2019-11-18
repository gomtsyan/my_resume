@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/adminArticles.css') }}">
    @include(config('settings.admin_theme') . '.partials.styles')
@endsection

@section('sliding_bar')
    @include(config('settings.admin_theme') . '.partials.sliding_bar')
@endsection

@section('header')
    @include(config('settings.admin_theme') . '.partials.header')
@endsection

@section('side_bar')
    {!! $sideBar ?? '' !!}
@endsection

@section('page_header')
    {!! $pageHeader !!}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render() }}
@endsection

@section('alert_messages')
    @include(config('settings.admin_theme') . '.partials.alert_messages')
@endsection

@section('content')
    {!! $content ?? '' !!}
@endsection

@section('subviews_container')
    @include(config('settings.admin_theme') . '.partials.subviews_container')
@endsection

@section('footer')
    @include(config('settings.admin_theme') . '.partials.footer')
@endsection

@section('scripts')
    @include(config('settings.admin_theme') . '.partials.scripts')
    <script> var CKEDITOR_BASEPATH = "{{ asset('admin-public/plugins/ckeditor') }}/"; </script>
    <script src="{{ asset('js/admin/adminArticles.js') }}"></script>
@endsection
