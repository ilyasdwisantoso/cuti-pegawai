@extends('layouts.pegawai')

@section('title', 'Dashboard Pegawai')

@section('content')
<div class="container py-4">
    <div class="text-center mb-5">
        <i class="fa fa-user fa-3x text-info mb-3"></i>
        <h2 class="fw-bold">Dashboard Pegawai</h2>
        <p class="text-light">Halo, {{ Auth::user()->name }}! Selamat datang di sistem cuti pegawai.</p>
    </div>

    <div class="row justify-content-center">

        <!-- Kartu Ajukan Cuti -->
        <div class="col-md-5 mb-4">
            <div class="card text-center shadow border-0 bg-light text-dark" style="border-radius: 15px;">
                <div class="card-body py-4">
                    <i class="fa fa-calendar-plus fa-3x text-success mb-3"></i>
                    <h5 class="fw-bold">Ajukan Cuti</h5>
                    <p class="text-muted small">Ingin mengambil cuti? Ajukan langsung dari sini.</p>
                    <a href="{{ route('pegawai.cuti.create') }}" class="btn btn-outline-success btn-sm">
                        <i class="fa fa-plus-circle me-1"></i> Buat Pengajuan
                    </a>
                </div>
            </div>
        </div>

        <!-- Kartu Cuti Saya -->
        <div class="col-md-5 mb-4">
            <div class="card text-center shadow border-0 bg-light text-dark" style="border-radius: 15px;">
                <div class="card-body py-4">
                    <i class="fa fa-calendar-alt fa-3x text-primary mb-3"></i>
                    <h5 class="fw-bold">Riwayat Cuti</h5>
                    <p class="text-muted small">Lihat status dan riwayat pengajuan cuti Anda.</p>
                    <a href="{{ route('pegawai.cuti.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-list me-1"></i> Lihat Cuti Saya
                    </a>
                </div>
            </div>
        </div>

        <!-- Kartu Profil -->
        <div class="col-md-10 mb-4">
            <div class="card text-center shadow border-0 bg-light text-dark" style="border-radius: 15px;">
                <div class="card-body py-4">
                    <i class="fa fa-user-circle fa-3x text-warning mb-3"></i>
                    <h5 class="fw-bold">Profile Saya</h5>
                    <p class="text-muted small">Perbarui informasi pribadi Anda agar tetap akurat.</p>
                    <a href="{{ route('pegawai.profile') }}" class="btn btn-outline-warning btn-sm">
                        <i class="fa fa-user-edit me-1"></i> Lihat Profile
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
