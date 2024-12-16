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
                    <h4>Tambah Jam Pelajaran</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('jampelajaran.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="nama_jam">Nama Jam <code>*)</code></label>
                                <input type="text" name="nama_jam" id="nama_jam"
                                    class="form-control @error('nama_jam') is-invalid @enderror"
                                    value="{{ old('nama_jam') }}" required>
                                @error('nama_jam')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="jam_mulai">Jam Mulai <code>*)</code></label>
                                <input type="time" name="jam_mulai" id="jam_mulai"
                                    class="form-control @error('jam_mulai') is-invalid @enderror"
                                    value="{{ old('jam_mulai') }}" required step="300"> <!-- Lompatan 5 menit -->
                                @error('jam_mulai')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="jam_selesai">Jam Selesai <code>*)</code></label>
                                <input type="time" name="jam_selesai" id="jam_selesai"
                                    class="form-control @error('jam_selesai') is-invalid @enderror"
                                    value="{{ old('jam_selesai') }}" required step="300"> <!-- Lompatan 5 menit -->
                                @error('jam_selesai')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="urutan">Urutan <code>*)</code></label>
                                <select name="urutan" id="urutan"
                                    class="form-control @error('urutan') is-invalid @enderror" required>
                                    <option value="">Pilih Urutan</option>
                                    @for ($i = 1; $i <= 14; $i++)
                                        <option value="{{ $i }}" {{ old('urutan') == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                @error('urutan')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <x-button-back link="{{ route('jampelajaran.index') }}" />
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