<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'startDate',
        'duration'
    ];

    public function enrollment():HasMany
    {
        return $this->hasMany(enrollment::class);
    }

    public function subject():HasMany
    {
        return $this->hasMany(subject::class);
    }
}
