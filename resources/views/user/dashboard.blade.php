@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-12">
            <div class="hero-section text-center py-4">
                <h1 class="hero-title">Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p class="hero-subtitle">Edukasi kesehatan mental dan relaksasi untuk ketenangan pikiran Anda</p>
            </div>
        </div>
    </div>

    <div class="content-section">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Articles Card -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card text-center h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body py-5">
                            <div class="mb-4">
                                <i class="ph-duotone ph-newspaper" style="font-size:70px;color:var(--primary-color);"></i>
                            </div>
                            <h4 class="card-title fw-bold mb-3">Artikel</h4>
                            <p class="card-text text-muted mb-4">Baca artikel edukatif untuk meningkatkan wawasan kesehatan mental Anda</p>
                            <a href="{{ route('articles.index') }}" class="btn btn-primary px-4 rounded-pill">Baca Artikel</a>
                        </div>
                    </div>
                </div>

                <!-- Meditation Audio Card -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card text-center h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body py-5">
                            <div class="mb-4">
                                <i class="ph-duotone ph-music-notes" style="font-size:70px;color:var(--primary-color);"></i>
                            </div>
                            <h4 class="card-title fw-bold mb-3">Meditasi</h4>
                            <p class="card-text text-muted mb-4">Dengarkan musik penenang untuk membantu relaksasi dan ketenangan Anda</p>
                            <a href="{{ route('user.meditation.index') }}" class="btn btn-primary px-4 rounded-pill">Putar Musik</a>
                        </div>
                    </div>
                </div>

                <!-- Mood Tracker Card -->
                <div class="col-lg-4 col-md-6 mb-4">
                     <div class="card text-center h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body py-5">
                            <div class="mb-4">
                                <i class="ph-duotone ph-smiley" style="font-size:70px;color:var(--primary-color);"></i>
                            </div>
                            <h4 class="card-title fw-bold mb-3">Mood Tracker</h4>
                            <p class="card-text text-muted mb-4">Pantau dan catat perkembangan mood harian untuk memahami kondisi emosional Anda</p>
                            <a href="{{route('user.mood-tracker.index')}}" class="btn btn-primary px-4 rounded-pill">Lihat Mood Kamu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
