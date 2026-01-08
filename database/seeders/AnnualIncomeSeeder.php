<?php

namespace Database\Seeders;

use App\Models\AnnualIncome;
use App\Models\Currency;
use Illuminate\Database\Seeder;

class AnnualIncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Map currencies to their specific income ranges
        $incomeData = [
            'INR' => [
                '₹ 1 Lakh & below',
                '₹ 1 Lakh - ₹ 2 Lakhs',
                '₹ 2 Lakhs - ₹ 3 Lakhs',
                '₹ 3 Lakhs - ₹ 5 Lakhs',
                '₹ 5 Lakhs - ₹ 7 Lakhs',
                '₹ 7 Lakhs - ₹ 10 Lakhs',
                '₹ 10 Lakhs - ₹ 15 Lakhs',
                '₹ 15 Lakhs - ₹ 20 Lakhs',
                '₹ 20 Lakhs & above',
            ],
            // You can add 'USD', 'EUR' etc. here later
        ];

        foreach ($incomeData as $currencyCode => $ranges) {
            // 1. Find the Currency Model based on the code (e.g., 'INR')
            $currency = Currency::where('code', $currencyCode)->first();

            if ($currency) {
                // 2. Loop through the text ranges (strings)
                foreach ($ranges as $rangeText) {

                    // 3. Create the AnnualIncome record
                    AnnualIncome::firstOrCreate([
                        // Ensure your database column is named 'name' or 'value'
                        'value' => $rangeText,
                        'currency_id' => $currency->id,
                    ]);
                }
            }
        }
    }
}
