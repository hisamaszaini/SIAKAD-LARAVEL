@extends('layouts.master', ['title' => $title])

@section('plugins_css')
<link rel="stylesheet" href="/assets/css/custom.css">
@endsection

@section('content')
<section class="section">
    @include('layouts.sectionheader')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Tagihan</th>
                                        <th class="text-center">Nominal</th>
                                        <th class="text-center">Status</th>
                                        <th>Tanggal Tempo</th>
                                        <th class="text-center">Aksi</th> 
                                    </tr>
                                    @forelse ($tagihan as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->tagihan->nama }}</td>
                                        <td class="text-center">Rp{{ number_format($item->tagihan->nominal, 2, ',', '.') }}</td>
                                        <td class="text-center">
                                            @if($item->status == 'Lunas')
                                            <span class="badge badge-success">Lunas</span>
                                            @elseif($item->status == 'Belum Dibayar')
                                            <span class="badge badge-danger">Belum Dibayar</span>
                                            @elseif($item->status == 'Terlambat')
                                            <span class="badge badge-warning">Terlambat</span>
                                            @else
                                            <span class="badge badge-secondary">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->tagihan->tanggal_tempo)->format('d F Y') }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-success print-receipt" data-id="{{ $item->id }}" style="{{ $item->status == 'lunas' ? 'display: inline-block' : 'disabled' }};">Print</button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada tagihan untuk ditampilkan</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('plugins_js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.print-receipt').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');

                // Buat iframe untuk memuat halaman
                const iframe = document.createElement('iframe');
                iframe.style.position = 'absolute';
                iframe.style.width = '0';
                iframe.style.height = '0';
                iframe.style.border = 'none';
                iframe.src = `/siswa/kwitansi/${id}`;
                document.body.appendChild(iframe);

                // Tunggu hingga konten iframe selesai dimuat, lalu cetak
                iframe.onload = function() {
                    iframe.contentWindow.print();

                    // Hapus iframe setelah proses cetak selesai
                    setTimeout(() => {
                        document.body.removeChild(iframe);
                    }, 1000);
                };
            });
        });
        
        // document.querySelectorAll('.print-receipt').forEach(button => {
        //     button.addEventListener('click', function() {
        //         const id = this.getAttribute('data-id');
        //         window.location.href = `/siswa/kwitansi/${id}`;
        //     });
        // });
    });
</script>
@endsection

@section('page_js')
@endsection