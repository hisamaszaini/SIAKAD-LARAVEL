@extends('layouts.master', ['title' => $title])

@section('plugins_css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="/assets/css/custom.css">

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<section class="section">
    @include('layouts.sectionheader')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    <h4>{{ $tagihan->nama }} Kelas {{ $tagihan->tingkatan }}</h4>
                    <div class="card-header-form">
                      <form>
                        <div class="input-group">
                            <a href="{{ route('tagihan.export', $tagihan->id) }}" class="btn btn-icon btn-info"><i class="far fa-file-excel"></i> Export</a>
                        </div>
                      </form>
                    </div>
                  </div>
                    <div class="card-body p-0 m-3">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Nomor Induk</th>
                                        <th>Nama Tagihan</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                    @forelse ($penagihan as $key => $item)
                                    <tr id="sid{{ $item->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->siswa->nama }}</td>
                                        <td>{{ $item->siswa->no_induk }}</td>
                                        <td>{{ $tagihan->nama }}</td>
                                        <td>{{ number_format($tagihan->nominal, 2, ',', '.') }}</td>
                                        <td>
                                            <select class="form-control status-selector" data-id="{{ $item->id }}">
                                                <option value="Belum Dibayar" {{ $item->status == 'Belum Dibayar' ? 'selected' : '' }}>Belum Bayar</option>
                                                <option value="Lunas" {{ $item->status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary update-status" data-id="{{ $item->id }}">Update</button>
                                            <button class="btn btn-sm btn-success print-receipt" data-id="{{ $item->id }}" style="display: {{ $item->status == 'Lunas' ? 'inline-block' : 'none' }};">Print</button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between flex-row-reverse mt-3">
                                <div>
                                    {{ $penagihan->links('layouts.pagination') }}
                                </div>
                            </div>
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
        document.querySelectorAll('.update-status').forEach(button => {
            button.addEventListener('click', function() {
                const statusSelector = button.closest('tr').querySelector('.status-selector');
                const status = statusSelector.value;
                const id = button.getAttribute('data-id');
                const printButton = button.closest('tr').querySelector('.print-receipt');

                fetch(`/admin/penagihan/${id}/update-status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            status
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            //alert('Sukses.');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Data tagihan sukses diperbarui!',
                            })

                            if (status === 'Belum Bayar') {
                                printButton.style.display = 'none';
                            } else if (status === 'Lunas') {
                                printButton.style.display = 'inline-block';
                            }
                        } else {
                            //alert('Gagal');
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Data tagihan gagal diperbarui!',
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });


        document.querySelectorAll('.print-receipt').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');

                const iframe = document.createElement('iframe');
                iframe.style.position = 'absolute';
                iframe.style.width = '0';
                iframe.style.height = '0';
                iframe.style.border = 'none';
                iframe.src = `/siswa/kwitansi/${id}`;
                document.body.appendChild(iframe);

                iframe.onload = function() {
                    iframe.contentWindow.print();

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
@include('layouts.sweetalert2')
@endsection