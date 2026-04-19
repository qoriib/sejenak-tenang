<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMoodLog extends Model
{
    protected $fillable = [
        'user_id',
        'mood_tracker_id',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mood()
    {
        return $this->belongsTo(MoodTracker::class, 'mood_tracker_id');
    }
}
