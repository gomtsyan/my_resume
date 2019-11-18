<div class="row page-edit">
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
            <div class="panel-body buttons-widget">
                <h2><i class="fas fa-user-edit"></i> {{ isset($institution->id) ? __('admin.edit_institution') : __('admin.new_institution') }}</h2>
                <p>
                    {{ isset($institution->id) ? __('admin.update_institution') : __('admin.create_institution') }}
                </p>
                <hr>
                <form action="{{  isset($institution->id) ? route('education.update', ['education'=>$institution->id]) :  route('education.store') }}"
                      method="post"
                      role="form"
                      id="form"
                      enctype="multipart/form-data"
                >
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group @error('institution') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.institution') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="institution" name="institution" value="{{ isset($institution->institution) ? $institution->institution : old('institution') }}">
                                @error('institution')
                                    <span class="help-block" role="alert" for="institution">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('degree') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.degree') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="degree" name="degree" value="{{ isset($institution->degree) ? $institution->degree : old('degree') }}">
                                @error('degree')
                                    <span class="help-block" role="alert" for="degree">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('specialization') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.specialization') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="specialization" name="specialization" value="{{ isset($institution->specialization) ? $institution->specialization : old('specialization') }}">
                                @error('specialization')
                                    <span class="help-block" role="alert" for="specialization">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('location') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.location') }}
                                </label>
                                <input type="text" class="form-control" id="location" name="location" value="{{ isset($institution->location) ? $institution->location : old('location') }}">
                                @error('location')
                                    <span class="help-block" role="alert" for="location">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @error('description') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.description') }}
                                </label>
                                <textarea name="description"
                                          id="description"
                                          class="autosize form-control"
                                >{{ isset($institution->description) ? $institution->description : old('description') }}</textarea>
                                @error('description')
                                    <span class="help-block" role="alert" for="description">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group @error('start_date') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.start_date') }} <span class="symbol required"></span>
                                </label>
                                <div class="input-group">
                                    <input type="text"
                                           data-date-format="yyyy-mm-dd"
                                           data-date-viewmode="years"
                                           class="form-control date-picker"
                                           name="start_date"
                                           value="{{ isset($institution->showStart) ? $institution->showStart : old('start_date') }}"
                                    >
                                    <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
                                </div>
                                @error('start_date')
                                    <span class="help-block" role="alert" for="start_date">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('end_date') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.end_date') }}
                                </label>
                                <div class="input-group">
                                    <input type="text"
                                           data-date-format="yyyy-mm-dd"
                                           data-date-viewmode="years"
                                           class="form-control date-picker"
                                           name="end_date"
                                           value="{{ isset($institution->showEnd) ? $institution->showEnd : old('end_date') }}"
                                    >
                                    <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
                                </div>
                                @error('end_date')
                                    <span class="help-block" role="alert" for="end_date">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                @if(isset($institution->id))
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
                                {{ isset($institution->id) ? __('admin.update') : __('admin.create') }}
                                <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>