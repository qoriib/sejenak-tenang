<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sejenak Tenang') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #4A90A4;
            --secondary-color: #5FB3CC;
            --accent-color: #7DD3FC;
            --dark-teal: #0F4C75;
            --light-bg: #F0F9FF;
        }

        body {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            color: var(--primary-color) !important;
            font-size: 1.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 144, 164, 0.3);
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .hero-section {
            padding: 120px 0;
            color: white;
            text-align: center;
            background: linear-gradient(rgba(74, 144, 164, 0.8), rgba(95, 179, 204, 0.8)),
                url('/storage/backgrounds/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .content-section {
            background: var(--light-bg);
            border-radius: 30px 30px 0 0;
            margin-top: -50px;
            position: relative;
            /* z-index: 1; */
            min-height: 500px;
            padding: 50px 0;
        }

        .article-card img {
            height: 200px;
            object-fit: cover;
            border-radius: 15px 15px 0 0;
        }

        .psychologist-card {
            text-align: center;
            padding: 20px;
        }

        .psychologist-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--accent-color);
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .badge {
            border-radius: 15px;
            padding: 8px 15px;
        }

        .alert {
            border-radius: 15px;
            border: none;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                Sejenak Tenang
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles.index') }}">Articles</a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary ms-2" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                data-bs-toggle="dropdown">
                                <div class="me-2">
                                    @if (Auth::user()->avatar)
                                        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                            class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                                    @else
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white"
                                            style="width: 32px; height: 32px; font-size: 14px; font-weight: bold;">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg"
                                style="min-width: 250px; border-radius: 15px; border: none;">
                                <!-- User Info Header -->
                                <li class="px-3 py-3 bg-light border-bottom">
                                    <div class="d-flex align-items-center">
                                        @if (Auth::user()->avatar)
                                            <img src="{{ Storage::url(Auth::user()->avatar) }}"
                                                alt="{{ Auth::user()->name }}" class="rounded-circle me-3"
                                                style="width: 48px; height: 48px; object-fit: cover;">
                                        @else
                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white me-3"
                                                style="width: 48px; height: 48px; font-size: 18px; font-weight: bold;">
                                                {{ substr(Auth::user()->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-bold text-dark">{{ Auth::user()->name }}</div>
                                            <small class="text-muted">{{ Auth::user()->email }}</small>
                                        </div>
                                    </div>
                                </li>

                                <!-- Profile Settings -->
                                <li>
                                    <a class="dropdown-item py-2 d-flex align-items-center"
                                        href="{{ route('profile.settings') }}">
                                        <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center"
                                            style="width: 36px; height: 36px;">
                                            <i class="ph-duotone ph-user-circle" style="font-size:20px;color:var(--primary-color);"></i>
                                        </div>
                                        <span>Profile Settings</span>
                                    </a>
                                </li>

                                <!-- Dashboard -->
                                <li>
                                    <a class="dropdown-item py-2 d-flex align-items-center"
                                        href="{{ route('dashboard') }}">
                                        <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center"
                                            style="width: 36px; height: 36px;">
                                            <i class="ph-duotone ph-squares-four" style="font-size:20px;color:var(--primary-color);"></i>
                                        </div>
                                        <span>Dashboard</span>
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <!-- About Us -->
                                <li>
                                    <a class="dropdown-item py-2 d-flex align-items-center" href="{{ route('about') }}">
                                        <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center"
                                            style="width: 36px; height: 36px;">
                                            <i class="ph-duotone ph-info" style="font-size:20px;color:var(--primary-color);"></i>
                                        </div>
                                        <span>About Us</span>
                                    </a>
                                </li>

                                <!-- Privacy Policy -->
                                <li>
                                    <a class="dropdown-item py-2 d-flex align-items-center"
                                        href="{{ route('privacy-policy') }}">
                                        <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center"
                                            style="width: 36px; height: 36px;">
                                            <i class="ph-duotone ph-shield-check" style="font-size:20px;color:var(--primary-color);"></i>
                                        </div>
                                        <span>Privacy Policy</span>
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <!-- Logout -->
                                <li>
                                    <a class="dropdown-item py-2 d-flex align-items-center text-danger"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center"
                                            style="width: 36px; height: 36px;">
                                            <i class="ph-duotone ph-sign-out" style="font-size:20px;color:#dc3545;"></i>
                                        </div>
                                        <span>Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="fw-bold text-primary">Sejenak Tenang</h5>
                    <p class="mb-2">Platform kesehatan mental yang memberikan ruang aman untuk pemulihan diri.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold mb-3">Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-white-50 text-decoration-none">About</a></li>
                        <li><a href="{{ route('articles.index') }}"
                                class="text-white-50 text-decoration-none">Articles</a></li>
                        <li><a href="{{ route('privacy-policy') }}"
                                class="text-white-50 text-decoration-none">Privacy
                                Policy</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-3">
            <div class="text-center text-white-50">
                <p class="mb-0">&copy; {{ date('Y') }} Sejenak Tenang. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
