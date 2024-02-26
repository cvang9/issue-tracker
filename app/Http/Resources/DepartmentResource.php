<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
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
                'type' => 'department',
                'department_id' => $this->id,
                'attributes' => [
                    'name' => $this->name,
                    'counts' => [
                        'issue' => $this->tickets()->count(),
                        'resolver' => $this->resolvers()->count(),
                        'resolved_tickets' => $this->tickets()->where('status', '=', 'resolved')->count(),
                        'unresolved_tickets' => $this->tickets()->where('status', '!=', 'resolved' )->count()
                    ]
                ]
            ]
                ];
    }
}
