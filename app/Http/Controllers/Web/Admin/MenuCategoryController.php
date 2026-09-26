<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityMenu;
use App\Models\CityMenuMatter;
use App\Models\Flag;
use App\Models\MenuCategories;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class MenuCategoryController extends Controller
{
    public function index()
    {
        $categories = MenuCategories::withCount('menus')->with('flag')->ordered()->get();

        return view('admin.menu-categories.index', compact('categories'));
    }

    public function create()
    {
        $cities = City::orderBy('name')->get();

        return view('admin.menu-categories.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateCategory($request);

        $category = MenuCategories::create([
            'name' => $validated['name'],
            'desc' => $validated['desc'] ?? null,
            'icon' => $request->hasFile('icon') ? $this->storeUploadedIcon($request->file('icon')) : ($validated['icon_url'] ?? null),
        ]);

        Flag::updateOrCreate(['id' => $category->id], ['menu_category' => $request->boolean('is_active')]);

        $category->cities()->sync($request->input('cities', []));

        return redirect()->route('admin.menu-categories.index')->with('status', 'Menu category created.');
    }

    public function edit(MenuCategories $menuCategory)
    {
        $menuCategory->load('flag');
        $cities = City::orderBy('name')->get();
        $attachedCityIds = $menuCategory->cities()->pluck('cities.id')->all();

        return view('admin.menu-categories.edit', compact('menuCategory', 'cities', 'attachedCityIds'));
    }

    public function update(Request $request, MenuCategories $menuCategory)
    {
        $validated = $this->validateCategory($request);

        $menuCategory->fill([
            'name' => $validated['name'],
            'desc' => $validated['desc'] ?? null,
        ]);

        if ($request->hasFile('icon')) {
            $menuCategory->icon = $this->storeUploadedIcon($request->file('icon'));
        } elseif (filled($validated['icon_url'] ?? null)) {
            $menuCategory->icon = $validated['icon_url'];
        }

        $menuCategory->save();

        Flag::updateOrCreate(['id' => $menuCategory->id], ['menu_category' => $request->boolean('is_active')]);

        $menuCategory->cities()->sync($request->input('cities', []));

        return redirect()->route('admin.menu-categories.index')->with('status', 'Menu category updated.');
    }

    public function destroy(MenuCategories $menuCategory)
    {
        $menuIds = $menuCategory->menus()->pluck('id');

        $hasLiveMatters = CityMenuMatter::whereIn(
            'city_menu_id',
            CityMenu::whereIn('menu_id', $menuIds)->pluck('id'),
        )->exists();

        if ($hasLiveMatters) {
            return back()->withErrors(['category' => 'This category has menus with posts attached. Mark it inactive instead of deleting it.']);
        }

        if ($menuIds->isNotEmpty()) {
            return back()->withErrors(['category' => 'This category still has menus in it. Delete or move them first.']);
        }

        $menuCategory->delete();

        return redirect()->route('admin.menu-categories.index')->with('status', 'Menu category deleted.');
    }

    public function reorder(Request $request, MenuCategories $menuCategory)
    {
        $validated = $request->validate(['direction' => 'required|in:up,down,top,bottom']);

        $scope = MenuCategories::query();

        $ids = (clone $scope)->orderBy('sort_order')->orderBy('id')->pluck('id');
        foreach ($ids->values() as $index => $id) {
            MenuCategories::whereKey($id)->update(['sort_order' => $index]);
        }
        $menuCategory->refresh();

        $ordered = (clone $scope)->orderBy('sort_order')->orderBy('id')->get(['id', 'sort_order']);
        $position = $ordered->search(fn ($row) => $row->id === $menuCategory->id);

        if ($position !== false) {
            match ($validated['direction']) {
                'up' => $this->swapWithNeighbor($menuCategory, $ordered->get($position - 1)),
                'down' => $this->swapWithNeighbor($menuCategory, $ordered->get($position + 1)),
                'top' => $menuCategory->update(['sort_order' => ((clone $scope)->min('sort_order') ?? 0) - 1]),
                'bottom' => $menuCategory->update(['sort_order' => ((clone $scope)->max('sort_order') ?? 0) + 1]),
            };
        }

        return back()->with('status', 'Category moved.');
    }

    private function swapWithNeighbor(MenuCategories $category, $neighbor): void
    {
        if (! $neighbor) {
            return;
        }

        MenuCategories::whereKey($category->id)->update(['sort_order' => $neighbor->sort_order]);
        MenuCategories::whereKey($neighbor->id)->update(['sort_order' => $category->sort_order]);
    }

    private function validateCategory(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string|max:500',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'icon_url' => 'nullable|string|max:500|url',
            'cities' => 'array',
            'cities.*' => 'integer|exists:cities,id',
        ]);
    }

    /**
     * Stored as a full asset() URL (not a relative path) so it drops into
     * the `icon` column exactly like the existing URL-string convention
     * that Api\MenuController and services-grid.blade.php already assume —
     * no other code needs to change to render an uploaded icon.
     */
    private function storeUploadedIcon(UploadedFile $file): string
    {
        $imageName = time().'_'.uniqid().'.jpg';

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->scaleDown(width: 512);

        $quality = 90;
        $encoded = $image->toJpeg($quality);

        while (strlen($encoded->toString()) > 204800 && $quality > 10) {
            $quality -= 10;
            $encoded = $image->toJpeg($quality);
        }

        $directory = public_path('images/menu-categories');
        if (! file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $encoded->save($directory.'/'.$imageName);

        return asset('images/menu-categories/'.$imageName);
    }
}
