<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
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
