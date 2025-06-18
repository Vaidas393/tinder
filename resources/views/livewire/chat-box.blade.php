<section class="home-page position-relative pb-120 z-1 overflow-hidden">
    <span class="gradient-circle-3"></span>
    <span class="gradient-circle-4"></span>
    <div class="container px-3">
        <!-- header area  -->
        <div class="header-area mt-5 mb-4">
            <div class="d-between">
                <div class="d-flex align-items-center gap-3">
                    <a href="javascript:void(0)" onclick="window.history.back()"><i class="bi bi-arrow-left text-gradient fs-xl fw-500"></i></a>
                    <div class="msg-sender-profile d-flex align-items-center gap-2">
                        <span class="tcn-700">{{ $conversation->userOne->id === auth()->id() ? $conversation->userTwo->username : $conversation->userOne->username }}</span>
                    </div>
                </div>
                <div class="msg-top-btn d-flex align-items-center gap-3">
                    <a href="#" class="icon-color">
                        <i class="bi bi-telephone-outbound icon-color"></i>
                    </a>
                    <a href="#" class="icon-color">
                        <i class="bi bi-camera-video icon-color"></i>
                    </a>
                    <div class="more-btn icon-color">
                        <i class="bi bi-grid-3x3-gap-fill icon-color"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- message area output -->
        <div class="message-area" style="padding-bottom: 90px;">
            <div class="message-content">
                <ul class="message-box d-grid gap-3"
                    wire:key="chat-messages"
                    x-data="{
                        shouldScroll: false,
                        scrollToBottom() { let box = $el; if (box) box.scrollTop = box.scrollHeight; }
                    }"
                    x-effect="if (shouldScroll) { scrollToBottom(); shouldScroll = false; }"
                    x-ref="msgBox" style="max-height: 60vh; overflow-y: auto;">
                    @foreach($messages as $msg)
                        <li class="{{ $msg->sender_id === auth()->id() ? 'receiver' : 'sender' }}">
                            <div class="d-flex align-items-end gap-2 justify-content-{{ $msg->sender_id === auth()->id() ? 'end' : 'start' }}">
                                <div class="msg-text">
                                    @if($editingMessageId === $msg->id)
                                        <input type="text" wire:model.defer="editingMessageText" class="form-control">
                                        <button wire:click="updateMessage">Save</button>
                                        <button wire:click="cancelEditing">Cancel</button>
                                    @else
                                        <span>{{ $msg->body }}</span>
                                        @if($msg->is_edited)
                                            <small class="text-muted">(edited)</small>
                                        @endif
                                    @endif
                                </div>
                                @if($msg->sender_id === auth()->id() && !$editingMessageId)
                                    <div>
                                        <button wire:click="startEditing({{ $msg->id }})">✏️</button>
                                        <button wire:click="deleteMessage({{ $msg->id }})">🗑️</button>
                                    </div>
                                @endif
                                @if($msg->sender_id === auth()->id())
                                    <div class="msg-process">
                                        @if($msg->read)
                                            <i class="bi bi-check2-all text-success"></i>
                                        @else
                                            <i class="bi bi-check"></i>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- message send area  -->
        <div class="message-send-area position-fixed bottom-0 start-50 translate-middle-x z-1 px-3 w-100 mb-3">
            <div class="d-flex align-items-center gap-3 w-100">
                <div class="msg-button-area px-sm-5 p-3 d-flex align-items-center gap-2 w-100">
                    <div class="emoji-btn">
                        <i class="bi bi-emoji-smile icon-color"></i>
                    </div>
                    <div class="input-area w-100">
                        <input type="text" wire:model.defer="newMessage" class="input-msg-text form-control" placeholder="Type a message" @keydown.enter="$wire.sendMessage()">
                    </div>
                    <div class="link-btn">
                        <i class="bi bi-link-45deg icon-color"></i>
                        <input type="file" class="input-msg-file" hidden>
                    </div>
                    <div class="upload-btn">
                        <i class="bi bi-camera icon-color"></i>
                    </div>
                </div>
                <button class="msg-send-btn gradient-btn" wire:click="sendMessage"><i class="bi bi-send"></i></button>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('livewire:update', function(e) {
        const ul = document.querySelector('[wire\:key="chat-messages"]');
        if (ul && e.target.__livewire && e.target.__livewire.get('shouldScroll')) {
            ul.scrollTop = ul.scrollHeight;
            e.target.__livewire.set('shouldScroll', false);
        }
    });
</script>
