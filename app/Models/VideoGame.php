<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGame extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'platform',
        'release_date',
        'summary',
        'reviews',
    ];

    protected $casts = [
        'release_date' => 'date',
    ];

    public function getReleaseDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }

    public function setReleaseDateAttribute($value)
    {
        $this->attributes['release_date'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
}
