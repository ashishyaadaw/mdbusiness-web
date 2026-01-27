<?php

namespace App\Http\Controllers;

class LegalController extends Controller
{
    public function privacy()
    {
        return view('pages.legal.privacy');
    }

    public function terms()
    {
        return view('pages.legal.terms');
    }

    public function refund()
    {
        return view('pages.legal.refund');
    }
}
