@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-12">
            <div class="hero-section text-center py-4">
                <h1 class="hero-title">Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p class="hero-subtitle">Kelola konsultasi dan jelajahi artikel kesehatan mental</p>
            </div>
        </div>
    </div>

    <div class="content-section">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Articles Card -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="ph-duotone ph-newspaper" style="font-size:60px;color:var(--primary-color);"></i>
                            </div>
                            <h5 class="card-title">Artikel</h5>
                            <p class="card-text">Baca artikel edukatif kesehatan mental</p>
                            <a href="{{ route('articles.index') }}" class="btn btn-primary">Baca Artikel</a>
                        </div>
                    </div>
                </div>

                <!-- Mood Tracker Card -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="ph-duotone ph-smiley" style="font-size:60px;color:var(--primary-color);"></i>
                            </div>
                            <h5 class="card-title">Mood Tracker</h5>
                            <p class="card-text">Pantau perkembangan mood harian Anda</p>
                            <a class="btn btn-primary enabled" href="{{route('user.mood-tracker.index')}}"  >Lihat Mood Kamu</a>
                        </div>
                    </div>
                </div>

                <!-- Consultation Card -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="ph-duotone ph-chat-dots" style="font-size:60px;color:var(--primary-color);"></i>
                            </div>
                            <h5 class="card-title">Konsultasi</h5>
                            <p class="card-text">Mulai chat dengan psikolog profesional</p>
                            <a href="{{ route('user.consultations.index') }}" class="btn btn-primary">
                                Coming Soon
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Meditation Audio Card -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="ph-duotone ph-music-notes" style="font-size:60px;color:var(--primary-color);"></i>
                            </div>
                            <h5 class="card-title">Meditasi</h5>
                            <p class="card-text">Dengarkan musik penenang untuk relaksasi</p>
                            <a href="{{ route('user.meditation.index') }}" class="btn btn-primary">Putar Musik</a>
                        </div>
                    </div>
                </div>

                <!-- Mood History Card -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="ph-duotone ph-clock-counter-clockwise" style="font-size:60px;color:var(--primary-color);"></i>
                            </div>
                            <h5 class="card-title">Riwayat Mood</h5>
                            <p class="card-text">Lihat catatan mood harian kamu</p>
                            <a href="{{ route('user.mood-tracker.history') }}" class="btn btn-primary">Lihat Riwayat</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
