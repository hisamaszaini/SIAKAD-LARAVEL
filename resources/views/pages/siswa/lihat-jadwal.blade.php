@extends('layouts.master', ['title' => $title])

@section('plugins_css')
<link rel="stylesheet" href="/assets/css/custom.css">
@endsection

@section('content')
<section class="section">
    @include('layouts.sectionheader')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th class="py-3">Hari</th>
                            <th class="py-3">Jam</th>
                            <th class="py-3">Mata Pelajaran</th>
                            <th class="py-3">Guru</th>
                            <th class="py-3">Kelas</th>
                            <th class="py-3">Ruang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr id="sid{{ $data->id }}">
                            <td>{{ $data->hari->nama_hari }}</td>
                            <td>{{ date("H:i", strtotime($data->jamPelajaran->jam_mulai)) }} - {{ date("H:i", strtotime($data->jamPelajaran->jam_selesai)) }}</td>
                            <td>{{ $data->mapel->nama_mapel }}</td>
                            <td>{{ $data->guru->nama_guru . ' ' . $data->guru->gelar }}</td>
                            <td>{{ $data->kelas->nama_kls }}</td>
                            <td>{{ $data->ruang->nama_ruang }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Data tidak ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@section('plugins_js')
@endsection

@section('page_js')
@endsection