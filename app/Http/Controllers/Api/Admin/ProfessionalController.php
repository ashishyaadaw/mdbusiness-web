<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyResource;
use App\Http\Resources\DropDownResource;
use App\Models\AnnualIncome;
use App\Models\Currency;
use App\Models\Education;
use App\Models\EmploymentType;
use App\Models\Occupation;
use Illuminate\Support\Facades\Cache;

class ProfessionalController extends Controller
{
    public function getEducationalDetails()
    {
        // Cache the list of education options forever
        $education_details = Cache::rememberForever('education', function () {
            return Education::orderBy('name')->get();
        });

        return response()->json([
            'success' => true,
            'data' => DropDownResource::collection($education_details),
        ]);
    }

    public function getEmploymentTypes()
    {
        // Cache the list of employment types forever
        $employment_types = Cache::rememberForever('employment_types', function () {
            return EmploymentType::orderBy('name')->get();
        });

        return response()->json([
            'success' => true,
            'data' => DropDownResource::collection($employment_types),
        ]);
    }

    public function getOccupations($employmentTypeId)
    {
        // Cache key is unique per employment type ID (e.g., 'occupations_1')
        $occupations = Cache::rememberForever("occupations_{$employmentTypeId}", function () use ($employmentTypeId) {
            return Occupation::where('employment_type_id', $employmentTypeId)->orderBy('name')->get();
        });

        return response()->json([
            'success' => true,
            'data' => DropDownResource::collection($occupations),
        ]);
    }

    public function getCurrencies()
    {
        // Cache the list of currencies forever
        $currencies = Cache::rememberForever('currencies', function () {
            return Currency::orderBy('id')->get();
        });

        return response()->json([
            'success' => true,
            'data' => CurrencyResource::collection($currencies),
        ]);
    }

    public function getAnnualIncomes($currencyId)
    {
        // FIX: Cache key must be unique per currency ID (e.g., 'annual_income_1')
        $annual_incomes = Cache::rememberForever("annual_income_{$currencyId}", function () use ($currencyId) {
            return AnnualIncome::where('currency_id', $currencyId)->orderBy('value')->get();
        });

        return response()->json([
            'success' => true,
            'data' => DropDownResource::collection($annual_incomes),
        ]);
    }
}
