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
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th class="py-3">Hari</th>
                                <th class="py-3">Jam</th>
                                <th class="py-3">Mata Pelajaran</th>
                                <th class="py-3">Guru</th>
                                <th class="text-center">Ruang</th>
                            </tr>
                            @forelse ($datas as $data)
                            <tr id="sid{{ $data->id }}">
                                <td>{{ $data->hari->nama }}</td>
                                <td>{{ date("H:i", strtotime($data->jamPelajaran->jam_mulai)) }} - {{ date("H:i", strtotime($data->jamPelajaran->jam_selesai)) }}</td>
                                <td>{{ $data->mapel->nama }}</td>
                                <td>{{ $data->guru->nama . ' ' . $data->guru->gelar }}</td>
                                <td class="text-center">{{ $data->ruang->nama }}</td>
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
    </div>
</section>
@endsection

@section('plugins_js')
@endsection

@section('page_js')
@endsection