@extends('layouts.admin')

@section('title', 'Data Cuti Pegawai')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">🗓️ Daftar Pengajuan Cuti</h3>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table id="cutiTable" class="table table-striped table-bordered align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>🔢 Nomor</th>
                            <th>👨 Pegawai</th>
                            <th>🗓️ Mulai</th>
                            <th>🗓️ Selesai</th>
                            <th>📄 Alasan</th>
                            <th>⏱️ Status</th>
                            <th>⚙️ Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cutis as $index => $cuti)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $cuti->pegawai->name }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d M Y') }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d M Y') }}</td>
                                <td>{{ $cuti->alasan }}</td>
                                <td class="text-center">
                                    @if($cuti->status == 'pending')
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @elseif($cuti->status == 'disetujui')
                                        <span class="badge bg-success">Disetujui</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($cuti->status === 'pending')
                                        <form action="{{ route('admin.cuti.status', $cuti->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="disetujui">
                                            <button type="submit" class="btn btn-success btn-sm me-1" title="Setujui">
                                                ✅
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.cuti.status', $cuti->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="ditolak">
                                            <button type="submit" class="btn btn-danger btn-sm" title="Tolak">
                                                ❌
                                            </button>
                                        </form>
                                    @else
                                        <i class="text-muted">Sudah diproses</i>
                                    @endif
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
<!-- jQuery + DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#cutiTable').DataTable({
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
