@extends('layouts.app')

@section('title', 'Profile Settings - Sejenak Tenang')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <!-- User Avatar -->
            <div class="mb-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle"
                    style="width: 120px; height: 120px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                    @if (auth()->user()->avatar)
                        <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                            class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                    @else
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white"
                            style="width: 100px; height: 100px; font-size: 2.5rem; font-weight: bold;">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Title -->
            <h1 class="hero-title">PROFILE SETTINGS</h1>
            <p class="hero-subtitle">
                Kelola informasi pribadi dan preferensi akun Anda
            </p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="content-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="ph-bold ph-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Profile Settings Card -->
                    <div class="card border-0 shadow-lg"
                        style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px;">
                        <div class="card-body p-5">
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Profile Picture Section -->
                                <div class="mb-5">
                                    <h5 class="mb-3" style="color: var(--primary-color);">
                                        <i class="ph-duotone ph-camera me-2"></i>Foto Profil
                                    </h5>
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="position-relative">
                                                @if (auth()->user()->avatar)
                                                    <img src="{{ Storage::url(auth()->user()->avatar) }}"
                                                        alt="{{ auth()->user()->name }}" class="rounded-circle"
                                                        style="width: 80px; height: 80px; object-fit: cover;"
                                                        id="avatar-preview">
                                                @else
                                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white"
                                                        style="width: 80px; height: 80px; font-size: 1.5rem; font-weight: bold;"
                                                        id="avatar-preview">
                                                        {{ substr(auth()->user()->name, 0, 1) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col">
                                            <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                                id="avatar" name="avatar" accept="image/*"
                                                onchange="previewAvatar(event)">
                                            <small class="text-muted">Format yang didukung: JPG, PNG, GIF. Maksimal
                                                2MB.</small>
                                            @error('avatar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Personal Information -->
                                <div class="mb-5">
                                    <h5 class="mb-3" style="color: var(--primary-color);">
                                        <i class="ph-duotone ph-user me-2"></i>Informasi Pribadi
                                    </h5>

                                    <!-- Name -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', auth()->user()->name) }}"
                                            required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                            required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Bio -->
                                    <div class="mb-3">
                                        <label for="bio" class="form-label">Bio</label>
                                        <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="4"
                                            placeholder="Ceritakan sedikit tentang diri Anda...">{{ old('bio', auth()->user()->bio) }}</textarea>
                                        <small class="text-muted">Maksimal 500 karakter</small>
                                        @error('bio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Account Information -->
                                <div class="mb-5">
                                    <h5 class="mb-3" style="color: var(--primary-color);">
                                        <i class="ph-duotone ph-shield me-2"></i>Informasi Akun
                                    </h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="bg-light p-3 rounded">
                                                <small class="text-muted">Role</small>
                                                <div class="fw-bold text-capitalize">{{ auth()->user()->role }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="bg-light p-3 rounded">
                                                <small class="text-muted">Bergabung Sejak</small>
                                                <div class="fw-bold">{{ auth()->user()->created_at->format('d M Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-lg px-4">
                                        <i class="ph-bold ph-arrow-left me-2"></i>Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-lg px-4">
                                        <i class="ph-bold ph-floppy-disk me-2"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Change Password Card -->
                    <div class="card border-0 shadow-lg mt-4"
                        style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px;">
                        <div class="card-body p-5">
                            <h5 class="mb-3" style="color: var(--primary-color);">
                                <i class="ph-duotone ph-key me-2"></i>Ubah Password
                            </h5>
                            <p class="text-muted mb-4">Untuk keamanan akun, kami sarankan mengganti password secara
                                berkala.</p>
                            <a href="#" class="btn btn-outline-warning btn-lg"
                                onclick="alert('Fitur ini akan segera tersedia!')">
                                <i class="ph-duotone ph-lock me-2"></i>Ubah Password
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .card {
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(74, 144, 164, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-teal);
        }
    </style>

    <script>
        function previewAvatar(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('avatar-preview');
                    preview.innerHTML =
                        `<img src="${e.target.result}" alt="Preview" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">`;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
