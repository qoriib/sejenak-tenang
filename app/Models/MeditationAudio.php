<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeditationAudio extends Model
{
    protected $table = 'meditation_audios';

    protected $fillable = [
        'title',
        'description',
        'audio_file',
        'cover_image',
        'duration_seconds',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getDurationFormattedAttribute(): string
    {
        if (!$this->duration_seconds) return '0:00';
        $minutes = intdiv($this->duration_seconds, 60);
        $seconds = $this->duration_seconds % 60;
        return $minutes . ':' . str_pad($seconds, 2, '0', STR_PAD_LEFT);
    }
}