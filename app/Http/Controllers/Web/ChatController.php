<?php

namespace App\Http\Controllers\Web;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // Get or create a chat for the authenticated user
    public function getOrCreate()
    {
        $chat = Chat::firstOrCreate(
            ['user_id' => auth()->id(), 'status' => 'open']
        );

        $messages = $chat->messages()->orderBy('created_at')->get();

        return response()->json([
            'chat_id'  => $chat->id,
            'messages' => $messages->map(fn($m) => [
                'id'         => $m->id,
                'sender'     => $m->sender,
                'message'    => $m->message,
                'created_at' => $m->created_at->format('h:i A'),
            ]),
        ]);
    }

    // User sends a message
    public function send(Request $request)
    {
        $request->validate(['message' => 'required|string|max:1000']);

        $chat = Chat::firstOrCreate(
            ['user_id' => auth()->id(), 'status' => 'open']
        );

        $chatMessage = ChatMessage::create([
            'chat_id' => $chat->id,
            'sender'  => 'user',
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
}
