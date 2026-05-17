<?php

namespace App\Services;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class MenuSortService
{
    /**
     * Reorder menu items based on direction.
     */
    public static function reorder(Menu $menu, string $direction): void
    {
        $currentOrder = $menu->sort_order;
        $categoryId = $menu->menu_category_id;

        switch ($direction) {
            case 'up':
                // Find the item immediately above
                $previous = Menu::where('menu_category_id', $categoryId)
                    ->where('sort_order', '<', $currentOrder)
                    ->orderBy('sort_order', 'desc')
                    ->first();

                if ($previous) {
                    $menu->update(['sort_order' => $previous->sort_order]);
                    $previous->update(['sort_order' => $currentOrder]);
                }
                break;

            case 'down':
                // Find the item immediately below
                $next = Menu::where('menu_category_id', $categoryId)
                    ->where('sort_order', '>', $currentOrder)
                    ->orderBy('sort_order', 'asc')
                    ->first();

                if ($next) {
                    $menu->update(['sort_order' => $next->sort_order]);
                    $next->update(['sort_order' => $currentOrder]);
                }
                break;

            case 'top':
                // Shift all others down and set this one to 0
                Menu::where('menu_category_id', $categoryId)
                    ->where('id', '!=', $menu->id)
                    ->increment('sort_order');
                
                $menu->update(['sort_order' => 0]);
                break;

            case 'bottom':
                // Get the current max and place this one after it
                $maxOrder = Menu::where('menu_category_id', $categoryId)->max('sort_order');
                $menu->update(['sort_order' => $maxOrder + 1]);
                break;
        }
    }
}