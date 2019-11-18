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
                <h2><i class="fas fa-user-edit"></i> {{ isset($language->id) ? __('admin.edit_language_skill') : __('admin.new_language_skill') }}</h2>
                <p>
                    {{ isset($language->id) ? __('admin.update_language_skill') : __('admin.create_language_skill') }}
                </p>
                <hr>
                <form action="{{  isset($language->id) ? route('languages.update', ['language'=>$language->id]) :  route('languages.store') }}"
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
                                <input type="text" class="form-control" id="name" name="name" value="{{ isset($language->name) ? $language->name : old('name') }}">
                                @error('name')
                                    <span class="help-block" role="alert" for="name">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label class="control-label">
                                    {{ __('admin.order') }}
                                </label>
                                <input id="order" class="touch-spin" type="text" value="{{ isset($language->order) ? $language->order : old('order') }}" name="order">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">
                                    {{ __('admin.max_rating') }}
                                </label>
                                <input id="max_rating" class="touch-spin" type="text" value="{{ isset($language->max_rating) ? $language->max_rating : old('max_rating') }}" name="max_rating">
                            </div>
                            <div class="form-group ">
                                <label class="control-label">
                                    {{ __('admin.rating') }}
                                </label>
                                <input id="rating" class="touch-spin" type="text" value="{{ isset($language->rating) ? $language->rating : old('rating') }}" name="rating">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                @if(isset($language->id))
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
                                {{ isset($language->id) ? __('admin.update') : __('admin.create') }}
                                <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>