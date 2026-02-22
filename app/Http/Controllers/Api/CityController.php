<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\MenuResource;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    // Uncomment the index method to enable filtering and pagination
    // GET /api/cities?name=San
    // GET /api/cities?country=UK&active=1

    // public function index(Request $request)
    // {
    //     // Start the query builder
    //     $query = City::query();

    //     // Filter by name (e.g., ?name=New York)
    //     if ($request->has('name')) {
    //         $query->where('name', 'like', '%'.$request->name.'%');
    //     }

    //     // Filter by country code (e.g., ?country=US)
    //     if ($request->has('country')) {
    //         $query->where('country_code', $request->country);
    //     }

    //     // Filter by active status (e.g., ?active=1)
    //     if ($request->has('active')) {
    //         $query->where('is_active', $request->boolean('active'));
    //     }

    //     // Return paginated results for better performance
    //     $cities = $query->paginate(10);

    //     return CityResource::collection($cities);
    // }

    public function index()
    {
        return CityResource::collection(City::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'state_code' => 'nullable|string|max:5',
            'country_code' => 'required|string|max:3',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $city = City::create($request->all());

        return response()->json(['message' => 'City added', 'data' => new CityResource($city)], 201);
    }

    public function show(City $city)
    {
        return new CityResource($city);
    }

    public function update(Request $request, City $city)
    {
        $city->update($request->all());

        return response()->json(['message' => 'City updated', 'data' => new CityResource($city)]);
    }

    public function destroy(City $city)
    {
        $city->delete();

        return response()->json(['message' => 'City deleted'], 200);
    }


// 1. Get menus for a specific city
public function getMenus(City $city)
{
    return MenuResource::collection($city->menus);
}

// 2. Link a menu to a city (Pivot Assignment)
public function attachMenu(Request $request, City $city)
{
    $request->validate(['menu_id' => 'required|exists:menus,id']);
    
    // syncWithoutDetaching prevents duplicate entries
    $city->menus()->syncWithoutDetaching([$request->menu_id]);

    return response()->json(['message' => 'Menu linked to city successfully']);
}
}