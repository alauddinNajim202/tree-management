<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Chat private channel - users can listen to their own chat, admins can listen to any chat
Broadcast::channel('chat.{chatId}', function ($user, $chatId) {
    // Admin can listen to all chats
    if ($user->is_admin ?? false) {
        return true;
    }
    // User can only listen to their own chat
    return \App\Models\Chat::where('id', $chatId)->where('user_id', $user->id)->exists();
});
