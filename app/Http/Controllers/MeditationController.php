<?php

namespace App\Http\Controllers;

use App\Models\MeditationAudio;
use Illuminate\Http\Request;

class MeditationController extends Controller
{
    public function index()
    {
        $audios = MeditationAudio::where('is_active', true)->latest()->get();
        return view('user.meditation.index', compact('audios'));
    }
}
