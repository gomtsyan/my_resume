@forelse ($items as $item)
    <li class="messages-item" data-bb="singleMessage" data-route="{{ route('messages.show', ['messages' => $item->id]) }}">

        <img
                src="{{ asset(config('settings.admin_public')) }}/images/{{ $item->is_viewed ? config('settings.admin_message_avatar') : config('settings.admin_new_message_avatar') }}"
                data-image="{{ asset(config('settings.admin_public')) }}/images/{{ config('settings.admin_message_avatar') }}"
                alt="avatar"
                class="messages-item-avatar"
        >
        <span class="messages-item-from">{{ $item->name ?? '' }}</span>

        <div class="messages-item-time">
            <span class="text">{{ $item->created_at ?? '' }}</span>
            @can('delete', 'App\Models\ContactMe')
                <div class="messages-item-actions">
                    <a href="{{ route('messages.destroy', ['messages'=>$item->id]) }}" class="delete"><i class="fa fa-trash"></i> {{ __('admin.delete') }}</a>
                </div>
            @endcan
        </div>
        <span class="messages-item-subject">{{ __('admin.work') }}</span>
        <span class="messages-item-preview">{{ $item->shortDescription ?? '' }}</span>
    </li>
@empty
    <li class="messages-item">{{ __('admin.no_post') }}</li>
@endforelse