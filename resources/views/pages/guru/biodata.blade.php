@extends('layouts.master', ['title' => $title])

@section('plugins_css')

@section('content')
<section class="section">
    @include('layouts.sectionheader')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Biodata</h4>
                    <div class="ml-auto p-2 bd-highlight">
                        <x-button-edit link="{{ route('guru.editbio') }}"></x-button-edit>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4 text-center">
                            <img src="{{ $guru->foto ? asset('storage/'.$guru->foto) : 'https://via.placeholder.com/150' }}"
                                alt="Foto Guru" class="img-fluid rounded" style="width: 150px; height: 225px;">
                        </div>
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th>No Induk Pegawai</th>
                                    <td>{{ $guru->nip ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $guru->nama }} {{ $guru->gelar }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $guru->jk == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td>{{ $guru->telp ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <td>{{ $guru->tmp_lahir }}, {{ $guru->tgl_lahir ? \Carbon\Carbon::parse($guru->tgl_lahir)->format('d-m-Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $guru->alamat ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Jabatan</th>
                                    <td>{{ $guru->jabatan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Pendidikan Terakhir</th>
                                    <td>{{ $guru->pendidikan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Masuk</th>
                                    <td>{{ $guru->tgl_masuk ? \Carbon\Carbon::parse($guru->tgl_masuk)->format('d-m-Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $guru->user->email ?? '-' }}</td>
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