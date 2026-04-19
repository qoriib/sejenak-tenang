@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5">
    <div class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1>Detail Konsultasi</h1>
                        <a href="{{ route('user.consultations.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    @if($consultation->psychologist->user->avatar)
                                        <img src="{{ asset('storage/' . $consultation->psychologist->user->avatar) }}" 
                                             alt="{{ $consultation->psychologist->user->name }}"
                                             class="rounded-circle mb-3"
                                             style="width: 120px; height: 120px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                                             style="width: 120px; height: 120px; font-size: 3rem;">
                                            {{ substr($consultation->psychologist->user->name, 0, 1) }}
                                        </div>
                                    @endif
                                    
                                    <h5>{{ $consultation->psychologist->user->name }}</h5>
                                    <p class="text-muted">{{ $consultation->psychologist->specialization }}</p>
                                </div>
                                
                                <div class="col-md-8">
                                    <h6>Informasi Konsultasi</h6>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="40%">Status Konsultasi:</td>
                                            <td>
                                                <span class="badge bg-{{ 
                                                    $consultation->status == 'active' ? 'success' : 
                                                    ($consultation->status == 'completed' ? 'primary' : 'warning') 
                                                }}">
                                                    {{ ucfirst($consultation->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Status Pembayaran:</td>
                                            <td>
                                                <span class="badge bg-{{ 
                                                    $consultation->payment_status == 'paid' ? 'success' : 'warning' 
                                                }}">
                                                    {{ ucfirst($consultation->payment_status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Harga:</td>
                                            <td>Rp {{ number_format($consultation->amount, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Dibuat:</td>
                                            <td>{{ $consultation->created_at->format('d M Y H:i') }}</td>
                                        </tr>
                                        @if($consultation->started_at)
                                            <tr>
                                                <td>Dimulai:</td>
                                                <td>{{ $consultation->started_at->format('d M Y H:i') }}</td>
                                            </tr>
                                        @endif
                                        @if($consultation->ended_at)
                                            <tr>
                                                <td>Selesai:</td>
                                                <td>{{ $consultation->ended_at->format('d M Y H:i') }}</td>
                                            </tr>
                                        @endif
                                    </table>

                                    <div class="mt-3">
                                        @if($consultation->status == 'active')
                                            <a href="{{ route('user.chat.show', $consultation) }}" 
                                               class="btn btn-success">Mulai Chat</a>
                                        @elseif($consultation->status == 'pending' && $consultation->payment_status == 'unpaid')
                                            <span class="text-muted">Silakan upload bukti pembayaran untuk memulai konsultasi</span>
                                        @elseif($consultation->status == 'pending' && $consultation->payment_status == 'pending')
                                            <span class="text-muted">Menunggu verifikasi pembayaran oleh admin</span>
                                        @elseif($consultation->status == 'completed')
                                            <span class="text-success">Konsultasi telah selesai</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Payment Section -->
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Pembayaran</h6>
                        </div>
                        <div class="card-body">
                            @if($consultation->payment_status == 'unpaid')
                                <div class="alert alert-warning">
                                    <strong>Pembayaran Diperlukan</strong><br>
                                    Silakan transfer ke rekening berikut dan upload bukti pembayaran.
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Bank BCA</strong><br>
                                    <strong>No. Rekening:</strong> 1234567890<br>
                                    <strong>Atas Nama:</strong> Sejenak Tenang<br>
                                    <strong>Jumlah:</strong> Rp {{ number_format($consultation->amount, 0, ',', '.') }}
                                </div>

                                <form method="POST" action="{{ route('user.consultations.upload-payment', $consultation) }}" 
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="payment_proof" class="form-label">Bukti Pembayaran</label>
                                        <input type="file" class="form-control" name="payment_proof" 
                                               accept="image/*" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">
                                        Upload Bukti Pembayaran
                                    </button>
                                </form>
                            
                            @elseif($consultation->payment_status == 'pending')
                                <div class="alert alert-info">
                                    <strong>Menunggu Verifikasi</strong><br>
                                    Bukti pembayaran Anda sedang diverifikasi oleh admin.
                                </div>
                                
                                @if($consultation->payment && $consultation->payment->payment_proof)
                                    <img src="{{ Storage::url($consultation->payment->payment_proof) }}" 
                                         class="img-fluid rounded" alt="Payment Proof">
                                @endif
                            
                            @elseif($consultation->payment_status == 'paid')
                                <div class="alert alert-success">
                                    <strong>Pembayaran Terverifikasi</strong><br>
                                    Konsultasi Anda sudah dapat dimulai.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection