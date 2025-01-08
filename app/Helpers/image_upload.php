<?php

use App\Models\File;

if (!function_exists('uploadImage')) {
    /**
     * Upload an image to the specified storage path.
     *
     * @param \Illuminate\Http\UploadedFile $image
     * @param string $path
     * @return string|bool
     */
    function uploadImage($image, $path = 'uploads/images', $fileAbleType=null, $fileAbleId=null)
    {
        try {

            $path = rtrim($path, '/');

            $filename = uniqid() .'_'.time(). '.' . $image->getClientOriginalExtension();


            $image->move(public_path($path), $filename);
            $routePath = "$path/$filename";
            if($fileAbleType)
            {
                File::create([
                    'fileable_type'=> $fileAbleType,
                    'fileable_id'=> $fileAbleId,
                    'value'=> $routePath,
                ]);
            }

            return "$path/$filename";
        } catch (\Exception $e) {
            // Log the error for debugging
           \Log::error("Image upload failed: " . $e->getMessage());
            return false;
        }
    }
}
