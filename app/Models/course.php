<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name',
        'faculty',
        'course_no',
        'student_id'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(student::class);
    }
}
