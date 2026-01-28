<?php

namespace App\Http\Controllers\Api;

use App\Events\MatrimonialProfileStatusChange;
use App\Http\Controllers\Controller;
use App\Models\Ads\Ad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AdController extends Controller
{
    public function index()
    {
        // Move with() before get()
        $ads = Ad::with('adsDetails', 'adCreator', 'adController')
            ->latest()
            ->get();

        return response()->json(['status' => true, 'data' => $ads], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required|in:image,text',
            'payload' => $request->type == 'text' ? 'required|string' : 'nullable',
            'image' => $request->type == 'image'
                    ? 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
                    : 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['status' => false, 'errors' => $validator->errors()],
                422,
            );
        }

        $payloadData = '';

        // Handle Image Upload (Direct to public folder)
        if ($request->type === 'image' && $request->hasFile('image')) {
            $file = $request->file('image');
            // Create a unique filename
            $filename = time().'_'.$file->getClientOriginalName();

            // Define the path: public/uploads/ads
            $destinationPath = public_path('uploads/ads');

            // Ensure directory exists (optional, but good practice)
            if (! File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // Move the file
            $file->move($destinationPath, $filename);

            // Store relative path in DB (e.g., "uploads/ads/123_image.jpg")
            $payloadData = 'uploads/ads/'.$filename;
        } else {
            $payloadData = $request->payload;
        }

        $ad = Ad::create([
            'title' => $request->title,
            'type' => $request->type,
            'payload' => $payloadData,
        ]);

        $ad->adCreator()->create([
            'name' => $request->username ?? 'Admin',
            'contact' => $request->contact ?? null,
            'alternate_contact' => $request->alternate_contact ?? null,
            'whatsapp' => $request->whatsapp ?? null,
            'email' => $request->email ?? null,
        ]);

        $ad->adsDetails()->create([
            'category' => $request->category ?? 'Other',
            'gender' => $request->gender ?? 'other',
        ]);

        $ad->adController()->create([
            'is_premium' => $request->is_premium ?? false,
            'valid_until' => $request->valid_until ?? null,
        ]);

        // Load the adCreator relationship
        $ad->load('adCreator', 'adsDetails', 'adController');

        return response()->json(
            [
                'status' => true,
                'message' => 'Ad created successfully',
                'data' => $ad,
            ],
            201,
        );
    }

    public function createNewAds(Request $request)
    {
        $user = Auth::user();

        // 1. Improved Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required|in:image,text',
            'payload' => 'required|string',
            'name' => 'required|string',
            'category' => 'nullable|string',
            'gender' => 'nullable|in:male,Male,Female,female,other',
            'is_premium' => 'nullable|boolean',
            'valid_until' => 'nullable|date|after:today',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['status' => false, 'errors' => $validator->errors()],
                422,
            );
        }

        try {
            // 2. Use a Transaction to ensure all or nothing is saved
            $ad = DB::transaction(function () use ($request, $user) {
                $ad = Ad::create([
                    'user_id' => $user->id,
                    'title' => $request->title,
                    'type' => $request->type,
                    'payload' => $request->payload,
                ]);

                $ad->adCreator()->create([
                    'name' => $request->name ?? ($user->username ?? 'Admin'),
                    'contact' => $request->contact,
                    'alternate_contact' => $request->alternate_contact,
                    'whatsapp' => $request->whatsapp,
                    'email' => $request->email,
                ]);

                $ad->adsDetails()->create([
                    'category' => $request->category ?? 'Other',
                    'gender' => $request->gender ?? 'other',
                ]);

                $ad->adController()->create([
                    'is_premium' => $request->is_premium ?? false,
                    'valid_until' => $request->valid_until,
                ]);

                return $ad;
            });

            // 3. Load relationships and return
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Ad created successfully',
                    'data' => $ad->load(
                        'adCreator',
                        'adsDetails',
                        'adController',
                    ),
                ],
                201,
            );
        } catch (\Exception $e) {
            // Handle database errors
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Failed to create ad. Please try again.',
                    'error' => $e->getMessage(), // Remove this in production
                ],
                500,
            );
        }
    }

    public function updateAd(Request $request, Ad $ad)
    {
        $user = Auth::user();

        // 1. Authorization: Ensure the user owns this ad
        if ($ad->user_id !== $user->id) {
            return response()->json(
                ['status' => false, 'message' => 'Unauthorized'],
                403,
            );
        }

        // 2. Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            // 'type' => 'required|in:image,text',
            'payload' => 'required|string',
            // 'category' => 'nullable|string',
            // 'gender' => 'nullable|in:male,Male,Female,female,other',
            'is_premium' => 'nullable|boolean',
            'valid_until' => 'nullable|date|after:today',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['status' => false, 'errors' => $validator->errors()],
                422,
            );
        }

        try {
            // 3. Use a Transaction
            DB::transaction(function () use ($request, $ad, $user) {
                // Update the main Ad record
                $ad->update([
                    'title' => $request->title,
                    // 'type' => $request->type,
                    'payload' => $request->payload,
                ]);

                // Update or Create AdCreator (using updateOrCreate handles cases where the record might be missing)
                $ad->adCreator()->updateOrCreate(
                    ['ad_id' => $ad->id], // match criteria
                    [
                        'name' => $request->username ?? ($user->name ?? 'Admin'),
                        'contact' => $request->contact,
                        'alternate_contact' => $request->alternate_contact,
                        'whatsapp' => $request->whatsapp,
                        'email' => $request->email,
                    ],
                );

                // Update or Create AdsDetails
                // $ad->adsDetails()->updateOrCreate(
                //     ['ad_id' => $ad->id],
                //     [
                //         // 'category' => $request->category ?? 'Other',
                //         // 'gender' => $request->gender ?? 'other',
                //     ]
                // );

                // Update or Create AdController
                $ad->adController()->updateOrCreate(
                    ['ad_id' => $ad->id],
                    [
                        'status' => 'pending',
                        // 'is_premium' => $request->is_premium ?? false,
                        // 'valid_until' => $request->valid_until,
                    ],
                );
            });

            // 4. Return the updated ad with relationships
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Ad updated successfully',
                    'data' => $ad->load(
                        'adCreator',
                        'adsDetails',
                        'adController',
                    ),
                ],
                200,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Failed to update ad.',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function changeAdStatus(Request $request, Ad $ad)
    {
        $user = Auth::user();

        // 1. Authorization
        if ($ad->user_id !== $user->id) {
            return response()->json(
                ['status' => false, 'message' => 'Unauthorized'],
                403,
            );
        }

        // 2. Fetch the current status from the relationship
        // Assuming adController holds the status field
        $currentStatus = $ad->adController->status ?? null;

        // 3. Status Guard: Only allow changes if current status is active or inactive
        $allowedCurrentStatuses = ['active', 'inactive'];

        if (! in_array($currentStatus, $allowedCurrentStatuses)) {
            return response()->json(
                [
                    'status' => false,
                    'message' => "Status cannot be changed because current status is '{$currentStatus}'.",
                ],
                422,
            );
        }

        // 4. Validation for the New Status
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['status' => false, 'errors' => $validator->errors()],
                422,
            );
        }

        try {
            DB::transaction(function () use ($request, $ad) {
                $ad->adController()->updateOrCreate(
                    ['ad_id' => $ad->id],
                    [
                        'status' => $request->status, // Use the validated request status
                    ],
                );
            });

            return response()->json(
                [
                    'status' => true,
                    'message' => 'Ad status updated successfully',
                    'data' => $ad->load('adController'),
                ],
                200,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Failed to update status.',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function updateAdProfileStatus(Request $request, Ad $ad)
    {
        $currentStatus = $ad->adController->status ?? null;

        // 3. Status Guard: Only allow changes if current status is active or inactive
        $allowedCurrentStatuses = [
            'active',
            'inactive',
            'hold',
            'pending',
            'rejected',
            'block',
            'hold',
        ];

        if (! in_array($currentStatus, $allowedCurrentStatuses)) {
            return response()->json(
                [
                    'status' => false,
                    'message' => "Status cannot be changed because current status is '{$currentStatus}'.",
                ],
                422,
            );
        }

        // 4. Validation for the New Status
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:active,inactive,hold,pending,rejected,block',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['status' => false, 'errors' => $validator->errors()],
                422,
            );
        }

        try {
            DB::transaction(function () use ($request, $ad) {
                $ad->adController()->updateOrCreate(
                    ['ad_id' => $ad->id],
                    [
                        'status' => $request->status, // Use the validated request status
                    ],
                );
            });

            $this->sendStatusChangeAlert($ad->user_id, $request->status);

            return response()->json(
                [
                    'status' => true,
                    'message' => 'Ad status updated successfully',
                    'data' => $ad->load('adController'),
                ],
                200,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Failed to update status.',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    protected function sendStatusChangeAlert($userId, $status)
    {
        $user = User::find($userId);

        if (! $user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        event(new MatrimonialProfileStatusChange($user, $status));

        return response()->json([
            'success' => true,
            'message' => 'Profile status changed and notification queued.',
        ]);
    }

    public function deleteAd(Ad $ad)
    {
        $user = Auth::user();

        // 1. Authorization: Ensure the user owns this ad
        // (Alternatively, you can use Laravel Policies for this)
        if ($ad->user_id !== $user->id) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Unauthorized',
                ],
                403,
            );
        }

        try {
            // 2. Use a Transaction to ensure all related data is wiped
            DB::transaction(function () use ($ad) {
                // Delete related records first (if not using cascade delete in migration)
                $ad->adCreator()->delete();
                $ad->adsDetails()->delete();
                $ad->adController()->delete();

                // Finally, delete the main Ad record
                $ad->delete();
            });

            return response()->json(
                [
                    'status' => true,
                    'message' => 'Ad and all associated data deleted successfully',
                ],
                200,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Failed to delete ad.',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function show($id)
    {
        $ad = Ad::find($id);
        if (! $ad) {
            return response()->json(
                ['status' => false, 'message' => 'Ad not found'],
                404,
            );
        }

        return response()->json(['status' => true, 'data' => $ad], 200);
    }

    public function update(Request $request, $id)
    {
        $ad = Ad::find($id);
        if (! $ad) {
            return response()->json(
                ['status' => false, 'message' => 'Ad not found'],
                404,
            );
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'type' => 'sometimes|in:image,text',
            'payload' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['status' => false, 'errors' => $validator->errors()],
                422,
            );
        }

        // Logic to update Payload
        if ($request->has('type')) {
            $ad->type = $request->type;
        }

        // Upload new Image
        if ($ad->type === 'image' && $request->hasFile('image')) {
            // 1. Delete Old Image if exists
            // We use getRawOriginal to get the database path (uploads/ads/...), not the full URL
            $oldImagePath = public_path($ad->getRawOriginal('payload'));

            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // 2. Upload New Image
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $destinationPath = public_path('uploads/ads');

            if (! File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            $ad->payload = 'uploads/ads/'.$filename;
        }
        // Update Text
        elseif ($ad->type === 'text' && $request->has('payload')) {
            $ad->payload = $request->payload;
        }

        if ($request->has('title')) {
            $ad->title = $request->title;
        }

        $ad->save();

        return response()->json(
            [
                'status' => true,
                'message' => 'Ad updated successfully',
                'data' => $ad,
            ],
            200,
        );
    }

    public function destroy($id)
    {
        $ad = Ad::find($id);
        if (! $ad) {
            return response()->json(
                ['status' => false, 'message' => 'Ad not found'],
                404,
            );
        }

        // Delete Image File from Public Folder
        if ($ad->type === 'image') {
            $imagePath = public_path($ad->getRawOriginal('payload'));

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $ad->delete();

        return response()->json(
            ['status' => true, 'message' => 'Ad deleted successfully'],
            200,
        );
    }

    public function getAdsByCategory(Request $request, $category, $gender = '')
    {
        // 1. Start the query with eager loading
        $query = Ad::with([
            'adsDetails',
            'adCreator',
            'adController',
        ])->latest();

        // 2. Filter by Category and Gender
        if (($category && strtolower($category) !== 'all') || ! empty($gender)) {
            $query->whereHas('adsDetails', function ($q) use (
                $category,
                $gender,
            ) {
                if ($category && strtolower($category) !== 'all') {
                    $q->where('category', $category);
                }
                if (! empty($gender)) {
                    $q->where('gender', $gender);
                }
            });
        }

        // 3. Only show active ads
        $query->whereHas('adController', function ($q) {
            $q->where('status', 'active');
        });

        // 4. Use paginate instead of get()
        // Default to 10 items per page to match your Flutter logic
        $perPage = $request->input('per_page', 10);
        $ads = $query->paginate($perPage);

        // 5. Return paginated response
        return response()->json(
            [
                'status' => true,
                'count' => $ads->count(), // Items in current page
                'total' => $ads->total(), // Total items in database
                'current_page' => $ads->currentPage(),
                'last_page' => $ads->lastPage(),
                'data' => $ads->items(), // The actual list of ads
            ],
            200,
        );
    }

    public function getfeatueredAdsByCategory(
        Request $request,
        $category,
        $gender = '',
    ) {
        // 1. Start the query with eager loading
        $query = Ad::with([
            'adsDetails',
            'adCreator',
            'adController',
            'adFeatured',
        ])->latest();

        // 2. Filter by Category and Gender
        if (($category && strtolower($category) !== 'all') || ! empty($gender)) {
            $query->whereHas('adsDetails', function ($q) use (
                $category,
                $gender,
            ) {
                if ($category && strtolower($category) !== 'all') {
                    $q->where('category', $category);
                }
                if (! empty($gender)) {
                    $q->where('gender', $gender);
                }
            });
        }

        // 3. Only show active ads
        $query->whereHas('adController', function ($q) {
            $q->where('status', 'active');
        });

        $query->whereHas('adFeatured', function ($q) {
            // You can add additional filters here if needed
        });

        // 4. Use paginate instead of get()
        // Default to 10 items per page to match your Flutter logic
        $perPage = $request->input('per_page', 10);
        $ads = $query->paginate($perPage);

        // 5. Return paginated response
        return response()->json(
            [
                'status' => true,
                'count' => $ads->count(), // Items in current page
                'total' => $ads->total(), // Total items in database
                'current_page' => $ads->currentPage(),
                'last_page' => $ads->lastPage(),
                'data' => $ads->items(), // The actual list of ads
            ],
            200,
        );
    }

    // public function getAdsByCategory($category, $gender = '')
    // {
    //     // 1. Start the query with eager loading
    //     $query = Ad::with(['adsDetails', 'adCreator', 'adController'])->latest();

    //     // 2. Filter by Category and Gender using a single whereHas for performance
    //     // We check if either variable has a valid value
    //     if (($category && strtolower($category) !== 'all') || ! empty($gender)) {
    //         $query->whereHas('adsDetails', function ($q) use ($category, $gender) {

    //             // Apply category filter if it's not 'all'
    //             if ($category && strtolower($category) !== 'all') {
    //                 $q->where('category', $category);
    //             }

    //             // Apply gender filter only if a value is provided
    //             if (! empty($gender)) {
    //                 $q->where('gender', $gender);
    //             }
    //         });
    //     }
    //     $query->whereHas('adController', function ($q) {
    //         $q->whereIn('status', ['active']);
    //     });
    //     // 3. Execute and return
    //     $ads = $query->get();

    //     return response()->json([
    //         'status' => true,
    //         'count' => $ads->count(),
    //         'data' => $ads,
    //     ], 200);
    // }

    public function getAdsProfiles(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['status' => false, 'errors' => $validator->errors()],
                422,
            );
        }

        // 1. Start Query
        $query = Ad::with([
            'adsDetails',
            'adCreator',
            'adController',
        ])->latest();

        $status = strtolower($request->status);

        // 2. Apply Filters
        if ($status && $status !== 'all') {
            $query->whereHas('adController', function ($q) use ($status) {
                if ($status == 'approved') {
                    $q->whereIn('status', ['active', 'inactive']);
                } else {
                    $q->where('status', $status);
                }
            });
        }

        // 3. Paginate
        // Laravel will automatically detect 'page' from the POST body or Query String
        $perPage = 15;
        $paginatedAds = $query->paginate($perPage);

        // 4. Return formatted response
        return response()->json(
            [
                'status' => true,
                'count' => $paginatedAds->total(),
                'data' => $paginatedAds->items(), // Returns current page items
                'pagination' => [
                    'current_page' => $paginatedAds->currentPage(),
                    'last_page' => $paginatedAds->lastPage(),
                    'has_more' => $paginatedAds->hasMorePages(),
                ],
            ],
            200,
        );
    }

    public function getAds(Request $request)
    {
        // Start the query builder
        $query = Ad::with([
            'adsDetails',
            'adCreator',
            'adController',
        ])->latest();

        $query->whereHas('adController', function ($q) {
            $q->whereIn('status', ['active']);
        });

        // Execute query
        $ads = $query->get();

        return response()->json(['status' => true, 'data' => $ads], 200);
    }
    // all the ads created by Users

    // public function myAds(Request $request)
    // {
    //     $user = Auth::user();

    //     // 1. Check if user is authenticated
    //     if (! $user) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Unauthorized',
    //         ], 401); // 401 is more appropriate for "Unauthenticated"
    //     }

    //     // 2. Query ads belonging to the user
    //     // Replace 'user_id' with whatever your foreign key column is named
    //     $ads = Ad::with(['adsDetails', 'adCreator', 'adController'])
    //         ->where('user_id', $user->id)
    //         ->latest()
    //         ->get();

    //     return response()->json([
    //         'status' => true,
    //         'data' => $ads,
    //     ], 200);
    // }
    public function myAds(Request $request)
    {
        $user = Auth::user();

        // 1. Check if user is authenticated
        if (! $user) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Unauthorized',
                ],
                401,
            );
        }

        // 2. Use paginate() instead of get()
        // You can set the number of items per page (e.g., 10 or 15)
        $perPage = $request->query('per_page', 10);

        $ads = Ad::with(['adsDetails', 'adCreator', 'adController'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate($perPage);

        // Laravel's Paginate object already puts the items inside a 'data' key
        // when converted to JSON, along with meta information like total, current_page, etc.
        return response()->json(
            [
                'status' => true,
                'data' => $ads->items(), // Returns just the array of ads for your Flutter list
                'meta' => [
                    'current_page' => $ads->currentPage(),
                    'last_page' => $ads->lastPage(),
                    'total' => $ads->total(),
                    'has_more' => $ads->hasMorePages(),
                ],
            ],
            200,
        );
    }
}
