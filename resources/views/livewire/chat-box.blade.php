<div>
    <ul class="message-box d-grid gap-3">
        @foreach($messages as $msg)
            <li class="{{ $msg->sender_id === auth()->id() ? 'receiver' : 'sender' }}">
                <div class="d-flex align-items-end gap-2 justify-content-{{ $msg->sender_id === auth()->id() ? 'end' : 'start' }}">
                    @if($msg->sender_id !== auth()->id())
                        <img src="{{ asset('path/to/user.png') }}" class="rounded-circle" width="32" height="32">
                    @endif

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

    <div class="message-send-area mt-3 d-flex gap-2">
        <input type="text" wire:model.defer="newMessage" class="form-control" placeholder="Type a message">
        <button wire:click="sendMessage" class="btn btn-primary">Send</button>
    </div>
</div>
