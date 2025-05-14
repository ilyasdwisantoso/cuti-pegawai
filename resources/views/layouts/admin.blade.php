<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title', 'Dashboard')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #3a6073, #16222a);
            min-height: 100vh;
            color: white;
        }

        .sidebar {
            height: 100vh;
            background-color: #212529;
            color: white;
            padding: 25px 20px;
            position: fixed;
            width: 220px;
        }

        .sidebar h4 {
            font-weight: bold;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: #dee2e6;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: 0.3s;
            font-weight: 500;
        }

        .sidebar a:hover,
        .sidebar .active-link {
            background-color: #495057;
            color: #fff;
        }

        .topbar {
            padding: 15px 30px;
            background-color: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-left: 220px;
        }

        .content {
            margin-left: 220px;
            padding: 30px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h4><i class="fa fa-shield-alt me-2"></i>Admin</h4>
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active-link' : '' }}">
        <i class="fa fa-home me-2"></i> Dashboard
    </a>
    <a href="{{ route('admin.index') }}" class="{{ request()->is('admin/list') ? 'active-link' : '' }}">
        <i class="fa fa-user-shield me-2"></i> Admin
    </a>
    <a href="{{ route('admin.pegawai.index') }}" class="{{ request()->is('admin/pegawai') ? 'active-link' : '' }}">
        <i class="fa fa-users me-2"></i> Pegawai
    </a>
    <a href="{{ route('admin.cuti.index') }}" class="{{ request()->is('admin/cuti') ? 'active-link' : '' }}">
        <i class="fa fa-calendar-alt me-2"></i> Cuti
    </a>
    <a href="{{ route('admin.cuti.laporan') }}" class="{{ request()->routeIs('admin.cuti.laporan') ? 'active-link' : '' }}">
        <i class="fa fa-chart-bar me-2"></i> Laporan Cuti
    </a>
    
    <hr class="text-secondary">
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-sign-out-alt me-2"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
</div>

<!-- TOPBAR -->
<div class="topbar d-flex justify-content-between align-items-center">
    <h5 class="mb-0">@yield('title')</h5>
    <div><i class="fa fa-user-circle me-1"></i> {{ Auth::user()->name }}</div>
</div>

<!-- MAIN CONTENT -->
<div class="content">
    @yield('content')
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')

</body>
</html>
