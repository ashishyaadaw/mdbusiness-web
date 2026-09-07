<?php

namespace App\Http\Controllers\Web\Admin;

use App\Events\MatrimonialProfileStatusChange;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Matters\Matter;
use App\Models\Menu;
use App\Services\StaffNotifier;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class MatterController extends Controller
{
    protected const STATUSES = ['pending', 'active', 'inactive', 'hold', 'rejected', 'block'];

    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');

        // Same order the public app uses (sort_order asc, then newest first),
        // so the up/down/top/bottom controls below visibly match reality.
        $matters = $this->filteredQuery($request, $status)
            ->with(['matterCreator', 'controller', 'cityMenus.city', 'cityMenus.menu'])
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        $cities = City::orderBy('name')->get();
        $menus = Menu::orderBy('title')->get();

        return view('admin.matters.index', compact('matters', 'status', 'cities', 'menus'));
    }

    /**
     * The same status/city/menu/search filters index() applies, without
     * eager loads or ordering — shared with reorder() so "top", "bottom",
     * and neighbour swaps operate on exactly the set the admin is looking at.
     */
    private function filteredQuery(Request $request, string $status)
    {
        return Matter::query()
            ->when($status !== 'all', fn ($query) => $query->whereHas('controller', fn ($q) => $q->where('status', $status)))
            ->when($request->filled('city'), fn ($query) => $query->whereHas('cityMenus', fn ($q) => $q->where('city_id', $request->integer('city'))))
            ->when($request->filled('menu'), fn ($query) => $query->whereHas('cityMenus', fn ($q) => $q->where('menu_id', $request->integer('menu'))))
            ->when($request->filled('user'), fn ($query) => $query->where('user_id', $request->integer('user')))
            ->when($request->filled('search'), fn ($query) => $query->where('title', 'like', '%'.$request->string('search').'%'));
    }

    public function reorder(Request $request, Matter $matter)
    {
        $validated = $request->validate([
            'direction' => 'required|in:up,down,top,bottom',
        ]);

        $status = $request->query('status', 'pending');
        $scope = $this->filteredQuery($request, $status);

        // Every matter defaults to sort_order=0, so most rows tie and are
        // really ordered by created_at underneath. Normalize the whole
        // scope to distinct sequential values first, so a "swap" below
        // always has two genuinely different numbers to exchange.
        $this->normalizeOrder($scope);
        $matter->refresh();

        match ($validated['direction']) {
            'up' => $this->swapWithNeighbor($scope, $matter, before: true),
            'down' => $this->swapWithNeighbor($scope, $matter, before: false),
            'top' => $matter->update(['sort_order' => ((clone $scope)->min('sort_order') ?? 0) - 1]),
            'bottom' => $matter->update(['sort_order' => ((clone $scope)->max('sort_order') ?? 0) + 1]),
        };

        return back()->with('status', "Matter #{$matter->id} moved {$validated['direction']}.");
    }

    private function normalizeOrder($scope): void
    {
        $ids = (clone $scope)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->orderBy('id')
            ->pluck('id');

        foreach ($ids->values() as $index => $id) {
            Matter::whereKey($id)->update(['sort_order' => $index]);
        }
    }

    private function swapWithNeighbor($scope, Matter $matter, bool $before): void
    {
        $ordered = (clone $scope)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->orderBy('id')
            ->get(['id', 'sort_order']);

        $position = $ordered->search(fn ($row) => $row->id === $matter->id);

        if ($position === false) {
            return;
        }

        $neighbor = $before ? $ordered->get($position - 1) : $ordered->get($position + 1);

        if (! $neighbor) {
            return;
        }

        Matter::whereKey($matter->id)->update(['sort_order' => $neighbor->sort_order]);
        Matter::whereKey($neighbor->id)->update(['sort_order' => $matter->sort_order]);
    }

    public function show(Matter $matter)
    {
        $matter->load(['matterCreator', 'controller', 'details', 'matterPricing', 'cityMenus.city', 'cityMenus.menu']);

        return view('admin.matters.show', compact('matter'));
    }

    public function edit(Matter $matter)
    {
        $matter->load(['details', 'controller']);

        return view('admin.matters.edit', compact('matter'));
    }

    public function update(Request $request, Matter $matter, StaffNotifier $notifier)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'payload' => 'required_if:type,text|nullable|string',
            'keep_images' => 'array',
            'keep_images.*' => 'string',
            'images' => 'array|max:6',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'alternate_contact' => 'nullable|string',
            'website' => 'nullable|string',
            'social_media' => 'nullable|string',
            'tags' => 'nullable|string',
            'gstin' => 'nullable|string',
            'is_premium' => 'sometimes|boolean',
            'valid_until' => 'nullable|date',
        ], [], ['type' => 'type']);

        $matter->title = $validated['title'];

        if ($matter->type === 'image') {
            // Multi-image payload: keep the still-checked existing paths,
            // append any newly uploaded images, comma-join for storage.
            $keptPaths = $validated['keep_images'] ?? [];
            $newPaths = array_map(
                fn ($file) => $this->storeUploadedImage($file),
                $request->file('images', []),
            );

            $imagePaths = array_values(array_merge($keptPaths, $newPaths));

            if (empty($imagePaths)) {
                return back()->withErrors(['images' => 'A post needs at least one image.'])->withInput();
            }

            $matter->forceFill(['payload' => implode(',', $imagePaths)]);
        } elseif ($matter->type === 'text') {
            $matter->forceFill(['payload' => $validated['payload']]);
        }

        $matter->save();

        $matter->matterDetails()->updateOrCreate(
            ['matter_id' => $matter->id],
            [
                'name' => $validated['name'] ?? null,
                'phone' => $validated['phone'] ?? null,
                'whatsapp' => $validated['whatsapp'] ?? null,
                'alternate_contact' => $validated['alternate_contact'] ?? null,
                'website' => $validated['website'] ?? null,
                'social_media' => $validated['social_media'] ?? null,
                'tags' => $validated['tags'] ?? null,
                'gstin' => $validated['gstin'] ?? null,
            ],
        );

        $matter->matterController()->updateOrCreate(
            ['matter_id' => $matter->id],
            array_filter([
                'is_premium' => $request->boolean('is_premium'),
                'valid_until' => $validated['valid_until'] ?? null,
            ], fn ($value) => ! is_null($value)),
        );

        if ($matter->matterCreator) {
            $notifier->notifyUser(
                $matter->matterCreator,
                'Post Updated',
                "Hi, our team made some edits to your post \"{$matter->title}\".",
                'matter_edited_by_admin',
                ['matter_id' => $matter->id],
            );
        }

        return redirect()->route('admin.matters.show', $matter)->with('status', "Matter #{$matter->id} updated.");
    }

    private function storeUploadedImage(UploadedFile $file): string
    {
        $imageName = time().'.jpg';

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->scaleDown(width: 1200);

        $quality = 90;
        $encoded = $image->toJpeg($quality);

        while (strlen($encoded->toString()) > 307200 && $quality > 10) {
            $quality -= 10;
            $encoded = $image->toJpeg($quality);
        }

        $directory = public_path('images');
        if (! file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $encoded->save($directory.'/'.$imageName);

        return 'images/'.$imageName;
    }

    public function updateStatus(Request $request, Matter $matter)
    {
        $validated = $request->validate([
            'status' => 'required|in:'.implode(',', self::STATUSES),
        ]);

        $matter->controller()->updateOrCreate(
            ['matter_id' => $matter->id],
            ['status' => $validated['status']],
        );

        if ($matter->matterCreator) {
            event(new MatrimonialProfileStatusChange($matter->matterCreator, $validated['status']));
        }

        if ($request->wantsJson()) {
            return response()->json(['status' => true, 'message' => 'Status updated.', 'new_status' => $validated['status']]);
        }

        return back()->with('status', "Matter #{$matter->id} status updated to {$validated['status']}.");
    }

    public function destroy(Request $request, Matter $matter, StaffNotifier $notifier)
    {
        $owner = $matter->matterCreator;
        $title = $matter->title;

        if ($owner) {
            $notifier->notifyUser(
                $owner,
                'Post Removed',
                "Hi, your post \"{$title}\" was removed by our team for not meeting our guidelines.",
                'matter_removed_by_admin',
                ['matter_id' => $matter->id],
            );
        }

        $matter->delete();

        if ($request->wantsJson()) {
            return response()->json(['status' => true, 'message' => 'Matter deleted.']);
        }

        return redirect()->route('admin.matters.index')->with('status', "Matter \"{$title}\" deleted.");
    }
}
