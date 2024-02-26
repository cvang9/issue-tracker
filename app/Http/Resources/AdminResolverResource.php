<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResolverResource extends JsonResource
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
                    'user' => $this->user->name,
                    'department' => $this->department->name,
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
