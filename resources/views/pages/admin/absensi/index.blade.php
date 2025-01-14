@extends('layouts.master', ['title' => $title])

@section('plugins_css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="/assets/css/custom.css">
@endsection

@section('plugins_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<section class="section">
    @include('layouts.sectionheader')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="d-flex bd-highlight mb-3 align-items-center">
                    <div class="p-2 bd-highlight">
                        <form action="{{ route('absensi.index') }}" method="GET">
                            <div class="input-group">
                                <input type="date" class="form-control" name="tanggal" value="{{ $tanggal }}">
                                <select name="kelas_id" id="kelas_id" class="form-control ml-2">
                                    <option value="">Pilih Kelas</option>
                                    @foreach($kelas as $kls)
                                    <option value="{{ $kls->id }}" {{ isset($kelas_id) && $kelas_id == $kls->id ? 'selected' : '' }}>{{ $kls->nama }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info ml-1">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <table class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th>No.</th>
                            <th>Hari, Tanggal</th>
                            <th>Kelas</th>
                            <th>Guru</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $key => $absen)
                        <tr id="sid{{ $absen->id }}">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ date("l, d-m-Y", strtotime($absen->tanggal)) }}</td>
                            <td>{{ $absen->kelas->nama }}</td>
                            <td>{{ $absen->guru->nama . " " . $absen->guru->gelar  }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" onclick="location.href='{{ route('absensi.view', $absen->id) }}'" data-toggle="tooltip" data-placement="top" title="Lihat Kehadiran"> <i class="fas fa-eye"></i> </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Data tidak ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-between flex-row-reverse mt-3">
                    <div>
                        {{ $datas->links('layouts.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page_js')
@include('layouts.sweetalert2')
@endsection