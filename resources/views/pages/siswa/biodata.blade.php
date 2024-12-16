@extends('layouts.master', ['title' => $title])

@section('plugins_css')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Biodata Siswa</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Biodata</h4>
                </div>
                <div class="card-body">
                    <!-- Foto dan Data Siswa -->
                    <div class="row mb-4">
                        <div class="col-md-4 text-center">
                            <img src="{{ $siswa->foto ? asset('storage/'.$siswa->foto) : 'https://via.placeholder.com/150' }}"
                                alt="Foto Siswa" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                        </div>
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th>No Induk:</th>
                                    <td>{{ $siswa->no_induk }}</td>
                                </tr>
                                <tr>
                                    <th>NISN:</th>
                                    <td>{{ $siswa->nisn ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Siswa:</th>
                                    <td>{{ $siswa->nama_siswa }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin:</th>
                                    <td>{{ $siswa->jk == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <th>Kelas:</th>
                                    <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Telepon:</th>
                                    <td>{{ $siswa->telp ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat, Tanggal Lahir:</th>
                                    <td>{{ $siswa->tmp_lahir }}, {{ $siswa->tgl_lahir ? \Carbon\Carbon::parse($siswa->tgl_lahir)->format('d-m-Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat:</th>
                                    <td>{{ $siswa->alamat ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Masuk:</th>
                                    <td>{{ $siswa->tgl_masuk ? \Carbon\Carbon::parse($siswa->tgl_masuk)->format('d-m-Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $siswa->email ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Data Orang Tua -->
                    <div class="row">
                        <div class="col-12">
                            <h5 class="mt-3">Data Orang Tua</h5>
                            <table class="table table-striped">
                                <tr>
                                    <th>Nama Ayah:</th>
                                    <td>{{ $orangTua->nama_ayah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Telepon Ayah:</th>
                                    <td>{{ $orangTua->telp_ayah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan Ayah:</th>
                                    <td>{{ $orangTua->pekerjaan_ayah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Penghasilan Ayah:</th>
                                    <td>{{ $orangTua->penghasilan_ayah ? 'Rp '.number_format($orangTua->penghasilan_ayah, 0, ',', '.') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Ibu:</th>
                                    <td>{{ $orangTua->nama_ibu ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Telepon Ibu:</th>
                                    <td>{{ $orangTua->telp_ibu ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan Ibu:</th>
                                    <td>{{ $orangTua->pekerjaan_ibu ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Penghasilan Ibu:</th>
                                    <td>{{ $orangTua->penghasilan_ibu ? 'Rp '.number_format($orangTua->penghasilan_ibu, 0, ',', '.') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat Orang Tua:</th>
                                    <td>{{ $orangTua->alamat_orang_tua ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('plugins_js')
@endsection

@section('page_js')
@endsection