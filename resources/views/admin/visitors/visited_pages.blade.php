<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-white margin-top-10">
        <div class="panel-heading">
            <h4 class="panel-title"> <span class="text-bold">{{ $title ?? '' }}</span></h4>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-hover margin-bottom-10" id="sample_1">
                <thead>
                    <tr>
                        <th >Page</th>
                        <th class="hidden-xs">Additional</th>
                        <th>Count</th>
                        <th class="hidden-xs">Last visit</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pagesData as $key => $pageData)
                        <tr>
                            <td>{{ $pageData->page ?? '' }}</td>
                            <td class="hidden-xs">{{ $pageData->additional_data ?? '-' }}</td>
                            <td>{{ $pageData->count ?? '' }}</td>
                            <td class="hidden-xs">{{ $pageData->updated_at ?? '' }}</td>
                        </tr>
                    @empty
                        <tr class="center"><td colspan="4">{{ __('admin.no_data') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
