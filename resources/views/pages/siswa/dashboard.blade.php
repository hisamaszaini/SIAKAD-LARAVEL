@extends('layouts.master', ['title' => $title])

@section('plugins_css')

@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ $title }}</h1>
    </div>
    <div class="section-body">
        <div class="row">

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Pengumuman</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @if($pengumuman)
                <p class="ml-3">{{ $pengumuman->isi }}</p>
                @else
                <p class="ml-3">Tidak ada pengumuman.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Jadwal Hari Ini</h4>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                        <thead>
                            <tr style="background-color: #F1F1F1">
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Mata Pelajaran</th>
                                <th>Guru</th>
                                <th>Ruang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jadwal as $data)
                            <tr>
                                <td>{{ $data->hari->nama_hari }}</td>
                                <td>{{ date("H:i", strtotime($data->jamPelajaran->jam_mulai)) }} - {{ date("H:i", strtotime($data->jamPelajaran->jam_selesai)) }}</td>
                                <td>{{ $data->mapel->nama_mapel }}</td>
                                <td>{{ $data->guru->nama_guru }}</td>
                                <td>{{ $data->ruang->nama_ruang }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Jadwal tidak ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('plugins_js')
<script src="../node_modules/chart.js/dist/Chart.min.js"></script>
<script src="../node_modules/summernote/dist/summernote-bs4.js"></script>
<script src="../node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
@endsection

@section('page_js')
@endsection