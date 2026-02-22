<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            [
                'title' => 'Dashboard',
                'icon' => 'layout-dashboard',
                'status' => 'active',
                'type' => 'actual',
            ],
            [
                'title' => 'Special Summer Offer',
                'icon' => 'megaphone',
                'status' => 'active',
                'type' => 'ad',
            ],
            [
                'title' => 'Settings',
                'icon' => 'settings',
                'status' => 'inactive',
                'type' => 'actual',
            ],
            [
                'title' => 'Premium Upgrade',
                'icon' => 'star',
                'status' => 'active',
                'type' => 'ad',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
