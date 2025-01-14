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
                                <form action="{{ route('guru.nilai.index') }}" method="GET">
                                    <div class="input-group">
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
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>Mata Pelajaran</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">Action</th>
                                    </tr>

                                    @forelse ($datas as $key => $jadwal)
                                    <tr id="sid{{ $jadwal->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $jadwal->mapel->nama }}</td>
                                        <td class="text-center">{{ $jadwal->kelas->nama }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-success" href="{{ route('guru.nilairapot.create', $jadwal->id) }}" data-toggle="tooltip" data-placement="top" title="Isi Nilai">
                                                <i class="fas fa-plus"></i></a>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" onclick="#modalNilai{{ $jadwal->id }}" data-toggle="tooltip" data-placement="top" title="Lihat Nilai">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <x-button-edit link="{{ route('guru.nilai.create', $jadwal->id) }}" />
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