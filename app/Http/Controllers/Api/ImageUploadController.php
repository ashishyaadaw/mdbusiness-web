<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ImageUploadController extends Controller
{
    /**
     * Handles the image upload API request.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
{
    // 1. Validate incoming request (allowing up to 2MB initially)
    $validator = Validator::make($request->all(), [
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    if ($request->hasFile('image')) {
        try {
            $file = $request->file('image');
            
            // Force the extension to .jpg for consistent compression
            $imageName = time() . '.jpg'; 

            // 2. Initialize Intervention Image Manager using the GD driver
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);

            // Optional but recommended: Scale down huge images to a max width (e.g., 1200px) 
            // This maintains aspect ratio and helps massively with file size reduction.
            $image->scaleDown(width: 1200);

            // 3. Dynamically compress to ensure the file is under 300 KB (307,200 bytes)
            $quality = 90;
            $encoded = $image->toJpeg($quality);
            
            while (strlen($encoded->toString()) > 307200 && $quality > 10) {
                $quality -= 10; // Drop quality by 10% in each loop
                $encoded = $image->toJpeg($quality);
            }

            // 4. Ensure the destination directory exists
            $directory = public_path('images');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            // 5. Save the compressed image
            $path = $directory . '/' . $imageName;
            $encoded->save($path);

            // 6. Generate the correct URL
            $url = asset('images/' . $imageName);

            return response()->json([
                'success' => true,
                'message' => 'Image compressed and uploaded successfully.',
                'url' => $url,
                'path' => $path,
                'final_size_kb' => round(filesize($path) / 1024, 2) . ' KB' // Added to verify size
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during the image upload.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    return response()->json([
        'success' => false,
        'message' => 'Image file not found in the request.'
    ], 400);
}

//     public function store(Request $request)
//     {
//         // 1. Validate the incoming request.
//         // The 'image' field is required, must be an image file,
//         // and should not exceed 2MB (2048 kilobytes).
//         $validator = Validator::make($request->all(), [
//             'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//         ]);

//         // If validation fails, return an error response.
//         if ($validator->fails()) {
//             return response()->json(['error' => $validator->errors()], 400);
//         }

//         // 2. Check if a file is present in the request.
//         if ($request->hasFile('image')) {
//             try {
//                 $image = $request->file('image');

//                 // 3. Generate a unique name for the image to prevent overwrites.
//                 // We use the current timestamp and the file's original extension.
//                 $imageName = time() . '.' . $image->getClientOriginalExtension();

//                 // 4. Store the image in the 'public' disk.
//                 // This will store the file in 'storage/app/public/images'.
//                 // The 'storeAs' method takes the directory, filename, and disk.
//                 // $path = $image->storeAs('images', $imageName, 'public');
//                 // 5. Generate the public URL for the stored image.
//                 // $url = Storage::disk('public')->url($path);

//                 // Less security
// // Move the file to public/images
//                 $path = $image->move(public_path('images'), $imageName);

//                 // Generate the correct URL using the asset() helper
//                 $url = asset('images/' . $imageName);

//                 // 6. Return a successful JSON response.
//                 // We include the path and the public URL for the client to use.
//                 return response()->json([
//                     'success' => true,
//                     'message' => 'Image uploaded successfully.',
//                     'url' => $url,
//                     'path' => $path,
//                 ], 201);

//             } catch (\Exception $e) {
//                 // If any exception occurs during the upload, return a server error.
//                 return response()->json([
//                     'success' => false,
//                     'message' => 'An error occurred during the image upload.',
//                     'error' => $e->getMessage()
//                 ], 500);
//             }
//         }

//         // If no image file is found in the request, return an error.
//         return response()->json([
//             'success' => false,
//             'message' => 'Image file not found in the request.'
//         ], 400);
//     }
    public function storeUserProfile(Request $request, $profile_id)
    {
        // 1. Validate the incoming request.
        // The 'image' field is required, must be an image file,
        // and should not exceed 2MB (2048 kilobytes).
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // If validation fails, return an error response.
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // 2. Check if a file is present in the request.
        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');

                // 3. Generate a unique name for the image to prevent overwrites.
                // We use the current timestamp and the file's original extension.
                // $imageName = $profile_id . '.' . $image->getClientOriginalExtension();
                $imageName = $profile_id . '.' . 'jpg';

                // 4. Store the image in the 'public' disk.
                // This will store the file in 'storage/app/public/images'.
                // The 'storeAs' method takes the directory, filename, and disk.
                // $path = $image->storeAs('images', $imageName, 'public');
                // 5. Generate the public URL for the stored image.
                // $url = Storage::disk('public')->url($path);

                // Less security
// Move the file to public/images
                $path = $image->move(public_path('images/matrimonial/profile/'), $imageName);

                // Generate the correct URL using the asset() helper
                $url = asset('images/matrimonial/profile/' . $imageName);

                // 6. Return a successful JSON response.
                // We include the path and the public URL for the client to use.
                return response()->json([
                    'success' => true,
                    'message' => 'Image uploaded successfully.',
                    'url' => $url,
                    'path' => 'images/matrimonial/profile/' . $imageName,
                ], 201);

            } catch (\Exception $e) {
                // If any exception occurs during the upload, return a server error.
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred during the image upload.',
                    'error' => $e->getMessage()
                ], 500);
            }
        }

        // If no image file is found in the request, return an error.
        return response()->json([
            'success' => false,
            'message' => 'Image file not found in the request.'
        ], 400);
    }
    public function uploadEducationalImage(Request $request)
    {
        // Define the validation rules
        $rules = [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        // Define the custom error messages 💡
        $messages = [
            'image.required' => 'Please upload an Image.',
            'image.image' => 'Please upload a valid Photograph.',
            'image.mimes' => 'Please upload image with valid format jpeg, jpg, png, gif, svg.',
            'image.max' => 'Image file size of maximum 2 MB .',
        ];

        // Create the validator instance
        $validator = Validator::make($request->all(), $rules, $messages);

        // 1. Validate the incoming request.
        // The 'image' field is required, must be an image file,
        // and should not exceed 2MB (2048 kilobytes).
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, return an error response.
        if ($validator->fails()) {
            // return response()->json(['error' => $validator->errors()], 400);
            return back()->with('error_message', 'Sorry Upload Failed!');
        }

        // 2. Check if a file is present in the request.
        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');

                // 3. Generate a unique name for the image to prevent overwrites.
                // We use the current timestamp and the file's original extension.
                // $imageName = $profile_id . '.' . $image->getClientOriginalExtension();
                $imageName = Str::random(20) . time() . '.' . 'jpg';

                // 4. Store the image in the 'public' disk.
                // This will store the file in 'storage/app/public/images'.
                // The 'storeAs' method takes the directory, filename, and disk.
                // $path = $image->storeAs('images', $imageName, 'public');
                // 5. Generate the public URL for the stored image.
                // $url = Storage::disk('public')->url($path);

                // Less security
// Move the file to public/images
                $path = $image->move(public_path('images/educational-hub/'), $imageName);

                // Generate the correct URL using the asset() helper
                $url = asset('images/educational-hub/' . $imageName);

                // 6. Return a successful JSON response.
                // We include the path and the public URL for the client to use.
                // return response()->json([
                //     'success' => true,
                //     'message' => 'Image uploaded successfully.',
                //     'url' => $url,
                //     'path' => 'images/educational-hub/' . $imageName,
                // ], 201);


                return back()->with('success_message', 'Successfully uploaded!')->with('image_url', $url);

            } catch (\Exception $e) {
                // If any exception occurs during the upload, return a server error.
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred during the image upload.',
                    'error' => $e->getMessage()
                ], 500);
            }
        }

        // If no image file is found in the request, return an error.
        return response()->json([
            'success' => false,
            'message' => 'Image file not found in the request.'
        ], 400);
    }


}