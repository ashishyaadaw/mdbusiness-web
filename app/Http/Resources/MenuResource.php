<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            'description' => $this->desc,
            'menu_category_id' => $this->menu_category_id,
             'category' => new MenuCategoryResource($this->whenLoaded('category')),
            'icon' => $this->icon,
            'status' => $this->flag ? $this->flag->menus : true,
            'type' => $this->type,
            // 'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}