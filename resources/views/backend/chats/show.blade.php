@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <a href="{{ route('admin.chats.index') }}" class="btn btn-secondary btn-sm mr-3">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div style="width: 38px; height: 38px; background: linear-gradient(135deg, #2ecc71, #27ae60); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                        <span style="color: white; font-weight: bold;">{{ strtoupper(substr($chat->user->name, 0, 1)) }}</span>
                    </div>
                    <div>
                        <h6 class="mb-0">{{ $chat->user->name }}</h6>
                        <small class="text-muted">{{ $chat->user->email }}</small>
                    </div>
                </div>
                <form action="{{ route('admin.chats.close', $chat->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Close this chat?')">
                        <i class="fas fa-times"></i> Close Chat
                    </button>
                </form>
            </div>

            <div class="card-body p-0">
                <!-- Messages area -->
                <div id="admin-chat-messages" style="height: 430px; overflow-y: auto; padding: 20px; background: #f8fdf9; display: flex; flex-direction: column; gap: 10px;">
                    @foreach($chat->messages as $message)
                    @php $isAdmin = $message->sender === 'admin'; @endphp
                    <div style="display: flex; justify-content: {{ $isAdmin ? 'flex-end' : 'flex-start' }};">
                        <div style="max-width: 65%; background: {{ $isAdmin ? 'linear-gradient(135deg, #2ecc71, #27ae60)' : '#fff' }};
                            color: {{ $isAdmin ? 'white' : '#333' }}; padding: 10px 14px;
                            border-radius: {{ $isAdmin ? '16px 16px 4px 16px' : '16px 16px 16px 4px' }};
                            font-size: 13px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                            <div>{{ $message->message }}</div>
                            <div style="font-size: 10px; opacity: 0.7; margin-top: 4px; text-align: right;">
                                {{ $isAdmin ? 'You' : $chat->user->name }} &bull; {{ $message->created_at->format('h:i A') }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="card-footer" style="border-top: 1px solid #e9f5ec;">
                <div style="display: flex; gap: 10px; align-items: center;">
                    <input type="text" id="admin-chat-input" placeholder="Type a reply..." class="form-control" style="border-radius: 22px;"
                        onkeydown="if(event.key==='Enter') sendAdminReply()">
                    <button onclick="sendAdminReply()" class="btn btn-success" style="border-radius: 22px; padding: 8px 20px;">
                        <i class="fas fa-paper-plane"></i> Send
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var chatId = {{ $chat->id }};

    // Scroll to bottom on load
    var msgContainer = document.getElementById('admin-chat-messages');
    msgContainer.scrollTop = msgContainer.scrollHeight;

    // Listen for new messages via Reverb
    if (window.Echo) {
        window.Echo.private('chat.' + chatId).listen('MessageSent', function(e) {
            if (e.sender === 'user') {
                appendAdminMsg(e.sender, e.message, e.created_at, '{{ $chat->user->name }}');
            }
        });
    }

    function sendAdminReply() {
        var input = document.getElementById('admin-chat-input');
        var msg = input.value.trim();
        if (!msg) return;

        input.value = '';
        appendAdminMsg('admin', msg, 'Just now', 'You');

        $.ajax({
            url: '/admin/chats/' + chatId + '/reply',
            method: 'POST',
            data: { message: msg, _token: '{{ csrf_token() }}' },
        });
    }

    function appendAdminMsg(sender, message, time, name) {
        var isAdmin = sender === 'admin';
        var container = document.getElementById('admin-chat-messages');
        var div = document.createElement('div');
        div.style.cssText = 'display: flex; justify-content: ' + (isAdmin ? 'flex-end' : 'flex-start') + ';';
        div.innerHTML = '<div style="max-width: 65%; background: ' + (isAdmin ? 'linear-gradient(135deg, #2ecc71, #27ae60)' : '#fff') + '; ' +
            'color: ' + (isAdmin ? 'white' : '#333') + '; padding: 10px 14px; border-radius: ' +
            (isAdmin ? '16px 16px 4px 16px' : '16px 16px 16px 4px') + '; font-size: 13px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">' +
            '<div>' + escapeHtml(message) + '</div>' +
            '<div style="font-size:10px; opacity:0.7; margin-top:4px; text-align:right;">' + name + ' &bull; ' + time + '</div>' +
            '</div>';
        container.appendChild(div);
        container.scrollTop = container.scrollHeight;
    }

    function escapeHtml(text) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(text));
        return div.innerHTML;
    }
</script>
@endsection
