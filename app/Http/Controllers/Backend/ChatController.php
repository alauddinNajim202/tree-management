<?php

namespace App\Http\Controllers\Backend;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::with(['user', 'lastMessage'])
            ->where('status', 'open')
            ->latest()
            ->get();

        return view('backend.chats.index', compact('chats'));
    }

    public function show($id)
    {
        $chat = Chat::with(['user', 'messages'])->findOrFail($id);
        // Mark all user messages as read
        $chat->messages()->where('sender', 'user')->update(['is_read' => true]);
        return view('backend.chats.show', compact('chat'));
    }

    public function reply(Request $request, $chatId)
    {
        $request->validate(['message' => 'required|string|max:1000']);

        $chat = Chat::findOrFail($chatId);

        $chatMessage = ChatMessage::create([
            'chat_id' => $chat->id,
            'sender'  => 'admin',
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($chatMessage))->toOthers();

        return response()->json([
            'id'         => $chatMessage->id,
            'sender'     => $chatMessage->sender,
            'message'    => $chatMessage->message,
            'created_at' => $chatMessage->created_at->format('h:i A'),
        ]);
    }

    public function close($id)
    {
        $chat = Chat::findOrFail($id);
        $chat->update(['status' => 'closed']);

        return redirect()->route('admin.chats.index')->with('success', 'Chat closed successfully.');
    }

    public function messages($chatId)
    {
        $chat = Chat::findOrFail($chatId);
        $messages = $chat->messages()->orderBy('created_at')->get();
        return response()->json($messages->map(fn($m) => [
            'id'         => $m->id,
            'sender'     => $m->sender,
            'message'    => $m->message,
            'created_at' => $m->created_at->format('h:i A'),
        ]));
    }
}
