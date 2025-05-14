<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegawai Panel - @yield('title', 'Dashboard')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #3a6073, #16222a);
            color: white;
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
        }

        .sidebar {
            background-color: #1f1f1f;
            height: 100vh;
            padding: 25px 15px;
            position: fixed;
            width: 220px;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .sidebar h4 {
            color: #ffc107;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: #dee2e6;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            text-decoration: none;
            font-weight: 500;
        }

        .sidebar a:hover,
        .sidebar .active-link {
            background-color: #495057;
            color: #fff;
        }

        .topbar {
            margin-left: 220px;
            padding: 15px 30px;
            background-color: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .content {
            margin-left: 220px;
            padding: 30px;
        }
    </style>
</head>
<body>

<!-- Sidebar Pegawai -->
<div class="sidebar">
    <h4><i class="fa fa-user me-2"></i>Pegawai</h4>
    <a href="{{ route('pegawai.dashboard') }}" class="{{ request()->routeIs('pegawai.dashboard') ? 'active-link' : '' }}">
        <i class="fa fa-home me-2"></i> Dashboard
    </a>
    <a href="{{ route('pegawai.cuti.index') }}" class="{{ request()->is('pegawai/cuti') ? 'active-link' : '' }}">
        <i class="fa fa-calendar-alt me-2"></i> Cuti Saya
    </a>
    <a href="{{ route('pegawai.profile') }}" class="{{ request()->routeIs('pegawai.profile') ? 'active-link' : '' }}">
        <i class="fa fa-user-circle me-2"></i> Profil
    </a>
    <hr class="text-secondary">
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-sign-out-alt me-2"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
</div>

<!-- Topbar -->
<div class="topbar d-flex justify-content-between align-items-center">
    <h5 class="mb-0">@yield('title')</h5>
    <div><i class="fa fa-user me-1"></i> {{ Auth::user()->name }}</div>
</div>

<!-- Konten Utama -->
<div class="content">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
