@extends('layouts.auth')

@section('styles')
    @include(config('settings.admin_theme') . '.partials.styles')
@endsection

@section('content')
<div class="row">
    <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <!-- start: LOGIN BOX -->
        <div class="box-login">
            <h3>{{ __('auth.sign_in') }}</h3>
            <p>
                {{ __('auth.enter_login_password') }}
            </p>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                @if($errors->count() > 0)
                    <div class="errorHandler alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li><i class="fa fa-remove-sign"></i> {{ $error ?? '' }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <fieldset>
                    <div class="form-group">
                        <span class="input-icon">
                            <input id="login" type="text" class="form-control" name="login" value="{{ old('login') }}" placeholder="{{ __('auth.login') }}">
                            <i class="fa fa-user"></i>
                        </span>
                    </div>

                    <div class="form-group form-actions">
                        <span class="input-icon">
                            <input id="password" type="password" class="form-control password" name="password" placeholder="{{ __('auth.password') }}">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>

                    <div class="form-actions">
                        <label for="remember" class="checkbox-inline">
                            <input type="checkbox" class="grey remember" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            {{ __('auth.keep_me') }}
                        </label>

                        <button type="submit" class="btn btn-green pull-right">
                            {{ __('auth.login') }} <i class="fa fa-arrow-circle-right"></i>
                        </button>
                    </div>
                </fieldset>
            </form>
            <!-- start: COPYRIGHT -->
            <div class="copyright">
                {{ now()->format('Y') }} &copy; {{ __('app.all_right_reserved') }}
            </div>
            <!-- end: COPYRIGHT -->
        </div>
        <!-- end: LOGIN BOX -->
    </div>
</div>
@endsection

@section('scripts')
    @include(config('settings.admin_theme') . '.partials.scripts')
    <script src="{{ asset('js/admin/authLogin.js') }}"></script>
@endsection
