<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResolverResource extends JsonResource
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
                'type' => 'resolvers',
                'resolver_id' => $this->id,
                'attributes' => [
                    'user' => new UserResource($this->user),
                    'department' => new DepartmentResource($this->department),
                    'resolved_tickets' => new TicketResourceCollection($this->tickets),
                    'counts' => [
                        'resolved_tickets' => $this->tickets()->where('status', '=', 'resolved' )->count(),
                        'rejected_tickets' =>  $this->tickets()->where('status', '=', 'rejected' )->count(),
                        'processing_tickets' =>  $this->tickets()->where('status', '=', 'processing' )->count()
                    ]
                ]
            ]
        ];
    }
}
