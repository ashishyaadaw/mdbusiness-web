<?php

namespace App\Http\Controllers;

class ServiceController extends Controller
{
    public function show($category)
    {
        // Define metadata for each category
        $services = [
            'b2b' => ['title' => 'B2B Solutions', 'icon' => 'briefcase'],
            'doctors' => ['title' => 'Find Doctors', 'icon' => 'user-md'],
            'packers' => ['title' => 'Packers & Movers', 'icon' => 'truck'],
            'car-hire' => ['title' => 'Car Hire', 'icon' => 'car'],
            'beauty' => ['title' => 'Beauty & Spa', 'icon' => 'magic'],
            'wedding' => ['title' => 'Wedding Services', 'icon' => 'heart'],
            'gyms' => ['title' => 'Gyms & Fitness', 'icon' => 'dumbbell'],
            'education' => ['title' => 'Education', 'icon' => 'graduation-cap'],
            'repairs' => ['title' => 'Repairs & Services', 'icon' => 'tools'],
            'rentals' => ['title' => 'Rentals', 'icon' => 'key'],
            'loans' => ['title' => 'Loans', 'icon' => 'hand-holding-usd'],
            'real-estate' => ['title' => 'Real Estate', 'icon' => 'building'],
            'pg-hostel' => ['title' => 'PG & Hostels', 'icon' => 'bed'],
            'repair' => ['title' => 'Repair & Service', 'icon' => 'bed'],
        ];

        if (! array_key_exists($category, $services)) {
            abort(404);
        }

        return view('pages.services.detail', [
            'service' => $services[$category],
            'isSearchBar' => true,
        ]);
    }
}
