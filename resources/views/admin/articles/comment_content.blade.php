@if($comments)
    @foreach($comments as $comment)
        <li class="post-comment">
            <div id="comment-{{ $comment->id }}" class="col-md-12 col-xs-12 col-lg-12">
                <div class="col-md-2 col-xs-2 post-user-info text-center">
                    <div class="user-img">
                        <img src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/{{ config('settings.comment_avatar') }}"
                             alt="{{ $comment->user_name ?? '' }}">
                    </div>
                    <div class="user-name {{ $comment->user_id ? 'text-bold text-blue' : '' }}">{{ $comment->user_name ?? '' }}</div>
                </div>
                <div class="col-md-10 col-xs-10 post-comment-txt">
                    <span class="comment-time">{{ $comment->createDate ?? '' }}</span>
                    <span class="trash">
                        @can('delete', 'App\Models\Comment')
                            <a class="hover-animate tooltips delete"
                               href="{{ route('comments.destroy', ['comments' => $comment->id]) }}"
                               data-placement="top"
                               data-original-title="Trash"
                               data-type="button_in_sub_view"
                               data-name="comment"
                            >
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        @endcan
                    </span>
                    <span class="clearfix"></span>
                    <p>{{ $comment->text ?? '' }}</p>
                </div>
            </div>
            <span class="clearfix"></span>
            @if(isset($article->commentsGroup[$comment->id]))
                <ul class="reply-post">
                    @include(config('settings.admin_theme').'.articles.comment_content', ['comments' => $article->commentsGroup[$comment->id]])
                </ul>
            @endif
        </li>
    @endforeach
@endif