<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title">{{ $title ?? '' }} <span class="text-bold">{{ __('admin.click_to_edit') }}</span></h4>
                <div class="panel-tools">
                    <div class="dropdown">
                        <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                            <i class="fa fa-cog"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                            <li>
                                <a class="panel-expand" href="#">
                                    <i class="fa fa-expand"></i> <span>{{ __('admin.fullscreen') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                @can('create', 'App\Models\Setting')
                    <div class="space12">
                        <a class="btn btn-green add-row"
                           href="{{ route('settings.create') }}"
                        >
                            {{ __('admin.new_setting') }}
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                @endcan
                @if($settings)
                    <table id="user" class="table table-bordered table-striped">
                        <tbody>
                            @foreach($settings as $setting)
                                <tr>
                                    <td class="column-left">
                                        <a
                                            @can('update', 'App\Models\Setting')
                                                href="{{ route('settings.edit', ['settings'=>$setting->id]) }}"
                                                class="tooltips"
                                                data-placement="top"
                                                data-original-title="{{ __('admin.edit') }}"
                                            @else
                                                href="javascript:void(0)"
                                            @endcan
                                        >
                                            {{ $setting->name ?? '' }}
                                        </a>
                                    </td>
                                    <td class="column-right">
                                        <a href="javascript:void(0)"
                                           @can('update', 'App\Models\Setting') id="{{ $setting->key ?? '' }}" @endcan
                                           data-value="{{ $setting->value ?? '' }}"
                                           data-url="{{ route('settings.update', ['settings' => $setting->id]) }}"
                                           data-name="{{ $setting->name ?? '' }}"
                                           data-type="{{ $setting->type ?? '' }}"
                                           data-pk="{{ $setting->id ?? '' }}"
                                           data-original-title="{{ __('admin.edit_setting') }}">
                                            {{ $setting->value ?? '' }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="visible-md visible-lg hidden-sm hidden-xs text-right">
                                            @can('delete', 'App\Models\Setting')
                                                <a href="{{ route('settings.destroy', ['settings'=>$setting->id]) }}"
                                                   class="btn btn-red tooltips delete"
                                                   data-placement="top"
                                                   data-original-title="{{ __('admin.remove') }}"
                                                   data-type="button_in_table"
                                                   data-name="setting"
                                                >
                                                    <i class="fa fa-times fa fa-white"></i>
                                                </a>
                                            @endcan
                                        </div>
                                        <div class="visible-xs visible-sm hidden-md hidden-lg">
                                            <div class="btn-group">
                                                <a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                                    <i class="fa fa-cog"></i> <span class="caret"></span>
                                                </a>
                                                <ul role="menu" class="dropdown-menu pull-right dropdown-dark">
                                                    @can('delete', 'App\Models\Setting')
                                                        <li>
                                                            <a role="menuitem"
                                                               class="delete"
                                                               tabindex="-1"
                                                               href="{{ route('settings.destroy', ['settings'=>$setting->id]) }}"
                                                               data-type="button_in_table"
                                                               data-name="setting"
                                                            >
                                                                <i class="fa fa-times"></i> {{ __('admin.remove') }}
                                                            </a>
                                                        </li>
                                                    @endcan
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>