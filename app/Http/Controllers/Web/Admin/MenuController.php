<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityMenu;
use App\Models\CityMenuMatter;
use App\Models\Flag;
use App\Models\Menu;
use App\Models\MenuCategories;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::with(['category', 'flag'])
            ->when($request->filled('category'), fn ($q) => $q->where('menu_category_id', $request->integer('category')))
            ->when($request->filled('search'), fn ($q) => $q->where('title', 'like', '%'.$request->string('search').'%'))
            ->ordered()
            ->paginate(50)
            ->withQueryString();

        $categories = MenuCategories::orderBy('name')->get();

        return view('admin.menus.index', compact('menus', 'categories'));
    }

    public function create()
    {
        $categories = MenuCategories::orderBy('name')->get();
        $cities = City::orderBy('name')->get();

        return view('admin.menus.create', compact('categories', 'cities'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateMenu($request);

        $menu = Menu::create([
            'title' => $validated['title'],
            'menu_category_id' => $validated['menu_category_id'],
            'desc' => $validated['desc'] ?? null,
            'type' => $validated['type'],
            'icon' => $request->hasFile('icon') ? $this->storeUploadedIcon($request->file('icon')) : ($validated['icon_url'] ?? null),
        ]);

        Flag::updateOrCreate(['id' => $menu->id], ['menus' => $request->boolean('is_active')]);

        $menu->cities()->sync($request->input('cities', []));

        return redirect()->route('admin.menus.index')->with('status', 'Menu created.');
    }

    public function edit(Menu $menu)
    {
        $menu->load('flag');
        $categories = MenuCategories::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        $attachedCityIds = $menu->cities()->pluck('cities.id')->all();

        return view('admin.menus.edit', compact('menu', 'categories', 'cities', 'attachedCityIds'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $this->validateMenu($request);

        $menu->fill([
            'title' => $validated['title'],
            'menu_category_id' => $validated['menu_category_id'],
            'desc' => $validated['desc'] ?? null,
            'type' => $validated['type'],
        ]);

        if ($request->hasFile('icon')) {
            $menu->icon = $this->storeUploadedIcon($request->file('icon'));
        } elseif (filled($validated['icon_url'] ?? null)) {
            $menu->icon = $validated['icon_url'];
        }

        $menu->save();

        Flag::updateOrCreate(['id' => $menu->id], ['menus' => $request->boolean('is_active')]);

        $menu->cities()->sync($request->input('cities', []));

        return redirect()->route('admin.menus.index')->with('status', 'Menu updated.');
    }

    public function destroy(Menu $menu)
    {
        $hasLiveMatters = CityMenuMatter::whereIn(
            'city_menu_id',
            CityMenu::where('menu_id', $menu->id)->pluck('id'),
        )->exists();

        if ($hasLiveMatters) {
            return back()->withErrors(['menu' => 'This menu has posts attached to it. Mark it inactive instead of deleting it.']);
        }

        $menu->delete();

        return redirect()->route('admin.menus.index')->with('status', 'Menu deleted.');
    }

    /**
     * Scoped by menu_category_id, same as the mobile app's own ordering
     * (services-grid.blade.php / Api\MenuController::getMenus sort by
     * sort_order within a category) — reordering never crosses categories.
     */
    public function reorder(Request $request, Menu $menu)
    {
        $validated = $request->validate(['direction' => 'required|in:up,down,top,bottom']);

        $scope = Menu::where('menu_category_id', $menu->menu_category_id);

        $ids = (clone $scope)->orderBy('sort_order')->orderBy('id')->pluck('id');
        foreach ($ids->values() as $index => $id) {
            Menu::whereKey($id)->update(['sort_order' => $index]);
        }
        $menu->refresh();

        $ordered = (clone $scope)->orderBy('sort_order')->orderBy('id')->get(['id', 'sort_order']);
        $position = $ordered->search(fn ($row) => $row->id === $menu->id);

        if ($position !== false) {
            match ($validated['direction']) {
                'up' => $this->swapWithNeighbor($menu, $ordered->get($position - 1)),
                'down' => $this->swapWithNeighbor($menu, $ordered->get($position + 1)),
                'top' => $menu->update(['sort_order' => ((clone $scope)->min('sort_order') ?? 0) - 1]),
                'bottom' => $menu->update(['sort_order' => ((clone $scope)->max('sort_order') ?? 0) + 1]),
            };
        }

        return back()->with('status', 'Menu moved.');
    }

    private function swapWithNeighbor(Menu $menu, $neighbor): void
    {
        if (! $neighbor) {
            return;
        }

        Menu::whereKey($menu->id)->update(['sort_order' => $neighbor->sort_order]);
        Menu::whereKey($neighbor->id)->update(['sort_order' => $menu->sort_order]);
    }

    private function validateMenu(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'menu_category_id' => 'required|exists:menu_category,id',
            'desc' => 'nullable|string|max:500',
            'type' => 'required|in:ad,actual',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'icon_url' => 'nullable|string|max:500|url',
            'cities' => 'array',
            'cities.*' => 'integer|exists:cities,id',
        ]);
    }

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

        $directory = public_path('images/menus');
        if (! file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $encoded->save($directory.'/'.$imageName);

        return asset('images/menus/'.$imageName);
    }
}
