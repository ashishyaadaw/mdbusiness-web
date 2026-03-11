<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'payload' => $this->payload,
            'type' => $this->type,
            // 'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
