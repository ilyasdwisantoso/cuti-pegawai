@extends('layouts.admin')

@section('title', 'Edit Admin')

@section('content')
<div class="container py-4">
    <div class="text-center mb-4">
        <i class="fa fa-user-edit fa-3x text-warning mb-2"></i>
        <h3 class="fw-bold">Edit Data Admin</h3>
        <p class="text-light">Perbarui informasi akun admin Anda.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 bg-light text-dark">
                <div class="card-body p-4">

                    <form action="{{ route('admin.update', $admin->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $admin->name) }}"
                                   class="form-control @error('name') is-invalid @enderror" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email', $admin->email) }}"
                                   class="form-control @error('email') is-invalid @enderror" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', \Carbon\Carbon::parse($admin->tanggal_lahir)->format('Y-m-d')) }}"
                                    class="form-control @error('tanggal_lahir') is-invalid @enderror" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                    <option value="L" {{ old('jenis_kelamin', $admin->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $admin->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-warning text-dark">
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
