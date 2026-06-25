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
        $controller = $this->whenLoaded('matterController');
        // $menus = $this->whenLoaded('cityMenuMatter')
        //     ->pluck('cityMenu.menu.title', 'cityMenu.menu_id');
        // Output: [1 => "Electronics", 2 => "Fashion"]

        // $menus = $this->whenLoaded('cityMenuMatter')->map(function ($cityMenuMatter) {
        //     return [
        //         // 'city_id' => $cityMenuMatter->cityMenu->city_id ?? null,
        //         'menu_id' => $cityMenuMatter->cityMenu->menu_id ?? null,
        //         // 'city' => $cityMenuMatter->cityMenu->city->name ?? 'N/A',
        //         'menu' => $cityMenuMatter->cityMenu->menu->title ?? 'N/A',
        //     ];
        // });

        $menus = [];
        foreach ($this->whenLoaded('cityMenuMatter') as $item) {
            $menus[] = [
                'menu_id' => $item->cityMenu->menu_id ?? null,
                'menu' => $item->cityMenu->menu->title ?? 'N/A',
            ];
        }

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'type' => $this->type,
            'payload' => $this->payload, // Accessor in Model handles asset() URL
            'status' => $controller ? $controller->status : 'Pending', // Default to 'Pending' if no controller or status

            // Financial Details (from Flutter implementation)
            'pricing' => [
                'base_amount' => $this->base_amount,
                'gst_amount' => $this->gst_amount,
                'total_amount' => $this->total_amount,
            ],
            'menus' => $menus,
            "details" => $this->whenLoaded('matterDetails'),

            'controller' => $controller,
            // 'cityMenuMatter' =>  $this->whenLoaded('cityMenuMatter') ?? "No city menu association",

            'created_at' => $this->created_at ? $this->created_at->format('d M Y') : null,
        ];
    }
}