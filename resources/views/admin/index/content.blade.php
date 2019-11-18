<div class="row">
    <div class="col-md-6 col-lg-3 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-tools">
                <a href="#" class="btn btn-xs btn-link panel-close">
                    <i class="fa fa-times"></i>
                </a>
            </div>
            <div class="panel-body no-padding">
                <div class="partition-green padding-20 text-center core-icon">
                    <i class="fas fa-download fa-2x icon-big"></i>
                </div>
                <div class="padding-20 core-content">
                    <h3 class="title block no-margin">{{ __('admin.downloads') }}</h3>
                    <div class="col-md-12 center">
                        <h1>{{ $totalCounts['downloadsCount'] ?? 0 }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-tools">
                <a href="#" class="btn btn-xs btn-link panel-close">
                    <i class="fa fa-times"></i>
                </a>
            </div>
            <div class="panel-body no-padding">
                <div class="partition-blue padding-20 text-center core-icon">
                    <i class="fas fa-eye fa-2x icon-big"></i>
                </div>
                <div class="padding-20 core-content">
                    <h3 class="title block no-margin">{{ __('admin.views') }}</h3>
                    <div class="col-md-12 center">
                        <h1>{{ $totalCounts['viewsCount'] ?? 0 }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-tools">
                <a href="#" class="btn btn-xs btn-link panel-close">
                    <i class="fa fa-times"></i>
                </a>
            </div>
            <div class="panel-body no-padding">
                <div class="partition-red padding-20 text-center core-icon">
                    <i class="fas fa-user-tie fa-2x icon-big"></i>
                </div>
                <div class="padding-20 core-content">
                    <h3 class="title block no-margin">{{ __('admin.visitors') }}</h3>
                    <div class="col-md-12 center">
                        <h1>{{ $totalCounts['visitorsCount'] ?? 0 }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-tools">
                <a href="#" class="btn btn-xs btn-link panel-close">
                    <i class="fa fa-times"></i>
                </a>
            </div>
            <div class="panel-body no-padding">
                <div class="partition-azure padding-20 text-center core-icon">
                    <i class="fa fa-envelope fa-2x icon-big"></i>
                </div>
                <div class="padding-20 core-content">
                    <h3 class="title block no-margin">{{ __('admin.messages') }}</h3>
                    <div class="col-md-12 center">
                        <h1>{{ $totalCounts['messagesCount'] ?? 0 }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-5">
        <div class="panel panel-red panel-calendar">
            <div class="panel-heading border-light">
                <h4 class="panel-title">{{ __('admin.date_time') }}</h4>
                <div class="panel-tools">
                    <div class="dropdown">
                        <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-white">
                            <i class="fa fa-cog"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                            <li>
                                <a class="panel-collapse collapses" href="#">
                                    <i class="fa fa-angle-up"></i>
                                    <span>{{ __('admin.collapse') }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="panel-expand" href="#">
                                    <i class="fa fa-expand"></i> <span>{{ __('admin.fullscreen') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <a class="btn btn-xs btn-link panel-close" href="#">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="actual-date">
                                <span class="actual-day"></span>
                                <span class="actual-month"></span>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="clock-wrapper">
                                        <div class="clock">
                                            <div class="circle">
                                                <div class="face">
                                                    <div id="hour"></div>
                                                    <div id="minute"></div>
                                                    <div id="second"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-dark">
            <div class="panel-heading">
                <h4 class="panel-title">{{ __('admin.pages') }}</h4>
                <div class="panel-tools">
                    <div class="dropdown">
                        <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-white">
                            <i class="fa fa-cog"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                            <li>
                                <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>{{ __('admin.collapse') }}</span> </a>
                            </li>
                            <li>
                                <a class="panel-expand" href="#">
                                    <i class="fa fa-expand"></i> <span>{{ __('admin.fullscreen') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <a class="btn btn-xs btn-link panel-close" href="#">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body no-padding">
                <div class="partition-green padding-15 text-center">
                    <h4 class="no-margin">{{ __('admin.visited_pages_statistics') }}</h4>
                    <span class="text-light">{{ __('admin.based_on_existing_pages') }}</span>
                </div>
                <div id="accordion" class="panel-group accordion accordion-white no-margin">
                    <div class="panel no-radius">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed padding-15">
                                    <i class="icon-arrow"></i>
                                    {{ __('admin.this_month') }}
                                </a></h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapseOne">
                            <div class="panel-body no-padding partition-light-grey">
                                <table class="table">
                                    <tbody>
                                        @forelse($currentMonthPagesVisitsCounts as $page => $count)
                                            <tr>
                                                <td></td>
                                                <td>{{ $page ?? '' }}</td>
                                                <td class="center">{{ $count ?? '' }}</td>
                                                <td><i class="fas fa-eye text-green"></i></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td></td>
                                                <td class="center">{{ __('admin.no_data') }}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel no-radius">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle padding-15 collapsed">
                                    <i class="icon-arrow"></i>
                                    {{ __('admin.total') }}
                                </a></h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapseTwo">
                            <div class="panel-body no-padding partition-light-grey">
                                <table class="table">
                                    <tbody>
                                        @forelse($pagesVisitsTotalCounts as $pageName => $totalCount)
                                            <tr>
                                                <td></td>
                                                <td>{{ $pageName ?? '' }}</td>
                                                <td class="center">{{ $totalCount ?? '' }}</td>
                                                <td><i class="fas fa-eye text-green"></i></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td></td>
                                                <td class="center">{{ __('admin.no_data') }}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-7">
        <div class="panel panel-white">
            <div class="panel-heading border-light">
                <h4 class="panel-title hidden-xs">{{ __('admin.visitors_downloads') }}</h4>
                <ul class="panel-heading-tabs border-light">
                    <li>
                        <div id="reportrange" class="pull-right" data-url="{{ route('chart_data') }}">
                            <span>{{ __('admin.last_7_days') }} </span><i class="fa fa-angle-down"></i>
                        </div>
                    </li>

                    <li class="panel-tools">
                        <div class="dropdown">
                            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                                <i class="fa fa-cog"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                                <li>
                                    <a class="panel-collapse collapses" href="#">
                                        <i class="fa fa-angle-up"></i>
                                        <span>{{ __('admin.collapse') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="panel-expand" href="#">
                                        <i class="fa fa-expand"></i> <span>{{ __('admin.fullscreen') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <a class="btn btn-xs btn-link panel-close" href="#">
                            <i class="fa fa-times"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="panel-body no-padding partition-green">
                <div class="col-md-3 col-lg-2 no-padding">
                    <div class="partition-body padding-15">
                        <ul class="mini-stats sparkline" data-url="{{ route('sparkline_data') }}">
                            <li class="col-md-12 col-sm-6 col-xs-6 no-padding">
                                <div class="sparkline-bar sparkline-1">
                                    <span></span>
                                </div>
                                <div class="values week-visits">
                                    <strong></strong>
                                    {{ __('admin.views') }}
                                </div>
                            </li>
                            <li class="col-md-12 col-sm-6 col-xs-6 no-padding">
                                <div class="sparkline-bar sparkline-2">
                                    <span></span>
                                </div>
                                <div class="values week-downloads">
                                    <strong></strong>
                                    {{ __('admin.downloads') }}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 col-lg-10 no-padding partition-white">
                    <div class="partition">
                        <div class="partition-body padding-15">
                            <div class="height-300">
                                <div id="chart1" class='with-3d-shadow with-transitions'>
                                    <svg></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>