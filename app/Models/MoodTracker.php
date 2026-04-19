<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoodTracker extends Model
{
    protected $fillable = [
        'mood_name',
        'mood_emoji',
        'mood_description',
        'mood_color',
        'mood_image',
    ];
}
