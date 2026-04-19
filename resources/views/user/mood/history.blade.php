@extends('layouts.app')

@section('content')
<div class="container my-5 py-5">
    <div class="row justify-content-center my-3">
        <div class="col-12 col-xl-8 col-md-10">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-white fw-bold mb-0"><i class="ph-duotone ph-clipboard-text me-2"></i>Riwayat Mood Kamu</h4>
                <a href="{{ route('user.mood-tracker.index') }}" class="btn btn-light btn-sm">← Kembali</a>
            </div>

            <div class="card p-3 shadow border">
                <div class="card-body">
                    @if ($logs->count() > 0)
                        @php
                            $groupedLogs = $logs->groupBy(fn($log) => $log->created_at->format('Y-m-d'));
                        @endphp

                        @foreach ($groupedLogs as $date => $dayLogs)
                            <div class="mb-4">
                                <h6 class="text-muted fw-bold border-bottom pb-2 mb-3">
                                    <i class="ph-duotone ph-calendar me-1"></i>{{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y') }}
                                </h6>
                                @foreach ($dayLogs as $log)
                                    <div class="d-flex align-items-start mb-3 p-3 rounded-3"
                                        style="background-color: {{ $log->mood->mood_color ?? '#4A90A4' }}22; border-left: 4px solid {{ $log->mood->mood_color ?? '#4A90A4' }};">
                                        <div class="me-3 fs-2">
                                            @if ($log->mood->mood_emoji)
                                                {{ $log->mood->mood_emoji }}
                                            @elseif ($log->mood->mood_image)
                                                <img src="{{ asset('mood-tracker/' . $log->mood->mood_image) }}"
                                                    style="width:40px;height:40px;object-fit:cover;border-radius:50%;"
                                                    alt="{{ $log->mood->mood_name }}">
                                            @else
                                                <i class="ph-duotone ph-smiley" style="font-size:28px;color:#4A90A4;"></i>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-bold">{{ $log->mood->mood_name }}</div>
                                            @if ($log->note)
                                                <div class="text-muted small mt-1">{{ $log->note }}</div>
                                            @endif
                                            <div class="text-muted" style="font-size:0.78rem;">
                                                {{ $log->created_at->format('H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-center mt-3">
                            {{ $logs->links() }}
                        </div>
                    @else
                        <div class="text-center py-5 text-muted">
                            <i class="ph-duotone ph-smiley" style="font-size:60px;color:#4A90A4;"></i>
                            <h5 class="mt-3">Belum ada riwayat mood</h5>
                            <p>Mulai catat perasaanmu hari ini!</p>
                            <a href="{{ route('user.mood-tracker.index') }}" class="btn btn-primary">Catat Mood Sekarang</a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
