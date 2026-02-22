<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use Illuminate\Http\Request;
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
            'status' => 'required|in:active,inactive',
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
}
