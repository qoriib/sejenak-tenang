@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Mood</h1>
        <a href="{{ route('admin.mood-tracker.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.mood-tracker.update', $moodTracker->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="mood_name" class="form-label">Judul Mood</label>
                    <input type="text" class="form-control @error('mood_name') is-invalid @enderror" id="mood_name"
                        name="mood_name" value="{{ old('mood_name', $moodTracker->mood_name) }}" required>
                    @error('mood_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="mood_emoji" class="form-label">Emoji Mood</label>
                    <input type="text" class="form-control @error('mood_emoji') is-invalid @enderror" id="mood_emoji"
                        name="mood_emoji" value="{{ old('mood_emoji', $moodTracker->mood_emoji) }}" placeholder="Contoh: 😊" maxlength="10">
                    <div class="form-text">Masukkan satu emoji yang mewakili mood ini.</div>
                    @error('mood_emoji')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="mood_image" class="form-label">Gambar Mood <span class="text-muted">(opsional)</span></label>
                    @if ($moodTracker->mood_image)
                        <div class="mb-2">
                            <img src="{{ asset('mood-tracker/' . $moodTracker->mood_image) }}" class="img-thumbnail" style="max-height: 100px;">
                            <div class="form-text">Gambar saat ini. Upload baru untuk mengganti.</div>
                        </div>
                    @endif
                    <input type="file" class="form-control @error('mood_image') is-invalid @enderror" id="mood_image"
                        name="mood_image" accept="image/*">
                    @error('mood_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="mood_description" class="form-label">Deskripsi Mood</label>
                    <textarea class="form-control @error('mood_description') is-invalid @enderror" id="content" name="mood_description"
                        rows="10" required>{{ old('mood_description', $moodTracker->mood_description) }}</textarea>
                    @error('mood_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="mood_color" class="form-label">Mood Color</label>
                    <input type="color" class="form-control w-25  @error('mood_color') is-invalid @enderror" id="mood_color"
                        name="mood_color" value="{{ old('mood_color', $moodTracker->mood_color) }}" accept="mood_color/*">
                    @error('mood_color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update Mood</button>
                    <a href="{{ route('admin.mood-tracker.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
