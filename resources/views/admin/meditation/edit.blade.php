@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Audio Meditasi</h1>
        <a href="{{ route('admin.meditation.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.meditation.update', $meditation) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Judul Audio</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                        id="title" name="title" value="{{ old('title', $meditation->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi <span class="text-muted">(opsional)</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                        id="description" name="description" rows="3">{{ old('description', $meditation->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="audio_file" class="form-label">File Audio <span class="text-muted">(opsional — biarkan kosong untuk tidak mengganti)</span></label>
                    <div class="mb-2">
                        <audio controls class="w-100">
                            <source src="{{ asset('meditation/' . $meditation->audio_file) }}">
                        </audio>
                        <div class="form-text">File saat ini: {{ $meditation->audio_file }}</div>
                    </div>
                    <input type="file" class="form-control @error('audio_file') is-invalid @enderror"
                        id="audio_file" name="audio_file" accept=".mp3,.wav,.ogg,.aac">
                    @error('audio_file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cover_image" class="form-label">Gambar Cover <span class="text-muted">(opsional)</span></label>
                    @if ($meditation->cover_image)
                        <div class="mb-2">
                            <img src="{{ asset('meditation/' . $meditation->cover_image) }}"
                                class="img-thumbnail" style="max-height:100px;">
                            <div class="form-text">Gambar saat ini. Upload baru untuk mengganti.</div>
                        </div>
                    @endif
                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror"
                        id="cover_image" name="cover_image" accept="image/*">
                    @error('cover_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="duration_seconds" class="form-label">Durasi (detik)</label>
                    <input type="number" class="form-control @error('duration_seconds') is-invalid @enderror"
                        id="duration_seconds" name="duration_seconds"
                        value="{{ old('duration_seconds', $meditation->duration_seconds) }}" min="0">
                    @error('duration_seconds')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                            {{ old('is_active', $meditation->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Aktifkan audio ini</label>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update Audio</button>
                    <a href="{{ route('admin.meditation.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
