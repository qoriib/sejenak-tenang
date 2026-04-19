<?php

namespace App\Http\Controllers;

use App\Models\MeditationAudio;
use App\Models\UserMeditationLog;
use Illuminate\Http\Request;

class MeditationController extends Controller
{
    public function index()
    {
        $audios = MeditationAudio::where('is_active', true)->latest()->get();
        return view('user.meditation.index', compact('audios'));
    }

    /**
     * Dipanggil via POST (AJAX/form) ketika user mulai memutar audio.
     */
    public function play(MeditationAudio $audio)
    {
        if (auth()->check()) {
            UserMeditationLog::create([
                'user_id'            => auth()->id(),
                'meditation_audio_id' => $audio->id,
            ]);
        }

        return response()->json(['status' => 'logged']);
    }
}
