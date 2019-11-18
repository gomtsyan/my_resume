<div class="row visitors">
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
            <div class="panel-body table-responsive">
                <table class="table table-striped table-bordered table-hover table-full-width"
                       id="visitors"
                       data-url="{!! route('visitor_data') !!}"
                       data-img-path="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/"
                >
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Flag</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>Visit Count</th>
                            <th>Downloads</th>
                            <th>Last Visit</th>
                            <th>Coordinates</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div id="visited-pages-subview" class="no-display"></div>
                <div id="visitor-map-subview" class="no-display">
                    <div class="col-md-12 margin-top-25">
                        <div class="panel panel-azure">
                            <div class="panel-body panel-map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>