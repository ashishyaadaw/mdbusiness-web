<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::withCount('states')->orderBy('name')->get();

        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateCountry($request);

        Country::create($validated);

        return redirect()->route('admin.countries.index')->with('status', 'Country created.');
    }

    public function edit(Country $country)
    {
        return view('admin.countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $validated = $this->validateCountry($request, $country->id);

        $country->update($validated);

        return redirect()->route('admin.countries.index')->with('status', 'Country updated.');
    }

    public function destroy(Country $country)
    {
        if ($country->states()->exists()) {
            return back()->withErrors(['country' => 'This country has states attached. Remove or reassign them first.']);
        }

        $country->delete();

        return redirect()->route('admin.countries.index')->with('status', 'Country deleted.');
    }

    private function validateCountry(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'iso_code' => 'required|string|max:3|unique:countries,iso_code,'.($ignoreId ?? 'NULL').',id',
        ]);
    }
}
