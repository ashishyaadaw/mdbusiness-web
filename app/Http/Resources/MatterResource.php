<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {   
        // In your model, status isn't in $fillable, but if it exists in DB:
        // Using a default of 'Pending' if status is null
        $statusText = match($this->status) {
            1 => 'Active',
            0 => 'Inactive',
            default => 'Pending Review',
        };

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'type' => $this->type,
            'payload' => $this->payload, // Accessor in Model handles asset() URL
            'status' => $statusText,
            
            // Financial Details (from Flutter implementation)
            'pricing' => [
                'base_amount' => $this->base_amount,
                'gst_amount' => $this->gst_amount,
                'total_amount' => $this->total_amount,
            ],

            'controller' => $this->whenLoaded('matterController'),
            
            'created_at' => $this->created_at ? $this->created_at->format('d M Y') : null,
        ];
    }
}   