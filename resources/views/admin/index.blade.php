@extends('layouts.admin')

@section('title', 'Kelola Admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">👤 Daftar Admin Sistem</h3>
        <a href="{{ route('admin.create') }}" class="btn btn-success">
            <i class="fa fa-plus-circle me-1"></i> Tambah Admin
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table id="adminTable" class="table table-hover table-bordered align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>🔢 Nomor</th>
                            <th>👤 Nama</th>
                            <th>📧 Email</th>
                            <th>🎂 Tgl Lahir</th>
                            <th>⚧️ Jenis Kelamin</th>
                            <th>⚙️ Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $index => $admin)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td class="text-center">
                                    {{ $admin->tanggal_lahir ? \Carbon\Carbon::parse($admin->tanggal_lahir)->format('d M Y') : '-' }}
                                </td>
                                <td class="text-center">
                                    {{ $admin->jenis_kelamin == 'L' ? '👨 Laki-laki' : '👩 Perempuan' }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- jQuery & DataTables CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#adminTable').DataTable({
            language: {
                search: "🔍 Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                zeroRecords: "Tidak ditemukan",
                infoEmpty: "Data kosong",
                paginate: {
                    next: "➡️",
                    previous: "⬅️"
                }
            }
        });
    });
</script>
@endpush
