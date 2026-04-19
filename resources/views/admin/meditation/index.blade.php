@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Kelola Audio Meditasi</h1>
        <a href="{{ route('admin.meditation.create') }}" class="btn btn-primary">Tambah Audio</a>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($audios->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cover</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Durasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($audios as $audio)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        @if ($audio->cover_image)
                                            <img src="{{ asset('meditation/' . $audio->cover_image) }}"
                                                class="img-thumbnail" style="width:60px;height:60px;object-fit:cover;">
                                        @else
                                            <div class="bg-secondary rounded d-flex align-items-center justify-content-center text-white"
                                                style="width:60px;height:60px;">
                                                <i class="ph-duotone ph-music-note" style="font-size:24px;"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $audio->title }}</td>
                                    <td>{{ Str::limit($audio->description, 60) }}</td>
                                    <td>{{ $audio->duration_formatted }}</td>
                                    <td>
                                        @if ($audio->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.meditation.edit', $audio) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form method="POST" action="{{ route('admin.meditation.destroy', $audio) }}"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus audio ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center">
                    {{ $audios->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="ph-duotone ph-music-notes" style="font-size:60px;color:#4A90A4;"></i>
                    <h5 class="text-muted mt-3">Belum ada audio meditasi</h5>
                    <p class="text-muted">Tambahkan musik meditasi untuk pengguna</p>
                    <a href="{{ route('admin.meditation.create') }}" class="btn btn-primary">Tambah Audio</a>
                </div>
            @endif
        </div>
    </div>
@endsection
