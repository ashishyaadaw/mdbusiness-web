<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Map specific occupations to each Employment Type
        $annualIncomeCurreny = [
            [
                'name' => 'India',
                'symbol' => '₹',
                'code' => 'INR',
            ],
            [
                'name' => 'Nepal',
                'symbol' => 'रु',
                'code' => 'NPR',
            ],
        ];

        foreach ($annualIncomeCurreny as $currencyData) {
            Currency::firstOrCreate([
                'name' => $currencyData['name'],
                'symbol' => $currencyData['symbol'],
                'code' => $currencyData['code'],
            ]);

        }
    }
}
