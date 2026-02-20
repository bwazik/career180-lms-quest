<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Level extends Model
{
    protected static function booted(): void
    {
        static::saving(function ($level) {
            if (empty($level->slug)) {
                $level->slug = Str::slug($level->name);
            }
        });
    }

    protected $fillable = [
        'name',
        'slug',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
