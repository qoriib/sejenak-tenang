<?php

namespace App\Http\Controllers\Admin;

use App\Models\MeditationAudio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class MeditationAudioController extends Controller
{
    public function index()
    {
        $audios = MeditationAudio::latest()->paginate(10);
        return view('admin.meditation.index', compact('audios'));
    }

    public function create()
    {
        return view('admin.meditation.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'audio_file'       => 'required|file|mimes:mp3,wav,ogg,aac|max:20480',
            'cover_image'      => 'nullable|image|max:2048',
            'duration_seconds' => 'nullable|integer|min:0',
            'is_active'        => 'nullable|boolean',
        ]);

        $audioFile = $request->file('audio_file');
        $audioName = time() . '_' . $audioFile->getClientOriginalName();
        $audioFile->move(public_path('meditation'), $audioName);
        $validated['audio_file'] = $audioName;

        if ($request->hasFile('cover_image')) {
            $img     = $request->file('cover_image');
            $imgName = time() . '_cover_' . $img->getClientOriginalName();
            $img->move(public_path('meditation'), $imgName);
            $validated['cover_image'] = $imgName;
        }

        $validated['is_active'] = $request->has('is_active');

        MeditationAudio::create($validated);

        return redirect()->route('admin.meditation.index')
            ->with('success', 'Audio meditasi berhasil ditambahkan.');
    }

    public function edit(MeditationAudio $meditation)
    {
        return view('admin.meditation.edit', compact('meditation'));
    }

    public function update(Request $request, MeditationAudio $meditation)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'audio_file'       => 'nullable|file|mimes:mp3,wav,ogg,aac|max:20480',
            'cover_image'      => 'nullable|image|max:2048',
            'duration_seconds' => 'nullable|integer|min:0',
            'is_active'        => 'nullable|boolean',
        ]);

        if ($request->hasFile('audio_file')) {
            if ($meditation->audio_file && File::exists(public_path('meditation/' . $meditation->audio_file))) {
                File::delete(public_path('meditation/' . $meditation->audio_file));
            }
            $audioFile = $request->file('audio_file');
            $audioName = time() . '_' . $audioFile->getClientOriginalName();
            $audioFile->move(public_path('meditation'), $audioName);
            $validated['audio_file'] = $audioName;
        } else {
            $validated['audio_file'] = $meditation->audio_file;
        }

        if ($request->hasFile('cover_image')) {
            if ($meditation->cover_image && File::exists(public_path('meditation/' . $meditation->cover_image))) {
                File::delete(public_path('meditation/' . $meditation->cover_image));
            }
            $img     = $request->file('cover_image');
            $imgName = time() . '_cover_' . $img->getClientOriginalName();
            $img->move(public_path('meditation'), $imgName);
            $validated['cover_image'] = $imgName;
        } else {
            $validated['cover_image'] = $meditation->cover_image;
        }

        $validated['is_active'] = $request->has('is_active');

        $meditation->update($validated);

        return redirect()->route('admin.meditation.index')
            ->with('success', 'Audio meditasi berhasil diperbarui.');
    }

    public function destroy(MeditationAudio $meditation)
    {
        if ($meditation->audio_file && File::exists(public_path('meditation/' . $meditation->audio_file))) {
            File::delete(public_path('meditation/' . $meditation->audio_file));
        }
        if ($meditation->cover_image && File::exists(public_path('meditation/' . $meditation->cover_image))) {
            File::delete(public_path('meditation/' . $meditation->cover_image));
        }

        $meditation->delete();

        return redirect()->route('admin.meditation.index')
            ->with('success', 'Audio meditasi berhasil dihapus.');
    }
}
