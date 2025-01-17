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
                        <form action="{{ route('siswa.cari') }}" method="GET">
                            <input type="text" class="form-sam ml-0" name="cari" value="{{ $cari }}">
                            <span>
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="submit" value="Cari">
                            </span>
                        </form>
                    </div>
                    <div class="ml-auto p-2 bd-highlight">
                        <a href="{{ route('siswa.export') }}" class="btn btn-sm btn-icon btn-info"><i class="far fa-file-excel"></i> Export</a>
                        <x-button-create link="{{ route('siswa.create') }}"></x-button-create>
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
                                <th>Nomor Induk</th>
                                <th>Nama</th>
                                <th>Email</th>
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
                                <td>{{ $data->no_induk }}</td>
                                <td>{{ Str::limit($data->nama, 25, ' ...') }}</td>
                                <td>{{ $data->user != null ? $data->user->email : 'Data tidak ditemukan' }}</td>
                                <td class="text-center min-row">
                                    <x-button-edit link="/admin/{{ $pages }}/{{$data->id}}" />
                                    <x-button-delete link="/admin/{{ $pages }}/{{$data->id}}" />
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