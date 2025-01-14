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
                    <form action="{{ route('guru.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="nomerinduk">Nomor Induk Pegawai <code>*)</code></label>
                                <input type="text" name="nip" id="nomerinduk"
                                    class="form-control @error('nip') is-invalid @enderror"
                                    value="{{ old('nip') }}" required>
                                @error('nip')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="nama">Nama Guru <code>*)</code></label>
                                <input type="text" name="nama" id="nama"
                                    class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}"
                                    required>
                                @error('nama')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label>Jenis Kelamin <code>*)</code></label>
                                <div class="d-flex">
                                    <div class="form-check mr-3">
                                        <input type="radio" class="form-check-input" id="laki-laki" name="jk" value="L"
                                            {{ old('jk') == 'L' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="laki-laki">Laki-laki</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="perempuan" name="jk" value="P"
                                            {{ old('jk') == 'P' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="perempuan">Perempuan</label>
                                    </div>
                                </div>
                                @error('jk')
                                <div class="invalid-feedback d-block"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" id="alamat"
                                    class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}">
                                @error('alamat')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="telp">No HP</label>
                                <input type="text" name="telp" id="telp"
                                    class="form-control @error('telp') is-invalid @enderror" value="{{ old('telp') }}">
                                @error('telp')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="email">Email <code>*)</code></label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    required>
                                @error('email')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="password">Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="password2">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                <input type="text" name="pendidikan_terakhir" id="pendidikan_terakhir"
                                    class="form-control @error('pendidikan_terakhir') is-invalid @enderror" value="{{ old('pendidikan_terakhir') }}">
                                @error('pendidikan_terakhir')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan"
                                    class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan') }}">
                                @error('jabatan')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" id="tgl_lahir"
                                    class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') }}">
                                @error('tgl_lahir')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="tmp_lahir">Tempat Lahir</label>
                                <input type="text" name="tmp_lahir" id="tmp_lahir"
                                    class="form-control @error('tmp_lahir') is-invalid @enderror" value="{{ old('tmp_lahir') }}">
                                @error('tmp_lahir')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="tgl_masuk">Tanggal Masuk</label>
                                <input type="date" name="tgl_masuk" id="tgl_masuk"
                                    class="form-control @error('tgl_masuk') is-invalid @enderror" value="{{ old('tgl_masuk', date('Y-m-d') }}">
                                @error('tgl_masuk')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="gelar">Gelar</label>
                                <input type="text" name="gelar" id="gelar"
                                    class="form-control @error('gelar') is-invalid @enderror" value="{{ old('gelar') }}">
                                @error('gelar')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="foto">Foto</label>
                                <input type="file" name="foto" id="foto"
                                    class="form-control @error('foto') is-invalid @enderror">
                                @error('foto')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <x-button-back link="{{ route('guru.index') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@section('block plugins_js')
<script src="../node_modules/chart.js/dist/Chart.min.js"></script>
<script src="../node_modules/jqvmap/dist/jquery.vmap.min.js"></script>
<script src="../node_modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="../node_modules/summernote/dist/summernote-bs4.js"></script>
<script src="../node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
@endsection

@section('page_js')
@include('layouts.sweetalert')
@endsection