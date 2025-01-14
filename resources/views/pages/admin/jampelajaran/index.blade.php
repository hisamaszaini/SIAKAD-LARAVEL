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
                        <form action="{{ route('jampelajaran.cari') }}" method="GET">
                            <input type="text" class="form-sam ml-0" name="cari" value="{{ $cari }}" placeholder="Cari Jam Pelajaran">
                            <span>
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="submit" value="Cari">
                            </span>
                        </form>
                    </div>
                    <div class="ml-auto p-2 bd-highlight">
                        <x-button-create link="{{ route('jampelajaran.create') }}"></x-button-create>
                    </div>
                </div>

                <table class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th>No</th>
                            <th>Nama Jam</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $key => $jam)
                        <tr id="sid{{ $jam->id }}">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $jam->nama }}</td>
                            <td>{{ date("h:i", strtotime($jam->jam_mulai)) }}</td>
                            <td>{{ date("h:i", strtotime($jam->jam_selesai)) }}</td>
                            <td class="text-center">
                                <x-button-edit link="{{ route('jampelajaran.edit', $jam->id) }}" />
                                <form action="{{ route('jampelajaran.destroy', $jam->id) }}" method="POST" style="display:inline;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <x-button-delete link="#" data-id="{{ $jam->id }}" />
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

@section('plugins_js')
@endsection

@section('page_js')
@include('layouts.sweetalert2')
@endsection