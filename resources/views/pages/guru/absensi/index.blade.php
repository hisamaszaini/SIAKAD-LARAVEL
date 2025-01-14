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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0 m-3">
                        <div class="d-flex bd-highlight mb-3 align-items-center">
                            <div class="p-2 bd-highlight">
                                <form action="{{ route('guru.absensi.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="tanggal" value="{{ $tanggal }}">
                                        <select name="kelas_id" id="kelas_id" class="form-control">
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
                            <div class="ml-auto p-2 bd-highlight">
                                <x-button-create link="{{ route('guru.absensi.create') }}"></x-button-create>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th class="text-center">Kelas</th>
                                        <th>Guru</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>

                                    @forelse ($datas as $key => $absen)
                                    <tr id="sid{{ $absen->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ date("d-m-Y", strtotime($absen->tanggal)) }}</td>
                                        <td class="text-center">{{ $absen->kelas->nama }}</td>
                                        <td>{{ $absen->guru->nama . " " . $absen->guru->gelar  }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-success" onclick="window.location.href='{{ route('guru.absensi.isikehadiran', $absen->id) }}'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Isi Absensi">
                                                <i class="fas fa-plus"></i>
                                            </button>
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
            </div>
        </div>
    </div>
</section>
@endsection

@section('page_js')
@include('layouts.sweetalert2')
@endsection