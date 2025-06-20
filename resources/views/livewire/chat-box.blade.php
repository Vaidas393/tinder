<div x-data>
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
                        <div class="img-area">
                            @php
                                $avatar = $user->photo1;
                                if ($avatar && !str_starts_with($avatar, 'http')) {
                                    $avatar = asset('storage/' . $avatar);
                                }
                            @endphp
                            @if($user->photo1)
                                <img class="w-100 h-100 h-100 rounded-circle" src="{{ $avatar }}" alt="user">
                            @else
                                <span class="tcn-700">{{ $user->username }}</span>
                            @endif
                        </div>
                        <span class="tcn-700">{{ $user->name ?? $user->username }}</span>
                    </div>
                </div>
                <div class="msg-top-btn d-flex align-items-center gap-3">
                    <a href="#" class="icon-color">
                        <i class="bi bi-telephone-outbound icon-color"></i>
                    </a>
                    <a href="#" class="icon-color" onclick="startVideoCall(event)">
                        <i class="bi bi-camera-video icon-color"></i>
                    </a>
                    <div class="more-btn icon-color">
                        <i class="bi bi-grid-3x3-gap-fill icon-color"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- message area output -->
        <div class="message-area">
            <div class="message-content ">
                <ul class="message-box d-grid gap-3">
                    @foreach($messages->reverse() as $msg)
                        @if($msg->sender_id == auth()->id())
                            <li class="sender d-flex align-items-end justify-content-start gap-1">
                                <div class="sender-thumb">
                                    @if(auth()->user()->photo1)
                                        @php
                                            $myAvatar = auth()->user()->photo1;
                                            if ($myAvatar && !str_starts_with($myAvatar, 'http')) {
                                                $myAvatar = asset('storage/' . $myAvatar);
                                            }
                                        @endphp
                                        <img class="w-100 rounded-circle" src="{{ $myAvatar }}" alt="sender">
                                    @else
                                        <span class="tcn-700">{{ auth()->user()->username }}</span>
                                    @endif
                                </div>
                                <div class="msg-text">
                                    <div class="single-msg">
                                        @if(isset($editingMessageId) && $editingMessageId === $msg->id)
                                            <div class="d-flex align-items-center">
                                                <input type="text" wire:model.defer="editingMessageText" wire:keydown.enter="updateMessage({{ $msg->id }})" class="form-control form-control-sm input-edit-msg-text" />
                                                <button type="button" wire:click="updateMessage({{ $msg->id }})" class="btn btn-sm btn-success ms-1">Save</button>
                                                <button type="button" wire:click="cancelEdit" class="btn btn-sm btn-secondary ms-1">Cancel</button>
                                            </div>
                                        @else
                                            <span class="d-block">{{ $msg->message }}</span>
                                            <button type="button" wire:click='startEdit({{ $msg->id }}, {!! json_encode($msg->message) !!})' class="btn btn-link btn-sm p-0 ms-2">Edit</button>
                                            <button type="button" wire:click="deleteMessage({{ $msg->id }})" class="btn btn-link btn-sm text-danger p-0 ms-1">Delete</button>
                                        @endif
                                    </div>
                                    <div class="msg-process mt-1">
                                        @if($msg->read_at)
                                            <i class="bi bi-check2-all text-primary"></i>
                                        @else
                                            <i class="bi bi-check2"></i>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @else
                            <li class="receiver">
                                <div class="receiver-msg d-flex align-items-end justify-content-end gap-1">
                                    <div class="msg-text">
                                        <div class="single-msg">
                                            <span class="d-block">{{ $msg->message }}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif
                        @if($loop->last)
                            <li class="time text-center fs-xs fw-500 "><span>{{ $msg->created_at->format('g:i A') }}</span></li>
                        @endif
                    @endforeach
                    @if($showTyping)
                        <li class="receiver">
                            <div class="receiver-msg d-flex align-items-end justify-content-end gap-1">
                                <div class="msg-text">
                                    <div class="single-msg">
                                        <span class="d-block"><em class="text-primary">Typing...</em> <span class="dot-flashing"></span></span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- message send area  -->
        <form wire:submit.prevent="sendMessage" class="message-send-area position-fixed bottom-0 start-50 translate-middle-x z-1 px-3 w-100 mb-3">
            <div class="d-flex align-items-center gap-3 w-100">
                <div class="msg-button-area px-sm-5 p-3 d-flex align-items-center gap-2 w-100">
                    <div class="emoji-btn position-relative">
                        <i class="bi bi-emoji-smile icon-color" onclick="toggleEmojiPicker(event)"></i>
                        <div id="emoji-picker-container" style="display:none; position:absolute; bottom:40px; left:0; z-index:1000;">
                            <emoji-picker></emoji-picker>
                        </div>
                    </div>
                    <div class="input-area w-100">
                        <input type="text" class="input-msg-text" placeholder="Type a message" wire:model.defer="newMessage" wire:keydown="typing">
                    </div>
                    <div class="link-btn">
                        <i class="bi bi-link-45deg icon-color"></i>
                        <input type="file" class="input-msg-file" hidden="">
                    </div>
                    <div class="upload-btn">
                        <i class="bi bi-camera icon-color"></i>
                    </div>
                </div>
                <button type="submit" class="msg-send-btn gradient-btn"><i class="bi bi-send"></i></button>
            </div>
        </form>
    </div>
