<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuCategoryResource;
use App\Http\Resources\MenuResource;
use App\Models\City;
use App\Models\Flag;
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
        // $menus = Menu::all();
        $menus = Menu::with('category')->get();

        return MenuResource::collection($menus);
    }

    // POST: api/menus
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|url',
            'menu_category_id' => 'required|exists:menu_category,id',
            'type' => 'required|in:ad,actual',
            'status' => 'nullable|boolean', // Status validated but not in Menu table
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            return DB::transaction(function () use ($request) {

                // 1. Filter out 'status' so it doesn't break the Menu insert
                // Default to 1 (active) if status is not provided

                $menuData = $request->except('status');
                $menu = Menu::create($menuData);

                // 2. Handle the 'status' logic separately for the Flag table

                Flag::updateOrCreate(
                    ['id' => $menu->id],
                    ['menus' => (int) $request->status ?? 1] // Casts true to 1 and false to 0, defaults to 1 if not provided
                );

                return response()->json([
                    'message' => 'Menu created successfully',
                    'data' => new MenuResource($menu),
                ], 201);
            });

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create menu',
                'error' => $e->getMessage(),
            ], 500);
        }
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
            'description' => 'nullable|string',
            'icon' => 'nullable|string|url',
            'menu_category_id' => 'sometimes|required|exists:menu_category,id',
            'type' => 'sometimes|required|in:ad,actual',
            'status' => 'sometimes|boolean', // Added status to validation
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            return DB::transaction(function () use ($request, $menu) {

                // 1. Update Menu excluding 'status'
                $menu->update($request->except('status'));

                // 2. Update Flag only if 'status' was actually provided in the request
                if ($request->has('status')) {
                    Flag::updateOrCreate(
                        ['id' => $menu->id],
                        ['menus' => (int) $request->status]
                    );
                }

                return response()->json([
                    'message' => 'Menu updated successfully',
                    'data' => new MenuResource($menu->fresh()), // fresh() loads updated data
                ]);
            });

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update menu',
                'error' => $e->getMessage(),
            ], 500);
        }
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

    public function getMenusByCategory(City $city, MenuCategories $menuCategories)
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

        $cityMenuCategories = $city->menuCategories()->where('menu_categories_id', $menuCategories->id)->first();
        $menus = $cityMenuCategories ? $cityMenuCategories->menus : collect();
        // $city->load('menus');

        $menus->load('category');

        return MenuResource::collection($menus);
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
        // $city->load('menuCategories');
        $city->load(['menuCategories' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        return MenuCategoryResource::collection($city->menuCategories);
    }

    public function getMenuCategoriesWithFilters(City $city, Request $request)
    {
        // 1. Check if the city is active
        if (! $city->isActiveInFlags()) {
            return response()->json([
                'message' => 'This specific city is inactive.',
                'error_code' => 'CITY_INACTIVE',
            ], 403);
        }

        // 2. Load relationship with constraints on the categories AND their flags
        $city->load(['menuCategories' => function ($query) use ($request) {

            // TODO: Add False in array

            // check if the request has a 'status' filter and apply it to the query
            if ($request->has('status') && in_array($request->input('status'), [true, false], true)) {
                $query->whereHas('flag', function ($flagQuery) use ($request) {
                    $flagQuery->where('menu_category', $request->input('status')); // Assuming 'menu_category' is the boolean field in the flags table
                });
            }

            if ($request->has('type')) {
                $query->where('type', $request->input('type'));
            }

            $query->orderBy('created_at', 'desc');
        }]);

        $menu_categories = $city->menuCategories;

        return MenuCategoryResource::collection($city->menuCategories);

        // return response()->json([
        //     'message' => 'Menu category updated successfully',
        //     'data' => $menu_categories, // Reindex the collection after filtering
        // ], 200);
    }

    public function deleteMenuCategory(MenuCategories $menuCategories)
    {
        $menuCategories->delete();

        return response()->json(['message' => 'Menu category deleted successfully'], 200);
    }

    public function updateMenuCategory(Request $request, MenuCategories $menuCategories)
    {
        // 1. Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'sometimes|string',
            'desc' => 'sometimes|string',
            'status' => 'sometimes|boolean',
            // 'type' => 'nullable|string|in:actual,ad,promo,social,news',
        ]);

        // 2. Update the model instance
        $menuCategories->update($validated);

        // Assuming $menuCategories is your single category instance
        // and 'menu_category_id' is the column on your flags table.

        Flag::updateOrCreate(
            ['id' => $menuCategories->id],
            ['menu_category' => (int) $validated['status'] ?? 0]     // Casts true to 1 and false to 0
        );
        $menuCategories->load('flag'); // Eager load the flag relationship to include it in the response

        $menuCategories['status'] = $menuCategories['flag']->menu_category; // Add the status to the menu category data

        // 3. Return the updated object and a success message
        return response()->json([
            'message' => 'Menu category updated successfully',
            'data' => $menuCategories,
        ], 200);
    }

    public function addMenuCategory(City $city, Request $request)
    {
        //  $user = Auth::user();

        // 1. Improved Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255|url',
            'desc' => 'required|string|max:255',
            'status' => 'boolean|nullable',
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
                    'name' => $request->name,
                    'icon' => $request->icon,
                    'desc' => $request->desc,
                ]);

                $menuCategory->cities()->attach($city->id); // Attach the city to the menu category
                // $menuCategory->flag()->updateOrCreate(['menu_category' => (int) $request->status]); // Create a flag for this menu category and set it to active
                $menuCategory->flag()->updateOrCreate(
                    ['id' => (int) $menuCategory->id], // Attributes to find the record
                    ['menu_category' => (int) $request->status] // Values to update/create
                );

                $menuCategory->load('flag'); // Eager load the flag relationship

                return $menuCategory;
            });

            // 3. Load relationships and return
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Menu category created successfully',
                    'data' => $menuCategory,
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