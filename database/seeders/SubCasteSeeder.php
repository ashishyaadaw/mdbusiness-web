<?php

namespace Database\Seeders;

use App\Models\Caste;
use App\Models\SubCaste;
use Illuminate\Database\Seeder;

class SubCasteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Map Caste Name => Array of Sub-Caste Names
        $data = [
            // Hinduism - Brahmins
            'Brahmin' => [
                'Saryupareen',
                'Kanyakubja',
                'Gaud',
                'Maithil',
                'Chitpavan',
                'Deshastha',
            ],
            'Iyer' => [
                'Vadama',
                'Brahacharanam',
                'Vathima',
                'Ashtasahasram',
            ],
            'Iyengar' => [
                'Vadakalai',
                'Thenkalai',
            ],
            // Hinduism - Rajputs
            'Rajput' => [
                'Suryavanshi',
                'Chandravanshi',
                'Agnivanshi',
                'Rathore',
                'Chauhan',
                'Sisodia',
            ],
            // Hinduism - Banias
            'Bania' => [
                'Agarwal',
                'Gupta',
                'Maheshwari',
                'Khandelwal',
                'Oswal',
            ],
            // Hinduism - Others
            'Yadav' => [
                'Ahir',
                'Gwal',
                'Dadhor',
            ],
            'Nair' => [
                'Kiriyathil',
                'Illathu',
                'Swaroopam',
            ],
            'Reddy' => [
                'Pokanati',
                'Pakanati',
                'Motati',
            ],

            // Christianity
            'Catholic' => [
                'Roman Catholic',
                'Syro-Malabar',
                'Syro-Malankara',
            ],
            'Protestant' => [
                'Baptist',
                'Lutheran',
                'Methodist',
                'Presbyterian',
                'Anglican (CSI/CNI)',
            ],
            'Orthodox' => [
                'Malankara Orthodox',
                'Jacobite',
            ],

            // Islam
            'Sunni' => [
                'Hanafi',
                'Shafi',
                'Maliki',
                'Hanbali',
                'Barelvi',
                'Deobandi',
            ],
            'Shia' => [
                'Twelver (Ithna Ashari)',
                'Ismaili',
                'Zaidi',
                'Bohra',
                'Khoja',
            ],
            'Pathan' => [
                'Yusufzai',
                'Afridi',
                'Khatak',
                'Niazi',
            ],

            // Sikhism
            'Jat Sikh' => [
                'Sandhu',
                'Sidhu',
                'Gill',
                'Mann',
                'Dhillon',
            ],
            'Khatri' => [
                'Bedi',
                'Sodhi',
                'Trehan',
                'Bhalla',
            ],
        ];

        foreach ($data as $casteName => $subCastes) {
            // Find the Caste ID first
            $caste = Caste::where('name', $casteName)->first();

            if ($caste) {
                foreach ($subCastes as $subCasteName) {
                    // Create the sub-caste linked to that caste
                    SubCaste::firstOrCreate([
                        'name' => $subCasteName,
                        'caste_id' => $caste->id,
                    ]);
                }
            }
        }
    }
}
