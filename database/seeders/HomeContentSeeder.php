<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use App\Models\HomeServiceCard;
use Illuminate\Database\Seeder;

/**
 * Seeds the homepage hero slider and service cards with the same content
 * that used to be hardcoded in resources/views/components/sections/hero.blade.php,
 * so switching that component over to the database doesn't change what
 * visitors see until an admin edits it from /admin/home.
 */
class HomeContentSeeder extends Seeder
{
    public function run(): void
    {
        if (HeroSlide::count() === 0) {
            HeroSlide::create([
                'image_path' => 'https://picsum.photos/id/180/1200/600',
                'eyebrow' => 'Mobile Experience',
                'heading' => 'Download our Mobile App',
                'subheading' => 'Get the best job alerts and business services on the go.',
                'button_text' => 'Get it on Google Play',
                'button_url' => route('app.open'),
                'sort_order' => 0,
                'is_active' => true,
            ]);
        }

        if (HomeServiceCard::count() === 0) {
            $cards = [
                [
                    'eyebrow' => 'Looking for?',
                    'title' => 'Interior Design',
                    'bg_class' => 'bg-slate-900',
                    'button_text' => 'Get Best Quotes',
                    'button_url' => null,
                    'sort_order' => 0,
                ],
                [
                    'title' => 'B2B',
                    'subtitle' => 'Quick Quotes',
                    'bg_class' => 'bg-blue-600',
                    'button_text' => 'Explore ›',
                    'button_url' => route('services.show', ['category' => 'b2b']),
                    'sort_order' => 1,
                ],
                [
                    'title' => 'Repairs & Services',
                    'subtitle' => 'Get Nearest Vendor',
                    'bg_class' => 'bg-blue-600',
                    'button_text' => 'Explore ›',
                    'button_url' => route('services.show', ['category' => 'repair']),
                    'sort_order' => 2,
                ],
                [
                    'title' => 'Real Estate',
                    'subtitle' => 'Finest Agents',
                    'bg_class' => 'bg-blue-600',
                    'button_text' => 'Explore ›',
                    'button_url' => route('services.show', ['category' => 'real-estate']),
                    'sort_order' => 3,
                ],
            ];

            foreach ($cards as $card) {
                HomeServiceCard::create(array_merge($card, ['is_active' => true]));
            }
        }
    }
}
