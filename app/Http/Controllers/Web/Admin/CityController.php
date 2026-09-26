<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Flag;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::with(['state.country', 'flag'])
            ->when($request->filled('state'), fn ($q) => $q->where('state_id', $request->integer('state')))
            ->when($request->filled('search'), fn ($q) => $q->search($request->string('search')))
            ->ordered()
            ->paginate(30)
            ->withQueryString();

        $states = State::with('country')->orderBy('name')->get();

        return view('admin.cities.index', compact('cities', 'states'));
    }

    public function create()
    {
        $states = State::with('country')->orderBy('name')->get();

        return view('admin.cities.create', compact('states'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateCity($request);

        $city = City::create([
            'name' => $validated['name'],
            'state_id' => $validated['state_id'],
            'city_code' => $validated['city_code'] ?? null,
        ]);

        Flag::updateOrCreate(['id' => $city->id], ['city' => $request->boolean('is_active')]);

        return redirect()->route('admin.cities.index')->with('status', 'City created.');
    }

    public function edit(City $city)
    {
        $city->load('flag');
        $states = State::with('country')->orderBy('name')->get();

        return view('admin.cities.edit', compact('city', 'states'));
    }

    public function update(Request $request, City $city)
    {
        $validated = $this->validateCity($request);

        $city->update([
            'name' => $validated['name'],
            'state_id' => $validated['state_id'],
            'city_code' => $validated['city_code'] ?? null,
        ]);

        Flag::updateOrCreate(['id' => $city->id], ['city' => $request->boolean('is_active')]);

        return redirect()->route('admin.cities.index')->with('status', 'City updated.');
    }

    public function destroy(City $city)
    {
        if ($city->menus()->exists()) {
            return back()->withErrors(['city' => 'This city has menus attached. Detach them first, or mark the city inactive instead.']);
        }

        $city->delete();

        return redirect()->route('admin.cities.index')->with('status', 'City deleted.');
    }

    public function reorder(Request $request, City $city)
    {
        $validated = $request->validate(['direction' => 'required|in:up,down,top,bottom']);

        $scope = City::query();

        $ids = (clone $scope)->orderBy('sort_order')->orderBy('id')->pluck('id');
        foreach ($ids->values() as $index => $id) {
            City::whereKey($id)->update(['sort_order' => $index]);
        }
        $city->refresh();

        $ordered = (clone $scope)->orderBy('sort_order')->orderBy('id')->get(['id', 'sort_order']);
        $position = $ordered->search(fn ($row) => $row->id === $city->id);

        if ($position !== false) {
            match ($validated['direction']) {
                'up' => $this->swapWithNeighbor($city, $ordered->get($position - 1)),
                'down' => $this->swapWithNeighbor($city, $ordered->get($position + 1)),
                'top' => $city->update(['sort_order' => ((clone $scope)->min('sort_order') ?? 0) - 1]),
                'bottom' => $city->update(['sort_order' => ((clone $scope)->max('sort_order') ?? 0) + 1]),
            };
        }

        return back()->with('status', 'City moved.');
    }

    private function swapWithNeighbor(City $city, $neighbor): void
    {
        if (! $neighbor) {
            return;
        }

        City::whereKey($city->id)->update(['sort_order' => $neighbor->sort_order]);
        City::whereKey($neighbor->id)->update(['sort_order' => $city->sort_order]);
    }

    private function validateCity(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'required|exists:states,id',
            'city_code' => 'nullable|string|max:10',
        ]);
    }
}
