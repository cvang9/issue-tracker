<?php

namespace App\Http\Controllers;

// use App\Events\FreshEvent;
// use App\Events\SendMessage;

use App\Events\SendMessage;
use App\Http\Resources\ChatResourceCollection;
use App\Models\Message;
use App\Models\User;

// use Illuminate\Http\Request;

class ChatController extends Controller
{
    
    public function index( $user_id, $friend_id )
    {
        $chats = Message::where('user_id', '=', (int)$user_id )
                       ->where('friend_id', '=', (int)$friend_id )
                       ->get();
                       
        return new ChatResourceCollection($chats);
    }

    public function store()
    {
        $user = User::findOrFail(request('user_id'));

        // dd($user);

        $message = $user->messages()->create([
            'message' => request('message'),
            'friend_id' => request('friend_id'),
            'role' =>  request('role')
        ]);

        broadcast(new SendMessage($user, $message))->toOthers();

        // broadcast( new FreshEvent() )->toOthers();

        return response(['status' => 'Message Sent!'], 200);
    }
}
