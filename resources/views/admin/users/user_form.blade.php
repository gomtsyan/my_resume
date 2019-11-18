<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title">{{ $title ?? '' }} <span class="text-bold"></span></h4>
                <div class="panel-tools">
                    <div class="dropdown">
                        <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                            <i class="fa fa-cog"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                            <li>
                                <a class="panel-expand" href="#"> <i class="fa fa-expand"></i> <span>{{ __('admin.fullscreen') }}</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <h2><i class="fas fa-user-edit"></i> {{ isset($user->id) ? __('admin.edit_user') : __('admin.new_user') }}</h2>
                <p>
                    {{ isset($user->id) ? __('admin.update_user') : __('admin.create_user') }}
                </p>
                <hr>
                <form action="{{  isset($user->id) ? route('users.update', ['users'=>$user->id]) :  route('users.store') }}" method="post" role="form" id="form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('login') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.login') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="login" name="login" value="{{ isset($user->login) ? $user->login : old('login') }}">
                                @error('login')
                                    <span class="help-block" role="alert" for="login">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('password') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.password') }} <span class="symbol required"></span>
                                </label>
                                <input type="password" class="form-control" name="password" id="password">
                                @error('password')
                                    <span class="help-block" role="alert" for="login">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    {{ __('admin.confirm_password') }} <span class="symbol required"></span>
                                </label>
                                <input type="password" class="form-control" id="password_again" name="password_confirmation">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @error('name') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.name') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ isset($user->name) ? $user->name : old('name') }}">
                                @error('name')
                                    <span class="help-block" role="alert" for="login">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('email') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.email') }} <span class="symbol required"></span>
                                </label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ isset($user->email) ? $user->email : old('email') }}">
                                @error('email')
                                    <span class="help-block" role="alert" for="login">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="form-field-select-4">
                                    {{ __('admin.roles') }}
                                </label>

                                {!! Form::select(
                                    'roles[]',
                                    $roles,
                                    isset($user) ? $user->rolesArray : null ,
                                    [
                                        'class' => 'form-control search-select',
                                        'id' => 'form-field-select-4',
                                        'multiple' => 'multiple'
                                    ]
                                ); !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                @if(isset($user->id))
                                    <input type="hidden" name="_method" value="PUT">
                                @endif

                                {{ csrf_field() }}
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <p>
                                <span class="symbol required"></span>{{ __('admin.required_fields') }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-yellow btn-block" type="submit">
                                {{ isset($user->id) ? __('admin.update') : __('admin.create') }}
                                <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>