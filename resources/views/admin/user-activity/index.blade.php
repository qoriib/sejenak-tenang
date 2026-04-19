@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-1">Riwayat Aktivitas Pengguna</h1>
        <p class="text-muted mb-0">Pantau aktivitas harian pengguna — artikel, mood, dan meditasi</p>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        @if ($users->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Pengguna</th>
                            <th class="text-center">
                                <i class="ph-duotone ph-smiley me-1"></i>Mood
                            </th>
                            <th class="text-center">
                                <i class="ph-duotone ph-music-notes me-1"></i>Meditasi
                            </th>
                            <th class="text-center">
                                <i class="ph-duotone ph-newspaper me-1"></i>Artikel Dibaca
                            </th>
                            <th>Terakhir Aktif</th>
                            <th class="pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                                             style="width:38px;height:38px;background:linear-gradient(135deg,#4A90A4,#5FB3CC);font-size:14px;flex-shrink:0;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $user->name }}</div>
                                            <small class="text-muted">{{ $user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-warning text-dark">
                                        {{ $user->mood_logs_count }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info text-dark">
                                        {{ $user->meditation_logs_count }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-secondary">
                                        {{ $user->article_reads_count }}
                                    </span>
                                </td>
                                <td>
                                    @if ($user->last_active_at)
                                        <span title="{{ $user->last_active_at->format('d M Y H:i') }}">
                                            {{ $user->last_active_at->diffForHumans() }}
                                        </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td class="pe-4">
                                    <a href="{{ route('admin.user-activity.show', $user) }}"
                                       class="btn btn-sm btn-primary">
                                        <i class="ph-duotone ph-clock-clockwise me-1"></i>Lihat Riwayat
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center py-3">
                {{ $users->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="ph-duotone ph-users" style="font-size:60px;color:#4A90A4;"></i>
                <h5 class="text-muted mt-3">Belum ada pengguna terdaftar</h5>
            </div>
        @endif
    </div>
</div>
@endsection
