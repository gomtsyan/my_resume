<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title">{{ $title ?? '' }} <span class="text-bold">{{ __('admin.page') }}</span></h4>
                @if($aboutMeData)
                    <div class="panel-tools">
                        @can('update', 'App\Models\AboutMe')
                            <a class="btn btn-xs btn-default tooltips"
                               href="{{ route('profile.edit', ['profile'=>$aboutMeData->id]) }}"
                               data-placement="top"
                               data-original-title="{{ __('admin.edit') }}"
                            >
                                <i class="fas fa-edit"></i>
                            </a>
                        @endcan
                        @can('delete', 'App\Models\AboutMe')
                            <a class="btn btn-xs btn-default tooltips delete"
                               href="{{ route('profile.destroy', ['profile'=>$aboutMeData->id]) }}"
                               data-type="button_in_panel"
                               data-name="profile data"
                               data-placement="top"
                               data-original-title="{{ __('admin.remove') }}"
                            >
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        @endcan
                    </div>
                @endif
            </div>
            <div class="panel-body {{ $aboutMeData ? '' : 'center' }}">
                @if($aboutMeData)
                    <div class="col-md-8 col-sm-8 padding-bottom-15">
                        <h3>{{ $aboutMeData->title ?? '' }}</h3>
                        {!! $aboutMeData->text ?? '' !!}
                        <a href="{{ asset(config('settings.theme')) }}/{{config('settings.file_path')}}/{{ $aboutMeData->cv }}" class="btn btn-green" target="_blank">{{ __('admin.view_cv') }}</a>
                    </div>
                    <div class="col-md-4 col-sm-4 center">
                        <img src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/{{ config('settings.profile_path') }}/{{ $aboutMeData->img ?? '' }}" class="img-thumbnail" alt="">
                    </div>
                @endif
                <a href="{{ route('profile.create') }}" class="btn btn-dark-orange create-button {{ $aboutMeData ? 'no-display' : '' }}">{{ __('admin.new_profile') }} <i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>