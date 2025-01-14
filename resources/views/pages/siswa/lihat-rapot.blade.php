@extends('layouts.master', ['title' => $title])

@section('plugins_css')
<link rel="stylesheet" href="/assets/css/custom.css">
@endsection

@section('content')
<section class="section">
    @include('layouts.sectionheader')
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Nilai Pengetahuan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th class="py-3">Mata Pelajaran</th>
                                <th class="py-3">Guru</th>
                                <th class="py-3 text-center">KKM</th>
                                <th class="py-3 text-center">Nilai</th>
                                <th class="py-3 text-center">Predikat</th>
                                <th class="py-3 text-center">Deskripsi</th>
                            </tr>
                            @forelse ($datas as $data)
                            <tr id="sid{{ $data->id }}">
                                <td>{{ $data->mapel->nama }}</td>
                                <td>{{ $data->guru->nama }} {{ $data->guru->gelar }}</td>
                                <td class="text-center">{{ $data->mapel->kkm }}</td>
                                <td class="text-center">{{ $data->p_nilai }}</td>
                                <td class="text-center">{{ $data->p_predikat }}</td>
                                <td>{{ $data->p_deskripsi }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Data tidak ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-header">
                <h4>Nilai Keterampilan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th class="py-3">Mata Pelajaran</th>
                                <th class="py-3">Guru</th>
                                <th class="py-3 text-center">KKM</th>
                                <th class="py-3 text-center">Nilai</th>
                                <th class="py-3 text-center">Predikat</th>
                                <th class="py-3 text-center">Deskripsi</th>
                            </tr>
                            @forelse ($datas as $data)
                            <tr id="sid{{ $data->id }}">
                                <td>{{ $data->mapel->nama }}</td>
                                <td>{{ $data->guru->nama }} {{ $data->guru->gelar }}</td>
                                <td class="text-center">{{ $data->mapel->kkm }}</td>
                                <td class="text-center">{{ $data->k_nilai }}</td>
                                <td class="text-center">{{ $data->k_predikat }}</td>
                                <td>{{ $data->k_deskripsi }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Data tidak ditemukan</td>
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