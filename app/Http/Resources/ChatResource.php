<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                    'chat_id' => $this->id,
                    'message' => $this->message,
                    'user_id' => $this->user->id,
                    'friend_id' => $this->friend_id,
                    'role' => $this->role 

                ];
    }
}
