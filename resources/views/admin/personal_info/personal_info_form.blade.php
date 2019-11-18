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
                <h2><i class="fas fa-user-edit"></i> {{ isset($personalInfoData->id) ? __('admin.edit_personal_information') : __('admin.new_personal_information') }}</h2>
                <p>
                    {{ isset($personalInfoData->id) ? __('admin.update_personal_information') : __('admin.create_personal_information') }}
                </p>
                <hr>
                <form action="{{  isset($personalInfoData->id) ? route('personal.update', ['personal'=>$personalInfoData->id]) :  route('personal.store') }}"
                      method="post"
                      role="form"
                      id="form"
                      enctype="multipart/form-data"
                >
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('img') has-error @enderror">
                                <div class="alert alert-danger">
                                    <span class="label label-danger"><i class="fas fa-exclamation-triangle"></i></span>
                                    <span> {{ __('admin.image_rule') }} </span>
                                </div>
                                <label class="control-label">
                                    {{ __('admin.image_upload') }} <span class="symbol required"></span>
                                </label>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail @error('img') has-error @enderror">
                                        <img src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/{{ $personalInfoData->img ?? 'no_photo.png' }}" alt="avatar"/>
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail"></div>
                                    @error('img')
                                        <span class="help-block text-red" role="alert" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div>
                                        <span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="far fa-image"></i> {{ __('admin.select_image') }}</span><span class="fileupload-exists"><i class="far fa-image"></i> {{ __('admin.change') }}</span>
                                            <input type="file" name="img">
                                        </span>
                                        <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
                                            <i class="fa fa-times"></i> {{ __('admin.remove') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="alert alert-warning">
                                    <span class="label label-warning">{{ __('admin.note') }}</span>
                                    <span> {{ __('admin.image_note') }} </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @error('first_name') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.first_name') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ isset($personalInfoData->first_name) ? $personalInfoData->first_name : old('first_name') }}">
                                @error('first_name')
                                    <span class="help-block" role="alert" for="first_name">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('last_name') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.last_name') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ isset($personalInfoData->last_name) ? $personalInfoData->last_name : old('last_name') }}">
                                @error('last_name')
                                <span class="help-block" role="alert" for="last_name">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('position') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.position') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="position" name="position" value="{{ isset($personalInfoData->position) ? $personalInfoData->position : old('position') }}">
                                @error('position')
                                    <span class="help-block" role="alert" for="position">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                @if(isset($personalInfoData->id))
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
                                {{ isset($personalInfoData->id) ? __('admin.update') : __('admin.create') }}
                                <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>