<div class="row article">
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
                                <a class="panel-expand" href="#"> <i class="fa fa-expand"></i>
                                    <span>{{ __('admin.fullscreen') }}</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <h2><i class="fas fa-user-edit"></i> {{ isset($article->id) ? __('admin.edit_article') : __('admin.new_article') }}
                </h2>
                <p>
                    {{ isset($article->id) ? __('admin.update_article') : __('admin.create_article') }}
                </p>
                <hr>
                <form action="{{  isset($article->slug) ? route('blog.update', ['alias'=>$article->slug]) :  route('blog.store') }}"
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
                                    <div class="fileupload-new  @error('img') has-error @enderror">
                                        <img src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/{{ config('settings.blog_path') }}/{{ $article->img ?? 'no_photo.png' }}"
                                             class="thumbnail"
                                             alt="article"/>
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail"></div>
                                    @error('img')
                                        <span class="help-block text-red" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div>
                                        <span class="btn btn-light-grey btn-file">
                                            <span class="fileupload-new">
                                                <i class="far fa-image"></i>
                                                {{ __('admin.select_image') }}
                                            </span>
                                            <span class="fileupload-exists">
                                                <i class="far fa-image"></i>
                                                {{ __('admin.change') }}
                                            </span>
                                            <input type="file" name="img">
                                        </span>
                                        <a href="#" class="btn fileupload-exists btn-light-grey"
                                           data-dismiss="fileupload">
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
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ isset($article->title) ? $article->title : old('title') }}">
                                @error('title')
                                    <span class="help-block" role="alert" for="title">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('slug') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.slug') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                       value="{{ isset($article->slug) ? $article->slug : old('slug') }}">
                                @error('slug')
                                    <span class="help-block" role="alert" for="slug">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="form-field-select-4">
                                    {{ __('admin.categories') }} <span class="symbol required"></span>
                                </label>

                                {!! Form::select(
                                    'category_id',
                                    $categories,
                                    isset($article) ? $article->category_id : null ,
                                    [
                                        'class' => 'form-control search-select',
                                        'id' => 'form-field-select-4'
                                    ]
                                ); !!}
                            </div>
                            <div class="form-group ">
                                <label class="control-label">
                                    {{ __('admin.is_active') }}
                                </label>
                                <input type="hidden" name="is_active" value="0" />
                                <input {{ (isset($article->is_active) && $article->is_active) ? 'checked' : '' }}
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
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group @error('short_desc') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.short_description') }}
                                </label>
                                <textarea name="short_desc" id="short_desc" class="form-control" cols="10" rows="10"
                                >{{ isset($article->short_desc) ? $article->short_desc : old('short_desc') }}</textarea>
                                @error('short_desc')
                                <span class="help-block" role="alert" for="short_desc">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('text') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.text') }} <span class="symbol required"></span>
                                </label>
                                <textarea name="text" id="text" class="ckeditor form-control" cols="10" rows="10">
                                    {{ isset($article->text) ? $article->text : old('text') }}
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
                                @if(isset($article->id))
                                    <input type="hidden" name="_method" value="PUT">
                                @endif
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? 1 }}">
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
                                {{ isset($article->id) ? __('admin.update') : __('admin.create') }}
                                <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>