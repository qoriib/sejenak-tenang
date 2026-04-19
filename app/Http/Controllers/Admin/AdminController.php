<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Models\MeditationAudio;
use App\Models\MoodTracker;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $user = request()->user();
        if (!$user || !$user->isAdmin()) {
            return redirect('/')->with('error', 'Access denied');
        }

        $stats = [
            'total_users'    => User::where('role', 'user')->count(),
            'total_articles' => Article::count(),
            'total_audios'   => MeditationAudio::count(),
            'total_moods'    => MoodTracker::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}