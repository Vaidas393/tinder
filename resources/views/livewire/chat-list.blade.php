<section class="home-page position-relative pb-120 z-1 overflow-hidden">
    <span class="gradient-circle-3"></span>
    <span class="gradient-circle-4"></span>
    <div class="container px-3">
        <!-- header area  -->
        <div class="header-area mt-5 mb-4">
            <div class="d-between">
                <a href="javascript:void(0)" onclick="window.history.back()"><i class="bi bi-arrow-left text-gradient fs-xl fw-500"></i></a>
                <h3 class="tcn-800">Chat</h3>
                <div class="line-bar rounded bgp2-50 py-1 px-2">
                    <i class="bi bi-text-center fs-lg tcp-2-300"></i>
                </div>
            </div>
        </div>
        <!-- chat list -->
        <div class="chat-area mb-4">
            <div class="chat-lists d-grid gap-3">
                @foreach ($conversations as $conv)
                    @php
                        $user = $this->getOtherUser($conv);
                        $last = $conv->messages->sortByDesc('created_at')->first();
                        $unread = $this->unreadCount($conv);
                    @endphp
                    <a href="{{ route('chat.box', $conv->id) }}">
                        <div class="chat-list-item d-between {{ $unread ? 'active-story' : '' }}">
                            <div class="d-flex align-items-center gap-3">
                                <div class="user-info">
                                    <span class="d-block fw-bold fs-base tcn-700">{{ $user->name }}</span>
                                    <div class="d-flex align-items-center tcn-100">
                                        <span class="d-block fs-sm tcn-100 char-limit" data-set-char-limit="20">
                                            {{ $last?->sender_id === auth()->id() ? 'You: ' : '' }}{{ Str::limit($last?->body, 20) }}
                                        </span>
                                        <span class="d-block fs-sm tcn-100 ms-2">{{ optional($last)->created_at?->format('H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-activity">
                                @if ($unread)
                                    <i class="bi bi-circle text-primary"></i>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        @include('partials.bottom-navbar')
    </div>
</section>
