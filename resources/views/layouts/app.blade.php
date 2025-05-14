<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuti Pegawai | {{ config('app.name', 'Cuti Pegawai') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts + Bootstrap + FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


    <style>
        body {
            font-family: 'Rubik', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #3a7bd5, #3a6073);
            background-attachment: fixed;
            background-size: cover;
            color: #f8f9fa;
        }

        

        .navbar {
            background-color: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .navbar-brand,
        .nav-link,
        .dropdown-item {
            color: #ffffff !important;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 20px;
            letter-spacing: 1px;
        }

        .nav-link:hover,
        .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 6px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.15);
            color: #333;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
        }

        .btn-primary {
            background-color: #3a7bd5;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2f6ab3;
        }
    </style>
</head>
<body>

<div id="app">
    <nav class="navbar navbar-expand-md shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fa fa-calendar-check me-1 text-warning"></i> Cuti Pegawai
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon bg-white rounded"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fa fa-sign-in-alt me-1"></i> Login
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    <i class="fa fa-user-plus me-1"></i> Daftar
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end text-dark">
                                <a class="dropdown-item" href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out-alt me-1"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-5 container">
        @yield('content')
    </main>

    <footer>
        <i class="fa fa-leaf me-1"></i> Sistem Informasi Cuti Pegawai – {{ date('Y') }}
    </footer>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
