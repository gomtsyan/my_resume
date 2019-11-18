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
                <h2><i class="fas fa-user-edit"></i> {{ isset($category->id) ? __('admin.edit_article_category') : __('admin.new_article_category') }}
                </h2>
                <p>
                    {{ isset($category->id) ? __('admin.update_article_category') : __('admin.create_article_category') }}
                </p>
                <hr>
                <form action="{{  isset($category->id) ? route('category.update', ['category'=>$category->id]) :  route('category.store') }}"
                      method="post"
                      role="form"
                      id="form"
                      enctype="multipart/form-data"
                >
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('title') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.title') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ isset($category->title) ? $category->title : old('title') }}">
                                @error('title')
                                    <span class="help-block" role="alert" for="title">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group @error('slug') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.slug') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                       value="{{ isset($category->slug) ? $category->slug : old('slug') }}">
                                @error('slug')
                                    <span class="help-block" role="alert" for="slug">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                @if(isset($category->id))
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
                                {{ isset($category->id) ? __('admin.update') : __('admin.create') }}
                                <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>