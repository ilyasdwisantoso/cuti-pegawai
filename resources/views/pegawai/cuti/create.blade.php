@extends('layouts.pegawai')

@section('title', 'Ajukan Cuti')

@section('content')
<div class="container py-4">
    <div class="text-center mb-4">
        <i class="fa fa-calendar-plus fa-3x text-success mb-2"></i>
        <h3 class="fw-bold">Form Pengajuan Cuti</h3>
        <p class="text-muted">Silakan isi formulir di bawah ini dengan benar.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 bg-light">
                <div class="card-body p-4">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>❗ {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pegawai.cuti.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai') }}" required>
                            @error('tanggal_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai') }}" required>
                            @error('tanggal_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alasan Cuti</label>
                            <textarea name="alasan" rows="4" class="form-control @error('alasan') is-invalid @enderror" placeholder="Contoh: Ingin berobat, acara keluarga, dll..." required>{{ old('alasan') }}</textarea>
                            @error('alasan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('pegawai.cuti.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-paper-plane me-1"></i> Ajukan Cuti
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
