@extends('layouts.app')

@section('content')
    <div class="container mt-5 pt-5">
        <div class="content-section">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Kelola Konsultasi</h1>
                    <a href="{{ route('psychologist.dashboard') }}" class="btn btn-secondary">
                        Kembali ke Dashboard
                    </a>
                </div>

                @if ($consultations->count() > 0)
                    <div class="row">
                        @foreach ($consultations as $consultation)
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="card-title">{{ $consultation->user->name }}</h5>
                                                <p class="text-muted">Klien</p>
                                            </div>
                                            <div class="text-end">
                                                <span
                                                    class="badge bg-{{ $consultation->status == 'active'
                                                        ? 'success'
                                                        : ($consultation->status == 'completed'
                                                            ? 'primary'
                                                            : 'warning') }}">
                                                    {{ ucfirst($consultation->status) }}
                                                </span>
                                                <br>
                                                <span
                                                    class="badge bg-{{ $consultation->payment_status == 'paid' ? 'success' : 'warning' }} mt-1">
                                                    {{ ucfirst($consultation->payment_status) }}
                                                </span>
                                            </div>
                                        </div>

                                        <p class="card-text">
                                            <strong>Harga:</strong> Rp
                                            {{ number_format($consultation->amount, 0, ',', '.') }}
                                            <br>
                                            <strong>Tanggal:</strong> {{ $consultation->created_at->format('d M Y H:i') }}
                                            @if ($consultation->started_at)
                                                <br><strong>Dimulai:</strong>
                                                {{ $consultation->started_at->format('d M Y H:i') }}
                                            @endif
                                        </p>

                                        <div class="d-flex gap-2 flex-wrap">
                                            <a href="{{ route('psychologist.consultations.show', $consultation) }}"
                                                class="btn btn-outline-primary btn-sm">Detail</a>

                                            @if ($consultation->status == 'active' || $consultation->status == 'completed')
                                                <a href="{{ route('psychologist.chat.show', $consultation) }}"
                                                    class="btn btn-success btn-sm">Chat</a>
                                            @endif

                                            @if ($consultation->status == 'pending' && $consultation->payment_status == 'paid')
                                                <form method="POST"
                                                    action="{{ route('psychologist.consultations.update-status', $consultation) }}"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="active">
                                                    <button type="submit" class="btn btn-warning btn-sm">
                                                        Mulai Konsultasi
                                                    </button>
                                                </form>
                                            @endif

                                            @if ($consultation->status == 'active')
                                                <form method="POST"
                                                    action="{{ route('psychologist.consultations.update-status', $consultation) }}"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="completed">
                                                    <button type="submit" class="btn btn-secondary btn-sm"
                                                        onclick="return confirm('Yakin ingin menyelesaikan konsultasi ini?')">
                                                        Selesaikan
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $consultations->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="ph-duotone ph-chat-dots" style="font-size:80px;opacity:0.5;color:#4A90A4;"></i>
                        <h5 class="text-muted mt-3">Belum ada konsultasi</h5>
                        <p class="text-muted">Konsultasi dari klien akan muncul di sini</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
