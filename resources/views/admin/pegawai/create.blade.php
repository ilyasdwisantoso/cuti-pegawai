@extends('layouts.admin')

@section('title', 'Tambah Pegawai')

@section('content')
<div class="container py-4">
    <div class="text-center mb-4">
        <i class="fa fa-user-plus fa-3x text-success mb-2"></i>
        <h3 class="fw-bold">Tambah Pegawai Baru</h3>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 bg-light text-dark">
                <div class="card-body p-4">
                    <form action="{{ route('admin.pegawai.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save me-1"></i> Simpan & Generate Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
