<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->getAttribute($model->getSlugSourceColumn()));
            }
        });

        static::deleting(function ($model) {
            if (in_array(SoftDeletes::class, class_uses_recursive($model))) {
                if (! $model->isForceDeleting()) {
                    $model->slug .= '::deleted::' . time();
                    $model->save();
                }
            }
        });
    }

    public function getSlugSourceColumn(): string
    {
        return 'title';
    }
}
