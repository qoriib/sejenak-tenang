<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMeditationLog extends Model
{
    protected $fillable = [
        'user_id',
        'meditation_audio_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function audio()
    {
        return $this->belongsTo(MeditationAudio::class, 'meditation_audio_id');
    }
}
