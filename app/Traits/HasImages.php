<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

trait HasImages
{
    public static function bootHasImages()
    {
        static::forceDeleting(function ($model) {
            $model->deleteAllImagesOnDelete();
        });
    }

    protected function deleteAllImagesOnDelete()
    {
        $images = Image::where('imageable_type', get_class($this))
            ->where('imageable_id', $this->id)
            ->get();

        foreach ($images as $image) {
            if (Storage::disk($image->disk)->exists($image->path)) {
                Storage::disk($image->disk)->delete($image->path);
            }
            $image->delete();
        }
    }
}
