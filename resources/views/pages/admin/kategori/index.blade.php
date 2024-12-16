@extends('layouts.master', ['title' => $title])

@section('plugins_css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="/assets/css/custom.css">
@endsection

@section('content')
<section class="section">
    @include('layouts.sectionheader')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="d-flex bd-highlight mb-3 align-items-center">
                    <!-- Form pencarian -->
                    <div class="p-2 bd-highlight">
                        <form action="{{ route('kategori.index') }}" method="GET">
                            <input type="text" class="form-control ml-0" name="cari" value="{{ $cari }}" placeholder="Cari Nama Kategori">
                            <span>
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="submit" value="Cari">
                            </span>
                        </form>
                    </div>
                    <!-- Tombol tambah -->
                    <div class="ml-auto p-2 bd-highlight">
                        <x-button-create link="{{ route('kategori.create') }}"></x-button-create>
                    </div>
                </div>

                <!-- Tabel data kategori -->
                <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th class="text-center py-2 min-row"><input type="checkbox" id="chkCheckAll"> All</th>
                            <th>Nama Kategori</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr id="sid{{ $data->id }}">
                            <td class="text-center">
                                <input type="checkbox" name="ids" class="checkBoxClass" value="{{ $data->id }}">
                            </td>
                            <td>{{ $data->nama_kategori }}</td>
                            <td class="text-center min-row">
                                <x-button-edit link="{{ route('kategori.edit', $data->id) }}" />
                                <form action="{{ route('ruang.destroy', $data->id) }}" method="POST" style="display:inline;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <x-button-delete link="#" data-id="{{ $data->id }}" />
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Data tidak ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination dan aksi massal -->
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