<?php

namespace App\Http\Controllers;

class AdvertiseController extends Controller
{
    public function businessListing()
    {
        return view('pages.advertise.business.listing', [
            'isSearchBar' => false,
            'isNavbar' => true,
        ]);
    }

    public function businessWithUs()
    {
        return view('pages.advertise.business.withus', [
            'isSearchBar' => false,
            'isNavbar' => true,
        ]);
    }
}
