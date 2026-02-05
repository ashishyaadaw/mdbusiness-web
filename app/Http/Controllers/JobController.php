<?php

namespace App\Http\Controllers;

class JobController extends Controller
{
    public function show($category)
    {
        // Define metadata for each category
        $jobs = [
            'b2b' => ['title' => 'B2B Solutions', 'icon' => 'handshake'],
        ];

        if (! array_key_exists($category, $jobs)) {
            abort(404);
        }

        return view('pages.services.detail', [
            'service' => $jobs[$category],
            'isSearchBar' => true,
        ]);
    }
}
