@extends('layouts.admin')

@section('title', 'Kelola Pegawai')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">📋 Daftar Pegawai</h3>
        <a href="{{ route('admin.pegawai.create') }}" class="btn btn-success">
            <i class="fa fa-plus-circle me-1"></i> Tambah Pegawai
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow border-0">
        <div class="card-body">
            @if($pegawais->count())
                <div class="table-responsive">
                    <table id="pegawaiTable" class="table table-bordered table-striped align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>🔢 Nomor</th>
                                <th>👤 Nama</th>
                                <th>📧 Email</th>
                                <th>🎂 Tgl Lahir</th>
                                <th>⚧️ JK</th>
                                <th>⚙️ Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pegawais as $index => $pegawai)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $pegawai->name }}</td>
                                    <td>{{ $pegawai->email }}</td>
                                    <td>{{ $pegawai->tanggal_lahir ? \Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('d M Y') : '-' }}</td>
                                    <td class="text-center">
                                        {{ $pegawai->jenis_kelamin === 'L' ? '👨 Laki-laki' : '👩 Perempuan' }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.pegawai.show', $pegawai->id) }}" class="btn btn-info btn-sm me-1" title="Lihat">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.pegawai.edit', $pegawai->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.pegawai.destroy', $pegawai->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
            @else
                <div class="alert alert-secondary text-center">🙁 Belum ada data pegawai.</div>
            @endif
        </div>
    </div>
</div>
@endsection
@push('scripts')
<!-- jQuery (wajib sebelum DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CDN -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#pegawaiTable').DataTable({
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

