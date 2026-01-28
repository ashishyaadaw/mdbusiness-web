<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'showSearch' => true, // Set to false to hide it
            'title' => 'Home',
        ]);
    }

    public function privacy()
    {
        return view('pages.legal.privacy', [
            'showSearch' => false,
            'title' => 'Privacy',
        ]);
    }

    public function refund()
    {
        return view('pages.legal.refund', [
            'showSearch' => false,
            'title' => 'Refund',
        ]);
    }

    public function terms()
    {
        return view('pages.legal.terms', [
            'showSearch' => false,
            'title' => 'Terms',
        ]);
    }

    public function childSafety()
    {
        return view('pages.legal.child_safety', [
            'showSearch' => false,
            'title' => 'Child Safety',
        ]);
    }

    public function deletion()
    {
        return view('pages.legal.request_deletion', [
            'showSearch' => false,
            'title' => 'Request Deletion',
        ]);
    }
}
