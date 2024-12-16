@extends('layouts.master', ['title' => $title])

@section('plugins_css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<section class="section">
    @include('layouts.sectionheader')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Ruang</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('ruang.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="nama_ruang">Nama Ruang <code>*)</code></label>
                                <input type="text" name="nama_ruang" id="nama_ruang"
                                    class="form-control @error('nama_ruang') is-invalid @enderror"
                                    value="{{ old('nama_ruang') }}" required>
                                @error('nama_ruang')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="jenis">Jenis <code>*)</code></label>
                                <input type="text" name="jenis" id="jenis"
                                    class="form-control @error('jenis') is-invalid @enderror"
                                    value="{{ old('jenis', 'Kelas') }}" required>
                                @error('jenis')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <x-button-back link="{{ route('ruang.index') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('plugins_js')
@endsection

@section('page_js')
@include('layouts.sweetalert')
@endsection