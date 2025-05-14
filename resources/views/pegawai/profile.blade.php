@extends('layouts.pegawai')

@section('title', 'Profile Saya')

@section('content')
<div class="container py-4">
    <div class="text-center mb-4">
        <i class="fa fa-user-circle fa-3x text-primary mb-2"></i>
        <h3 class="fw-bold">Profile Pegawai</h3>
        <p class="text-muted">Lihat dan perbarui informasi akun Anda.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 bg-light text-dark">
                <div class="card-body p-4">
                    <form action="{{ route('pegawai.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                                   class="form-control @error('name') is-invalid @enderror" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                   class="form-control @error('email') is-invalid @enderror" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir"
                                       value="{{ old('tanggal_lahir', \Carbon\Carbon::parse(Auth::user()->tanggal_lahir)->format('Y-m-d')) }}"
                                       class="form-control @error('tanggal_lahir') is-invalid @enderror" required>
                                @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                    <option value="L" {{ old('jenis_kelamin', Auth::user()->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', Auth::user()->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('pegawai.dashboard') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
