<div class="row profile-edit">
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
                <h2><i class="fas fa-user-edit"></i> {{ isset($profileData->id) ? __('admin.edit_profile') : __('admin.new_profile') }}</h2>
                <p>
                    {{ isset($profileData->id) ? __('admin.update_profile') : __('admin.create_profile') }}
                </p>
                <hr>
                <form action="{{  isset($profileData->id) ? route('profile.update', ['profile'=>$profileData->id]) :  route('profile.store') }}"
                      method="post"
                      role="form"
                      id="form"
                      enctype="multipart/form-data"
                >
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('img') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.image_upload') }} <span class="symbol required"></span>
                                </label>
                                <div class="alert alert-danger">
                                    <span class="label label-danger"><i class="fas fa-exclamation-triangle"></i></span>
                                    <span> {{ __('admin.image_rule') }} </span>
                                </div>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail @error('img') has-error @enderror">
                                        <img src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/{{ config('settings.profile_path') }}/{{ $profileData->img ?? 'no_photo.png' }}" alt="profile"/>
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail"></div>
                                    @error('img')
                                        <span class="help-block text-red" role="alert">
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
                            <div class="form-group @error('title') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.title') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ isset($profileData->title) ? $profileData->title : old('title') }}">
                                @error('title')
                                    <span class="help-block" role="alert" for="title">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('cv') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.cv_file') }} <span class="symbol required"></span>
                                </label>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-group">
                                        <div class="form-control overflow-auto">
                                            <i class="fa fa-file fileupload-exists"></i>
                                            <span class="fileupload-preview">{{ $profileData->cv ?? '' }}</span>
                                        </div>
                                        <div class="input-group-btn">
                                            <div class="btn btn-light-grey btn-file">
                                                <span class="fileupload-new"><i class="fas fa-folder-open"></i> {{ __('admin.select_file') }}</span>
                                                <span class="fileupload-exists"><i class="fas fa-folder-open"></i> {{ __('admin.change') }}</span>
                                                <input type="file" class="file-input" name="cv">
                                            </div>
                                            <a href="#" class="btn btn-light-grey fileupload-exists" data-dismiss="fileupload">
                                                <i class="fa fa-times"></i> {{ __('admin.remove') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @error('cv')
                                    <span class="help-block" role="alert" for="title">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group @error('text') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.text') }} <span class="symbol required"></span>
                                </label>
                                <textarea name="text" id="text" class="ckeditor form-control" cols="10" rows="10">
                                    {{ isset($profileData->text) ? $profileData->text : old('text') }}
                                </textarea>
                                @error('text')
                                    <span class="help-block" role="alert" for="text">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                @if(isset($profileData->id))
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
                                {{ isset($profileData->id) ? __('admin.update') : __('admin.create') }}
                                <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>