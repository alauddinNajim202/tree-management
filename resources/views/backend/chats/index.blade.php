@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-comments text-success mr-2"></i> Live Chats</h4>
                <span class="badge badge-success">{{ $chats->count() }} Active</span>
            </div>
            <div class="card-body">
                @if($chats->isEmpty())
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-comment-slash fa-3x mb-3"></i>
                        <p>No active chats at the moment.</p>
                    </div>
                @else
                <div class="list-group">
                    @foreach($chats as $chat)
                    <a href="{{ route('admin.chats.show', $chat->id) }}" class="list-group-item list-group-item-action">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div style="width: 44px; height: 44px; background: linear-gradient(135deg, #2ecc71, #27ae60); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">
                                    <span style="color: white; font-size: 16px; font-weight: bold;">{{ strtoupper(substr($chat->user->name ?? 'U', 0, 1)) }}</span>
                                </div>
                                <div>
                                    <strong>{{ $chat->user->name ?? 'Unknown' }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $chat->lastMessage->message ?? 'No messages yet' }}</small>
                                </div>
                            </div>
                            <div class="text-right">
                                <small class="text-muted">{{ $chat->updated_at->diffForHumans() }}</small>
                                @php
                                    $unread = $chat->messages()->where('sender','user')->where('is_read', false)->count();
                                @endphp
                                @if($unread > 0)
                                    <br><span class="badge badge-danger">{{ $unread }} new</span>
                                @endif
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
// Auto-refresh chat list every 10 seconds
setInterval(function() { location.reload(); }, 10000);
</script>
@endsection
