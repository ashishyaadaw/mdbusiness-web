<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Models\HomeServiceCard;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class HomeContentController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::ordered()->get();
        $cards = HomeServiceCard::ordered()->get();

        return view('admin.home.index', compact('slides', 'cards'));
    }

    // --- Hero slides ---------------------------------------------------

    public function createSlide()
    {
        return view('admin.home.slides.create');
    }

    public function storeSlide(Request $request)
    {
        $validated = $this->validateSlide($request, true);

        HeroSlide::create([
            'image_path' => $this->storeUploadedImage($request->file('image'), 'hero'),
            'eyebrow' => $validated['eyebrow'] ?? null,
            'heading' => $validated['heading'] ?? null,
            'subheading' => $validated['subheading'] ?? null,
            'button_text' => $validated['button_text'] ?? null,
            'button_url' => $validated['button_url'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.home.index')->with('status', 'Slide created.');
    }

    public function editSlide(HeroSlide $slide)
    {
        return view('admin.home.slides.edit', compact('slide'));
    }

    public function updateSlide(Request $request, HeroSlide $slide)
    {
        $validated = $this->validateSlide($request, false);

        $slide->fill([
            'eyebrow' => $validated['eyebrow'] ?? null,
            'heading' => $validated['heading'] ?? null,
            'subheading' => $validated['subheading'] ?? null,
            'button_text' => $validated['button_text'] ?? null,
            'button_url' => $validated['button_url'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ]);

        if ($request->hasFile('image')) {
            $slide->image_path = $this->storeUploadedImage($request->file('image'), 'hero');
        }

        $slide->save();

        return redirect()->route('admin.home.index')->with('status', 'Slide updated.');
    }

    public function destroySlide(HeroSlide $slide)
    {
        $slide->delete();

        return redirect()->route('admin.home.index')->with('status', 'Slide deleted.');
    }

    public function reorderSlide(Request $request, HeroSlide $slide)
    {
        $validated = $request->validate(['direction' => 'required|in:up,down,top,bottom']);

        $this->reorderModel(HeroSlide::query(), $slide, $validated['direction']);

        return back()->with('status', 'Slide moved.');
    }

    private function validateSlide(Request $request, bool $imageRequired): array
    {
        return $request->validate([
            'image' => ($imageRequired ? 'required' : 'nullable').'|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'eyebrow' => 'nullable|string|max:255',
            'heading' => 'nullable|string|max:255',
            'subheading' => 'nullable|string|max:500',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:500',
        ]);
    }

    // --- Service cards ("Looking for? Interior Design" etc.) -----------

    public function createCard()
    {
        return view('admin.home.cards.create');
    }

    public function storeCard(Request $request)
    {
        $validated = $this->validateCard($request);

        HomeServiceCard::create([
            'image_path' => $request->hasFile('image') ? $this->storeUploadedImage($request->file('image'), 'home-cards') : null,
            'eyebrow' => $validated['eyebrow'] ?? null,
            'title' => $validated['title'] ?? null,
            'subtitle' => $validated['subtitle'] ?? null,
            'bg_class' => $validated['bg_class'] ?? null,
            'button_text' => $validated['button_text'] ?? null,
            'button_url' => $validated['button_url'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.home.index')->with('status', 'Card created.');
    }

    public function editCard(HomeServiceCard $card)
    {
        return view('admin.home.cards.edit', compact('card'));
    }

    public function updateCard(Request $request, HomeServiceCard $card)
    {
        $validated = $this->validateCard($request);

        $card->fill([
            'eyebrow' => $validated['eyebrow'] ?? null,
            'title' => $validated['title'] ?? null,
            'subtitle' => $validated['subtitle'] ?? null,
            'bg_class' => $validated['bg_class'] ?? null,
            'button_text' => $validated['button_text'] ?? null,
            'button_url' => $validated['button_url'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ]);

        if ($request->hasFile('image')) {
            $card->image_path = $this->storeUploadedImage($request->file('image'), 'home-cards');
        }

        $card->save();

        return redirect()->route('admin.home.index')->with('status', 'Card updated.');
    }

    public function destroyCard(HomeServiceCard $card)
    {
        $card->delete();

        return redirect()->route('admin.home.index')->with('status', 'Card deleted.');
    }

    public function reorderCard(Request $request, HomeServiceCard $card)
    {
        $validated = $request->validate(['direction' => 'required|in:up,down,top,bottom']);

        $this->reorderModel(HomeServiceCard::query(), $card, $validated['direction']);

        return back()->with('status', 'Card moved.');
    }

    private function validateCard(Request $request): array
    {
        return $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'eyebrow' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'bg_class' => 'nullable|string|max:100',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:500',
        ]);
    }

    // --- Shared helpers --------------------------------------------------

    /**
     * Same normalize-then-swap-with-neighbor scheme as
     * Web\Admin\MatterController::reorder(), reused here for both hero
     * slides and service cards since both are plain sort_order lists with
     * no filtering scope.
     */
    private function reorderModel($query, $model, string $direction): void
    {
        $modelClass = get_class($model);

        $ids = (clone $query)->orderBy('sort_order')->orderBy('id')->pluck('id');
        foreach ($ids->values() as $index => $id) {
            $modelClass::whereKey($id)->update(['sort_order' => $index]);
        }
        $model->refresh();

        $ordered = (clone $query)->orderBy('sort_order')->orderBy('id')->get(['id', 'sort_order']);
        $position = $ordered->search(fn ($row) => $row->id === $model->id);

        if ($position === false) {
            return;
        }

        match ($direction) {
            'up' => $this->swapWithNeighbor($modelClass, $model, $ordered, $position - 1),
            'down' => $this->swapWithNeighbor($modelClass, $model, $ordered, $position + 1),
            'top' => $model->update(['sort_order' => ((clone $query)->min('sort_order') ?? 0) - 1]),
            'bottom' => $model->update(['sort_order' => ((clone $query)->max('sort_order') ?? 0) + 1]),
        };
    }

    private function swapWithNeighbor(string $modelClass, $model, $ordered, int $neighborPosition): void
    {
        $neighbor = $ordered->get($neighborPosition);

        if (! $neighbor) {
            return;
        }

        $modelClass::whereKey($model->id)->update(['sort_order' => $neighbor->sort_order]);
        $modelClass::whereKey($neighbor->id)->update(['sort_order' => $model->sort_order]);
    }

    private function storeUploadedImage(UploadedFile $file, string $subfolder): string
    {
        $imageName = time().'_'.uniqid().'.jpg';

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->scaleDown(width: 1600);

        $quality = 90;
        $encoded = $image->toJpeg($quality);

        while (strlen($encoded->toString()) > 512000 && $quality > 10) {
            $quality -= 10;
            $encoded = $image->toJpeg($quality);
        }

        $directory = public_path('images/'.$subfolder);
        if (! file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $encoded->save($directory.'/'.$imageName);

        return 'images/'.$subfolder.'/'.$imageName;
    }
}
