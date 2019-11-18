<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title">{{ $title ?? '' }} <span class="text-bold">{{ __('admin.table') }}</span></h4>
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
                @can('create', 'App\Models\Page')
                    <div class="space12">
                        <a class="btn btn-green add-row"
                           href="{{ route('pages.create') }}"
                        >
                            {{ __('admin.new_page') }}
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                @endcan

                <table class="table table-striped table-hover margin-bottom-10" id="sample-table-2">
                    <thead>
                        <tr>
                            @forelse ($fieldNames as $fieldName)
                                <th class="{{ in_array($fieldName, ['id', 'title']) ? '' : 'hidden-xs' }}">{{ ucfirst($fieldName) }}</th>
                            @empty
                                <th>{{ __('admin.empty') }}</th>
                            @endforelse

                            <th>{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($pages as $key => $page)
                            <tr>
                                <td>{{ $page->id ?? '' }}</td>
                                <td>{{ $page->title ?? '' }}</td>
                                <td class="hidden-xs">{{ $page->path ?? '' }}</td>
                                <td class="hidden-xs">
                                    <img src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/{{ config('settings.menu_path') }}/{{ $page->img->small ?? '' }}" alt="page">
                                </td>
                                <td class="hidden-xs">{{ $page->sub_title ?? '' }}</td>
                                <td class="hidden-xs"><span class="label label-{{ $page->is_active ? 'success' : 'danger' }}">{{ $page->is_active ? 'Active' : 'Inactive' }}</span></td>
                                <td class="hidden-xs"><span class="badge badge-warning">{{ $page->order ?? '' }}</span></td>
                                <td class="center">
                                    <div class="visible-md visible-lg hidden-sm hidden-xs">
                                        @can('update', 'App\Models\Page')
                                            <a href="{{ route('pages.edit', ['pages'=>$page->id]) }}"
                                               class="btn btn-xs btn-blue tooltips"
                                               data-placement="top"
                                               data-original-title="{{ __('admin.edit') }}"
                                            >
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('delete', 'App\Models\Page')
                                            <a href="{{ route('pages.destroy', ['pages'=>$page->id]) }}"
                                               class="btn btn-xs btn-red tooltips delete"
                                               data-placement="top"
                                               data-original-title="{{ __('admin.remove') }}"
                                               data-type="button_in_table"
                                               data-name="page"
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
                                                @can('update', 'App\Models\Page')
                                                    <li>
                                                        <a role="menuitem"
                                                           tabindex="-1"
                                                           href="{{ route('pages.edit', ['pages'=>$page->id]) }}"
                                                        >
                                                            <i class="fa fa-edit"></i>{{ __('admin.edit') }}
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('delete', 'App\Models\Page')
                                                    <li>
                                                        <a role="menuitem"
                                                           class="delete"
                                                           tabindex="-1"
                                                           href="{{ route('pages.destroy', ['pages'=>$page->id]) }}"
                                                           data-type="button_in_table"
                                                           data-name="page"
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
                        @empty
                            <th colspan="2">{{ __('admin.empty') }}</th>
                        @endforelse

                    </tbody>
                </table>
                    @include(config('settings.admin_theme').'.partials.pagination', ['pagination' => $pages])
            </div>
        </div>
    </div>
</div>