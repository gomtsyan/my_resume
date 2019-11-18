@if ($message)
    <div class="message-header">
        <div class="message-time">
            {{ $message->created_at ?? '' }}
        </div>
        <div class="message-from">
            {{ $message->name ?? '' }} &lt;{{ $message->email ?? '' }}&gt;
        </div>
        <div class="message-to">
            {{ __('admin.to') }} {{ __('admin.me') }}
        </div>
        <div class="message-actions">
        </div>
    </div>
    <div class="message-content">
        {{ $message->message ?? '' }}
    </div>
@else
    <div class="message-content">
        {{ __('admin.no_data') }}
    </div>
@endif