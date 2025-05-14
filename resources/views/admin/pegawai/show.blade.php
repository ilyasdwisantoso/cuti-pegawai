@extends('layouts.admin')

@section('title', 'Detail Pegawai')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4">Detail Pegawai</h3>

    <div class="card shadow">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $pegawai->name }}</p>
            <p><strong>Email:</strong> {{ $pegawai->email }}</p>
            <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('d M Y') }}</p>
            <p><strong>Jenis Kelamin:</strong> {{ $pegawai->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
        </div>
    </div>

    <a href="{{ route('admin.pegawai.index') }}" class="btn btn-secondary mt-3">
        <i class="fa fa-arrow-left me-1"></i> Kembali
    </a>
</div>
@endsection
