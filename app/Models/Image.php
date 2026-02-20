<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Image extends Model
{
    protected $fillable = [
        'imageable_type',
        'imageable_id',
        'path',
        'disk',
        'collection',
        'sort_order',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    # Relations
    public function imageable()
    {
        return $this->morphTo();
    }

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::disk($this->disk)->url($this->path),
        );
    }
}
