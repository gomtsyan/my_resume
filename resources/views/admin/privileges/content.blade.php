<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title">{{ __('admin.permission_role') }} <span class="text-bold">{{ __('admin.table') }}</span></h4>
                <div class="panel-tools">
                    <div class="dropdown">
                        <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                            <i class="fa fa-cog"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                            <li>
                                <a class="panel-expand" href="#"> <i class="fa fa-expand"></i> <span>Fullscreen</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel-body">

                <form action="{{ route('privileges.store') }}" method="post">

                    <div class="panel-group accordion" id="accordion">
                        @forelse ($permissionNames as $permissionName => $permissionIds)
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#{{ $permissionName ?? '' }}">
                                            <i class="icon-arrow"></i> {{ $permissionName ?? '' }}
                                        </a>
                                    </h5>
                                </div>
                                <div id="{{ $permissionName ?? '' }}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="sample-table-4">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('admin.permissions') }}</th>

                                                        @forelse ($roles as $role)
                                                            <th class="center">{{ $role->name }}</th>
                                                        @empty
                                                            <th class="center">{{ __('admin.empty') }}</th>
                                                        @endforelse
                                                        <th class="center">{{ __('admin.actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($permissions as $permission)
                                                        @if(in_array($permission->id, $permissionIds))
                                                            <tr>
                                                                <td>{{ $permission->name }}</td>

                                                                @forelse ($roles as $role)
                                                                    <td class="center">
                                                                        <div class="checkbox-table">
                                                                            <label class="checkbox-inline">
                                                                                <input  type="checkbox"
                                                                                        class="flat-green foocheck"
                                                                                        name="{{ $role->id }}[]"
                                                                                        value="{{ $permission->id }}"
                                                                                        {{ $role->hasPermissions($permission->name) ? 'checked' : '' }}
                                                                                        @cannot('update', 'App\Models\Permission') disabled @endcannot
                                                                                >
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                @empty
                                                                    <td>{{ __('admin.empty') }}</td>
                                                                @endforelse
                                                                <td class="center">
                                                                    <div class="">
                                                                        @can('delete', 'App\Models\Permission')
                                                                            <a href="{{ route('privileges.destroy', ['privileges'=>$permission->id]) }}"
                                                                               class="btn btn-xs btn-red tooltips delete"
                                                                               data-placement="top"
                                                                               data-original-title="{{ __('admin.remove') }}"
                                                                               data-type="button_in_table"
                                                                               data-name="permission"
                                                                            >
                                                                                <i class="fa fa-times fa fa-white"></i>
                                                                            </a>
                                                                        @endcan
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @empty
                                                        <tr><td>{{ __('admin.empty') }}</td></tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr><td>{{ __('admin.empty') }}</td></tr>
                        @endforelse
                    </div>
                    {{ csrf_field() }}
                    @can('create', 'App\Models\Permission')
                        <button type="submit" class="btn btn-azure">
                            {{ __('admin.save') }}
                        </button>
                    @endcan
                </form>

            </div>
        </div>
    </div>
</div>