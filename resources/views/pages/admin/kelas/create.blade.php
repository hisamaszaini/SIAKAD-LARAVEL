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
                    <h4>{{ $title}}/h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('kelas.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="nama_kelas">Nama Kelas <code>*)</code></label>
                                <input type="text" name="nama_kelas" id="nama_kelas"
                                    class="form-control @error('nama_kelas') is-invalid @enderror"
                                    value="{{ old('nama_kelas') }}" required>
                                @error('nama_kelas')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="tingkat">Tingkat <code>*)</code></label>
                                <select name="tingkat" id="tingkat" class="form-control @error('tingkat') is-invalid @enderror" required>
                                    <option value="">Pilih Tingkat</option>
                                    @for ($i = 1; $i <= 6; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                </select>
                                @error('tingkat')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="guru_id">Wali Kelas <code>*)</code></label>
                                <select name="guru_id" id="guru_id" class="form-control @error('guru_id') is-invalid @enderror" required>
                                    <option value="">Pilih Guru</option>
                                    @foreach($gurus as $guru)
                                    <option value="{{ $guru->id }}" {{ old('guru_id') == $guru->id ? 'selected' : '' }}>
                                        {{ $guru->nama }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('guru_id')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <x-button-back link="{{ route('kelas.index') }}" />
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