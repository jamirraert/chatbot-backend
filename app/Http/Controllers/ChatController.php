<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Events\MessageSent;
use App\Events\UserTyping;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function message(Request $request) {
         $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $chat = Chat::create([
            'message' => $validated['message'],
        ]);

        event(new MessageSent($chat));

         return response()->json([
            'status' => 'Message broadcasted!',
            'data' => $chat,
        ], 201);
    }

    public function typing(Request $request)
    {
        Log::info($request->input('username'));
        event(new UserTyping($request->input('username')));
        return response()->noContent();
    }
}
