@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Tambah Audio Meditasi</h1>
        <a href="{{ route('admin.meditation.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.meditation.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Judul Audio</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                        id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi <span class="text-muted">(opsional)</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                        id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="audio_file" class="form-label">File Audio <span class="text-muted">(mp3, wav, ogg, aac — maks 20MB)</span></label>
                    <input type="file" class="form-control @error('audio_file') is-invalid @enderror"
                        id="audio_file" name="audio_file" accept=".mp3,.wav,.ogg,.aac" required>
                    @error('audio_file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cover_image" class="form-label">Gambar Cover <span class="text-muted">(opsional)</span></label>
                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror"
                        id="cover_image" name="cover_image" accept="image/*">
                    @error('cover_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="duration_seconds" class="form-label">Durasi (detik) <span class="text-muted">(opsional)</span></label>
                    <input type="number" class="form-control @error('duration_seconds') is-invalid @enderror"
                        id="duration_seconds" name="duration_seconds" value="{{ old('duration_seconds') }}" min="0">
                    @error('duration_seconds')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                            {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Aktifkan audio ini</label>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Audio</button>
                    <a href="{{ route('admin.meditation.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
