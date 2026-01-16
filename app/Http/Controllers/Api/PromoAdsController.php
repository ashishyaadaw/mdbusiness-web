<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PromoAd;
use Illuminate\Http\Request;

class PromoAdsController extends Controller
{
    public function show($ad_id)
    {
        $ad = PromoAd::where('ad_id', $ad_id)
            ->where('is_active', true)
            ->first();
        if (!$ad) {
            return response()->json(['message' => 'Ad not found'], 404);
        }

        // Mapping to match the Flutter AdResponse model
        return response()->json([
            'id' => $ad->ad_id,
            'type' => $ad->type,
            'title' => $ad->title,
            'body' => $ad->body,
            'images' => $ad->images ?? [],
            'actionText' => $ad->action_text,
            'targetUrl' => $ad->target_url,
        ]);
    }
    // 1. CREATE (Store)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ad_id' => 'required|unique:ads,ad_id',
            'type' => 'required|in:slider,banner,native,video',
            'title' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'images' => 'nullable|array',
            'action_text' => 'nullable|string',
            'target_url' => 'nullable|url',
        ]);

        $ad = PromoAd::create($validated);

        return response()->json($ad, 201); // 201 Created
    }

    // 2. UPDATE
    public function update(Request $request, $ad_id)
    {
        // Find by your custom ad_id instead of database primary key
        $ad = PromoAd::where('ad_id', $ad_id)->firstOrFail();

        $validated = $request->validate([
            'type' => 'sometimes|in:slider,banner,native,video',
            'title' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'images' => 'nullable|array',
            'action_text' => 'nullable|string',
            'target_url' => 'nullable|url',
        ]);

        $ad->update($validated);

        return response()->json($ad);
    }

    // 3. DELETE (Destroy)
    public function destroy($ad_id)
    {
        $ad = PromoAd::where('ad_id', $ad_id)->firstOrFail();
        $ad->delete();

        return response()->json(['message' => 'Ad deleted successfully'], 200);
    }
}
