@extends('layouts.admin')

@section('title', 'Laporan Cuti Pegawai')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h3 class="fw-bold">📊 Laporan Cuti Pegawai</h3>
        <p class="text-white">Menampilkan jumlah hari cuti yang telah digunakan setiap pegawai dalam tahun ini.</p>
    </div>    

    <div class="card shadow border-0">
        <div class="card-body">
            @if($pegawais->count())
                <div class="table-responsive">
                    <table id="laporanCutiTable" class="table table-bordered table-striped align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>👤 Nama Pegawai</th>
                                <th>📧 Email</th>
                                <th>🧮 Total Hari Cuti</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pegawais as $pegawai)
                                <tr>
                                    <td>{{ $pegawai->name }}</td>
                                    <td>{{ $pegawai->email }}</td>
                                    <td class="text-center">
                                        {{ $pegawai->cutis->first()->total_hari ?? 0 }} hari
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-secondary text-center">
                    🙁 Belum ada data pegawai ditemukan.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#laporanCutiTable').DataTable({
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
