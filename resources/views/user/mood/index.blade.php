@extends('layouts.app')

@section('content')
<div class="container my-5 py-5">
    <div class="row justify-content-center my-5">
        <div class="col-12 col-xl-6 col-md-8">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card p-3 shadow border">
                <div class="card-body">
                    <div class="text-center">
                        <h3>How are you feeling <br> right now?</h3>
                        <p class="text-muted small">Pilih mood kamu hari ini</p>
                    </div>

                    @if ($moods->count() > 0)
                        <div class="d-flex justify-content-center flex-wrap gap-2 my-4">
                            @foreach ($moods as $mood)
                                <button type="button"
                                    class="border-0 bg-transparent mx-2 fs-1 mood-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#mood-{{ $mood->id }}"
                                    title="{{ $mood->mood_name }}">
                                    @if ($mood->mood_emoji)
                                        {{ $mood->mood_emoji }}
                                    @elseif ($mood->mood_image)
                                        <img src="{{ asset('mood-tracker/' . $mood->mood_image) }}"
                                            style="width:60px;height:60px;object-fit:cover;border-radius:50%;"
                                            alt="{{ $mood->mood_name }}">
                                    @else
                                        <i class="ph-duotone ph-smiley" style="font-size:48px;color:#4A90A4;"></i>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center my-5 text-muted">
                            <p>Belum ada mood yang tersedia.</p>
                        </div>
                    @endif

                    <div class="text-center mt-3">
                        <a href="{{ route('user.mood-tracker.history') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="ph-bold ph-clipboard-text me-1"></i>Lihat Riwayat Mood
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($moods as $mood)
<div class="modal fade" id="mood-{{ $mood->id }}" data-bs-backdrop="false" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4 rounded-4"
            style="background-color: {{ $mood->mood_color ?? '#4A90A4' }}; color: white;">
            <h5 class="mb-3">
                {{ $mood->mood_emoji ?? '' }} {{ $mood->mood_name }}
            </h5>
            @if ($mood->mood_image)
                <div class="text-center my-3">
                    <img src="{{ asset('mood-tracker/' . $mood->mood_image) }}"
                        style="width:100px;height:100px;object-fit:cover;border-radius:50%;border:3px solid rgba(255,255,255,0.5);"
                        alt="{{ $mood->mood_name }}">
                </div>
            @elseif ($mood->mood_emoji)
                <div class="text-center my-3">
                    <span style="font-size: 80px;">{{ $mood->mood_emoji }}</span>
                </div>
            @endif
            <p><em>{{ $mood->mood_description }}</em></p>

            <form method="POST" action="{{ route('user.mood-tracker.store') }}" class="mt-3">
                @csrf
                <input type="hidden" name="mood_tracker_id" value="{{ $mood->id }}">
                <div class="mb-3">
                    <textarea name="note" class="form-control bg-white text-dark"
                        rows="2" placeholder="Tambahkan catatan (opsional)..."></textarea>
                </div>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="submit" class="btn btn-light fw-bold">Simpan Mood</button>
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
