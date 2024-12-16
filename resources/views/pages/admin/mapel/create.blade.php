@extends('layouts.master', ['title' => 'Tambah Mata Pelajaran'])

@section('plugins_css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<section class="section">
    @include('layouts.sectionheader') <!-- Include your section header -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Mata Pelajaran</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('mapel.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="kode_mapel">Kode Mata Pelajaran <code>*)</code></label>
                                <input type="text" name="kode_mapel" id="kode_mapel"
                                    class="form-control @error('kode_mapel') is-invalid @enderror"
                                    value="{{ old('kode_mapel') }}" required>
                                @error('kode_mapel')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="nama_mapel">Nama Mata Pelajaran <code>*)</code></label>
                                <input type="text" name="nama_mapel" id="nama_mapel"
                                    class="form-control @error('nama_mapel') is-invalid @enderror"
                                    value="{{ old('nama_mapel') }}" required>
                                @error('nama_mapel')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="kategori_id">Kategori <code>*)</code></label>
                                <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}" {{ old('kategori_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="kkm">KKM <code>*)</code></label>
                                <input type="number" name="kkm" id="kkm"
                                    class="form-control @error('kkm') is-invalid @enderror"
                                    value="{{ old('kkm') }}" required>
                                @error('kkm')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <x-button-back link="{{ route('mapel.index') }}" />
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