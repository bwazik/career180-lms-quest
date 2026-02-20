<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Enrollment extends Pivot
{
    protected $table = 'enrollments';
    public $incrementing = true;

    protected $fillable = [
        'user_id',
        'course_id',
        'enrolled_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'enrolled_at' => 'datetime',
    ];
}
