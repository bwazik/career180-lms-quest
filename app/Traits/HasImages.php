<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

trait HasImages
{
    public static function bootHasImages()
    {
        static::forceDeleting(function ($model) {
            $model->deleteAllImagesOnDelete();
        });
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    protected function deleteAllImagesOnDelete()
    {
        $images = $this->images()->get();

        foreach ($images as $image) {
            if (Storage::disk($image->disk)->exists($image->path)) {
                Storage::disk($image->disk)->delete($image->path);
            }
            $image->delete();
        }
    }
}
