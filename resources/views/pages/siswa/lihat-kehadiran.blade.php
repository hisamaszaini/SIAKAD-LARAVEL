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
                <div class="table">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th class="py-3">Tanggal</th>
                                <th class="text-center">Status Kehadiran</th>
                            </tr>
                            @forelse ($datas as $data)
                            <tr id="sid{{ $data->id }}">
                                <td>{{ date("d F Y", strtotime($data->absensi->tanggal)) }}</td>
                                <td class="text-center">{{ $data->status_label }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center">Data tidak ditemukan</td>
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
    </div>
</section>
@endsection

@section('plugins_js')
@endsection

@section('page_js')
@endsection