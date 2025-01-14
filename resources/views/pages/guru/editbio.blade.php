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
                    <h4>{{ $title }}</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('guru.updatebio', $guru->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-4">
                            <div class="col-sm-12 col-md-7">
                                <div id="image-preview"
                                    class="image-preview @error('foto') is-invalid @enderror"
                                    style="background-image: url('{{ $guru->foto ? asset('storage/' . $guru->foto) : '' }}'); background-size: cover; background-position: center;">
                                    <label for="image-upload" id="image-label">Upload Foto</label>
                                    <input type="file" name="foto" id="image-upload" />
                                    @error('foto')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="nip">NIP <code>*)</code></label>
                                <input type="text" name="nip" id="nip"
                                    class="form-control @error('nip') is-invalid @enderror"
                                    value="{{ old('nip', $guru->nip) }}" disabled>
                                @error('nip')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="nama">Nama <code>*)</code></label>
                                <input type="text" name="nama" id="nama"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    value="{{ old('nama', $guru->nama) }}" required>
                                @error('nama')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label>Jenis Kelamin <code>*)</code></label>
                                <div class="d-flex">
                                    <div class="form-check mr-3">
                                        <input type="radio" class="form-check-input" id="laki-laki" name="jk" value="L"
                                            {{ old('jk', $guru->jk) == 'L' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="laki-laki">Laki-laki</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="perempuan" name="jk" value="P"
                                            {{ old('jk', $guru->jk) == 'P' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="perempuan">Perempuan</label>
                                    </div>
                                </div>
                                @error('jk')
                                <div class="invalid-feedback d-block"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="telp">No HP</label>
                                <input type="text" name="telp" id="telp"
                                    class="form-control @error('telp') is-invalid @enderror"
                                    value="{{ old('telp', $guru->telp) }}">
                                @error('telp')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="tmp_lahir">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tmp_lahir"
                                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    value="{{ old('tempat_lahir', $guru->tmp_lahir) }}">
                                @error('tempat_lahir')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tgl_lahir"
                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    value="{{ old('tanggal_lahir', $guru->tgl_lahir) }}">
                                @error('tanggal_lahir')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" id="alamat"
                                    class="form-control @error('alamat') is-invalid @enderror"
                                    value="{{ old('alamat', $guru->alamat) }}">
                                @error('alamat')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                <input type="text" name="pendidikan_terakhir" id="pendidikan_terakhir"
                                    class="form-control @error('pendidikan_terakhir') is-invalid @enderror"
                                    value="{{ old('pendidikan_terakhir', $guru->pendidikan) }}">
                                @error('pendidikan_terakhir')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="gelar">Gelar</label>
                                <input type="text" name="gelar" id="gelar"
                                    class="form-control @error('gelar') is-invalid @enderror"
                                    value="{{ old('gelar', $guru->gelar) }}">
                                @error('gelar')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('guru.biodata') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('plugins_js')
@include('layouts.uploadfoto')
@endsection

@section('page_js')
@include('layouts.sweetalert2')
@endsection