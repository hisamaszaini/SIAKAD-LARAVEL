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
                        <form action="{{ route('guru.absensi.index') }}" method="GET">
                            <div class="input-group">
                                <input type="date" class="form-control" name="tanggal" value="{{ $tanggal }}">
                                <select name="kelas_id" id="kelas_id" class="form-control ml-2">
                                    <option value="">Pilih Kelas</option>
                                    @foreach($kelas as $kls)
                                    <option value="{{ $kls->id }}" {{ isset($kelas_id) && $kelas_id == $kls->id ? 'selected' : '' }}>{{ $kls->nama_kls }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info ml-1">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="ml-auto p-2 bd-highlight">
                        <x-button-create link="{{ route('guru.absensi.create') }}"></x-button-create>
                    </div>
                </div>

                <table class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Tanggal</th>
                            <th>Guru</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $key => $absen)
                        <tr id="sid{{ $absen->id }}">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $absen->kelas->nama_kls }}</td>
                            <td>{{ date("d-m-Y", strtotime($absen->tanggal)) }}</td>
                            <td>{{ $absen->guru->nama_guru . " " . $absen->guru->gelar  }}</td>
                            <td class="text-center">
                                <a href="{{ route('guru.absensi.isikehadiran', $absen->id) }}" class="btn btn-warning">Isi Kehadiran</a>
                                <x-button-edit link="{{ route('guru.absensi.edit', $absen->id) }}" />
                                <form action="{{ route('guru.absensi.destroy', $absen->id) }}" method="POST" style="display:inline;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <x-button-delete link="#" data-id="{{ $absen->id }}" />
                                </form>
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