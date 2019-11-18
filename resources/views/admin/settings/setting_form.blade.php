<div class="row personal-info">
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
                <h2><i class="fas fa-user-edit"></i> {{ isset($setting->id) ? __('admin.edit_setting') : __('admin.new_setting') }}</h2>
                <p>
                    {{ isset($setting->id) ? __('admin.update_setting') : __('admin.create_setting') }}
                </p>
                <hr>
                <form action="{{  isset($setting->id) ? route('settings.update', ['settings'=>$setting->id]) :  route('settings.store') }}"
                      method="post"
                      role="form"
                      id="form"
                      enctype="multipart/form-data"
                >
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('name') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.name') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ isset($setting->name) ? $setting->name : old('name') }}">
                                @error('name')
                                    <span class="help-block" role="alert" for="name">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('type') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.type') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="type" name="type" value="{{ isset($setting->type) ? $setting->type : old('type') }}">
                                @error('type')
                                    <span class="help-block" role="alert" for="type">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @error('key') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.key') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="key" name="key" value="{{ isset($setting->key) ? $setting->key : old('key') }}">
                                @error('key')
                                    <span class="help-block" role="alert" for="key">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('value') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.value') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="value" name="value" value="{{ isset($setting->value) ? $setting->value : old('value') }}">
                                @error('value')
                                    <span class="help-block" role="alert" for="value">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                @if(isset($setting->id))
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
                                {{ isset($setting->id) ? __('admin.update') : __('admin.create') }}
                                <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>