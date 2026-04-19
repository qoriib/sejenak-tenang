@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Kelola Mood</h1>
        <a href="{{ route('admin.mood-tracker.create') }}" class="btn btn-primary">Tambah Mood</a>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($moods->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Emoji</th>
                                <th>Nama Mood</th>
                                <th>Deskripsi Mood</th>
                                <th>Warna Mood</th>
                                <th class="w-25">Gambar Mood</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($moods as $mood)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center fs-3">{{ $mood->mood_emoji ?? '-' }}</td>
                                    <td>{{ $mood->mood_name }}</td>
                                    <td>{{ $mood->mood_description }}</td>
                                    <td>
                                        <div
                                            style="width: 40px; height: 40px; background-color: {{ $mood->mood_color }}; border-radius: 4px;">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <img class="img-thumbnail w-50 h-25" src="{{ asset('mood-tracker/' . $mood->mood_image) }}"
                                            alt="">
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.mood-tracker.show', $mood) }}"
                                            class="btn btn-info btn-sm">Lihat</a>
                                        <a href="{{ route('admin.mood-tracker.edit', $mood) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form method="POST" action="{{ route('admin.mood-tracker.destroy', $mood) }}"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus mood ini?')">
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
                    {{ $moods->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <h5 class="text-muted">Belum ada mood</h5>
                    <p class="text-muted">Mulai dengan mood artikel pertama</p>
                    <a href="{{ route('admin.mood-tracker.create') }}" class="btn btn-primary">Tambah Mood</a>
                </div>
            @endif
        </div>
    </div>
@endsection
