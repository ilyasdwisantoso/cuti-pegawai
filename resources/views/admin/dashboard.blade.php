@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container py-4">
    <div class="text-center mb-5">
        <i class="fa fa-user-shield fa-3x text-warning mb-3"></i>
        <h2 class="fw-bold">Dashboard Admin</h2>
        <p class="text-light">Selamat datang, {{ Auth::user()->name }}! Kelola data pegawai dan cuti di sini.</p>
    </div>

    <div class="row justify-content-center">

        <!-- Kartu: Data Pegawai -->
        <div class="col-md-4 mb-4">
            <div class="card text-center shadow border-0 bg-light text-dark" style="border-radius: 15px;">
                <div class="card-body py-4">
                    <i class="fa fa-users fa-3x text-info mb-3"></i>
                    <h5 class="fw-bold">Manajemen Pegawai</h5>
                    <p class="text-muted small">Lihat dan kelola data pegawai aktif.</p>
                    <a href="{{ route('admin.pegawai.index') }}" class="btn btn-outline-info btn-sm">
                        Kelola Pegawai
                    </a>
                </div>
            </div>
        </div>

        <!-- Kartu: Data Cuti -->
        <div class="col-md-4 mb-4">
            <div class="card text-center shadow border-0 bg-light text-dark" style="border-radius: 15px;">
                <div class="card-body py-4">
                    <i class="fa fa-calendar-alt fa-3x text-success mb-3"></i>
                    <h5 class="fw-bold">Data Cuti Pegawai</h5>
                    <p class="text-muted small">Tambah dan pantau cuti setiap pegawai.</p>
                    <a href="{{ route('admin.cuti.index') }}" class="btn btn-outline-success btn-sm">
                        Kelola Cuti
                    </a>
                </div>
            </div>
        </div>

        <!-- Kartu: Laporan Cuti -->
        <div class="col-md-4 mb-4">
            <div class="card text-center shadow border-0 bg-light text-dark" style="border-radius: 15px;">
                <div class="card-body py-4">
                    <i class="fa fa-chart-bar fa-3x text-primary mb-3"></i>
                    <h5 class="fw-bold">Laporan Cuti</h5>
                    <p class="text-muted small">Lihat total cuti per pegawai tahun ini.</p>
                    <a href="{{ route('admin.cuti.laporan') }}" class="btn btn-outline-primary btn-sm">
                        Lihat Laporan
                    </a>
                </div>
            </div>
        </div>


        <!-- Kartu: Profil Admin -->
        <div class="col-md-4 mb-4">
            <div class="card text-center shadow border-0 bg-light text-dark" style="border-radius: 15px;">
                <div class="card-body py-4">
                    <i class="fa fa-user-cog fa-3x text-warning mb-3"></i>
                    <h5 class="fw-bold">Profil Saya</h5>
                    <p class="text-muted small">Perbarui informasi akun admin.</p>
                    <a href="{{ route('admin.edit', Auth::user()->id) }}" class="btn btn-outline-warning btn-sm">
                        Edit Profil
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
