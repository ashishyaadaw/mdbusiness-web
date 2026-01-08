<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Http\Resources\DropDownResource;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Facades\Cache;

class LocationController extends Controller
{
    public function getCountries()
    {
        // Cache the list of countries forever until manually cleared
        $countries = Cache::rememberForever('countries', function () {
            return Country::orderBy('name')->get();
        });

        return response()->json([
            'success' => true,
            'data' => CountryResource::collection($countries),
        ]);
    }

    public function getStates($countryId)
    {
        // Cache key is unique per country, e.g., 'states_for_country_1'
        $states = Cache::rememberForever("states_for_country_{$countryId}", function () use ($countryId) {
            return State::where('country_id', $countryId)->orderBy('name')->get();
        });

        return response()->json([
            'success' => true,
            'data' => DropDownResource::collection($states),
        ]);
    }

    public function getCities($stateId)
    {
        // Cache key unique per state
        $cities = Cache::rememberForever("cities_for_state_{$stateId}", function () use ($stateId) {
            return City::where('state_id', $stateId)->orderBy('name')->get();
        });

        return response()->json([
            'success' => true,
            'data' => DropDownResource::collection($cities),
        ]);
    }
}
