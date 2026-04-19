@extends('layouts.app')

@section('content')
<div class="container my-5 py-5">
    <div class="row justify-content-center my-3">
        <div class="col-12 col-xl-8 col-md-10">

            <div class="text-center mb-4">
                <h3 class="text-white fw-bold"><i class="ph-duotone ph-music-notes me-2"></i>Musik Meditasi</h3>
                <p class="text-white-50">Dengarkan musik penenang untuk membantu relaksasi kamu</p>
                {{-- heading already has icon below --}}
            </div>

            @if ($audios->count() > 0)
                <div class="row g-3">
                    @foreach ($audios as $audio)
                        <div class="col-12 col-md-6">
                            <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                                <div class="d-flex">
                                    <!-- Cover -->
                                    <div class="flex-shrink-0"
                                        style="width:100px;min-height:100px;background-color:#4A90A4;display:flex;align-items:center;justify-content:center;">
                                        @if ($audio->cover_image)
                                            <img src="{{ asset('meditation/' . $audio->cover_image) }}"
                                                style="width:100px;height:100%;object-fit:cover;"
                                                alt="{{ $audio->title }}">
                                        @else
                                            <i class="ph-duotone ph-music-note" style="font-size:40px;color:white;"></i>
                                        @endif
                                    </div>
                                    <!-- Info -->
                                    <div class="card-body p-3 d-flex flex-column justify-content-between">
                                        <div>
                                            <h6 class="fw-bold mb-1">{{ $audio->title }}</h6>
                                            @if ($audio->description)
                                                <p class="text-muted small mb-2" style="font-size:0.8rem;">
                                                    {{ Str::limit($audio->description, 80) }}
                                                </p>
                                            @endif
                                            @if ($audio->duration_seconds)
                                                <span class="badge bg-light text-dark" style="font-size:0.75rem;">
                                                    ⏱ {{ $audio->duration_formatted }}
                                                </span>
                                            @endif
                                        </div>
                                        <button class="btn btn-sm btn-primary mt-2 play-btn rounded-pill"
                                            data-audio="{{ asset('meditation/' . $audio->audio_file) }}"
                                            data-title="{{ $audio->title }}"
                                            data-id="{{ $audio->id }}">
                                            ▶ Putar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card p-5 text-center shadow border-0 rounded-4">
                    <i class="ph-duotone ph-music-notes" style="font-size:60px;color:#4A90A4;"></i>
                    <h5 class="mt-3 text-muted">Belum ada audio meditasi</h5>
                    <p class="text-muted">Admin belum menambahkan musik meditasi.</p>
                </div>
            @endif

        </div>
    </div>
</div>

<!-- Sticky Audio Player -->
<div id="audioPlayer" class="d-none"
    style="position:fixed;bottom:0;left:0;right:0;z-index:1050;background:rgba(15,76,117,0.97);backdrop-filter:blur(10px);padding:12px 20px;box-shadow:0 -4px 20px rgba(0,0,0,0.3);">
    <div class="container">
        <div class="d-flex align-items-center gap-3">
            <div class="flex-grow-1">
                <div class="text-white fw-bold small" id="playerTitle">-</div>
                <audio id="mainAudio" controls class="w-100 mt-1" style="height:32px;"></audio>
            </div>
            <button class="btn btn-sm btn-outline-light rounded-pill" onclick="closePlayer()">✕</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let currentBtn = null;

    document.querySelectorAll('.play-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const audioSrc   = this.dataset.audio;
            const audioTitle = this.dataset.title;
            const mainAudio  = document.getElementById('mainAudio');
            const player     = document.getElementById('audioPlayer');
            const titleEl    = document.getElementById('playerTitle');

            if (currentBtn && currentBtn !== this) {
                currentBtn.textContent = '▶ Putar';
            }

            titleEl.textContent = '♪ ' + audioTitle;
            mainAudio.src = audioSrc;
            player.classList.remove('d-none');
            mainAudio.play();
            this.textContent = '⏸ Memutar...';
            currentBtn = this;

            mainAudio.onended = () => {
                this.textContent = '▶ Putar';
                currentBtn = null;
            };
        });
    });

    function closePlayer() {
        const mainAudio = document.getElementById('mainAudio');
        mainAudio.pause();
        mainAudio.src = '';
        document.getElementById('audioPlayer').classList.add('d-none');
        if (currentBtn) {
            currentBtn.textContent = '▶ Putar';
            currentBtn = null;
        }
    }
</script>
@endpush
@endsection
