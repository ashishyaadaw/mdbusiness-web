<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $religions = [
            'Hindu',
            'Muslim - Shia',
            'Muslim - Sunni',
            'Muslim - Other',
            'Christian',
            'Sikh',
            'Jain - Digambar',
            'Jain - Shwetambar',
            'Jain - Other',
            'Parsi',
            'Buddhist',
            'Jewish',
            'Inter - Religion',
        ];

        foreach ($religions as $religion) {
            // firstOrCreate ensures we don't create duplicates if run multiple times
            Religion::firstOrCreate(['name' => $religion]);
        }
    }
}
