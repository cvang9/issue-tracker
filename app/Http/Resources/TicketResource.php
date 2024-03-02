<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                'type' => 'tickets',
                'ticket_id' => $this->id,
                'attributes' => [
                    'body' => $this->body,
                    'status' => $this->status,
                    'feedback' => $this->feedback ?? '',
                    'user' => new UserResource($this->user),
                    'department' => new DepartmentResource($this->department),
                    'created_at' => $this->created_at,
                ]
            ]
        ];
    }
}
