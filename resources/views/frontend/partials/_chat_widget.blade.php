@auth
<div id="chat-widget" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; font-family: inherit;">
    <!-- Chat Bubble Button -->
    <button id="chat-toggle-btn" onclick="toggleChat()" style="
        width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #2ecc71, #27ae60);
        border: none; cursor: pointer; box-shadow: 0 4px 15px rgba(46,204,113,0.4);
        display: flex; align-items: center; justify-content: center; margin-left: auto;
        transition: transform 0.2s;
    " title="Chat with us">
        <i class="fa fa-comments" style="color: white; font-size: 24px;"></i>
        <span id="chat-unread-badge" style="
            position: absolute; top: 0; right: 0; background: #e74c3c; color: white;
            border-radius: 50%; width: 20px; height: 20px; font-size: 11px;
            display: none; align-items: center; justify-content: center;
        ">0</span>
    </button>

    <!-- Chat Window -->
    <div id="chat-window" style="
        display: none; width: 340px; height: 460px; background: white;
        border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        flex-direction: column; overflow: hidden; margin-bottom: 10px;
    ">
        <!-- Header -->
        <div style="background: linear-gradient(135deg, #2ecc71, #27ae60); padding: 14px 18px; display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 38px; height: 38px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fa fa-headset" style="color: white; font-size: 16px;"></i>
                </div>
                <div>
                    <div style="color: white; font-weight: 700; font-size: 14px;">TreeWorld Support</div>
                    <div style="color: rgba(255,255,255,0.8); font-size: 11px;">
                        <span style="width: 7px; height: 7px; background: #a8f0c8; border-radius: 50%; display: inline-block; margin-right: 4px;"></span>
                        Online
                    </div>
                </div>
            </div>
            <button onclick="toggleChat()" style="background: none; border: none; color: white; cursor: pointer; font-size: 18px; line-height: 1;">&times;</button>
        </div>

        <!-- Messages Area -->
        <div id="chat-messages" style="flex: 1; overflow-y: auto; padding: 14px; background: #f8fdf9; display: flex; flex-direction: column; gap: 10px;">
            <div style="text-align: center; color: #999; font-size: 12px; padding: 8px;">
                Hi {{ auth()->user()->name }}! 👋 How can we help you today?
            </div>
        </div>

        <!-- Input Area -->
        <div style="padding: 12px; border-top: 1px solid #e9f5ec; background: white; display: flex; gap: 8px; align-items: center;">
            <input type="text" id="chat-input" placeholder="Type a message..." style="
                flex: 1; border: 1px solid #ddd; border-radius: 22px; padding: 9px 16px;
                font-size: 13px; outline: none; transition: border-color 0.2s;
            " onkeydown="if(event.key==='Enter') sendChatMessage()">
            <button onclick="sendChatMessage()" style="
                width: 40px; height: 40px; background: linear-gradient(135deg, #2ecc71, #27ae60);
                border: none; border-radius: 50%; cursor: pointer; display: flex;
                align-items: center; justify-content: center; flex-shrink: 0;
            ">
                <i class="fa fa-paper-plane" style="color: white; font-size: 14px;"></i>
            </button>
        </div>
    </div>
</div>

<script>
    var chatId = null;
    var chatEcho = null;
    var chatOpen = false;

    function toggleChat() {
        chatOpen = !chatOpen;
        var win = document.getElementById('chat-window');
        win.style.display = chatOpen ? 'flex' : 'none';
        if (chatOpen && chatId === null) {
            initChat();
        }
    }

    function initChat() {
        $.get('{{ route('chat.init') }}', function(data) {
            chatId = data.chat_id;
            // Render existing messages
            if (data.messages && data.messages.length > 0) {
                data.messages.forEach(function(msg) {
                    appendMessage(msg.sender, msg.message, msg.created_at);
                });
            }
            // Subscribe to Reverb channel
            subscribeChannel();
        });
    }

    function subscribeChannel() {
        if (window.Echo && chatId) {
            chatEcho = window.Echo.private('chat.' + chatId)
                .listen('MessageSent', function(e) {
                    if (e.sender === 'admin') {
                        appendMessage('admin', e.message, e.created_at);
                        if (!chatOpen) {
                            var badge = document.getElementById('chat-unread-badge');
                            badge.style.display = 'flex';
                            badge.textContent = parseInt(badge.textContent || '0') + 1;
                        }
                    }
                });
        }
    }

    function sendChatMessage() {
        var input = document.getElementById('chat-input');
        var msg = input.value.trim();
        if (!msg) return;

        input.value = '';
        appendMessage('user', msg, 'Just now');

        $.ajax({
            url: '{{ route('chat.send') }}',
            method: 'POST',
            data: { message: msg, _token: '{{ csrf_token() }}' },
        });
    }

    function appendMessage(sender, message, time) {
        var container = document.getElementById('chat-messages');
        var isUser = sender === 'user';
        var div = document.createElement('div');
        div.style.cssText = 'display: flex; justify-content: ' + (isUser ? 'flex-end' : 'flex-start') + ';';
        div.innerHTML = '<div style="max-width: 75%; background: ' + (isUser ? 'linear-gradient(135deg, #2ecc71, #27ae60)' : '#fff') + '; ' +
            'color: ' + (isUser ? 'white' : '#333') + '; padding: 9px 13px; border-radius: ' +
            (isUser ? '16px 16px 4px 16px' : '16px 16px 16px 4px') + '; font-size: 13px; ' +
            'box-shadow: 0 2px 8px rgba(0,0,0,0.08);">' +
            '<div>' + escapeHtml(message) + '</div>' +
            '<div style="font-size: 10px; opacity: 0.7; margin-top: 4px; text-align: right;">' + time + '</div>' +
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
@endauth
