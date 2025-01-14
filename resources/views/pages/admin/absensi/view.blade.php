@extends('layouts.master', ['title' => $title])

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
                <h4>Kehadiran Siswa Kelas {{ $absensi->kelas->nama }} Tanggal: {{ date('d-m-Y', strtotime($absensi->tanggal)) }}</h4>
                <p>{{ $absensi->guru->nama . " " . $absensi->guru->gelar  }}</p>
            </div>
            <div class="card-body">
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
                            <td>{{ $siswa->nama }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    {{ $kehadiranData[$siswa->id] ?? 'Unknown' }}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="card-footer text-right">
                    <a href="{{ route('absensi.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page_js')
@endsection