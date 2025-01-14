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
                                                <option value="belum_dibayar" {{ $item->status == 'belum_dibayar' ? 'selected' : '' }}>Belum Bayar</option>
                                                <option value="lunas" {{ $item->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary update-status" data-id="{{ $item->id }}">Update</button>
                                            <button class="btn btn-sm btn-success print-receipt" data-id="{{ $item->id }}" style="display: {{ $item->status == 'lunas' ? 'inline-block' : 'none' }};">Print</button>
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
                const printButton = button.closest('tr').querySelector('.print-receipt'); // Find the print button in the same row

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
                            alert('Status updated successfully.');

                            // Show or hide the print button based on the updated status
                            if (status === 'Belum Bayar') {
                                printButton.style.display = 'none'; // Hide the print button
                            } else if (status === 'Lunas') {
                                printButton.style.display = 'inline-block'; // Show the print button
                            }
                        } else {
                            alert('Failed to update status.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });

        // Print button event listener
        document.querySelectorAll('.print-receipt').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                // Redirect to the receipt page
                window.location.href = `/siswa/kwitansi/${id}`;
            });
        });
    });
</script>
@endsection

@section('page_js')
@include('layouts.sweetalert2')
@endsection