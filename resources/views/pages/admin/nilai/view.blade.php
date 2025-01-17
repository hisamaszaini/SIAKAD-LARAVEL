@extends('layouts.master', ['title' => $title])

@section('plugins_css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<section class="section">
    @include('layouts.sectionheader')
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Lihat Nilai {{ $mapel->nama }} Kelas {{ $kelas->nama }}</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th class="text-center">Nilai Pengetahuan</th>
                            <th class="text-center">Predikat Pengetahuan</th>
                            <th class="text-center">Nilai Keterampilan</th>
                            <th class="text-center">Predikat Keterampilan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $s->nama }}
                            </td>
                            <td class="text-center">
                                {{ $rapot[$s->id]->p_nilai ?? '' }}
                            </td>
                            <td class="text-center">
                                {{ $rapot[$s->id]->p_predikat ?? '' }}
                            </td>
                            <td class="text-center">
                                {{ $rapot[$s->id]->k_nilai ?? '' }}
                            </td>
                            <td class="text-center">
                                {{ $rapot[$s->id]->k_predikat ?? '' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="card-footer text-right">
                    <a href="{{ route('nilai.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page_js')
@include('layouts.sweetalert')
@endsection