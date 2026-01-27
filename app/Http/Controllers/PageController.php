<?php

namespace App\Http\Controllers;

use Request;

class PageController extends Controller
{   public function index(Request $request) {
    $selectedState = $request->get('state', 'Uttar Pradesh');
    
    // Fetch cities based on the selected state
    $cities = City::where('state_name', $selectedState)->get(); 

    return view('your-view', [
        'activeState' => $selectedState,
        'cities' => $cities,
        'activeCity' => $request->get('city', $cities->first()->name ?? '')
    ]);
}
    public function privacy()
    {
        return view('legal.privacy');
    }

    public function childSafety()
    {
        return view('legal.child_safety');
    }

    public function deletion()
    {
        return view('legal.request_deletion');
    }
}