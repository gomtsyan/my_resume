<div class="toolbar row">

    <div class="col-sm-6 hidden-xs">
        <div class="page-header">
            <h1>{{ $title ?? '' }} <small>{{ $subTitle ?? '' }} </small></h1>
        </div>
    </div>

    <div class="col-sm-6 col-xs-12">
        <a href="#" class="back-subviews">
            <i class="fa fa-chevron-left"></i> {{ __('admin.back') }}
        </a>
        <a href="#" class="close-subviews">
            <i class="fa fa-times"></i> {{ __('admin.close') }}
        </a>

        @if($messages)
            <div class="toolbar-tools pull-right">
                <!-- start: TOP NAVIGATION MENU -->
                <ul class="nav navbar-right">
                    <!-- start: TO-DO DROPDOWN -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                            <span class="messages-count badge {{ $unreadMessagesCount > 0 ? '' : 'hide' }}">{{ $unreadMessagesCount ?? 0 }}</span> <i class="fa fa-envelope"></i> {{ __('admin.Messages') }}
                        </a>
                        <ul class="dropdown-menu dropdown-light dropdown-messages">
                            <li>
                                <div class="drop-down-wrapper ps-container">
                                    <ul>
                                        @forelse ($messages as $message)
                                            <li>
                                                <a href="javascript:;" class="{{ $message->is_viewed ? '' : 'unread' }}">
                                                    <div class="clearfix">
                                                        <div class="thread-image">
                                                            <img src="{{ asset(config('settings.admin_public')) }}/images/businessman.png" alt="avatar" height="50px">
                                                        </div>
                                                        <div class="thread-content">
                                                            <span class="author">{{ $message->name ?? '' }}</span>
                                                            <span class="preview">{{ $message->shortDescription ?? '' }}</span>
                                                            <span class="time"> {{ $message->dateRange ?? '' }}</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @empty
                                            <li>
                                                <span class="dropdown-header"> {{ __('admin.no_post') }}</span>
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>
                            </li>
                            <li class="view-all">
                                <a href="{{ route('messages.index') }}">
                                    {{ __('admin.see_all') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        @endif
    </div>
</div>