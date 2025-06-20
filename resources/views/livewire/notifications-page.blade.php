<section class="home-page position-relative pb-120 z-1 overflow-hidden">
    <span class="gradient-circle-3"></span>
    <span class="gradient-circle-4"></span>

    <div class="container px-3">
        <!-- header area -->
        <div class="header-area mt-5 mb-4">
            <div class="d-between">
                <h3 class="tcn-800">{{ __('messages.notifications') }}</h3>
                <button wire:click="markAllAsRead" class="btn btn-sm btn-outline-primary ms-2">
                    {{ __('Mark all as read') }}
                </button>
            </div>
        </div>

        <!-- all notifications -->
        <div class="notification-list d-grid gap-3">
            @forelse($notifications as $notif)
                <div class="notification-item p-3 rounded bg-light d-flex justify-content-between align-items-center">
                    <div>
                        <span class="fw-bold tcn-700">{{ $notif->fromUser->username ?? __('messages.unknown_user') }}</span>
                        <span class="ms-2 tcn-500">
                            @switch($notif->type)
                                @case('like') {{ __('messages.liked_you') }} @break
                                @case('dislike') {{ __('messages.disliked_you') }} @break
                                @case('match') {{ __('messages.you_have_a_match') }} @break
                                @default {{ __('messages.did_something') }}
                            @endswitch
                        </span>
                    </div>

                    <button wire:click="deleteNotification({{ $notif->id }})" class="btn btn-sm btn-outline-danger" title="{{ __('messages.delete') }}">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            @empty
                <div class="tcn-500">{{ __('messages.no_notifications_yet') }}</div>
            @endforelse
        </div>
    </div>
    @include('partials.bottom-navbar')

</section>
