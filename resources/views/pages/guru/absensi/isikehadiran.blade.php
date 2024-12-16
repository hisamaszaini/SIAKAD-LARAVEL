@extends('layouts.master', ['title' => 'Input Kehadiran'])

@section('plugins_css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<section class="section">
    @include('layouts.sectionheader')
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Input Kehadiran Siswa untuk Tanggal: {{ date('d-m-Y', strtotime($absensi->tanggal)) }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('guru.kehadiran.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="absensi_id" value="{{ $absensi->id }}">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswas as $key => $siswa)
                            <tr data-siswa-id="{{ $siswa->id }}">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $siswa->nama_siswa }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        @php
                                        // Ambil status kehadiran siswa jika ada
                                        $statusKehadiran = isset($kehadiranData[$siswa->id]) ? $kehadiranData[$siswa->id] : '2';
                                        @endphp

                                        <input type="hidden" name="kehadiran[{{ $siswa->id }}]" value="{{ $statusKehadiran }}" id="kehadiran_{{ $siswa->id }}">

                                        <button type="button" class="btn btn-success kehadiran-btn {{ $statusKehadiran === 'Hadir' ? 'active' : '' }}" data-status="Hadir" onclick="setKehadiran({{ $siswa->id }}, 'Hadir')">
                                            {{ $statusKehadiran === 'Hadir' ? 'Hadir' : 'Tandai Hadir' }}
                                        </button>
                                        <button type="button" class="btn btn-danger kehadiran-btn {{ $statusKehadiran === 'Tidak Hadir' ? 'active' : '' }}" data-status="Tidak Hadir" onclick="setKehadiran({{ $siswa->id }}, 'Tidak Hadir')">
                                            {{ $statusKehadiran === 'Tidak Hadir' ? 'Tidak Hadir' : 'Tandai Tidak Hadir' }}
                                        </button>
                                        <button type="button" class="btn btn-warning kehadiran-btn {{ $statusKehadiran === 'Sakit' ? 'active' : '' }}" data-status="Sakit" onclick="setKehadiran({{ $siswa->id }}, 'Sakit')">
                                            {{ $statusKehadiran === 'Sakit' ? 'Sakit' : 'Tandai Sakit' }}
                                        </button>
                                        <button type="button" class="btn btn-info kehadiran-btn {{ $statusKehadiran === 'Izin' ? 'active' : '' }}" data-status="Izin" onclick="setKehadiran({{ $siswa->id }}, 'Izin')">
                                            {{ $statusKehadiran === 'Izin' ? 'Izin' : 'Tandai Izin' }}
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan Kehadiran</button>
                        <a href="{{ route('guru.absensi.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page_js')
<script>
    // Fungsi untuk mengatur kehadiran
    function setKehadiran(siswaId, status) {
    const input = document.querySelector(`input[name="kehadiran[${siswaId}]"]`);
    if (input) {
        // Mengonversi status menjadi integer
        let statusValue;
        switch (status) {
            case 'Hadir':
                statusValue = 1; // Hadir
                break;
            case 'Tidak Hadir':
                statusValue = 2; // Tidak Hadir
                break;
            case 'Sakit':
                statusValue = 3; // Sakit
                break;
            case 'Izin':
                statusValue = 4; // Izin
                break;
            default:
                statusValue = 2; // Default ke 'Tidak Hadir' jika tidak dikenali
        }
        input.value = statusValue; // Menyimpan nilai status dalam input tersembunyi
    }

    const buttonGroup = document.querySelector(`tr[data-siswa-id="${siswaId}"] .btn-group`);

    if (buttonGroup) {
        const buttons = buttonGroup.querySelectorAll('button[data-status]');

        buttons.forEach(btn => {
            const buttonStatus = btn.getAttribute('data-status');

            // Tetap menggunakan string untuk status tombol
            if (buttonStatus === status) {
                btn.textContent = status; // Mengatur teks tombol sesuai dengan status
                btn.classList.remove('btn-success', 'btn-warning', 'btn-danger', 'btn-info', 'active');

                // Tambahkan kelas berdasarkan status yang dipilih
                if (status === 'Hadir') {
                    btn.classList.add('btn-success', 'active');
                } else if (status === 'Tidak Hadir') {
                    btn.classList.add('btn-danger', 'active');
                } else if (status === 'Sakit') {
                    btn.classList.add('btn-warning', 'active');
                } else if (status === 'Izin') {
                    btn.classList.add('btn-info', 'active');
                }
            } else {
                btn.textContent = `Tandai ${buttonStatus}`; // Set teks untuk tombol lainnya
                btn.classList.remove('btn-success', 'btn-warning', 'btn-danger', 'btn-info', 'active');
            }
        });
    }
}


// Fungsi untuk menginisialisasi kehadiran saat halaman dimuat
function initializeKehadiran() {
    const buttonGroups = document.querySelectorAll('.btn-group'); // Ambil semua grup tombol kehadiran

    buttonGroups.forEach(buttonGroup => {
        const buttons = buttonGroup.querySelectorAll('button[data-status]');
        const siswaId = buttonGroup.closest('tr').dataset.siswaId; // Ambil ID siswa dari atribut data

        // Ambil nilai awal dari input tersembunyi
        const input = document.querySelector(`input[name="kehadiran[${siswaId}]"]`);
        const initialStatus = parseInt(input.value); // Dapatkan status awal sebagai integer

        // Set kelas aktif pada tombol berdasarkan status awal
        buttons.forEach(btn => {
            const buttonStatus = btn.getAttribute('data-status');

            // Mengonversi buttonStatus ke angka untuk perbandingan
            let buttonStatusValue;
            if (buttonStatus === 'Hadir') {
                buttonStatusValue = 1;
            } else if (buttonStatus === 'Tidak Hadir') {
                buttonStatusValue = 2;
            } else if (buttonStatus === 'Sakit') {
                buttonStatusValue = 3;
            } else if (buttonStatus === 'Izin') {
                buttonStatusValue = 4;
            }

            if (buttonStatusValue === initialStatus) {
                btn.classList.add('active'); // Tambahkan kelas aktif
                btn.textContent = buttonStatus; // Set teks tombol sesuai status
                if (initialStatus === 1) {
                    btn.classList.add('btn-success');
                } else if (initialStatus === 2) {
                    btn.classList.add('btn-danger');
                } else if (initialStatus === 3) {
                    btn.classList.add('btn-warning');
                } else if (initialStatus === 4) {
                    btn.classList.add('btn-info');
                }
            } else {
                btn.textContent = `Tandai ${buttonStatus}`; // Set teks untuk tombol lainnya
                btn.classList.remove('btn-success', 'btn-warning', 'btn-danger', 'btn-info', 'active');
            }
        });
    });
}

// Pastikan untuk memanggil fungsi ini setelah DOM dimuat
document.addEventListener('DOMContentLoaded', initializeKehadiran);

</script>
@include('layouts.sweetalert')
@endsection