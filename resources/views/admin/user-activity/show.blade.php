@extends('layouts.admin')

@section('content')

{{-- Header --}}
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-2">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <a href="{{ route('admin.user-activity.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="ph-duotone ph-arrow-left me-1"></i>Kembali
            </a>
        </div>
        <h1 class="mb-0">Riwayat: {{ $user->name }}</h1>
        <p class="text-muted mb-0">{{ $user->email }}</p>
    </div>

    {{-- Filter Tanggal --}}
    <form method="GET" action="{{ route('admin.user-activity.show', $user) }}"
          class="d-flex align-items-center gap-2 flex-wrap">
        <div class="input-group input-group-sm" style="width:auto;">
            <span class="input-group-text">Dari</span>
            <input type="date" name="start_date" class="form-control"
                   value="{{ $startDate->toDateString() }}">
        </div>
        <div class="input-group input-group-sm" style="width:auto;">
            <span class="input-group-text">Sampai</span>
            <input type="date" name="end_date" class="form-control"
                   value="{{ $endDate->toDateString() }}">
        </div>
        <button type="submit" class="btn btn-sm btn-primary">
            <i class="ph-duotone ph-funnel me-1"></i>Filter
        </button>
    </form>
</div>

{{-- Ringkasan --}}
<div class="row mb-4 g-3">
    <div class="col-md-4">
        <div class="card border-0 h-100" style="background:linear-gradient(135deg,#f6d365,#fda085);">
            <div class="card-body text-white text-center py-4">
                <div style="font-size:2rem;font-weight:700;">
                    {{ $moodLogs->flatten()->count() }}
                </div>
                <div class="fw-semibold mt-1">
                    <i class="ph-duotone ph-smiley me-1"></i>Total Mood Tercatat
                </div>
                <small class="opacity-75">dalam rentang ini</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 h-100" style="background:linear-gradient(135deg,#4A90A4,#5FB3CC);">
            <div class="card-body text-white text-center py-4">
                <div style="font-size:2rem;font-weight:700;">
                    {{ $meditationLogs->flatten()->count() }}
                </div>
                <div class="fw-semibold mt-1">
                    <i class="ph-duotone ph-music-notes me-1"></i>Total Sesi Meditasi
                </div>
                <small class="opacity-75">dalam rentang ini</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 h-100" style="background:linear-gradient(135deg,#667eea,#764ba2);">
            <div class="card-body text-white text-center py-4">
                <div style="font-size:2rem;font-weight:700;">
                    {{ $articleReads->flatten()->count() }}
                </div>
                <div class="fw-semibold mt-1">
                    <i class="ph-duotone ph-newspaper me-1"></i>Total Artikel Dibaca
                </div>
                <small class="opacity-75">dalam rentang ini</small>
            </div>
        </div>
    </div>
</div>

{{-- Riwayat Per Hari --}}
@if ($allDates->isEmpty())
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="ph-duotone ph-clock" style="font-size:60px;color:#ccc;"></i>
            <h5 class="text-muted mt-3">Tidak ada aktivitas dalam rentang tanggal ini</h5>
            <p class="text-muted">Coba perluas rentang tanggal filter.</p>
        </div>
    </div>
@else
    @foreach ($allDates as $date)
        @php
            $dayMoods      = $moodLogs->get($date, collect());
            $dayMeditations = $meditationLogs->get($date, collect());
            $dayArticles   = $articleReads->get($date, collect());
            $parsedDate    = \Carbon\Carbon::parse($date);
        @endphp

        <div class="card mb-3">
            <div class="card-header d-flex align-items-center justify-content-between py-3"
                 style="background:linear-gradient(135deg,#4A90A4,#5FB3CC);color:white;border-radius:15px 15px 0 0;">
                <div class="d-flex align-items-center gap-2">
                    <i class="ph-duotone ph-calendar-blank" style="font-size:20px;"></i>
                    <strong>{{ $parsedDate->translatedFormat('l, d F Y') }}</strong>
                    @if ($parsedDate->isToday())
                        <span class="badge bg-light text-dark ms-1">Hari ini</span>
                    @elseif ($parsedDate->isYesterday())
                        <span class="badge bg-light text-dark ms-1">Kemarin</span>
                    @endif
                </div>
                <div class="d-flex gap-2">
                    <span class="badge bg-warning text-dark">
                        <i class="ph-duotone ph-smiley me-1"></i>{{ $dayMoods->count() }} mood
                    </span>
                    <span class="badge bg-info text-dark">
                        <i class="ph-duotone ph-music-notes me-1"></i>{{ $dayMeditations->count() }} meditasi
                    </span>
                    <span class="badge bg-light text-dark">
                        <i class="ph-duotone ph-newspaper me-1"></i>{{ $dayArticles->count() }} artikel
                    </span>
                </div>
            </div>

            <div class="card-body">
                <div class="row g-3">

                    {{-- Mood --}}
                    <div class="col-md-4">
                        <h6 class="text-muted fw-semibold mb-3 d-flex align-items-center gap-1">
                            <i class="ph-duotone ph-smiley" style="color:#fda085;"></i>Mood
                        </h6>
                        @forelse ($dayMoods as $log)
                            <div class="d-flex align-items-start gap-2 mb-2 p-2 rounded-3"
                                 style="background:#fff9f0;">
                                <span style="font-size:1.4rem;">
                                    {{ $log->mood->mood_emoji ?? '😊' }}
                                </span>
                                <div>
                                    <div class="fw-semibold" style="font-size:0.88rem;">
                                        {{ $log->mood->mood_name ?? '—' }}
                                    </div>
                                    @if ($log->note)
                                        <div class="text-muted" style="font-size:0.8rem;">
                                            {{ Str::limit($log->note, 60) }}
                                        </div>
                                    @endif
                                    <small class="text-muted">
                                        {{ $log->created_at->format('H:i') }}
                                    </small>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted small">Tidak ada mood tercatat</p>
                        @endforelse
                    </div>

                    {{-- Meditasi --}}
                    <div class="col-md-4">
                        <h6 class="text-muted fw-semibold mb-3 d-flex align-items-center gap-1">
                            <i class="ph-duotone ph-music-notes" style="color:#5FB3CC;"></i>Meditasi
                        </h6>
                        @forelse ($dayMeditations as $log)
                            <div class="d-flex align-items-start gap-2 mb-2 p-2 rounded-3"
                                 style="background:#f0f8ff;">
                                <i class="ph-duotone ph-music-note mt-1" style="color:#4A90A4;font-size:18px;"></i>
                                <div>
                                    <div class="fw-semibold" style="font-size:0.88rem;">
                                        {{ $log->audio->title ?? '—' }}
                                    </div>
                                    <small class="text-muted">
                                        {{ $log->created_at->format('H:i') }}
                                    </small>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted small">Tidak ada sesi meditasi</p>
                        @endforelse
                    </div>

                    {{-- Artikel --}}
                    <div class="col-md-4">
                        <h6 class="text-muted fw-semibold mb-3 d-flex align-items-center gap-1">
                            <i class="ph-duotone ph-newspaper" style="color:#764ba2;"></i>Artikel Dibaca
                        </h6>
                        @forelse ($dayArticles as $read)
                            <div class="d-flex align-items-start gap-2 mb-2 p-2 rounded-3"
                                 style="background:#f8f0ff;">
                                <i class="ph-duotone ph-book-open mt-1" style="color:#764ba2;font-size:18px;"></i>
                                <div>
                                    <div class="fw-semibold" style="font-size:0.88rem;">
                                        {{ Str::limit($read->article_title, 45) }}
                                    </div>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($read->created_at)->format('H:i') }}
                                    </small>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted small">Tidak ada artikel dibaca</p>
                        @endforelse
                    </div>

                </div>{{-- row --}}
            </div>{{-- card-body --}}
        </div>{{-- card --}}
    @endforeach
@endif

@endsection
