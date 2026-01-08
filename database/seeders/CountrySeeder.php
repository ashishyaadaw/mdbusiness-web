<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            ['name' => 'India', 'code' => 'IN', 'phone' => '+91'],
            ['name' => 'United States', 'code' => 'US', 'phone' => '+1'],
            ['name' => 'United Kingdom', 'code' => 'UK', 'phone' => '+44'],
            ['name' => 'Canada', 'code' => 'CA', 'phone' => '+1'],
            ['name' => 'Australia', 'code' => 'AU', 'phone' => '+61'],
            ['name' => 'United Arab Emirates', 'code' => 'AE', 'phone' => '+971'],
        ];

        foreach ($countries as $countryData) {
            Country::firstOrCreate(
                ['iso_code' => $countryData['code']],
                ['name' => $countryData['name'], 'phone_code' => $countryData['phone']]
            );
        }
    }
}
