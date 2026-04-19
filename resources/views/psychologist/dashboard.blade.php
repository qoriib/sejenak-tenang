@extends('layouts.app')

@section('content')
    <div class="container mt-5 pt-5">
        <div class="hero-section text-center py-4">
            <h1 class="hero-title">Dashboard Psikolog</h1>
            <p class="hero-subtitle">Selamat datang, {{ Auth::user()->name }}</p>
        </div>

        <div class="content-section">
            <div class="container">
                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card stats-card text-center">
                            <div class="card-body">
                                <div class="stats-number">{{ $stats['total_consultations'] }}</div>
                                <div>Total Konsultasi</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card stats-card text-center">
                            <div class="card-body">
                                <div class="stats-number">{{ $stats['active_consultations'] }}</div>
                                <div>Konsultasi Aktif</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card stats-card text-center">
                            <div class="card-body">
                                <div class="stats-number">{{ $stats['completed_consultations'] }}</div>
                                <div>Konsultasi Selesai</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="row mb-4">
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <div class="mb-3">
                                    <i class="ph-duotone ph-chat-dots" style="font-size:60px;color:var(--primary-color);"></i>
                                </div>
                                <h5 class="card-title">Kelola Konsultasi</h5>
                                <p class="card-text">Lihat dan kelola semua konsultasi dengan klien</p>
                                <a href="{{ route('psychologist.consultations.index') }}" class="btn btn-primary">
                                    Lihat Konsultasi
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <div class="mb-3">
                                    <i class="ph-duotone ph-newspaper" style="font-size:60px;color:var(--primary-color);"></i>
                                </div>
                                <h5 class="card-title">Artikel Kesehatan</h5>
                                <p class="card-text">Baca artikel edukatif kesehatan mental</p>
                                <a href="{{ route('articles.index') }}" class="btn btn-primary">Baca Artikel</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Consultations -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Konsultasi Terbaru</h5>
                                <a href="{{ route('psychologist.consultations.index') }}"
                                    class="btn btn-outline-primary btn-sm">
                                    Lihat Semua
                                </a>
                            </div>
                            <div class="card-body">
                                @if ($consultations->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Klien</th>
                                                    <th>Status</th>
                                                    <th>Pembayaran</th>
                                                    <th>Tanggal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($consultations as $consultation)
                                                    <tr>
                                                        <td>{{ $consultation->user->name }}</td>
                                                        <td>
                                                            <span
                                                                class="badge bg-{{ $consultation->status == 'active'
                                                                    ? 'success'
                                                                    : ($consultation->status == 'completed'
                                                                        ? 'primary'
                                                                        : 'warning') }}">
                                                                {{ ucfirst($consultation->status) }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge bg-{{ $consultation->payment_status == 'paid' ? 'success' : 'warning' }}">
                                                                {{ ucfirst($consultation->payment_status) }}
                                                            </span>
                                                        </td>
                                                        <td>{{ $consultation->created_at->format('d M Y') }}</td>
                                                        <td>
                                                            <div class="d-flex gap-1">
                                                                <a href="{{ route('psychologist.consultations.show', $consultation) }}"
                                                                    class="btn btn-outline-primary btn-sm">Detail</a>

                                                                @if ($consultation->status == 'active' || $consultation->status == 'completed')
                                                                    <a href="{{ route('psychologist.chat.show', $consultation) }}"
                                                                        class="btn btn-success btn-sm">Chat</a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-muted text-center py-4">Belum ada konsultasi</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .stats-card {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 20px;
            border: none;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
        }
    </style>
@endsection
