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
                    <form action="{{ route('tagihan.update', $tagihan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="nama">Nama Tagihan <code>*)</code></label>
                                <input type="text" name="nama" id="nama"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    value="{{ old('nama', $tagihan->nama) }}" required>
                                @error('nama')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="nominal">Nominal <code>*)</code></label>
                                <input type="number" name="nominal" id="nominal" min="0"
                                    class="form-control @error('nominal') is-invalid @enderror"
                                    value="{{ old('nominal', $tagihan->nominal) }}" required>
                                @error('nominal')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="keterangan">Keterangan <code>(optional)</code></label>
                                <input type="text" name="keterangan" id="keterangan"
                                    class="form-control @error('keterangan') is-invalid @enderror"
                                    value="{{ old('keterangan', $tagihan->keterangan) }}">
                                @error('keterangan')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="tingkatan">Tingkat <code>*)</code></label>
                                <select name="tingkatan" id="tingkatan" class="form-control @error('tingkatan') is-invalid @enderror" required>
                                    <option value="">Pilih Tingkat</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ old('tingkatan', $tagihan->tingkatan) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('tingkatan')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="semester">Semester <code>*)</code></label>
                                <select name="semester" id="semester" class="form-control @error('semester') is-invalid @enderror" required>
                                    <option value="">Pilih Semester</option>
                                    <option value="1" {{ old('semester', $tagihan->semester) == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ old('semester', $tagihan->semester) == 2 ? 'selected' : '' }}>2</option>
                                </select>
                                @error('semester')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="tanggal_tagihan">Tanggal Tagihan <code>*)</code></label>
                                <input type="date" name="tanggal_tagihan" id="tanggal_tagihan"
                                    class="form-control @error('tanggal_tagihan') is-invalid @enderror"
                                    value="{{ old('tanggal_tagihan', $tagihan->tgl_tagihan) }}" required>
                                @error('tanggal_tagihan')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="tanggal_tempo">Tanggal Tempo <code>*)</code></label>
                                <input type="date" name="tanggal_tempo" id="tanggal_tempo"
                                    class="form-control @error('tanggal_tempo') is-invalid @enderror"
                                    value="{{ old('tanggal_tempo', $tagihan->tgl_tempo) }}" required>
                                @error('tanggal_tempo')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <x-button-back link="{{ route('tagihan.index') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('block plugins_js')
@endsection

@section('page_js')
@include('layouts.sweetalert')
@endsection