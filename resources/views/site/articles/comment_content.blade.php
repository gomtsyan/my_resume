@if($comments)
    @foreach($comments as $comment)
        <li class="post-comment">
            <div id="comment-{{ $comment->id }}" class="col-md-12 col-xs-12 col-lg-12">
                <div class="col-md-2 col-xs-2 post-user-info text-center">
                    <div class="user-img">
                        <img src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/{{ config('settings.comment_avatar') }}"
                             alt="{{ $comment->user_name ?? '' }}">
                    </div>
                    <div class="user-name {{ $comment->user_id ? 'bold' : '' }}">{{ $comment->user_name ?? '' }}</div>
                </div>
                <div class="col-md-10 col-xs-10 post-comment-txt">
                    <span class="comment-time">{{ $comment->createDate ?? '' }}</span>
                    <span class="reply">
                        <a class="comment-reply-link hover-animate"
                           href="#respond"
                           onclick="return addComment.moveForm('comment-{{ $comment->id }}', '{{ $comment->id }}', 'respond', '{{ $comment->article_id }}')"
                        >
                            <i class="fa fa-reply"></i>{{ __('app.reply') }}
                        </a>
                    </span>
                    <span class="clearfix"></span>
                    <p>{{ $comment->text ?? '' }}</p>
                </div>
            </div>
            <span class="clearfix"></span>
            @if(isset($article->commentsGroup[$comment->id]))
                <ul class="reply-post">
                    @include(config('settings.theme').'.articles.comment_content', ['comments' => $article->commentsGroup[$comment->id]])
                </ul>
            @endif
        </li>
    @endforeach
@endif