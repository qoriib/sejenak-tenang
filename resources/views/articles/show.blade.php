@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5">
    <div class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- Back Button -->
                    <div class="mb-3">
                        <a href="{{ route('articles.index') }}" class="btn btn-outline-primary">
                            ← Kembali ke Artikel
                        </a>
                    </div>

                    <!-- Article Content -->
                    <div class="card">
                        @if($article->image)
                            <img src="{{ Storage::url($article->image) }}" class="card-img-top" alt="{{ $article->title }}" style="height: 300px; object-fit: cover;">
                        @endif
                        
                        <div class="card-body">
                            <h1 class="card-title mb-3">{{ $article->title }}</h1>
                            
                            <div class="d-flex justify-content-between align-items-center mb-4 text-muted">
                                <span>By {{ $article->author->name }}</span>
                                <span>{{ $article->created_at->format('d M Y') }}</span>
                            </div>

                            <div class="article-content" style="line-height: 1.8; font-size: 1.1rem;">
                                {!! nl2br(e($article->content)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Related Articles -->
                    <div class="mt-5">
                        <h4 class="mb-4">Artikel Lainnya</h4>
                        <div class="row">
                            @php
                                $relatedArticles = App\Models\Article::published()
                                    ->where('id', '!=', $article->id)
                                    ->latest()
                                    ->take(3)
                                    ->get();
                            @endphp
                            
                            @foreach($relatedArticles as $related)
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100">
                                        @if($related->image)
                                            <img src="{{ Storage::url($related->image) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                        @endif
                                        <div class="card-body">
                                            <h6 class="card-title">{{ Str::limit($related->title, 50) }}</h6>
                                            <a href="{{ route('articles.show', $related) }}" class="btn btn-sm btn-primary">Baca</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection