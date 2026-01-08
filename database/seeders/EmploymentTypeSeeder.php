<?php

namespace Database\Seeders;

use App\Models\EmploymentType;
use Illuminate\Database\Seeder;

class EmploymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $religions = [
            'Private Sector',
            'Government / PSU',
            'Business',
            'Self Employed',
            'Defence',
            'Not Employed',
            'Other',
        ];

        foreach ($religions as $religion) {
            // firstOrCreate ensures we don't create duplicates if run multiple times
            EmploymentType::firstOrCreate(['name' => $religion]);
        }
    }
}
