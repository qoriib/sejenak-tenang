@extends('layouts.app')

@section('title', 'Privacy Policy - Sejenak Tenang')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <!-- Title -->
            <h1 class="hero-title">PRIVACY POLICY</h1>
            <p class="hero-subtitle">
                Komitmen kami dalam melindungi privasi dan keamanan data pribadi Anda
            </p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="content-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Privacy Policy Content Card -->
                    <div class="card border-0 shadow-lg"
                        style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px;">
                        <div class="card-body p-5">
                            <!-- Header -->
                            <div class="text-center mb-4">
                                <h2 class="h3 fw-bold text-primary mb-2">SEJENAK TENANG</h2>
                                <p class="text-muted mb-0">Last Update February 2030</p>
                            </div>

                            <!-- Content -->
                            <div class="privacy-content" style="line-height: 1.8; color: #2c3e50;">
                                <!-- Paragraph 1 -->
                                <p class="mb-4" style="text-align: justify;">
                                    Kami menyadari pentingnya melindungi privasi dan hak anda terkait perlindungan data
                                    pribadi.
                                    Internet merupakan alat yang ampuh untuk memberikan informasi pribadi, oleh karena itu,
                                    kami
                                    di <strong>Sejenak Tenang</strong> berkomitmen untuk mematuhi peraturan dan hukum yang
                                    berlaku terkait perlindungan dan keamanan data pribadi.
                                </p>

                                <!-- Paragraph 2 -->
                                <p class="mb-4" style="text-align: justify;">
                                    Kami bertanggung jawab untuk memastikan bahwa semua aktivitas dalam aplikasi
                                    <strong>Sejenak
                                        Tenang</strong> - termasuk penggunaan layanan konsultasi, akses ke artikel kesehatan
                                    mental, dan pelacakan suasana hati dilakukan dengan cara yang aman, terkendali, dan
                                    rahasia.
                                    Tujuan kami adalah menyediakan lingkungan yang aman dan terlindungi bagi setiap
                                    pengguna.
                                </p>

                                <!-- Paragraph 3 -->
                                <p class="mb-4" style="text-align: justify;">
                                    Kami hanya akan mengumpulkan, menyimpan, dan menggunakan informasi pribadi untuk tujuan
                                    yang
                                    telah ditetapkan dan disepakati secara jelas, seperti memberikan layanan kesehatan
                                    mental
                                    yang lebih baik, mempersonalisasi konten sesuai kebutuhan Anda, dan menjaga kualitas
                                    serta
                                    kemanan aplikasi kami.
                                </p>

                                <!-- Paragraph 4 -->
                                <p class="mb-4" style="text-align: justify;">
                                    Dengan menggunakan aplikasi <strong>Sejenak Tenang</strong>, mengakses fitur-fiturnya,
                                    atau
                                    memberikan data pribadi Anda untuk tujuan tertentu, Anda mengonfirmasi bahwa Anda telah
                                    membaca, memahami, dan menyetujui kebijakan privasi ini.
                                </p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-5 pt-4 border-top text-center">
                                <div class="row g-3 justify-content-center">
                                    <div class="col-auto">
                                        <a href="{{ route('home') }}" class="btn btn-outline-primary btn-lg px-4">
                                            <i class="ph-bold ph-house me-2"></i>Kembali ke Beranda
                                        </a>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('about') }}" class="btn btn-primary btn-lg px-4">
                                            <i class="ph-bold ph-info me-2"></i>Tentang Kami
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Footer Note -->
                            <div class="mt-4 text-center">
                                <small class="text-muted">
                                    Jika Anda memiliki pertanyaan tentang kebijakan privasi ini,
                                    silakan hubungi kami melalui <a href="mailto:privacy@sejenaktenang.com"
                                        class="text-primary">privacy@sejenaktenang.com</a>
                                </small>
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

        .btn-link {
            text-decoration: none;
        }

        .btn-link:hover {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .privacy-content p {
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .text-primary {
            color: var(--primary-color) !important;
        }
    </style>
@endsection
