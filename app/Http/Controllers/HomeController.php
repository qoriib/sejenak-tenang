<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Psychologist;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::published()
            ->latest()
            ->take(6)
            ->get();

        $psychologists = Psychologist::available()
            ->with('user')
            ->take(4)
            ->get();

        return view('home', compact('articles', 'psychologists'));
    }

    public function dashboard()
    {
        $user = request()->user();

        // Redirect berdasarkan role
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isPsychologist()) {
            return redirect()->route('psychologist.dashboard');
        } else {
            return view('user.dashboard');
        }
    }

    public function about()
    {
        return view('about');
    }

    public function privacyPolicy()
    {
        return view('privacy-policy');
    }

    public function profileSettings()
    {
        return view('profile.settings');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'bio' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                \Storage::disk('public')->delete($user->avatar);
            }

            // Store new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()->route('profile.settings')->with('success', 'Profile berhasil diperbarui!');
    }
}
