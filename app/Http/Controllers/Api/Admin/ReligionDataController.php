<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReligionCasteRequest;
use App\Http\Requests\StoreReligionRequest;
use App\Http\Resources\DropDownResource;
use App\Models\Caste;
use App\Models\Religion;
use App\Traits\ApiResponse; // Import the Trait
use Illuminate\Http\Request;

class ReligionDataController extends Controller
{
    use ApiResponse; // Use the Trait

    /**
     * Get all religions.
     * GET /api/v1/religions
     */
    public function allReligions()
    {
        $religions = Religion::orderBy('name')->get();

        return $this->successResponse(
            DropDownResource::collection($religions),
            'Religions fetched successfully'
        );
    }

    /**
     * Get all castes for a specific religion.
     * GET /api/v1/religions/{religion}/castes
     */
    public function castesForReligion(Religion $religion)
    {
        // The $religion variable is automatically fetched thanks to Route-Model binding
        $castes = $religion->castes()->orderBy('name')->get();

        return $this->successResponse(
            DropDownResource::collection($castes),
            'Castes fetched successfully'
        );
    }

    // ADMIN ONLY METHODS

    public function storeReligion(StoreReligionRequest $request)
    {
        // Request is already validated
        $religion = Religion::create($request->validated());

        return $this->successResponse(
            new DropDownResource($religion),
            'Religion created successfully',
            201 // HTTP Status Created
        );
    }

    public function storeCaste(StoreReligionCasteRequest $request, Religion $religion)
    {
        // Fix: Assign the validated data to a variable
        $validated = $request->validated();

        $caste = Caste::create([
            'religion_id' => $religion->id,
            'name' => $validated['name'],
        ]);

        return $this->successResponse(
            new DropDownResource($caste),
            'Caste created successfully',
            201 // HTTP Status Created
        );
    }
}
