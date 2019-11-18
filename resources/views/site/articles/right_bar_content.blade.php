@if($articleCategories)
    <aside class="widget widget_categories">
        <h3 class="widget-title">{{ __('app.categories') }}</h3>
        <ul>
            <li class="cat-item cat-item-0"><a href="{{ route('articles.index') }}">{{ __('app.all') }}</a></li>
            @foreach($articleCategories as $articleCategory)
                <li class="cat-item cat-item-{{ $articleCategory->id ?? '' }}"><a href="{{ route('articles_cat', ['cat_slug'=>$articleCategory->slug]) }}">{{ $articleCategory->title ?? '' }}</a></li>
            @endforeach
        </ul>
    </aside>
@endif

@if($recentArticles)
    <aside class="widget widget_recent_entries">
        <h3 class="widget-title">{{ __('app.recent_posts') }}</h3>
        <ul>
            @foreach($recentArticles as $recentArticle)
                <li><a href="{{ route('articles.show', ['article'=>$recentArticle->slug]) }}">{{ $recentArticle->title ?? '' }}</a></li>
            @endforeach
        </ul>
    </aside>
@endif
