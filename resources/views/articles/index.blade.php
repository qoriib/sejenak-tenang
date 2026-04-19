@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5">
    <!-- Header -->
    <div class="hero-section text-center py-4">
        <h1 class="hero-title">Artikel Kesehatan Mental</h1>
        <p class="hero-subtitle">Temukan wawasan dan tips untuk kesehatan mental yang lebih baik</p>
    </div>

    <div class="content-section">
        <div class="container">
            <!-- Search -->
            <div class="row mb-4">
                <div class="col-lg-6 mx-auto">
                    <form method="GET" action="{{ route('articles.index') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" 
                                   placeholder="Cari artikel..." value="{{ request('search') }}"
                                   style="border-radius: 25px 0 0 25px; border: 2px solid var(--primary-color);">
                            <button class="btn btn-primary" type="submit" style="border-radius: 0 25px 25px 0;">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Articles Grid -->
            <div class="row">
                @forelse($articles as $article)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card article-card h-100">
                            @if($article->image)
                                <img src="{{ Storage::url($article->image) }}" class="card-img-top" alt="{{ $article->title }}">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <span class="text-muted">Health Article</span>
                                </div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $article->title }}</h5>
                                <p class="card-text text-muted flex-grow-1">
                                    {{ Str::limit(strip_tags($article->content), 120) }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <a href="{{ route('articles.show', $article) }}" class="btn btn-primary btn-sm">
                                        Baca Selengkapnya
                                    </a>
                                    <small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="card">
                            <div class="card-body py-5">
                                <h4 class="text-muted">Tidak ada artikel ditemukan</h4>
                                <p class="text-muted">Coba kata kunci lain atau kembali ke halaman utama</p>
                                <a href="{{ route('articles.index') }}" class="btn btn-primary">Lihat Semua Artikel</a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $articles->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection