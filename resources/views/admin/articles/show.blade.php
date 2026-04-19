@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Detail Artikel</h1>
    <div>
        <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <h2>{{ $article->title }}</h2>
                
                <div class="d-flex justify-content-between align-items-center mb-4 text-muted">
                    <span>Oleh: {{ $article->author->name }}</span>
                    <span>{{ $article->created_at->format('d M Y H:i') }}</span>
                </div>

                @if($article->image)
                    <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" 
                         class="img-fluid mb-4" style="max-height: 300px; border-radius: 15px;">
                @endif

                <div class="article-content" style="line-height: 1.8;">
                    {!! nl2br(e($article->content)) !!}
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Info Artikel</h6>
                    </div>
                    <div class="card-body">
                        <p><strong>Status:</strong> 
                            <span class="badge bg-{{ $article->is_published ? 'success' : 'warning' }}">
                                {{ $article->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </p>
                        <p><strong>Dibuat:</strong> {{ $article->created_at->format('d M Y H:i') }}</p>
                        <p><strong>Diupdate:</strong> {{ $article->updated_at->format('d M Y H:i') }}</p>
                        <p><strong>Penulis:</strong> {{ $article->author->name }}</p>
                        
                        <hr>
                        
                        <div class="d-grid gap-2">
                            <a href="{{ route('articles.show', $article) }}" 
                               class="btn btn-info btn-sm" target="_blank">
                                Lihat di Website
                            </a>
                            <a href="{{ route('admin.articles.edit', $article) }}" 
                               class="btn btn-warning btn-sm">
                                Edit Artikel
                            </a>
                            <form method="POST" action="{{ route('admin.articles.destroy', $article) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100" 
                                        onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                                    Hapus Artikel
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection