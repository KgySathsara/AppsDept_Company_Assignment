<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'batch'
    ];

    public function student() : BelongsToMany
    {
        return $this->belongsToMany(student::class);
    }

    public function course() : BelongsToMany
    {
        return $this->belongsToMany(course::class);
    }
}
