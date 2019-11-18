<div class="row blog">
    <div class="col-md-12">
        <!-- start: TABLE WITH IMAGES PANEL -->
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
                @can('create', 'App\Models\Article')
                    <div class="space12">
                        <a class="btn btn-green add-row"
                           href="{{ route('blog.create') }}"
                        >
                            {{ __('admin.new_article') }}
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

                        @forelse ($articles as $key => $article)
                            <tr>
                                <td>{{ $article->id ?? '' }}</td>
                                <td>{{ $article->title ?? '' }}</td>
                                <td class="hidden-xs">{{ $article->slug ?? '' }}</td>
                                <td class="hidden-xs">
                                    <img
                                        src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/{{ config('settings.blog_path') }}/{{ $article->img ?? '' }}"
                                        alt="blog"
                                        class="thumbnail"
                                    >

                                </td>
                                <td class="hidden-xs"><span class="label label-{{ $article->is_active ? 'success' : 'danger' }}">{{ $article->is_active ? 'Active' : 'Inactive' }}</span></td>
                                <td class="hidden-xs">{{ $article->category->title ?? '' }}</td>
                                <td class="hidden-xs">{{ $article->user->name ?? '' }}</td>
                                <td class="center">
                                    <div class="visible-md visible-lg hidden-sm hidden-xs">
                                        @can('update', 'App\Models\Article')
                                            <a href="{{ route('blog.edit', ['article'=>$article->slug]) }}"
                                               class="btn btn-blue tooltips"
                                               data-placement="top"
                                               data-original-title="{{ __('admin.edit') }}"
                                            >
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('delete', 'App\Models\Article')
                                            <a href="{{ route('blog.destroy', ['article'=>$article->slug]) }}"
                                               class="btn btn-red tooltips delete"
                                               data-placement="top"
                                               data-original-title="{{ __('admin.remove') }}"
                                               data-type="button_in_table"
                                               data-name="article"
                                            >
                                                <i class="fa fa-times fa fa-white"></i>
                                            </a>
                                        @endcan
                                        @can('view', 'App\Models\Comment')
                                            <a href="#comments-subview-{{ $article->id }}"
                                               class="btn btn-green tooltips show-sv"
                                               data-placement="top"
                                               data-original-title="{{ __('admin.comments') }}"
                                               data-startFrom="right"
                                            >
                                                {{ $article->comments->count() }} <i class="fas fa-comments"></i>
                                            </a>
                                        @endcan
                                    </div>
                                    <div id="comments-subview-{{ $article->id }}" class=" no-display">
                                        <div class="col-md-12">
                                            @if($article->comments->count() > 0)
                                                <div class="post-comments">
                                                    <h3 class="row">
                                                        <span class="col-md-6 inline-block text-left">{{ $article->title ?? '' }}</span>
                                                        <span class="col-md-6 inline-block text-right">{{ $article->comments->count() ?? '' }} {{ __('admin.comments') }}</span>
                                                    </h3>
                                                    <ul class="post-content-txt">
                                                        @foreach($article->commentsGroup as $parent_id => $comments)
                                                            @if($parent_id == 0)
                                                                @include(config('settings.admin_theme').'.articles.comment_content', ['comments' => $comments])
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="visible-xs visible-sm hidden-md hidden-lg">
                                        <div class="btn-group">
                                            <a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                                <i class="fa fa-cog"></i> <span class="caret"></span>
                                            </a>
                                            <ul role="menu" class="dropdown-menu pull-right dropdown-dark">
                                                @can('update', 'App\Models\Article')
                                                    <li>
                                                        <a role="menuitem"
                                                           tabindex="-1"
                                                           href="{{ route('blog.edit', ['article'=>$article->slug]) }}"
                                                        >
                                                            <i class="fa fa-edit"></i>{{ __('admin.edit') }}
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('delete', 'App\Models\Article')
                                                    <li>
                                                        <a role="menuitem"
                                                           class="delete"
                                                           tabindex="-1"
                                                           href="{{ route('blog.destroy', ['article'=>$article->slug]) }}"
                                                           data-type="button_in_table"
                                                           data-name="article"
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
                    @include(config('settings.admin_theme').'.partials.pagination', ['pagination' => $articles])
            </div>
        </div>
    </div>
</div>