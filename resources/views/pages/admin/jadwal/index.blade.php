@extends('layouts.master', ['title' => $title])

@section('plugins_css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="/assets/css/custom.css">

<!-- JS -->
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
                        <form action="{{ route('jadwal.cari') }}" method="GET">
                            <input type="text" class="form-sam ml-0" name="cari" value="{{ $cari }}" placeholder="Cari Mata Pelajaran">
                            <span>
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="submit" value="Cari">
                            </span>
                        </form>
                    </div>
                    <div class="ml-auto p-2 bd-highlight">
                        <x-button-create link="{{ route('jadwal.create') }}"></x-button-create>
                    </div>
                </div>

                <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th class="text-center py-2 min-row"><input type="checkbox" id="chkCheckAll"> All</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru</th>
                            <th>Kelas</th>
                            <th>Ruang</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr id="sid{{ $data->id }}">
                            <td class="text-center">
                                <input type="checkbox" name="ids" class="checkBoxClass" value="{{ $data->id }}">
                            </td>
                            <td>{{ $data->hari->nama }}</td>
                            <td>{{ date("H:i", strtotime($data->jamPelajaran->jam_mulai)) }} - {{ date("H:i", strtotime($data->jamPelajaran->jam_selesai)) }}</td>
                            <td>{{ $data->mapel->nama }}</td>
                            <td>{{ $data->guru->nama. " " . $data->guru->gelar  }}</td>
                            <td>{{ $data->kelas->nama }}</td>
                            <td>{{ $data->ruang->nama }}</td>
                            <td class="text-center min-row">
                                <x-button-edit link="/admin/jadwal/{{ $data->id }}" />
                                <x-button-delete link="/admin/jadwal/{{ $data->id }}" />
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Data tidak ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-between flex-row-reverse mt-3">
                    <div>
                        {{ $datas->links('layouts.pagination') }}
                    </div>
                    <div>
                        <a href="#" class="btn btn-sm btn-danger mb-2" id="deleteAllSelectedRecord" data-toggle="tooltip" data-placement="top" title="Hapus Terpilih">
                            <i class="fas fa-trash-alt mr-2"></i> Hapus Terpilih
                        </a>
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
@include('layouts.sweetalert2')
@endsection