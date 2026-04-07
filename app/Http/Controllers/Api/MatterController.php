<?php

namespace App\Http\Controllers\Api;

use App\Events\MatrimonialProfileStatusChange;
use App\Http\Controllers\Controller;
use App\Http\Resources\MatterResource;
use App\Models\City;
use App\Models\CityMenu;
use App\Models\Matters\Matter;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class MatterController extends Controller
{
    public function index()
    {
        // Move with() before get()
        $matters = Matter::with('matterDetail', 'matterController')
            ->latest()
            ->get();

        return response()->json(['status' => true, 'data' => $matters], 200);
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

        $matters = Matter::create([
            'title' => $request->title,
            'type' => $request->type,
            'payload' => $payloadData,
        ]);

        $matters->adCreator()->create([
            'name' => $request->username ?? 'Mattermin',
            'contact' => $request->contact ?? null,
            'alternate_contact' => $request->alternate_contact ?? null,
            'whatsapp' => $request->whatsapp ?? null,
            'email' => $request->email ?? null,
        ]);

        $matters->adsDetails()->create([
            'category' => $request->category ?? 'Other',
            'gender' => $request->gender ?? 'other',
        ]);

        $matters->adController()->create([
            'is_premium' => $request->is_premium ?? false,
            'valid_until' => $request->valid_until ?? null,
        ]);

        // Load the adCreator relationship
        $matters->load('adCreator', 'adsDetails', 'adController');

        return response()->json(
            [
                'status' => true,
                'message' => 'Matter created successfully',
                'data' => $matters,
            ],
            201,
        );
    }

    public function createNewMatters(Request $request)
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
            $matters = DB::transaction(function () use ($request, $user) {
                $matters = Matter::create([
                    'user_id' => $user->id,
                    'title' => $request->title,
                    'type' => $request->type,
                    'payload' => $request->payload,
                ]);

                $matters->adCreator()->create([
                    'name' => $request->name ?? ($user->username ?? 'Mattermin'),
                    'contact' => $request->contact,
                    'alternate_contact' => $request->alternate_contact,
                    'whatsapp' => $request->whatsapp,
                    'email' => $request->email,
                ]);

                $matters->adsDetails()->create([
                    'category' => $request->category ?? 'Other',
                    'gender' => $request->gender ?? 'other',
                ]);

                $matters->adController()->create([
                    'is_premium' => $request->is_premium ?? false,
                    'valid_until' => $request->valid_until,
                ]);

                return $matters;
            });

            // 3. Load relationships and return
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Matter created successfully',
                    'data' => $matters->load(
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

    public function updateMatter(Request $request, Matter $matters)
    {
        $user = Auth::user();

        // 1. Authorization: Ensure the user owns this ad
        if ($matters->user_id !== $user->id) {
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
            DB::transaction(function () use ($request, $matters, $user) {
                // Update the main Matter record
                $matters->update([
                    'title' => $request->title,
                    // 'type' => $request->type,
                    'payload' => $request->payload,
                ]);

                // Update or Create MatterCreator (using updateOrCreate handles cases where the record might be missing)
                $matters->adCreator()->updateOrCreate(
                    ['ad_id' => $matters->id], // match criteria
                    [
                        'name' => $request->username ?? ($user->name ?? 'Mattermin'),
                        'contact' => $request->contact,
                        'alternate_contact' => $request->alternate_contact,
                        'whatsapp' => $request->whatsapp,
                        'email' => $request->email,
                    ],
                );

                // Update or Create MattersDetails
                // $matters->adsDetails()->updateOrCreate(
                //     ['ad_id' => $matters->id],
                //     [
                //         // 'category' => $request->category ?? 'Other',
                //         // 'gender' => $request->gender ?? 'other',
                //     ]
                // );

                // Update or Create MatterController
                $matters->adController()->updateOrCreate(
                    ['ad_id' => $matters->id],
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
                    'message' => 'Matter updated successfully',
                    'data' => $matters->load(
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

    public function changeMatterStatus(Request $request, Matter $matters)
    {
        $user = Auth::user();

        // 1. Authorization
        if ($matters->user_id !== $user->id) {
            return response()->json(
                ['status' => false, 'message' => 'Unauthorized'],
                403,
            );
        }

        // 2. Fetch the current status from the relationship
        // Assuming adController holds the status field
        $currentStatus = $matters->adController->status ?? null;

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
            DB::transaction(function () use ($request, $matters) {
                $matters->adController()->updateOrCreate(
                    ['ad_id' => $matters->id],
                    [
                        'status' => $request->status, // Use the validated request status
                    ],
                );
            });

            return response()->json(
                [
                    'status' => true,
                    'message' => 'Matter status updated successfully',
                    'data' => $matters->load('adController'),
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

    public function updateMatterProfileStatus(Request $request, Matter $matters)
    {
        $currentStatus = $matters->adController->status ?? null;

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
            DB::transaction(function () use ($request, $matters) {
                $matters->adController()->updateOrCreate(
                    ['ad_id' => $matters->id],
                    [
                        'status' => $request->status, // Use the validated request status
                    ],
                );
            });

            $this->sendStatusChangeAlert($matters->user_id, $request->status);

            return response()->json(
                [
                    'status' => true,
                    'message' => 'Matter status updated successfully',
                    'data' => $matters->load('adController'),
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

    public function deleteMatter(Matter $matters)
    {
        $user = Auth::user();

        // 1. Authorization: Ensure the user owns this ad
        // (Alternatively, you can use Laravel Policies for this)
        if ($matters->user_id !== $user->id) {
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
            DB::transaction(function () use ($matters) {
                // Delete related records first (if not using cascade delete in migration)
                $matters->adCreator()->delete();
                $matters->adsDetails()->delete();
                $matters->adController()->delete();

                // Finally, delete the main Matter record
                $matters->delete();
            });

            return response()->json(
                [
                    'status' => true,
                    'message' => 'Matter and all associated data deleted successfully',
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
        $matters = Matter::find($id);
        if (! $matters) {
            return response()->json(
                ['status' => false, 'message' => 'Matter not found'],
                404,
            );
        }

        return response()->json(['status' => true, 'data' => $matters], 200);
    }

    public function update(Request $request, $id)
    {
        $matters = Matter::find($id);
        if (! $matters) {
            return response()->json(
                ['status' => false, 'message' => 'Matter not found'],
                404,
            );
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'type' => 'sometimes|in:image,text',
            'payload' => 'sometimes|string',
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
            $matters->type = $request->type;
        }

        // Upload new Image
        if ($matters->type === 'image' && $request->hasFile('image')) {
            // 1. Delete Old Image if exists
            // We use getRawOriginal to get the database path (uploads/ads/...), not the full URL
            $oldImagePath = public_path($matters->getRawOriginal('payload'));

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
            $matters->forceFill(['payload' => 'uploads/ads/'.$filename]);
        }
        // Update Text
        elseif ($matters->type === 'text' && $request->has('payload')) {
            $matters->forceFill(['payload' => $request->payload]);
        }

        if ($request->has('title')) {
            $matters->title = $request->title;
        }

        $matters->save();

        return response()->json(
            [
                'status' => true,
                'message' => 'Matter updated successfully',
                'data' => $matters,
            ],
            200,
        );
    }

    public function destroy($id)
    {
        $matters = Matter::find($id);
        if (! $matters) {
            return response()->json(
                ['status' => false, 'message' => 'Matter not found'],
                404,
            );
        }

        // Delete Image File from Public Folder
        if ($matters->type === 'image') {
            $imagePath = public_path($matters->getRawOriginal('payload'));

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $matters->delete();

        return response()->json(
            ['status' => true, 'message' => 'Matter deleted successfully'],
            200,
        );
    }

    public function getMattersByMenuAndCity(Request $request, Menu $menu, City $city)
    {
        // 1. Check if the city is active (reuse your existing logic)
        if (! $city->isActiveInFlags()) {
            return response()->json(['message' => 'This specific city is inactive.'], 403);
        }

        // 2. Build the query
        $query = Matter::with(['matterDetail', 'matterController'])
            // Filter via the new pivot table 'city_menu_matter'
            ->whereHas('cityMenuMatter', function ($q) use ($menu, $city) {
                $q->where('city_menu_id', $menu->id)
                    ->where('matter_id', $city->id);
            })
            // Only show active controllers
            ->whereHas('matterController', function ($q) {
                $q->where('status', 'active');
            })
            ->latest();

        // 3. Handle Pagination
        $perPage = $request->input('per_page', 10);
        $matters = $query->paginate($perPage);

        // 4. Return standard response
        return response()->json([
            'status' => true,
            'count' => $matters->count(),
            'total' => $matters->total(),
            'current_page' => $matters->currentPage(),
            'last_page' => $matters->lastPage(),
            'data' => MatterResource::collection($matters->items()),
        ], 200);
    }

    public function getMattersByUser(Request $request, User $user)
    {
        // 1. Check if the user is active (reuse your existing logic)
        // if (! $user->isActiveInFlags()) {
        //     return response()->json(['message' => 'This specific user is inactive.'], 403);
        // }

        // 2. Build the query
        $query = Matter::with(['matterDetail', 'matterController'])
            ->where('user_id', $user->id)
            // Only show active controllers
            // ->whereHas('matterController', function ($q) {
            //     $q->where('status', 'active');
            // })
            ->latest();

        // 3. Handle Pagination
        $perPage = $request->input('per_page', 10);
        $matters = $query->paginate($perPage);

        // 4. Return standard response
        return response()->json([
            'status' => true,
            'count' => $matters->count(),
            'total' => $matters->total(),
            'current_page' => $matters->currentPage(),
            'last_page' => $matters->lastPage(),
            'data' => MatterResource::collection($matters->items()),
        ], 200);
    }

    public function getMyMatters(Request $request)
    {
        // 1. Check if the user is active (reuse your existing logic)
        // if (! $user->isActiveInFlags()) {
        //     return response()->json(['message' => 'This specific user is inactive.'], 403);
        // }

        $user = Auth::user();

        // 2. Build the query
        $query = Matter::with(['matterDetails', 'matterController'])
            ->where('user_id', $user->id)
            // Only show active controllers
            // ->whereHas('matterController', function ($q) {
            //     $q->where('status', 'active');
            // })
            ->latest();

        // 3. Handle Pagination
        $perPage = $request->input('per_page', 10);
        $matters = $query->paginate($perPage);

        // 4. Return standard response
        return response()->json([
            'status' => true,
            'count' => $matters->count(),
            'total' => $matters->total(),
            'current_page' => $matters->currentPage(),
            'last_page' => $matters->lastPage(),
            'data' => MatterResource::collection($matters->items()),
        ], 200);
    }

    public function destroyMyMatter(Matter $matter)
    {
        // Ensure the matter belongs to the authenticated user
        if ($matter->user_id !== Auth::id()) {
            return response()->json(['status' => false, 'message' => 'Unauthorized.'], 403);
        }

        $matter->delete();

        return response()->json([
            'status' => true,
            'message' => 'Matter deleted successfully.',
        ], 200);
    }

    public function getfeatueredMattersByCategory(
        Request $request,
        $category,
        $gender = '',
    ) {
        // 1. Start the query with eager loading
        $query = Matter::with([
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
        $matters = $query->paginate($perPage);

        // 5. Return paginated response
        return response()->json(
            [
                'status' => true,
                'count' => $matters->count(), // Items in current page
                'total' => $matters->total(), // Total items in database
                'current_page' => $matters->currentPage(),
                'last_page' => $matters->lastPage(),
                'data' => $matters->items(), // The actual list of ads
            ],
            200,
        );
    }

    // public function getMattersByCategory($category, $gender = '')
    // {
    //     // 1. Start the query with eager loading
    //     $query = Matter::with(['adsDetails', 'adCreator', 'adController'])->latest();

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
    //     $matters = $query->get();

    //     return response()->json([
    //         'status' => true,
    //         'count' => $matters->count(),
    //         'data' => $matters,
    //     ], 200);
    // }

    public function getMattersProfiles(Request $request)
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
        $query = Matter::with([
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
        $paginatedMatters = $query->paginate($perPage);

        // 4. Return formatted response
        return response()->json(
            [
                'status' => true,
                'count' => $paginatedMatters->total(),
                'data' => $paginatedMatters->items(), // Returns current page items
                'pagination' => [
                    'current_page' => $paginatedMatters->currentPage(),
                    'last_page' => $paginatedMatters->lastPage(),
                    'has_more' => $paginatedMatters->hasMorePages(),
                ],
            ],
            200,
        );
    }

    public function getMatters(Request $request)
    {
        // Start the query builder
        $query = Matter::with([
            'matterDetail',
            'matterController',
        ])->latest();

        $query->whereHas('matterController', function ($q) {
            $q->whereIn('status', ['active']);
        });

        // Execute query
        $matters = $query->get();

        return MatterResource::collection($matters);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        // 1. Improved Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required|in:image,text',
            'payload' => 'required|string',
            'name' => 'required|string',
            'category' => 'nullable|string',
            'contact' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'alternate_contact' => 'nullable|string',
            'gstin' => 'nullable|string',
            'duration_days' => 'nullable|integer|min:1',
            'base_amount' => 'nullable|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'processing_fee' => 'nullable|numeric|min:0',
            'gst_amount' => 'nullable|numeric|min:0',
            'total_amount' => 'nullable|numeric|min:0',
            'is_premium' => 'nullable|boolean',
            // 'valid_until' => 'nullable|date|after:today',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['status' => false, 'errors' => $validator->errors()],
                422,
            );
        }

        try {
            // 2. Use a Transaction to ensure all or nothing is saved
            $matter = DB::transaction(function () use ($request, $user) {
                $matter = Matter::create([
                    'user_id' => $user->id,
                    'title' => $request->title,
                    'type' => $request->type,
                    'payload' => $request->payload,
                ]);

                $matter->matterDetails()->create([
                    'phone' => $request->phone ?? null,
                    'website' => $request->website ?? null,
                ]);

                $matter->matterPricing()->create([
                    'duration_days' => $request->duration_days ?? 1,
                    'base_amount' => $request->base_amount ?? 0,
                    'discount_amount' => $request->discount_amount ?? 0,
                    'processing_fee' => $request->processing_fee ?? 0,
                    'gst_amount' => $request->gst_amount ?? 0,
                    'total_amount' => $request->total_amount ?? 0,
                    'payment_status' => 'pending',
                    'transaction_id' => $request->transaction_id ?? null,
                ]);

                $matter->matterController()->create([
                    'is_premium' => $request->is_premium ?? false,
                    'valid_until' => $request->valid_until ?? Date::now()->addDays($request->duration_days ?? 1), // Default to duration_days if not provided
                    'status' => 'pending', // Default status
                ]);

                return $matter;
            });

            // 3. Load relationships and return
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Matter created successfully',
                    'data' => $matter->load(
                        'matterCreator',
                        'matterDetail',
                        'matterPricing',
                        'matterController',
                    ),
                ],
                201,
            );
        } catch (\Exception $e) {
            // Handle database errors
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Failed to create matter. Please try again.',
                    'error' => $e->getMessage(), // Remove this in production
                ],
                500,
            );
        }
    }

    public function createWithCityAndMenu(Request $request, City $city, Menu $menu)
    {
        $user = Auth::user();

        // 1. Improved Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required|in:image,text',
            'payload' => 'required|string',
            'name' => 'required|string',
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
            $matter = DB::transaction(function () use ($request, $user, $menu, $city) {
                $matter = Matter::create([
                    'user_id' => $user->id,
                    'title' => $request->title,
                    'type' => $request->type,
                    'payload' => $request->payload,
                ]);

                $matter->matterDetails()->create([
                    'phone' => $request->phone ?? null,
                    'website' => $request->website ?? null,
                ]);

                $matter->matterController()->create([
                    'is_premium' => $request->is_premium ?? false,
                    'valid_until' => $request->valid_until ?? Date::now()->addDays(30), // Default to 30 days if not provided
                    'status' => 'pending', // Default status
                ]);

                $cityMenu = CityMenu::firstOrCreate([
                    'menu_id' => $menu->id,
                    'city_id' => $city->id,
                ]);

                $matter->cityMenuMatter()->create([
                    'city_menu_id' => $cityMenu->id
                ]);

                return $matter;
            });

            // 3. Load relationships and return
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Matter created successfully',
                    'data' => $matter->load(
                        'matterCreator',
                        'matterDetail',
                        'matterController',
                    ),
                ],
                201,
            );
        } catch (\Exception $e) {
            // Handle database errors
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Failed to create matter. Please try again.',
                    'error' => $e->getMessage(), // Remove this in production
                ],
                500,
            );
        }
    }

    // all the ads created by Users

    // public function myMatters(Request $request)
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
    //     $matters = Matter::with(['adsDetails', 'adCreator', 'adController'])
    //         ->where('user_id', $user->id)
    //         ->latest()
    //         ->get();

    //     return response()->json([
    //         'status' => true,
    //         'data' => $matters,
    //     ], 200);
    // }
    public function myMatters(Request $request)
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

        $matters = Matter::with(['adsDetails', 'adCreator', 'adController'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate($perPage);

        // Laravel's Paginate object already puts the items inside a 'data' key
        // when converted to JSON, along with meta information like total, current_page, etc.
        return response()->json(
            [
                'status' => true,
                'data' => $matters->items(), // Returns just the array of ads for your Flutter list
                'meta' => [
                    'current_page' => $matters->currentPage(),
                    'last_page' => $matters->lastPage(),
                    'total' => $matters->total(),
                    'has_more' => $matters->hasMorePages(),
                ],
            ],
            200,
        );
    }
}