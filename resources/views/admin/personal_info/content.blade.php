<div class="row personal-info">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title">{{ $title ?? '' }} <span class="text-bold">{{ __('admin.page') }}</span></h4>
                @if($personalInfoData)
                    <div class="panel-tools">
                        @can('update', 'App\Models\PersonalInfo')
                            <a class="btn btn-xs btn-default tooltips"
                               href="{{ route('personal.edit', ['personal'=>$personalInfoData->id]) }}"
                               data-placement="top"
                               data-original-title="{{ __('admin.edit') }}"
                            >
                                <i class="fas fa-edit"></i>
                            </a>
                        @endcan
                        @can('delete', 'App\Models\PersonalInfo')
                            <a class="btn btn-xs btn-default tooltips delete"
                               href="{{ route('personal.destroy', ['personal'=>$personalInfoData->id]) }}"
                               data-type="button_in_panel"
                               data-name="Personal info"
                               data-placement="top"
                               data-original-title="{{ __('admin.remove') }}"
                            >
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        @endcan
                    </div>
                @endif
            </div>
            <div class="panel-body {{ $personalInfoData ? '' : 'center' }}">
                @if($personalInfoData)
                    <div class="col-md-4 col-sm-4 center">
                        <img src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/{{ $personalInfoData->img ?? 'photo.png' }}" class="img-thumbnail" alt="avatar">
                    </div>
                    <div class="col-md-8 col-sm-8 padding-bottom-15 center">
                        <h1 class="tooltips"
                            data-placement="top"
                            data-original-title="{{ __('admin.full_name') }}"
                        >
                            <span class="text-bold">{{ $personalInfoData->full_name ?? '' }}</span>
                        </h1>
                        <h3 class="tooltips"
                            data-placement="bottom"
                            data-original-title="{{ __('admin.position') }}"
                        >
                            {{ $personalInfoData->position ?? '' }}
                        </h3>
                    </div>

                @endif
                <a href="{{ route('personal.create') }}" class="btn btn-dark-orange create-button {{ $personalInfoData ? 'no-display' : '' }}">{{ __('admin.new_personal_info_data') }} <i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>