</section>
<!-- Video Call Modal -->
<div id="video-call-modal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.8); z-index:9999; align-items:center; justify-content:center;">
    <div style="position:relative; width:90vw; max-width:500px; background:#222; border-radius:10px; padding:20px;">
        <video id="localVideo" autoplay muted style="width:100%; border-radius:10px;"></video>
        <video id="remoteVideo" autoplay style="width:100%; border-radius:10px; margin-top:10px;"></video>
        <button onclick="endVideoCall()" style="position:absolute; top:10px; right:10px; background:red; color:white; border:none; border-radius:50%; width:40px; height:40px;">X</button>
    </div>
</div>
<script>
function toggleEmojiPicker(e) {
    e.stopPropagation();
    const picker = document.getElementById('emoji-picker-container');
    picker.style.display = picker.style.display === 'none' ? 'block' : 'none';
}
document.addEventListener('DOMContentLoaded', function () {
    const picker = document.querySelector('emoji-picker');
    if (picker) {
        picker.addEventListener('emoji-click', function(event) {
            window.insertEmojiToInput(event.detail.unicode);
            document.getElementById('emoji-picker-container').style.display = 'none';
        });
    }
    document.addEventListener('click', function(e) {
        const picker = document.getElementById('emoji-picker-container');
        if (picker && !picker.contains(e.target) && e.target.className !== 'bi bi-emoji-smile icon-color') {
            picker.style.display = 'none';
        }
    });
});
function isScrolledToBottom() {
    var box = document.querySelector('.message-content');
    if (!box) return false;
    return box.scrollHeight - box.scrollTop - box.clientHeight < 10;
}
function tryMarkAsRead() {
    if (isScrolledToBottom()) {
        if (window.Livewire && window.Livewire.find) {
            window.Livewire.find('@this').call('markAllAsRead');
        }
    }
}
document.addEventListener('scroll-to-bottom', function () {
    setTimeout(function () {
        var box = document.querySelector('.message-content');
        if (box) box.scrollTop = box.scrollHeight;
        tryMarkAsRead();
    }, 100);
});
document.addEventListener('DOMContentLoaded', function () {
    const box = document.querySelector('.message-content');
    if (box) {
        box.addEventListener('scroll', function() {
            tryMarkAsRead();
        });
        // Always scroll to bottom on load
        box.scrollTop = box.scrollHeight;
        setTimeout(tryMarkAsRead, 300);
    }
    window.addEventListener('focus', function() {
        tryMarkAsRead();
    });
    tryMarkAsRead();

    // Livewire hook: scroll to bottom after DOM updates
    if (window.Livewire) {
        window.Livewire.hook('message.processed', (message, component) => {
            const box = document.querySelector('.message-content');
            if (box) {
                box.scrollTop = box.scrollHeight;
                setTimeout(tryMarkAsRead, 100);
            }
        });
    }
});
let localStream, remoteStream, peerConnection;
const servers = { iceServers: [{ urls: 'stun:stun.l.google.com:19302' }] };

function startVideoCall(e) {
    e.preventDefault();
    document.getElementById('video-call-modal').style.display = 'flex';
    startLocalStream();
    window.Livewire.find('@this').call('startVideoCall');
}

function endVideoCall() {
    document.getElementById('video-call-modal').style.display = 'none';
    if (peerConnection) peerConnection.close();
    if (localStream) localStream.getTracks().forEach(track => track.stop());
    document.getElementById('localVideo').srcObject = null;
    document.getElementById('remoteVideo').srcObject = null;
    window.Livewire.find('@this').call('endVideoCall');
}

async function startLocalStream() {
    localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
    document.getElementById('localVideo').srcObject = localStream;
    setupPeerConnection();
}

function setupPeerConnection() {
    peerConnection = new RTCPeerConnection(servers);
    localStream.getTracks().forEach(track => peerConnection.addTrack(track, localStream));
    peerConnection.ontrack = event => {
        document.getElementById('remoteVideo').srcObject = event.streams[0];
    };
    peerConnection.onicecandidate = event => {
        if (event.candidate) {
            window.Livewire.find('@this').call('sendIceCandidate', event.candidate);
        }
    };
}

window.addEventListener('video-offer', async e => {
    if (!peerConnection) setupPeerConnection();
    await peerConnection.setRemoteDescription(new RTCSessionDescription(e.detail.offer));
    const answer = await peerConnection.createAnswer();
    await peerConnection.setLocalDescription(answer);
    window.Livewire.find('@this').call('sendVideoAnswer', answer);
});

window.addEventListener('video-answer', async e => {
    await peerConnection.setRemoteDescription(new RTCSessionDescription(e.detail.answer));
});

window.addEventListener('video-ice', async e => {
    if (peerConnection) {
        await peerConnection.addIceCandidate(new RTCIceCandidate(e.detail.candidate));
    }
});
</script>
<style>
.dot-flashing {
  position: relative;
  width: 8px;
  height: 8px;
  border-radius: 5px;
  background-color: #0d6efd;
  color: #0d6efd;
  animation: dotFlashing 1s infinite linear alternate;
  margin-left: 4px;
}
@keyframes dotFlashing {
  0% { opacity: 1; }
  50%, 100% { opacity: 0.2; }
}
</style>
</div>
