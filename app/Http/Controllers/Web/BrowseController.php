<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Matters\Matter;
use App\Models\Menu;
use Illuminate\Http\Request;

/**
 * Public, read-only browsing of the same city -> menu -> matters hierarchy
 * the mobile app consumes via routes/api/matters.php, cities.php and
 * menus.php. Mirrors those endpoints' "active only" filtering exactly, but
 * renders Blade pages instead of JSON, and never writes anything.
 */
class BrowseController extends Controller
{
    public function index()
    {
        $cities = City::whereHas('flag', fn ($q) => $q->where('city', true))
            ->orderBy('name')
            ->get();

        return view('pages.browse.index', [
            'title' => 'Browse Cities',
            'isSearchBar' => false,
            'cities' => $cities,
        ]);
    }

    /**
     * All active listings for one category, across every active city —
     * used by the homepage's "Popular Categories" grid, which links out
     * before the visitor has picked a city.
     */
    public function category(Menu $menu)
    {
        $matters = Matter::whereHas('cityMenuMatter.cityMenu', function ($q) use ($menu) {
            $q->where('menu_id', $menu->id)
                ->whereHas('city', fn ($cityQ) => $cityQ->whereHas('flag', fn ($f) => $f->where('city', true)));
        })
            ->whereHas('matterController', fn ($q) => $q->where('status', 'active'))
            ->with(['matterDetails', 'matterController', 'cityMenuMatter.cityMenu.city'])
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        return view('pages.browse.category', [
            'title' => $menu->title,
            'isSearchBar' => false,
            'menu' => $menu,
            'matters' => $matters,
        ]);
    }

    public function city(City $city)
    {
        abort_unless($city->isActiveInFlags(), 404);

        $menus = $city->menus()
            ->whereHas('flag', fn ($q) => $q->where('menus', 1))
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('pages.browse.city', [
            'title' => $city->name,
            'isSearchBar' => false,
            'city' => $city,
            'menus' => $menus,
        ]);
    }

    public function matters(Request $request, City $city, Menu $menu)
    {
        abort_unless($city->isActiveInFlags(), 404);

        $matters = Matter::whereHas('cityMenuMatter', function ($q) use ($city, $menu) {
            $q->whereHas('cityMenu', fn ($sub) => $sub->where('city_id', $city->id)->where('menu_id', $menu->id));
        })
            ->whereHas('matterController', fn ($q) => $q->where('status', 'active'))
            ->with(['matterDetails', 'matterController'])
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        return view('pages.browse.matters', [
            'title' => $menu->title.' in '.$city->name,
            'isSearchBar' => false,
            'city' => $city,
            'menu' => $menu,
            'matters' => $matters,
        ]);
    }

    public function show(Matter $matter)
    {
        $matter->load([
            'matterDetails',
            'matterController',
            'cityMenuMatter.cityMenu.city',
            'cityMenuMatter.cityMenu.menu',
        ]);

        $isOwner = auth()->check() && auth()->id() === $matter->user_id;

        // A pending/rejected/hold/blocked listing is only visible to its
        // owner (so they can preview it while it awaits admin approval) —
        // the public detail page otherwise matches the app's "active only"
        // rule from MatterController::getMattersByMenuAndCity.
        abort_unless($isOwner || $matter->matterController?->status === 'active', 404);

        return view('pages.browse.show', [
            'title' => $matter->title,
            'isSearchBar' => false,
            'matter' => $matter,
            'isOwner' => $isOwner,
        ]);
    }

    public function search(Request $request)
    {
        $term = trim((string) $request->query('q', ''));

        $query = Matter::whereHas('matterController', fn ($q) => $q->where('status', 'active'))
            ->with(['matterDetails', 'matterController']);

        if ($term !== '') {
            $query->whereHas('matterDetails', fn ($q) => $q->where('tags', 'like', "%{$term}%"));
        }

        $matters = $query->orderByDesc('created_at')->paginate(12)->withQueryString();

        return view('pages.browse.search', [
            'title' => 'Search Results',
            'isSearchBar' => false,
            'term' => $term,
            'matters' => $matters,
        ]);
    }
}
