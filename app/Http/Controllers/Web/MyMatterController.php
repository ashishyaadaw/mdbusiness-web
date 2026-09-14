<?php

namespace App\Http\Controllers\Web;

use App\Events\MatterDeletedByUser;
use App\Events\NewMatrimonialProfileAdded;
use App\Events\NewMatterSubmittedForReview;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityMenu;
use App\Models\CityMenuMatter;
use App\Models\Matters\Matter;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

/**
 * Consumer-facing "post & manage my own listing" area — a Blade equivalent
 * of the app API's create/updateMatter/activateMatterByUser/etc endpoints in
 * Api\MatterController. Every write here goes through the same status rule
 * the app enforces: a listing is always created/edited as 'pending', and a
 * user can only toggle between active/inactive once an admin has approved
 * it at least once — never straight to 'active'.
 */
class MyMatterController extends Controller
{
    public function index()
    {
        $matters = Auth::user()->matters()
            ->with(['matterDetails', 'matterController', 'cityMenuMatter.cityMenu.city', 'cityMenuMatter.cityMenu.menu'])
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('pages.account.matters.index', [
            'title' => 'My Listings',
            'isSearchBar' => false,
            'matters' => $matters,
        ]);
    }

    public function create()
    {
        return view('pages.account.matters.create', [
            'title' => 'Add Listing',
            'isSearchBar' => false,
            'cities' => City::orderBy('name')->get(),
            'menus' => Menu::orderBy('title')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateMatter($request);

        $payload = $this->resolvePayload($request, $validated['type']);

        $matter = DB::transaction(function () use ($validated, $payload) {
            $matter = Matter::create([
                'user_id' => Auth::id(),
                'title' => $validated['title'],
                'type' => $validated['type'],
                'payload' => $payload,
            ]);

            $matter->matterDetails()->create($this->detailFields($validated));

            $matter->matterController()->create(['status' => 'pending']);

            $cityMenu = CityMenu::firstOrCreate([
                'city_id' => $validated['city_id'],
                'menu_id' => $validated['menu_id'],
            ]);

            $matter->cityMenuMatter()->create(['city_menu_id' => $cityMenu->id]);

            return $matter;
        });

        event(new NewMatrimonialProfileAdded(Auth::user(), 'pending'));
        event(new NewMatterSubmittedForReview($matter, false));

        return redirect()->route('account.matters.index')
            ->with('status', 'Your listing has been submitted and is awaiting admin approval.');
    }

    public function edit(Matter $matter)
    {
        $this->authorizeOwner($matter);

        $matter->load(['matterDetails', 'matterController', 'cityMenuMatter.cityMenu']);
        $currentCityMenu = $matter->cityMenuMatter->first()?->cityMenu;

        return view('pages.account.matters.edit', [
            'title' => 'Edit Listing',
            'isSearchBar' => false,
            'matter' => $matter,
            'cities' => City::orderBy('name')->get(),
            'menus' => Menu::orderBy('title')->get(),
            'currentCityId' => $currentCityMenu?->city_id,
            'currentMenuId' => $currentCityMenu?->menu_id,
        ]);
    }

    public function update(Request $request, Matter $matter)
    {
        $this->authorizeOwner($matter);

        $validated = $this->validateMatter($request, $matter);

        $payload = $this->resolvePayload($request, $validated['type'], $matter);

        DB::transaction(function () use ($validated, $payload, $matter) {
            $matter->update([
                'title' => $validated['title'],
                'type' => $validated['type'],
                'payload' => $payload,
            ]);

            $matter->matterDetails()->updateOrCreate(
                ['matter_id' => $matter->id],
                $this->detailFields($validated),
            );

            $cityMenu = CityMenu::firstOrCreate([
                'city_id' => $validated['city_id'],
                'menu_id' => $validated['menu_id'],
            ]);

            CityMenuMatter::where('matter_id', $matter->id)->delete();
            $matter->cityMenuMatter()->create(['city_menu_id' => $cityMenu->id]);

            // Editing always sends the listing back through admin review —
            // never straight back to 'active' on the user's own say-so.
            $matter->matterController()->updateOrCreate(
                ['matter_id' => $matter->id],
                ['status' => 'pending'],
            );
        });

        event(new NewMatterSubmittedForReview($matter, true));

        return redirect()->route('account.matters.index')
            ->with('status', 'Your changes were submitted and are awaiting admin approval.');
    }

    public function destroy(Matter $matter)
    {
        $this->authorizeOwner($matter);

        event(new MatterDeletedByUser($matter->id, $matter->title, $matter->matterCreator));

        foreach ($matter->raw_image_paths as $path) {
            File::delete(public_path($path));
        }

        $matter->delete();

        return redirect()->route('account.matters.index')->with('status', 'Listing deleted.');
    }

    public function activate(Matter $matter)
    {
        return $this->toggleStatus($matter, 'active');
    }

    public function inactivate(Matter $matter)
    {
        return $this->toggleStatus($matter, 'inactive');
    }

    private function toggleStatus(Matter $matter, string $status)
    {
        $this->authorizeOwner($matter);

        $current = $matter->controller->status ?? null;

        if (! in_array($current, ['active', 'inactive'])) {
            return back()->with('error', "This listing can't be toggled while its status is '{$current}' — it needs admin approval first.");
        }

        $matter->controller()->updateOrCreate(['matter_id' => $matter->id], ['status' => $status]);

        return back()->with('status', 'Listing marked as '.$status.'.');
    }

    private function authorizeOwner(Matter $matter): void
    {
        abort_if($matter->user_id !== Auth::id(), 403);
    }

    private function detailFields(array $validated): array
    {
        return [
            'name' => $validated['name'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'whatsapp' => $validated['whatsapp'] ?? null,
            'alternate_contact' => $validated['alternate_contact'] ?? null,
            'website' => $validated['website'] ?? null,
            'social_media' => $validated['social_media'] ?? null,
            'tags' => $validated['tags'] ?? null,
            'gstin' => $validated['gstin'] ?? null,
        ];
    }

    private function validateMatter(Request $request, ?Matter $matter = null): array
    {
        $keepsExistingImages = $matter && $matter->type === 'image' && count($matter->raw_image_paths) > 0;

        return $request->validate([
            'title' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'menu_id' => 'required|exists:menus,id',
            'type' => 'required|in:image,text',
            'payload' => 'required_if:type,text|nullable|string',
            'images' => $keepsExistingImages ? 'nullable|array' : 'required_if:type,image|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'alternate_contact' => 'nullable|string|max:20',
            'website' => 'nullable|string|max:255',
            'social_media' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'gstin' => 'nullable|string|max:32',
        ]);
    }

    private function resolvePayload(Request $request, string $type, ?Matter $matter = null): string
    {
        if ($type === 'text') {
            return $request->input('payload', '');
        }

        $existing = $matter?->raw_image_paths ?? [];

        $destination = public_path('uploads/matters');
        if (! File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        $uploaded = collect($request->file('images', []))->map(function ($file) use ($destination) {
            $filename = time().'_'.uniqid().'_'.$file->getClientOriginalName();
            $file->move($destination, $filename);

            return 'uploads/matters/'.$filename;
        })->all();

        $paths = array_merge($existing, $uploaded);

        abort_if(empty($paths), 422, 'At least one image is required.');

        return implode(',', $paths);
    }
}
