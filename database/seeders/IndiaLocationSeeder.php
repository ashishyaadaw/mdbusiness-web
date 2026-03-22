<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndiaLocationSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Country
        $countryId = DB::table('countries')->insertGetId([
            'name' => 'India',
            'iso_code' => 'IND',
            'created_at' => now(),
        ]);

        // 2. Define Hierarchy
        $locations = [
            'Maharashtra' => [
                'code' => 'MH',
                'cities' => [
                    'Mumbai' => [
                        ['office' => 'Mumbai GPO', 'pin' => '400001'],
                        ['office' => 'Colaba PO', 'pin' => '400005']
                    ],
                    'Pune' => [
                        ['office' => 'Pune City PO', 'pin' => '411002'],
                        ['office' => 'Yerwada PO', 'pin' => '411006']
                    ]
                ]
            ],
            'Delhi' => [
                'code' => 'DL',
                'cities' => [
                    'New Delhi' => [
                        ['office' => 'Sansad Marg PO', 'pin' => '110001'],
                        ['office' => 'Lodhi Road PO', 'pin' => '110003']
                    ]
                ]
            ],
            'Karnataka' => [
                'code' => 'KA',
                'cities' => [
                    'Bengaluru' => [
                        ['office' => 'Bengaluru GPO', 'pin' => '560001'],
                        ['office' => 'Jayanagar PO', 'pin' => '560011']
                    ]
                ]
            ]
        ];

        foreach ($locations as $stateName => $stateData) {
            $stateId = DB::table('states')->insertGetId([
                'country_id' => $countryId,
                'name' => $stateName,
                'state_code' => $stateData['code'],
                'created_at' => now(),
            ]);

            foreach ($stateData['cities'] as $cityName => $postOffices) {
                $cityId = DB::table('cities')->insertGetId([
                    'state_id' => $stateId,
                    'name' => $cityName,
                    'created_at' => now(),
                ]);

                foreach ($postOffices as $po) {
                    DB::table('post_offices')->insert([
                        'city_id' => $cityId,
                        'office_name' => $po['office'],
                        'pincode' => $po['pin'],
                        'created_at' => now(),
                    ]);
                }
            }
        }
    }
}