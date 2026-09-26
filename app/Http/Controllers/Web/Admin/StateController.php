<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(Request $request)
    {
        $states = State::with('country')
            ->withCount('cities')
            ->when($request->filled('country'), fn ($q) => $q->where('country_id', $request->integer('country')))
            ->orderBy('name')
            ->paginate(30)
            ->withQueryString();

        $countries = Country::orderBy('name')->get();

        return view('admin.states.index', compact('states', 'countries'));
    }

    public function create()
    {
        $countries = Country::orderBy('name')->get();

        return view('admin.states.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateState($request);

        State::create($validated);

        return redirect()->route('admin.states.index')->with('status', 'State created.');
    }

    public function edit(State $state)
    {
        $countries = Country::orderBy('name')->get();

        return view('admin.states.edit', compact('state', 'countries'));
    }

    public function update(Request $request, State $state)
    {
        $validated = $this->validateState($request);

        $state->update($validated);

        return redirect()->route('admin.states.index')->with('status', 'State updated.');
    }

    public function destroy(State $state)
    {
        if ($state->cities()->exists()) {
            return back()->withErrors(['state' => 'This state has cities attached. Remove or reassign them first.']);
        }

        $state->delete();

        return redirect()->route('admin.states.index')->with('status', 'State deleted.');
    }

    private function validateState(Request $request): array
    {
        return $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255',
            'state_code' => 'nullable|string|max:10',
        ]);
    }
}
