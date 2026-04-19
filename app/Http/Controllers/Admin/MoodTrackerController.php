<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MoodTracker;
use Illuminate\Http\Request;

class MoodTrackerController extends Controller
{
    public function index()
    {
        $moods = MoodTracker::latest()->paginate(10);
        return view('admin.mood-tracker.index', compact('moods'));
    }

    public function create()
    {
        return view('admin.mood-tracker.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mood_name'        => 'required|string|max:255',
            'mood_emoji'       => 'nullable|string|max:10',
            'mood_description' => 'required|string',
            'mood_color'       => 'required|string',
            'mood_image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'mood_name',
            'mood_emoji',
            'mood_description',
            'mood_color',
        ]);

        if ($request->hasFile('mood_image')) {
            $data['mood_image'] = $request->file('mood_image')
                ->store('mood-tracker', 'public');
        }

        MoodTracker::create($data);

        return redirect()->route('admin.mood-tracker.index')
            ->with('success', 'Mood berhasil ditambahkan');
    }

    public function edit(MoodTracker $moodTracker)
    {
        return view('admin.mood-tracker.edit', compact('moodTracker'));
    }

    public function update(Request $request, MoodTracker $moodTracker)
    {
        $request->validate([
            'mood_name'        => 'required|string|max:255',
            'mood_emoji'       => 'nullable|string|max:10',
            'mood_description' => 'required|string',
            'mood_color'       => 'required|string',
            'mood_image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'mood_name',
            'mood_emoji',
            'mood_description',
            'mood_color',
        ]);

        if ($request->hasFile('mood_image')) {
            $data['mood_image'] = $request->file('mood_image')
                ->store('mood-tracker', 'public');
        }

        $moodTracker->update($data);

        return redirect()->route('admin.mood-tracker.index')
            ->with('success', 'Mood berhasil diupdate');
    }

    public function destroy(MoodTracker $moodTracker)
    {
        $moodTracker->delete();
        return redirect()->route('admin.mood-tracker.index')
            ->with('success', 'Mood berhasil dihapus');
    }
}