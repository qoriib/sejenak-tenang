<?php

namespace App\Http\Controllers;

use App\Models\MoodTracker;
use App\Models\UserMoodLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoodtrackerController extends Controller
{
    public function index()
    {
        $moods = MoodTracker::all();
        return view('user.mood.index', compact('moods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mood_tracker_id' => 'required|exists:mood_trackers,id',
            'note'            => 'nullable|string|max:500',
        ]);

        UserMoodLog::create([
            'user_id'         => Auth::id(),
            'mood_tracker_id' => $request->mood_tracker_id,
            'note'            => $request->note,
        ]);

        return redirect()->back()->with('success', 'Mood kamu hari ini sudah tersimpan!');
    }

    public function history()
    {
        $logs = UserMoodLog::with('mood')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.mood.history', compact('logs'));
    }
}
