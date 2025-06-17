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
                        <div class="img-area">
                            <img class="w-100 h-100 rounded-circle" src="{{ asset('assets/img/user-thumb6.png') }}" alt="{{ $user->name }}" />
                        </div>
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
