<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'bio',
        'last_active_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_active_at' => 'datetime',
    ];

    // Role methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPsychologist()
    {
        return $this->role === 'psychologist';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    // Relationships
    public function articles()
    {
        return $this->hasMany(Article::class, 'created_by');
    }

    public function psychologist()
    {
        return $this->hasOne(Psychologist::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function sentChats()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }

    public function moodLogs()
    {
        return $this->hasMany(UserMoodLog::class);
    }

    public function meditationLogs()
    {
        return $this->hasMany(UserMeditationLog::class);
    }

    public function articleReads()
    {
        return $this->hasMany(ArticleRead::class);
    }
}
