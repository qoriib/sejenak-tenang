@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5">
    <div class="content-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1>Konsultasi Baru</h1>
                        <a href="{{ route('user.consultations.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-4">Pilih Psikolog untuk Konsultasi</h5>
                            
                            <form method="POST" action="{{ route('user.consultations.store') }}">
                                @csrf
                                
                                <div class="row">
                                    @foreach($psychologists as $psychologist)
                                        <div class="col-md-6 mb-4">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" 
                                                               name="psychologist_id" 
                                                               value="{{ $psychologist->id }}"
                                                               id="psychologist{{ $psychologist->id }}" required>
                                                        <label class="form-check-label w-100" 
                                                               for="psychologist{{ $psychologist->id }}">
                                                            
                                                            <div class="text-center mb-3">
                                                                @if($psychologist->user->avatar)
                                                                    <img src="{{ asset('storage/' . $psychologist->user->avatar) }}" 
                                                                         alt="{{ $psychologist->user->name }}"
                                                                         class="rounded-circle"
                                                                         style="width: 80px; height: 80px; object-fit: cover;">
                                                                @else
                                                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto"
                                                                         style="width: 80px; height: 80px; font-size: 2rem;">
                                                                        {{ substr($psychologist->user->name, 0, 1) }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            
                                                            <h6 class="card-title">{{ $psychologist->user->name }}</h6>
                                                            <p class="text-muted small">{{ $psychologist->specialization }}</p>
                                                            <p class="card-text small">{{ $psychologist->description }}</p>
                                                            
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <span class="fw-bold text-primary">
                                                                    Rp {{ number_format($psychologist->price, 0, ',', '.') }}
                                                                </span>
                                                                <span class="badge bg-{{ $psychologist->status == 'available' ? 'success' : 'warning' }}">
                                                                    {{ ucfirst($psychologist->status) }}
                                                                </span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Buat Konsultasi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection