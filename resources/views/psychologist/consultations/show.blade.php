@extends('layouts.app')

@section('title', 'Detail Konsultasi - Psikolog')

@section('content')
    <div class="container-fluid" style="padding-top: 100px;">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Back Button -->
                <div class="mb-4">
                    <a href="{{ route('psychologist.consultations.index') }}" class="btn btn-outline-primary">
                        <i class="ph-bold ph-arrow-left me-2"></i>Kembali ke Daftar Konsultasi
                    </a>
                </div>

                <!-- Consultation Detail Card -->
                <div class="card shadow-lg border-0" style="border-radius: 20px;">
                    <div class="card-header bg-primary text-white" style="border-radius: 20px 20px 0 0;">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="mb-0">Detail Konsultasi</h4>
                            </div>
                            <div class="col-auto">
                                <span class="badge bg-light text-primary px-3 py-2">
                                    {{ ucfirst($consultation->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="row">
                            <!-- Patient Info -->
                            <div class="col-md-6 mb-4">
                                <h5 class="text-primary mb-3">
                                    <i class="ph-duotone ph-user me-2"></i>Informasi Pasien
                                </h5>
                                <div class="d-flex align-items-center mb-3">
                                    @if ($consultation->user->avatar)
                                        <img src="{{ Storage::url($consultation->user->avatar) }}"
                                            alt="{{ $consultation->user->name }}" class="rounded-circle me-3"
                                            style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3 text-primary"
                                            style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">
                                            {{ substr($consultation->user->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div>
                                        <h6 class="mb-1">{{ $consultation->user->name }}</h6>
                                        <p class="text-muted mb-0">{{ $consultation->user->email }}</p>
                                    </div>
                                </div>
                                @if ($consultation->user->bio)
                                    <p class="text-muted">{{ $consultation->user->bio }}</p>
                                @endif
                            </div>

                            <!-- Consultation Info -->
                            <div class="col-md-6 mb-4">
                                <h5 class="text-primary mb-3">
                                    <i class="ph-duotone ph-calendar me-2"></i>Informasi Konsultasi
                                </h5>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="text-muted">Tanggal Dibuat:</td>
                                            <td>{{ $consultation->created_at->format('d M Y, H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Status:</td>
                                            <td>
                                                <span
                                                    class="badge 
                                                @if ($consultation->status == 'pending') bg-warning
                                                @elseif($consultation->status == 'active') bg-success
                                                @elseif($consultation->status == 'completed') bg-primary
                                                @else bg-secondary @endif">
                                                    {{ ucfirst($consultation->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Status Pembayaran:</td>
                                            <td>
                                                <span
                                                    class="badge 
                                                @if ($consultation->payment_status == 'pending') bg-warning
                                                @elseif($consultation->payment_status == 'verified') bg-success
                                                @else bg-secondary @endif">
                                                    {{ ucfirst($consultation->payment_status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Biaya:</td>
                                            <td>Rp {{ number_format($consultation->amount, 0, ',', '.') }}</td>
                                        </tr>
                                        @if ($consultation->started_at)
                                            <tr>
                                                <td class="text-muted">Dimulai:</td>
                                                <td>{{ $consultation->started_at->format('d M Y, H:i') }}</td>
                                            </tr>
                                        @endif
                                        @if ($consultation->ended_at)
                                            <tr>
                                                <td class="text-muted">Selesai:</td>
                                                <td>{{ $consultation->ended_at->format('d M Y, H:i') }}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Info -->
                        @if ($consultation->payment)
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="text-primary mb-3">
                                        <i class="ph-duotone ph-credit-card me-2"></i>Informasi Pembayaran
                                    </h5>
                                    <div class="bg-light p-3 rounded">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-1"><strong>Metode Pembayaran:</strong>
                                                    {{ $consultation->payment->payment_method ?? 'Transfer Bank' }}</p>
                                                <p class="mb-1"><strong>Status:</strong>
                                                    <span
                                                        class="badge 
                                                @if ($consultation->payment->status == 'pending') bg-warning
                                                @elseif($consultation->payment->status == 'verified') bg-success
                                                @else bg-danger @endif">
                                                        {{ ucfirst($consultation->payment->status) }}
                                                    </span>
                                                </p>
                                            </div>
                                            @if ($consultation->payment->proof_image)
                                                <div class="col-md-6">
                                                    <p class="mb-1"><strong>Bukti Pembayaran:</strong></p>
                                                    <img src="{{ Storage::url($consultation->payment->proof_image) }}"
                                                        alt="Bukti Pembayaran" class="img-thumbnail"
                                                        style="max-width: 200px; cursor: pointer;"
                                                        onclick="showImageModal(this.src)">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Chat Messages Preview -->
                        @if ($consultation->chats->count() > 0)
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5 class="text-primary mb-3">
                                        <i class="ph-duotone ph-chat-dots me-2"></i>Pesan Terbaru
                                    </h5>
                                    <div class="bg-light p-3 rounded" style="max-height: 300px; overflow-y: auto;">
                                        @foreach ($consultation->chats->take(5) as $chat)
                                            <div
                                                class="d-flex {{ $chat->sender_id == Auth::id() ? 'justify-content-end' : 'justify-content-start' }} mb-2">
                                                <div class="chat-message {{ $chat->sender_id == Auth::id() ? 'bg-primary text-white' : 'bg-white border' }}"
                                                    style="max-width: 70%; padding: 8px 12px; border-radius: 12px;">
                                                    <div class="small mb-1">
                                                        <strong>{{ $chat->sender_id == Auth::id() ? 'Anda' : $chat->sender->name }}</strong>
                                                    </div>
                                                    <div>{{ $chat->message }}</div>
                                                    <div class="text-end mt-1">
                                                        <small
                                                            class="{{ $chat->sender_id == Auth::id() ? 'text-white-50' : 'text-muted' }}">
                                                            {{ $chat->sent_at->format('H:i') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if ($consultation->chats->count() > 5)
                                            <div class="text-center">
                                                <small class="text-muted">Dan {{ $consultation->chats->count() - 5 }} pesan
                                                    lainnya...</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex gap-2 justify-content-center">
                                    <!-- Chat Button -->
                                    @if ($consultation->status == 'active' || $consultation->status == 'completed')
                                        <a href="{{ route('psychologist.chat.show', $consultation) }}"
                                            class="btn btn-success btn-lg">
                                            <i class="ph-duotone ph-chat-dots me-2"></i>Mulai Chat
                                        </a>
                                    @endif

                                    <!-- Status Update -->
                                    @if ($consultation->payment_status == 'verified')
                                        @if ($consultation->status == 'pending')
                                            <form method="POST"
                                                action="{{ route('psychologist.consultations.update-status', $consultation) }}"
                                                class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="active">
                                                <button type="submit" class="btn btn-primary btn-lg">
                                                    <i class="ph-bold ph-play me-2"></i>Mulai Konsultasi
                                                </button>
                                            </form>
                                        @elseif($consultation->status == 'active')
                                            <form method="POST"
                                                action="{{ route('psychologist.consultations.update-status', $consultation) }}"
                                                class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="btn btn-outline-primary btn-lg"
                                                    onclick="return confirm('Apakah Anda yakin ingin menyelesaikan konsultasi ini?')">
                                                    <i class="ph-bold ph-check me-2"></i>Selesaikan Konsultasi
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bukti Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Bukti Pembayaran" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function showImageModal(src) {
            document.getElementById('modalImage').src = src;
            new bootstrap.Modal(document.getElementById('imageModal')).show();
        }
    </script>
@endpush
