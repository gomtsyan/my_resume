<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <span class="text-bold"><h4 class="panel-title">{{ __('admin.inbox') }}</h4></span>
                <div class="panel-tools">
                    <div class="dropdown">
                        <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                            <i class="fa fa-cog"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                            <li>
                                <a class="panel-expand" href="#">
                                    <i class="fa fa-expand"></i> <span>{{ __('admin.fullscreen') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel-body messages">
                <ul class="messages-list col-md-4">
                    <li class="messages-search">
                        <form action="{{ route('search_messages') }}" class="form-inline search-form">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="{{ __('admin.search_messages') }}" name="keyword">
                                <div class="input-group-btn">
                                    <button class="btn btn-green start-search" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </li>

                    @forelse ($messages as $message)
                        <li class="messages-item" data-bb="singleMessage" data-route="{{ route('messages.show', ['messages' => $message->id]) }}">

                            <img
                                src="{{ asset(config('settings.admin_public')) }}/images/{{ $message->is_viewed ? config('settings.admin_message_avatar') : config('settings.admin_new_message_avatar') }}"
                                data-image="{{ asset(config('settings.admin_public')) }}/images/{{ config('settings.admin_message_avatar') }}"
                                alt="avatar"
                                class="messages-item-avatar"
                            >
                            <span class="messages-item-from">{{ $message->name ?? '' }}</span>

                            <div class="messages-item-time">
                                <span class="text">{{ $message->created_at ?? '' }}</span>
                                @can('delete', 'App\Models\ContactMe')
                                    <div class="messages-item-actions">
                                        <a href="{{ route('messages.destroy', ['messages'=>$message->id]) }}" class="delete"><i class="fa fa-trash"></i> {{ __('admin.delete') }}</a>
                                    </div>
                                @endcan
                            </div>
                            <span class="messages-item-subject">{{ __('admin.work') }}</span>
                            <span class="messages-item-preview">{{ $message->shortDescription ?? '' }}</span>
                        </li>
                    @empty
                        <li class="messages-item">{{ __('admin.no_post') }}</li>
                    @endforelse

                    <li class="messages-pagination">
                        @include(config('settings.admin_theme').'.partials.pagination', ['pagination' => $messages])
                    </li>

                </ul>

                <div class="border"></div>
                <div class="messages-content col-md-8 flex">

                    <div class="row background-message">
                        <img src="{{ asset(config('settings.admin_public')) }}/images/message.png" alt="avatar" class="img-rounded">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>