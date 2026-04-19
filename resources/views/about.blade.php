@extends('layouts.app')

@section('title', 'Tentang Kami - Sejenak Tenang')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <!-- Logo Sejenak Tenang -->
            <div class="mb-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle"
                    style="width: 120px; height: 120px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 80px; height: 80px;">
                        <!-- Smiley Face -->
                        <div style="color: var(--primary-color); font-size: 2.5rem;">
                            <div style="position: relative;">
                                <div
                                    style="width: 60px; height: 60px; border: 3px solid currentColor; border-radius: 50%; position: relative;">
                                    <!-- Eyes -->
                                    <div
                                        style="position: absolute; top: 18px; left: 15px; width: 4px; height: 4px; background: currentColor; border-radius: 50%;">
                                    </div>
                                    <div
                                        style="position: absolute; top: 18px; right: 15px; width: 4px; height: 4px; background: currentColor; border-radius: 50%;">
                                    </div>
                                    <!-- Smile -->
                                    <div
                                        style="position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%); width: 25px; height: 12px; border-bottom: 3px solid currentColor; border-radius: 0 0 25px 25px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Title -->
            <h1 class="hero-title">SEJENAK TENANG</h1>
            <p class="hero-subtitle">
                Mengenal lebih dekat tentang platform kesehatan mental yang mengutamakan kenyamanan dan kepercayaan Anda
            </p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="content-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- About Content Card -->
                    <div class="card border-0 shadow-lg"
                        style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px;">
                        <div class="card-body p-5">
                            <div class="text-center text-dark">
                                <!-- Paragraph 1 -->
                                <p class="lead mb-4" style="line-height: 1.8; font-size: 1.1rem; color: #2c3e50;">
                                    <strong>Sejenak Tenang</strong> adalah aplikasi kesehatan mental yang dirancang untuk
                                    memfasilitasi ruang aman dan damai bagi siapa pun yang ingin memahami, terhubung, dan
                                    merawat diri sendiri. Kami percaya bahwa setiap orang berhak mendapatkan kedamaian
                                    batin, dukungan emosional, dan layanan kesehatan mental yang mudah diakses.
                                </p>

                                <!-- Paragraph 2 -->
                                <p class="lead mb-4" style="line-height: 1.8; font-size: 1.1rem; color: #2c3e50;">
                                    <strong>Sejenak Tenang</strong> menawarkan beragam fitur, termasuk jurnal harian,
                                    latihan mindfulness, akses psikologi, artikel edukatif, dan akses ke tenaga profesional
                                    kesehatan mental. Setiap fitur dirancang dengan cermat untuk membantu melewati hari-hari
                                    sulit, mengelola stres, dan secara bertahap membangun kebiasaan positif.
                                </p>

                                <!-- Paragraph 3 -->
                                <p class="lead mb-4" style="line-height: 1.8; font-size: 1.1rem; color: #2c3e50;">
                                    Kami berkomitmen untuk menciptakan lingkungan yang empatiik dan bebas stigma yang
                                    memberdayakan pengguna untuk mencintai diri sendiri, karena penyembuhan dimulai dengan
                                    keberanian untuk mengenal diri sendiri.
                                </p>

                                <!-- Final Quote -->
                                <div class="mt-5 pt-4 border-top">
                                    <p class="h5 fw-bold text-primary mb-0"
                                        style="font-style: italic; color: var(--primary-color) !important;">
                                        "Sejenak Tenang - karena setiap orang membutuhkan ruang untuk berdiam diri"
                                    </p>
                                </div>

                                <!-- Call to Action -->
                                <div class="mt-5">
                                    <div class="row g-3 justify-content-center">
                                        <div class="col-auto">
                                            <a href="{{ route('home') }}" class="btn btn-outline-primary btn-lg px-4">
                                                <i class="ph-bold ph-house me-2"></i>Kembali ke Beranda
                                            </a>
                                        </div>
                                        @guest
                                            <div class="col-auto">
                                                <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4">
                                                    <i class="ph-bold ph-user-plus me-2"></i>Bergabung Sekarang
                                                </a>
                                            </div>
                                        @endguest
                                        @auth
                                            <div class="col-auto">
                                                <a href="{{ route('articles.index') }}" class="btn btn-primary btn-lg px-4">
                                                    <i class="ph-bold ph-book-open me-2"></i>Baca Artikel
                                                </a>
                                            </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>
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
    </style>
@endsection
