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
                <h2><i class="fas fa-user-edit"></i> {{ isset($page->id) ? __('admin.edit_page') : __('admin.new_page') }}</h2>
                <p>
                    {{ isset($page->id) ? __('admin.update_page') : __('admin.create_page') }}
                </p>
                <hr>
                <form action="{{  isset($page->id) ? route('pages.update', ['pages'=>$page->id]) :  route('pages.store') }}"
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
                                        <img src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/{{ config('settings.menu_path') }}/{{ isset($page->img) ? $page->img->medium : 'no_photo.png' }}" class="menu-img" alt="page" />
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail"></div>
                                    @error('img')
                                    <span class="help-block text-red" role="alert" for="title">
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
                            <div class="form-group @error('order') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.order') }} <span class="symbol required"></span>
                                </label>
                                <input id="order" class="touch-spin" type="text" value="{{ isset($page->order) ? $page->order : old('order') }}" name="order">
                                @error('order')
                                    <span class="help-block" role="alert" for="order">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label class="control-label">
                                    {{ __('admin.is_active') }}
                                </label>
                                <input type="hidden" name="is_active" value="0" />
                                <input {{ (isset($page->is_active) && $page->is_active) ? 'checked' : '' }}
                                       type="checkbox"
                                       class="make-switch"
                                       name="is_active"
                                       data-on-color="success"
                                       data-off-color="danger"
                                       data-on-text="ON"
                                       data-off-text="OFF"
                                       value="1"
                                >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @error('name') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.name') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ isset($page->name) ? $page->name : old('name') }}">
                                @error('name')
                                    <span class="help-block" role="alert" for="name">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('title') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.title') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ isset($page->title) ? $page->title : old('title') }}">
                                @error('title')
                                    <span class="help-block" role="alert" for="title">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('sub_title') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.sub_title') }}
                                </label>
                                <input type="text" class="form-control" id="sub_title" name="sub_title" value="{{ isset($page->sub_title) ? $page->sub_title : old('sub_title') }}">
                                @error('sub_title')
                                    <span class="help-block" role="alert" for="sub_title">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('path') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.path') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="path" name="path" value="{{ isset($page->path) ? $page->path : old('path') }}">
                                @error('path')
                                    <span class="help-block" role="alert" for="path">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('keywords') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.keywords') }}
                                </label>
                                <textarea name="keywords"
                                          id="keywords"
                                          class="autosize form-control"
                                >{{ isset($page->keywords) ? $page->keywords : old('keywords') }}</textarea>
                                @error('keywords')
                                    <span class="help-block" role="alert" for="keywords">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('meta_desc') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.meta_description') }}
                                </label>
                                <textarea name="meta_desc"
                                          id="meta_desc"
                                          class="autosize form-control"
                                >{{ isset($page->meta_desc) ? $page->meta_desc : old('meta_desc') }}</textarea>
                                @error('meta_desc')
                                    <span class="help-block" role="alert" for="meta_desc">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                @if(isset($page->id))
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
                                {{ isset($page->id) ? __('admin.update') : __('admin.create') }}
                                <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>