<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            ['name' => 'Mumbai', 'state_code' => 'MH', 'country_code' => 'IN', 'is_active' => true],
            ['name' => 'Delhi', 'state_code' => 'DL', 'country_code' => 'IN', 'is_active' => true],
            ['name' => 'Bengaluru', 'state_code' => 'KA', 'country_code' => 'IN', 'is_active' => true],
            ['name' => 'Hyderabad', 'state_code' => 'TG', 'country_code' => 'IN', 'is_active' => true],
            ['name' => 'Ahmedabad', 'state_code' => 'GJ', 'country_code' => 'IN', 'is_active' => true],
            ['name' => 'Chennai', 'state_code' => 'TN', 'country_code' => 'IN', 'is_active' => true],
            ['name' => 'Kolkata', 'state_code' => 'WB', 'country_code' => 'IN', 'is_active' => true],
            ['name' => 'Pune', 'state_code' => 'MH', 'country_code' => 'IN', 'is_active' => true],
            ['name' => 'Jaipur', 'state_code' => 'RJ', 'country_code' => 'IN', 'is_active' => true],
            ['name' => 'Lucknow', 'state_code' => 'UP', 'country_code' => 'IN', 'is_active' => true],
            ['name' => 'Chandigarh', 'state_code' => 'CH', 'country_code' => 'IN', 'is_active' => false], // Testing inactive
        ];

        foreach ($cities as $city) {
            City::updateOrCreate(
                ['name' => $city['name']], // Prevents duplicate entries if you run it twice
                $city
            );
        }
    }
}