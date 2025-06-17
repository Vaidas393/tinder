<section class="home-page position-relative pb-120 z-1 overflow-hidden">
    <span class="gradient-circle-3"></span>
    <span class="gradient-circle-4"></span>

    <div class="container px-3">
        <!-- header area -->
        <div class="header-area mt-5 mb-4">
            <div class="d-between">
                <a href="javascript:void(0)" onclick="window.history.back()">
                    <i class="bi bi-arrow-left text-gradient fs-xl fw-500"></i>
                </a>
                <h3 class="tcn-800">Notification</h3>
                <div class="line-bar rounded bgp2-50 py-1 px-2">
                    <i class="bi bi-text-center fs-lg tcp-2-300"></i>
                </div>
            </div>
        </div>

        <!-- all notifications -->
        <div class="notification-list d-grid gap-3">
            @forelse($notifications as $notif)
                <div class="notification-item p-3 rounded bg-light d-flex justify-content-between align-items-center">
                    <div>
                        <span class="fw-bold tcn-700">{{ $notif->fromUser->username ?? 'Unknown user' }}</span>
                        <span class="ms-2 tcn-500">
                            @switch($notif->type)
                                @case('like') liked you. @break
                                @case('dislike') disliked you. @break
                                @case('match') you have a match! @break
                                @default did something.
                            @endswitch
                        </span>
                    </div>

                    <button wire:click="deleteNotification({{ $notif->id }})" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            @empty
                <div class="tcn-500">You don’t have any notifications yet.</div>
            @endforelse
        </div>
    </div>
</section>
