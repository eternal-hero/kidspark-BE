<?php

namespace App\Http\Controllers\Supporter;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $supporter_user_id = Auth::id();
        $chats = ChatRoom::with(['chat','guardianUser:id,first_name,last_name'])
            ->where('supporter_user_id',$supporter_user_id)
            ->where('message_type', $request->message_type)
            ->get();
        return response()->ok($chats);
    }
    
    public function search(Request $request, $chat_room_id)
    {
        $chats = ChatRoom::with(['chat','guardianUser:id,first_name,last_name','supporterUser:id,first_name,last_name'])
            ->where('id', $chat_room_id)
            ->where('message_type', $request->message_type)
            ->first();
        foreach($chats['chat'] as $value) {
            if($value['sender'] == 1) {
                $value['is_read'] = 1;
            }
        }
        $chats->save();
        return response()->ok($chats);
    }

    public function store(Request $request, $chat_room_id)
    {
        $chat = [
            'chat_room_id' => $chat_room_id,
            'sender' => 0,
            'body' => $request->body,
            'is_read' => 0,
            'file_path' => $request->file_path ? $request->file_path : null,
        ];
        Chat::create($chat);
        return response()->ok();
    }
}
