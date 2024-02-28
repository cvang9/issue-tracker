<?php

namespace App\Http\Controllers;

// use App\Events\FreshEvent;
// use App\Events\SendMessage;

use App\Events\SendMessage;
use App\Http\Resources\ChatResourceCollection;
use App\Jobs\SendChatSessionNotification;
use App\Models\Message;
use App\Models\Resolver;
use App\Models\User;

// use Illuminate\Http\Request;

class ChatController extends Controller
{
    
    public function index( $hash )
    {
        $chats = Message::where('hash', '=', $hash )->get();
                       
        return new ChatResourceCollection($chats);
    }

    public function store()
    {
        $user = User::findOrFail(request('user_id'));

        // dd($user);

        $message = $user->messages()->create([
            'message' => request('message'),
            'friend_id' => request('friend_id'),
            'role' =>  request('role'),
            'hash' => request('hash')
        ]);

        broadcast(new SendMessage($user, $message))->toOthers();

        // broadcast( new FreshEvent() )->toOthers();

        return response(['status' => 'Message Sent!'], 200);
    }

    public function notifyUser( $resolver_id, $user_id )
    {
        request()->validate([
            'timestamp' => 'required'
        ]);

        $user = User::findOrFail($user_id);

        $resolver_user = Resolver::findOrFail($resolver_id)->user->id;

        SendChatSessionNotification::dispatch($user, request('timestamp'), $resolver_user);
        
        return response(['status' => 'Notification Sent!'], 200);   
    }
}
