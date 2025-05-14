@extends('layouts.pegawai')

@section('title', 'Riwayat Cuti Saya')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">📅 Riwayat Pengajuan Cuti</h3>
        <a href="{{ route('pegawai.cuti.create') }}" class="btn btn-success">
            <i class="fa fa-plus-circle me-1"></i> Ajukan Cuti Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow border-0">
        <div class="card-body">
            @if($cutis->count())
                <div class="table-responsive">
                    <table id="cutiTable" class="table table-bordered table-striped align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>🔢 Nomor</th>
                                <th>🗓️ Tgl Mulai</th>
                                <th>🗓️ Tgl Selesai</th>
                                <th>📄 Alasan</th>
                                <th>⏱️ Status</th>
                                <th>🕒 Diajukan Pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cutis as $index => $cuti)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
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
                                    <td class="text-center">{{ \Carbon\Carbon::parse($cuti->created_at)->format('d M Y, H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-secondary text-center">
                    🙁 Anda belum pernah mengajukan cuti.
                </div>
            @endif
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
                lengthMenu: "Tampilkan _MENU_ entri",
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
