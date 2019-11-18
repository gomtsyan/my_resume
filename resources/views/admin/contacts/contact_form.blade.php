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
                <h2><i class="fas fa-user-edit"></i> {{ isset($contact->id) ? __('admin.edit_contact') : __('admin.new_contact') }}</h2>
                <p>
                    {{ isset($contact->id) ? __('admin.update_contact') : __('admin.create_contact') }}
                </p>
                <hr>
                <form action="{{  isset($contact->id) ? route('contact.update', ['contact'=>$contact->id]) :  route('contact.store') }}"
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
                                <input type="text" class="form-control" id="name" name="name" value="{{ isset($contact->name) ? $contact->name : old('name') }}">
                                @error('name')
                                    <span class="help-block" role="alert" for="name">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('value') has-error @enderror">
                                <label class="control-label">
                                    {{ __('admin.value') }} <span class="symbol required"></span>
                                </label>
                                <input type="text" class="form-control" id="value" name="value" value="{{ isset($contact->value) ? $contact->value : old('value') }}">
                                @error('value')
                                    <span class="help-block" role="alert" for="value">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group text-center">
                                <label for="form-field-select-4">
                                    {{ __('admin.icon') }} <span class="symbol required"></span>
                                </label>
                                @if(isset($icons) && is_array($icons))
                                    <select id="icon" name="icon" class="selectpicker" data-live-search="true">
                                        @foreach($icons as $iconClass => $icon)
                                            <option data-content="<i class='{{ $iconClass }}'></i> {{ $iconClass }}"
                                                    value="{{ $iconClass }}"
                                                    {{ (isset($contact->icon) && $contact->icon == $iconClass) ? 'selected="selected"' : '' }}
                                            ></option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>

                            <div class="form-group text-center">
                                <label class="control-label">
                                    {{ __('admin.is_social') }}
                                </label>
                                <input type="hidden" name="is_social" value="0" />
                                <input {{ (isset($contact->is_social) && $contact->is_social) ? 'checked' : '' }}
                                       type="checkbox"
                                       class="make-switch"
                                       name="is_social"
                                       data-on-color="success"
                                       data-off-color="danger"
                                       data-on-text="YES"
                                       data-off-text="NO"
                                       value="1"
                                >
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                @if(isset($contact->id))
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
                                {{ isset($contact->id) ? __('admin.update') : __('admin.create') }}
                                <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>