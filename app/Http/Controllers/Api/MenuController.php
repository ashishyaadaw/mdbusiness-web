<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuCategoryResource;
use App\Http\Resources\MenuResource;
use App\Models\City;
use App\Models\Menu;
use App\Models\MenuCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    // GET: api/menus
    public function index()
    {
        $menus = Menu::all();

        return MenuResource::collection($menus);
    }

    // POST: api/menus
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string',
            'menu_category_id' => 'required|exists:menu_categories,id',
            'type' => 'required|in:ad,actual',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $menu = Menu::create($request->all());

        return response()->json([
            'message' => 'Menu created successfully',
            'data' => new MenuResource($menu),
        ], 210);
    }

    // GET: api/menus/{id}
    public function show(Menu $menu)
    {
        return new MenuResource($menu);
    }

    // PUT/PATCH: api/menus/{id}
    public function update(Request $request, Menu $menu)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|in:active,inactive',
            'type' => 'sometimes|required|in:ad,actual',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $menu->update($request->all());

        return response()->json([
            'message' => 'Menu updated successfully',
            'data' => new MenuResource($menu),
        ]);
    }

    // DELETE: api/menus/{id}
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return response()->json(['message' => 'Menu deleted successfully'], 200);
    }

    // 1. Get menus for a specific city
    public function getMenus(City $city)
    {
        // 2. Check if the city is active
        if (! $city->isActiveInFlags()) {
            return response()->json([
                'message' => 'This specific city is inactive.',
                'error_code' => 'CITY_INACTIVE',
            ], 403);
        }

        // 3. Eager load menus and return as a collection
        // Using load() on the existing model instance is cleaner than $city->menus()->get()
        $city->load('menus');

        return MenuResource::collection($city->menus);
    }

    // 1. Get menus for a specific city
    public function getMenuCategories(City $city)
    {
        // 2. Check if the city is active
        if (! $city->isActiveInFlags()) {
            return response()->json([
                'message' => 'This specific city is inactive.',
                'error_code' => 'CITY_INACTIVE',
            ], 403);
        }
        $city->load('menuCategories');

        return MenuCategoryResource::collection($city->menuCategories);
    }

    public function addMenuCategory(City $city, Request $request)
    {
        //  $user = Auth::user();

        // 1. Improved Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'desc' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['status' => false, 'errors' => $validator->errors()],
                422,
            );
        }

        try {
            // 2. Use a Transaction to ensure all or nothing is saved
            $menuCategory = DB::transaction(function () use ($request, $city) {
                $menuCategory = MenuCategories::create([
                    'name' => $request->title,
                    'icon' => $request->icon,
                    'desc' => $request->description,
                ]);
                
                $menuCategory->cities()->attach($city->id); // Attach the city to the menu category

                return $menuCategory;
            });

            // 3. Load relationships and return
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Menu category created successfully',
                    'data' => $menuCategory->load(
                        'menus',
                        'cities',
                    ),
                ],
                201,
            );
        } catch (\Exception $e) {
            // Handle database errors
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Failed to create menu category. Please try again.',
                    'error' => $e->getMessage(), // Remove this in production
                ],
                500,
            );
        }
    }
}
