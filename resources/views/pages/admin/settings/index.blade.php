@extends('layouts.master', ['title' => $title])

@section('plugins_css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .custom-file-input {
        display: none;
    }

    .custom-file-label {
        display: inline-block;
        padding: 10px 15px;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        background-color: #f8f9fa;
        cursor: pointer;
        text-align: right;
    }

    .custom-file-label:hover {
        background-color: #e2e6ea;
    }
</style>
@endsection

@section('content')
<section class="section">
    @include('layouts.sectionheader')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Settings</h4>
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
                    <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="app_nama">Nama Aplikasi <code>*)</code></label>
                                <input type="text" name="app_nama" id="app_nama"
                                    class="form-control @error('app_nama') is-invalid @enderror"
                                    value="{{ old('app_nama', $settings->app_nama) }}" required>
                                @error('app_nama')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="app_namapendek">Nama Pendek Aplikasi <code>*)</code></label>
                                <input type="text" name="app_namapendek" id="app_namapendek"
                                    class="form-control @error('app_namapendek') is-invalid @enderror"
                                    value="{{ old('app_namapendek', $settings->app_namapendek) }}" required>
                                @error('app_namapendek')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="pagination">Pagination <code>*)</code></label>
                                <select name="pagination" id="pagination" class="form-control @error('pagination') is-invalid @enderror" required>
                                    @for ($i = 8; $i <= 40; $i +=8)
                                        <option value="{{ $i }}" {{ old('pagination', $settings->pagination) == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                        </option>
                                        @endfor
                                </select>
                                @error('pagination')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="lembaga_nama">Nama Lembaga <code>*)</code></label>
                                <input type="text" name="lembaga_nama" id="lembaga_nama"
                                    class="form-control @error('lembaga_nama') is-invalid @enderror"
                                    value="{{ old('lembaga_nama', $settings->lembaga_nama) }}" required>
                                @error('lembaga_nama')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="lembaga_jalan">Jalan Lembaga <code>*)</code></label>
                                <input type="text" name="lembaga_jalan" id="lembaga_jalan"
                                    class="form-control @error('lembaga_jalan') is-invalid @enderror"
                                    value="{{ old('lembaga_jalan', $settings->lembaga_jalan) }}" required>
                                @error('lembaga_jalan')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="lembaga_telp">No Telepon Lembaga <code>*)</code></label>
                                <input type="text" name="lembaga_telp" id="lembaga_telp"
                                    class="form-control @error('lembaga_telp') is-invalid @enderror"
                                    value="{{ old('lembaga_telp', $settings->lembaga_telp) }}" required>
                                @error('lembaga_telp')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="lembaga_kota">Kota Lembaga <code>*)</code></label>
                                <input type="text" name="lembaga_kota" id="lembaga_kota"
                                    class="form-control @error('lembaga_kota') is-invalid @enderror"
                                    value="{{ old('lembaga_kota', $settings->lembaga_kota) }}" required>
                                @error('lembaga_kota')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="nama_kepsek">Nama Kepala Sekolah <code>*)</code></label>
                                <input type="text" name="nama_kepsek" id="nama_kepsek"
                                    class="form-control @error('nama_kepsek') is-invalid @enderror"
                                    value="{{ old('nama_kepsek', $settings->nama_kepsek) }}" required>
                                @error('nama_kepsek')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="nominaltagihan">Nominal Tagihan <code>*)</code></label>
                                <input type="number" name="nominaltagihan" id="nominaltagihan"
                                    class="form-control @error('nominaltagihan') is-invalid @enderror"
                                    value="{{ old('nominaltagihan', $settings->nominaltagihan) }}" required>
                                @error('nominaltagihan')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="semesteraktif">Semester Aktif <code>*)</code></label>
                                <select name="semesteraktif" id="semesteraktif"
                                    class="form-control @error('semesteraktif') is-invalid @enderror" required>
                                    <option value="1" {{ old('semesteraktif', $settings->semesteraktif) == '1' ? 'selected' : '' }}>1 (Ganjil)</option>
                                    <option value="2" {{ old('semesteraktif', $settings->semesteraktif) == '2' ? 'selected' : '' }}>2 (Genap)</option>
                                </select>
                                @error('semesteraktif')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="lembaga_logo">Logo Lembaga</label>
                                <div class="custom-file">
                                    <input type="file" name="lembaga_logo" id="lembaga_logo"
                                        class="custom-file-input @error('lembaga_logo') is-invalid @enderror"
                                        onchange="previewImage(this, 'preview-lembaga')">
                                    <label class="custom-file-label" for="lembaga_logo">Pilih file</label>
                                </div>
                                @error('lembaga_logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-2">
                                    <img id="preview-lembaga"
                                        src="{{ asset('storage/' . $settings->lembaga_logo) }}"
                                        class="img-preview img-fluid mb-3 col-sm-5"
                                        style="max-height: 150px; display: {{ $settings->lembaga_logo ? 'block' : 'none' }};">
                                </div>
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="sekolah_logo">Logo Sekolah</label>
                                <div class="custom-file">
                                    <input type="file" name="sekolah_logo" id="sekolah_logo"
                                        class="custom-file-input @error('sekolah_logo') is-invalid @enderror"
                                        onchange="previewImage(this, 'preview-sekolah')">
                                    <label class="custom-file-label" for="sekolah_logo">Pilih file</label>
                                </div>
                                @error('sekolah_logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-2">
                                    <img id="preview-sekolah"
                                        src="{{ asset('storage/' . $settings->sekolah_logo) }}"
                                        class="img-preview img-fluid mb-3 col-sm-5"
                                        style="max-height: 150px; display: {{ $settings->sekolah_logo ? 'block' : 'none' }};">
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <x-button-back link="{{ route('dashboard') }}" />
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('plugins_js')
<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.onerror = function(e) {
                console.error('Error:', e);
                preview.style.display = 'none';
            }

            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    }
</script>
@endsection

@section('page_js')
@include('layouts.sweetalert2')
@endsection