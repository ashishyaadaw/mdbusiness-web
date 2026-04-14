<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuCategoryResource extends JsonResource
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
            'title' => $this->name,
            'description' => $this->desc,
            'icon' => $this->icon,
            // 'status' => $this->flag ? $this->flag->menu_category : null, // Assuming 'menu_category' is the boolean field in the flags table
            'status' => $this->flag ? $this->flag->menu_category : false, 
        ];
    }
}