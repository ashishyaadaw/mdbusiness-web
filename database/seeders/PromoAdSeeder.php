<?php

namespace Database\Seeders;

use App\Models\PromoAd;
use Illuminate\Database\Seeder;

class PromoAdSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Slider Ad (Multiple Images)
        PromoAd::create([
            'ad_id' => 'home_top_slider',
            'type' => 'slider',
            'images' => [
                'https://picsum.photos/id/10/800/400',
                'https://picsum.photos/id/20/800/400',
                'https://picsum.photos/id/30/800/400',
            ],
            'target_url' => 'https://example.com/promo',
            'is_active' => true,
        ]);

        // 2. Banner Ad (Simple bar)
        PromoAd::create([
            'ad_id' => 'cart_bottom_banner',
            'type' => 'banner',
            'title' => 'Flash Sale! ⚡',
            'body' => 'Use code FLASH20 for extra 20% off.',
            'target_url' => 'https://example.com/flash-sale',
            'is_active' => true,
        ]);

        // 3. Native Ad (Full Card)
        PromoAd::create([
            'ad_id' => 'feed_native_1',
            'type' => 'native',
            'title' => 'New Adventure Gear',
            'body' => 'Explore our latest collection of durable hiking boots and backpacks.',
            'images' => ['https://picsum.photos/id/43/600/300'],
            'action_text' => 'Shop Now',
            'target_url' => 'https://example.com/gear',
            'is_active' => true,
        ]);

        // 4. Video Ad (Placeholder)
        PromoAd::create([
            'ad_id' => 'profile_video_ad',
            'type' => 'video',
            'title' => 'Watch the Reveal',
            'target_url' => 'https://www.w3schools.com/html/mov_bbb.mp4',
            'is_active' => true,
        ]);
    }
}
