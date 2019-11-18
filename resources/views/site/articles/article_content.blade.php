<section class="blog padding-block">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-8">
                @if($article && is_object($article))
                    <div class="post one-post">
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
                            <time class="entry-published right-border">{{ $article->createDate ?? '' }}</time>
                            <i class="fa fa-comment"></i>
                            <span class="comments-link">{{ $article->comments->count() ?? '' }} <span class="hidden-xxs">{{ __('app.comments') }}</span></span>
                        </div>
                        <!-- start text post -->
                        {!! $article->text ?? '' !!}
                        <!-- end text post -->

                        <!-- start post pagination -->
                        <div class="post-pagination">
                            <a href="{{ route('articles.index') }}"
                               class="btn btn-color-hover hover-animate pre">{{ __('app.back_to_articles') }}</a>
                        </div>
                        <div class="clearfix"></div>
                        <!-- end post pagination -->

                        <!-- start post comments -->
                        @if($article->comments->count() > 0)
                            <div class="post-comments">
                                <h3>{{ $article->comments->count() ?? '' }} {{ __('app.comments') }}</h3>
                                <ul class="post-content-txt">

                                    @foreach($article->commentsGroup as $parent_id => $comments)
                                        @if($parent_id == 0)

                                            @include(config('settings.theme').'.articles.comment_content', ['comments'=>$comments])

                                        @endif
                                    @endforeach

                                </ul>
                            </div>
                        @endif
                    <!-- end post comments -->

                        <!-- start leave comment -->
                        <div class="leave-comment col-xs-12 col-sm-12 col-lg-12" id="respond">
                            <h3 id="cancel-comment-reply-link">{{ __('app.leave_a_comment') }}</h3>

                            <form id="commentform" class="form email-form" method="post"
                                  action="{{ route('comment.store') }}" autocomplete="off">
                                <input type="text" name="email" id="subject" class="input-contact" placeholder="{{ __('app.email') }}">
                                <div class="error-message">{{ $errors->comment->first('email') }}</div>

                                <input type="text" name="user_name" id="name" class="input-contact" placeholder="{{ __('app.name') }}">
                                <div class="error-message">{{ $errors->comment->first('user_name') }}</div>

                                <textarea type="text" name="text" id="message" class="input-contact"
                                          placeholder="{{ __('app.message') }}"></textarea>
                                <div class="error-message">{{ $errors->comment->first('text') }}</div>

                                <div class="text-right ">
                                    <button id="submit" type="submit"
                                            class="btn btn-color hover-animate">{{ __('app.send_comment') }}</button>
                                </div>
                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                <input id="parent_id" type="hidden" name="parent_id" value="0">
                                {{ csrf_field() }}
                            </form>

                        </div>
                        <!-- end leave comment -->

                    </div>
                @endif
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

@if(session('comment_status_success'))
    <div class="myAlert-top alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><i class="fa fa-check-circle"></i></strong> {{ session('comment_status_success') ?? '' }}
    </div>
@endif