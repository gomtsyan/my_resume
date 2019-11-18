<section class="blog padding-block">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-8 padding-bottom">
                <!-- start post -->
                @if($articles && is_object($articles))
                    @foreach($articles as $key => $article)
                        <div class="post {{ (($key+1)%config('settings.articles_count') == 0) ? 'last' : '' }}">

                            <div class="photo">
                                <img src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/{{ config('settings.blog_path') }}/{{ $article->img ?? config('settings.article_img') }}"
                                     alt="{{ $article->title ?? '' }}">
                            </div>
                            <h3 class="title title-blog">{{ $article->title ?? '' }}</h3>

                            <div class="entry-byline">
                                <i class="fa fa-user"></i>
                                <span class="entry-author right-border">
                                    <a href="#" title="Posts by Theme Admin" rel="author">
                                        <span>{{ $article->user->name ?? '' }}</span>
                                    </a>
                                </span>
                                <i class="far fa-clock fa"></i>
                                <time class="entry-published right-border">{{ $article->CreateDate ?? '' }}</time>
                                <i class="fa fa-comment"></i>
                                <span class="comments-link">{{ $article->comments->count() ?? 0 }} <span class="hidden-xxs">{{ __('app.comments') }}</span></span>
                            </div>
                            <!-- start desc post -->
                            <p>{{ $article->short_desc ?? '' }}</p>
                            <!-- end desc post -->
                            <a href="{{ route('articles.show', ['article'=>$article->slug]) }}"
                               class="btn hover-animate btn-color-hover">{{ __('app.read_more') }}</a>
                        </div>
                    @endforeach
                @else
                    <p>{{ __('app.no_articles') }}</p>
            @endif
            <!-- end post -->
                @include(config('settings.theme').'.partials.pagination', ['pagination'=>$articles])
            </div>
            <div class="col-xs-12 col-sm-12 col-lg-4">
                @include(config('settings.theme').'.articles.right_bar_content',
                    [
                        'articleCategories'=>$articleCategories,
                        'recentArticles'=>$recentArticles
                    ]
                )
            </div>
        </div>
    </div>
</section>