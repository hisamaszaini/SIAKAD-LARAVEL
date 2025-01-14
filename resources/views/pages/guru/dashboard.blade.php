@extends('layouts.master', ['title' => 'Dashboard'])

@section('plugins_css')

@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="section-body">
        <div class="row">

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4><i class="fa fa-info-circle"></i> Pengumuman</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @if($pengumuman)
                <div class="ml-3">{!! htmlspecialchars_decode($pengumuman->isi) !!}</div>
                @else
                <div class="ml-3">Tidak ada pengumuman.</div>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Jadwal Mengajar Hari Ini</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th class="text-center">Hari</th>
                                    <th class="text-center">Jam</th>
                                    <th>Mata Pelajaran</th>
                                    <th class="text-center">Kelas</th>
                                    <th class="text-center">Ruang</th>
                                </tr>
                                @forelse ($jadwal as $data)
                                <tr>
                                    <td class="text-center">{{ $data->hari->nama }}</td>
                                    <td class="text-center">{{ date("H:i", strtotime($data->jamPelajaran->jam_mulai)) }} - {{ date("H:i", strtotime($data->jamPelajaran->jam_selesai)) }}</td>
                                    <td>{{ $data->mapel->nama }}</td>
                                    <td class="text-center">{{ $data->kelas->nama }}</td>
                                    <td class="text-center">{{ $data->ruang->nama }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Jadwal tidak ditemukan</td>
                                </tr>
                                @endforelse
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('block plugins_js')
@endsection

@section('page_js')
@endsection