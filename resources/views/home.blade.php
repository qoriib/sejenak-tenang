@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">Sejenak Tenang</h1>
        <p class="hero-subtitle">
            Ruang yang aman dan damai untuk kesehatan mental Anda.<br>
            Konsultasi dengan psikolog profesional, akses artikel edukatif, dan temukan ketenangan batin.
        </p>
        @guest
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-3">Daftar Sekarang</a>
        <a href="{{ route('articles.index') }}" class="btn btn-outline-light btn-lg">Baca Artikel</a>
        @else
        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg me-3">Dashboard Saya</a>
        <a href="{{ route('articles.index') }}" class="btn btn-outline-light btn-lg">Baca Artikel</a>
        @endguest
    </div>
</section>

<!-- Content Section -->
<section class="content-section">
    <div class="container">
        <!-- Latest Articles -->
        <div class="row mb-5">
            <div class="col-12">
                <h2 class="text-center mb-4" style="color: var(--dark-teal);">Artikel Kesehatan Mental Terbaru</h2>
            </div>
            @foreach($articles as $article)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card article-card h-100">
                    @if($article->image)
                    <img src="{{ Storage::url($article->image) }}" class="card-img-top" alt="{{ $article->title }}">
                    @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                        <span class="text-muted">No Image</span>
                    </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ Str::limit($article->title, 60) }}</h5>
                        <p class="card-text text-muted">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('articles.show', $article) }}" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                            <small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Available Psychologists -->
        <div class="row">
            <div class="col-12">
            </div>
            @foreach($psychologists as $psychologist)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card psychologist-card h-100">
                    @if($psychologist->user->avatar)
                    <div class="text-center mb-3">
                        <img src="{{ Storage::url($psychologist->user->avatar) }}"
                            alt="{{ $psychologist->user->name }}"
                            style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid var(--accent-color);">
                    </div>
                    @else
                    <div class="psychologist-avatar">
                        {{ substr($psychologist->user->name, 0, 1) }}
                    </div>
                    @endif
                    <h5 class="card-title">{{ $psychologist->user->name }}</h5>
                    <p class="text-muted">{{ $psychologist->specialization }}</p>
                    <p class="fw-bold" style="color: var(--primary-color);">Rp {{ number_format($psychologist->price, 0, ',', '.') }}</p>
                    <span class="badge bg-success">{{ ucfirst($psychologist->status) }}</span>
                    @auth
                    <div class="mt-3">
                        <button class="btn btn-primary btn-sm">Chat Sekarang</button>
                    </div>
                    @endauth
                </div>
            </div>
            @endforeach
        </div>

        <!-- Call to Action -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <div class="card" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: white;">
                    <div class="card-body py-5">
                        <h3>Siap Memulai Perjalanan Menuju Kesehatan Mental yang Lebih Baik?</h3>
                        <p class="mb-4">Bergabunglah dengan ribuan orang yang telah merasakan manfaat sejenak tenang</p>
                        @guest
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg">Daftar Sekarang</a>
                        @else
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection