<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'session_count',
        'course_id'
    ];

    public function course() : BelongsTo
    {
        return $this->belongsTo(course::class);
    }
}
