@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Dashboard Admin</h1>
    <span class="text-muted">Selamat datang, {{ Auth::user()->name }}</span>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="stats-card">
            <div class="stats-number">{{ $stats['total_users'] }}</div>
            <div>Total Users</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="stats-card">
            <div class="stats-number">{{ $stats['total_articles'] }}</div>
            <div>Total Artikel</div>
        </div>
        </div>
    </div>
</div>


    </div>
</div>
@endsection