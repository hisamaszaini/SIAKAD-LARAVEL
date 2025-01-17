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
                        <form action="{{ route('tagihan.index') }}" method="GET">
                            <input type="text" class="form-sam ml-0" name="cari" value="{{ $cari }}" placeholder="Cari Nama Tagihan">
                            <span>
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="submit" value="Cari">
                            </span>
                        </form>
                    </div>
                    <div class="ml-auto p-2 bd-highlight">
                        <x-button-create link="{{ route('tagihan.create') }}"></x-button-create>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input"
                                            id="chkCheckAll">
                                        <label for="chkCheckAll" class="custom-control-label"> All</label>
                                    </div>
                                </th>
                                <th>Nama Tagihan</th>
                                <th>Nominal</th>
                                <th>Tingkat</th>
                                <th>Semester</th>
                                <th>Tanggal Tagihan</th>
                                <th>Tanggal Tempo</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                            @forelse ($datas as $data)
                            <tr id="sid{{ $data->id }}">
                                <td class="p-0 text-center">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input checkBoxClass" id="checkbox-{{ $data->id }}" name="ids" value="{{ $data->id }}">
                                        <label for="checkbox-{{ $data->id }}" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ number_format($data->nominal, 0, ',', '.') }}</td>
                                <td>{{ $data->tingkatan }}</td>
                                <td>{{ $data->semester }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tgl_tagihan)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tgl_tempo)->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success mb-1" onclick="window.location.href='{{ route('penagihan.daftar', $data->id) }}'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Isi Pembayaran">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning mb-1 ml-1" onclick="window.location.href='{{ route('tagihan.edit', $data->id) }}'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Tagihan">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <x-button-delete link="/admin/{{ $pages }}/{{ $data->id}}" />
                                    <form action="{{ route('penagihan.create', $data->id) }}" method="POST" style="display:inline;" class="ml-1">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Buat Penagihan" title="Buat Penagihan"><i class="fas fa-paper-plane"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Data tidak ditemukan</td>
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
    </div>
</section>
@endsection

@section('plugins_js')
@endsection

@section('page_js')
@include('layouts.sweetalert2')
@endsection