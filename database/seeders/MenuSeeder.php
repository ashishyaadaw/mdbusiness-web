<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menu_categories = [
            ['name' => 'Dashboard'],
            ['name' => 'Teachers Jobs'],
            ['name' => 'Office Staffs Jobs'],
            ['name' => 'Managers Jobs'],
            ['name' => 'Drivers Jobs'],
            ['name' => 'Security Guards Jobs'],
            ['name' => 'Housekeeping Jobs'],
            ['name' => 'Cooks Jobs'],
            ['name' => 'Nurses Jobs'],
            ['name' => 'Caregivers Jobs'],
        ];
        foreach ($menu_categories as $category) {
            MenuCategory::updateOrCreate(
                ['name' => $category['name']], // Prevents duplicate entries if you run it twice
                $category
            );
        }

        $menus = [
            [
                'title' => 'Dashboard',
                'menu_category_id' => MenuCategory::where('name', 'Dashboard')->first()->id,
                'icon' => 'layout-dashboard',
                'type' => 'actual',
            ],
            [
                'title' => 'Special Summer Offer',
                'menu_category_id' => MenuCategory::where('name', 'Teachers Jobs')->first()->id,
                'icon' => 'megaphone',
                'type' => 'ad',
            ],
            [
                'title' => 'Settings',
                'menu_category_id' => MenuCategory::where('name', 'Office Staffs Jobs')->first()->id,
                'icon' => 'settings',
                'type' => 'actual',
            ],
            [
                'title' => 'Premium Upgrade',
                'menu_category_id' => MenuCategory::where('name', 'Drivers Jobs')->first()->id,
                'icon' => 'star',
                'type' => 'ad',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
