@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Kelola Artikel</h1>
    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">Tambah Artikel</a>
</div>

<div class="card">
    <div class="card-body">
        @if($articles->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ Str::limit($article->title, 50) }}</td>
                                <td>{{ $article->author->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $article->is_published ? 'success' : 'warning' }}">
                                        {{ $article->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                </td>
                                <td>{{ $article->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.articles.show', $article) }}" class="btn btn-info btn-sm">Lihat</a>
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $articles->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <h5 class="text-muted">Belum ada artikel</h5>
                <p class="text-muted">Mulai dengan membuat artikel pertama</p>
                <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">Tambah Artikel</a>
            </div>
        @endif
    </div>
</div>
@endsection
