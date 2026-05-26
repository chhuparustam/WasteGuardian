<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait HandlesFileUploads
{
    /**
     * Store uploaded file to storage
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @param string $disk
     * @return string The stored file path
     */
    protected function storeFile($file, $directory, $disk = 'public')
    {
        return $file->store($directory, $disk);
    }

    /**
     * Handle profile picture upload
     *
     * @param Request $request
     * @param string $fieldName
     * @param string $directory
     * @return string|null The stored file path or null
     */
    protected function handleProfilePictureUpload(Request $request, $fieldName = 'profile_picture', $directory = 'profile-pictures')
    {
        if ($request->hasFile($fieldName)) {
            return $this->storeFile($request->file($fieldName), $directory);
        }

        return null;
    }

    /**
     * Handle image upload with custom naming
     *
     * @param Request $request
     * @param string $fieldName
     * @param string $directory
     * @return string|null
     */
    protected function handleImageUpload(Request $request, $fieldName = 'image', $directory = 'images')
    {
        if ($request->hasFile($fieldName)) {
            return $this->storeFile($request->file($fieldName), $directory);
        }

        return null;
    }

    /**
     * Delete file from storage
     *
     * @param string $path
     * @param string $disk
     * @return bool
     */
    protected function deleteFile($path, $disk = 'public')
    {
        if ($path && Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->delete($path);
        }

        return false;
    }
}
