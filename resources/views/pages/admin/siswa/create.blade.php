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

                    <form action="{{ route('siswa.store') }}" method="POST">
                        @csrf
                        <div class="form-group row mb-4">
                            <div class="col-sm-12 col-md-7">
                                <div id="image-preview"
                                    class="image-preview @error('foto') is-invalid @enderror"
                                    style="background-position: center;">
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
                                <label for="nisn">Nomor Induk Siswa Nasional <code>*)</code></label>
                                <input type="text" name="nisn" id="nisn"
                                    class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn') }}">
                                @error('nisn')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="nama_siswa">Nama Siswa <code>*)</code></label>
                                <input type="text" name="nama_siswa" id="nama_siswa"
                                    class="form-control @error('nama_siswa') is-invalid @enderror" value="{{ old('nama_siswa') }}" required>
                                @error('nama_siswa')
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
                                <label for="telp">No HP</label>
                                <input type="text" name="telp" id="telp"
                                    class="form-control @error('telp') is-invalid @enderror" value="{{ old('telp') }}">
                                @error('telp')
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
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" id="tgl_lahir"
                                    class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') }}">
                                @error('tgl_lahir')
                                <div class="invalid-feedback"> {{ $message }}</div>
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
                                <label for="tgl_masuk">Tanggal Masuk <code>*)</code></label>
                                <input type="date" name="tgl_masuk" id="tgl_masuk"
                                    class="form-control @error('tgl_masuk') is-invalid @enderror" value="{{ old('tgl_masuk', date('Y-m-d')) }}">
                                @error('tgl_masuk')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="kelas_id">Kelas <code>*)</code></label>
                                <select name="kelas_id" id="kelas_id"
                                    class="form-control @error('kelas_id') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Kelas</option>
                                    @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}" {{ old('kelas_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror" value="">
                                @error('password')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password_confirmation" name="password_confirmation" id="password_confirmation"
                                    class="form-control @error('password') is-invalid @enderror" value="">
                                @error('password')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="nama_ayah">Nama Ayah</label>
                                <input type="text" name="nama_ayah" id="nama_ayah"
                                    class="form-control @error('nama_ayah') is-invalid @enderror" value="{{ old('nama_ayah') }}">
                                @error('nama_ayah')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="telp_ayah">No HP Ayah</label>
                                <input type="text" name="telp_ayah" id="telp_ayah"
                                    class="form-control @error('telp_ayah') is-invalid @enderror" value="{{ old('telp_ayah') }}">
                                @error('telp_ayah')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah"
                                    class="form-control @error('pekerjaan_ayah') is-invalid @enderror" value="{{ old('pekerjaan_ayah') }}">
                                @error('pekerjaan_ayah')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="penghasilan_ayah">Penghasilan Ayah</label>
                                <input type="number" name="penghasilan_ayah" id="penghasilan_ayah"
                                    class="form-control @error('penghasilan_ayah') is-invalid @enderror" value="{{ old('penghasilan_ayah') }}">
                                @error('penghasilan_ayah')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="nama_ibu">Nama Ibu</label>
                                <input type="text" name="nama_ibu" id="nama_ibu"
                                    class="form-control @error('nama_ibu') is-invalid @enderror" value="{{ old('nama_ibu') }}">
                                @error('nama_ibu')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="telp_ibu">No HP Ibu</label>
                                <input type="text" name="telp_ibu" id="telp_ibu"
                                    class="form-control @error('telp_ibu') is-invalid @enderror" value="{{ old('telp_ibu') }}">
                                @error('telp_ibu')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu"
                                    class="form-control @error('pekerjaan_ibu') is-invalid @enderror" value="{{ old('pekerjaan_ibu') }}">
                                @error('pekerjaan_ibu')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="penghasilan_ibu">Penghasilan Ibu</label>
                                <input type="number" name="penghasilan_ibu" id="penghasilan_ibu"
                                    class="form-control @error('penghasilan_ibu') is-invalid @enderror" value="{{ old('penghasilan_ibu') }}">
                                @error('penghasilan_ibu')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="alamat_orang_tua">Alamat Orang Tua</label>
                                <input type="text" name="alamat_orang_tua" id="alamat_orang_tua"
                                    class="form-control @error('alamat_orang_tua') is-invalid @enderror" value="{{ old('alamat_orang_tua') }}">
                                @error('alamat_orang_tua')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <x-button-back link="{{ route('siswa.index') }}" />
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
@include('layouts.sweetalert')
@endsection