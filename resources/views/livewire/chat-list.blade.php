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
        <!-- active member  -->
        <div class="active-member-area mb-3">
            <div class="active-member-list w-100 overflow-x-scroll d-flex align-items-center gap-2">
                @foreach($conversations as $userId => $chats)
                    @php 
                        $firstChat = reset($chats);
                        $user = $firstChat->sender_id == auth()->id() ? $firstChat->receiver : $firstChat->sender; 
                        $avatar = $user->profile_photo_url ?? $user->photo1 ?? null;
                        if ($avatar && !str_starts_with($avatar, 'http')) {
                            $avatar = asset('storage/' . $avatar);
                        }
                    @endphp
                    <a href="{{ route('chat.box', $user->id) }}">
                        <div class="active-user">
                            <div class="img-area position-relative">
                                <img class="w-100 h-100" src="{{ $avatar ?? 'assets/img/user-thumb4.png' }}" alt="user">
                                <div class="active"></div>
                            </div>
                            <span class="d-block fs-xs tcn-300 mt-1  text-center">{{ $user->name }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <!-- chat list -->
        <div class="chat-area mb-4">
            <div class="chat-lists d-grid gap-3">
                @foreach($conversations as $userId => $chats)
                    @php
                        $firstChat = reset($chats);
                        $lastMessage = end($chats);
                        $user = $firstChat->sender_id == auth()->id() ? $firstChat->receiver : $firstChat->sender;
                        $unreadCount = collect($chats)->where('receiver_id', auth()->id())->whereNull('read_at')->count();
                        $avatar = $user->profile_photo_url ?? $user->photo1 ?? null;
                        if ($avatar && !str_starts_with($avatar, 'http')) {
                            $avatar = asset('storage/' . $avatar);
                        }
                    @endphp
                    <div class="position-relative">
                        <a href="{{ route('chat.box', $user->id) }}">
                            <div class="chat-list-item d-between">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="img-area position-relative">
                                        <img class="w-100 h-100" src="{{ $avatar ?? 'assets/img/user-thumb5.png' }}" alt="user">
                                        @if($unreadCount > 0)
                                            <span class="badge bg-danger position-absolute top-0 end-0 translate-middle p-1 rounded-circle" style="font-size:10px;">{{ $unreadCount }}</span>
                                        @endif
                                    </div>
                                    <div class="user-info">
                                        <span class="d-block fw-bold fs-base tcn-700">{{ $user->name }}</span>
                                        <div class="d-flex align-items-center tcn-100">
                                            <span class="d-block fs-sm tcn-100 char-limit" data-set-char-limit="20">
                                                {{ $lastMessage->sender_id == auth()->id() ? 'You: ' : '' }}{{ \Illuminate\Support\Str::limit($lastMessage->message, 20) }}
                                            </span>
                                            <span class="d-block fs-sm tcn-100">{{ $lastMessage->created_at->format('g:i A') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-activity">
                                    @if(is_null($lastMessage->read_at) && $lastMessage->receiver_id == auth()->id())
                                        <i class="bi bi-circle"></i>
                                    @elseif($lastMessage->read_at)
                                        <i class="bi bi-check-circle"></i>
                                    @endif
                                </div>
                            </div>
                        </a>
                        <button type="button" class="btn btn-link text-danger position-absolute top-0 end-0" style="z-index:2;"
                            wire:click="deleteConversation({{ $user->id }})"
                            onclick="event.stopPropagation(); if(!confirm('Delete this conversation?')){event.preventDefault();}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('partials.bottom-navbar')
</section>