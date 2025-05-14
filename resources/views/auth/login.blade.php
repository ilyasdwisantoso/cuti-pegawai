@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg p-5 animate__animated animate__fadeIn"
         style="max-width: 460px; width: 100%; height: auto; min-height: 540px;
                background-color: rgba(255, 255, 255, 0.08);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border-radius: 20px;
                border: 1px solid rgba(255, 255, 255, 0.2); color: white;">

        <div class="text-center mb-4">
            <i class="fa fa-calendar-check fa-3x text-warning mb-3"></i>
            <h4 class="fw-bold">Sistem Cuti Pegawai</h4>
            <p class="text-light small">Login untuk mengakses dashboard Anda</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger text-light bg-danger bg-opacity-50 border-0">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" class="mt-4">
            @csrf

            <div class="mb-4">
                <label class="form-label text-white"><i class="fa fa-envelope me-1"></i> Email</label>
                <input type="email" name="email"
                       class="form-control bg-light bg-opacity-10 border-0 text-white @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" required autofocus style="backdrop-filter: blur(2px);">
                @error('email') <div class="invalid-feedback text-white">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label text-white"><i class="fa fa-lock me-1"></i> Password</label>
                <input type="password" name="password"
                       class="form-control bg-light bg-opacity-10 border-0 text-white @error('password') is-invalid @enderror"
                       required style="backdrop-filter: blur(2px);">
                @error('password') <div class="invalid-feedback text-white">{{ $message }}</div> @enderror
            </div>

            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-warning fw-semibold text-dark py-2">
                    <i class="fa fa-sign-in-alt me-1"></i> Masuk Sekarang
                </button>
            </div>

            <p class="text-center small text-light mb-0">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-warning fw-semibold">Daftar sekarang</a>
            </p>
        </form>
    </div>
</div>
@endsection
