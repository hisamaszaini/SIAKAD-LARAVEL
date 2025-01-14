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
                    <form action="{{ route('guru.nilai.storeDeskripsi') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="kelas_id">Nama Kelas <code>*)</code></label>
                                <input type="text" name="kelas_id" id="kelas_id"
                                    class="form-control @error('kelas_id') is-invalid @enderror"
                                    value="{{ $kelas->nama }}" readonly>
                                <input type="hidden" name="kelas_id" value="{{ $kelas->id }}" class="form-control @error('kelas_id') is-invalid @enderror" readonly>
                                @error('kelas_id')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="mapel_id">Mata Pelajaran <code>*)</code></label>
                                <input type="text" name="nama_mapel" id="mapel_id"
                                    class="form-control"
                                    value="{{ $mapel->nama }}" readonly>
                                <input type="hidden" name="mapel_id" value="{{ $mapel->id }}" class="form-control @error('mapel_id') is-invalid @enderror" readonly>
                                @error('mapel_id')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="deskripsi_a">Deskripsi A <code>*)</code></label>
                                <textarea class="form-control" id="deskripsi_a" name="deskripsi_a" required>{{ old('deskripsi_a', $deskripsi['deskripsi_a']) }}</textarea>
                                @error('deskripsi_a')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="deskripsi_b">Deskripsi B <code>*)</code></label>
                                <textarea class="form-control" id="deskripsi_b" name="deskripsi_b" required>{{ old('deskripsi_b', $deskripsi['deskripsi_b']) }}</textarea>
                                @error('deskripsi_b')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="deskripsi_c">Deskripsi C <code>*)</code></label>
                                <textarea class="form-control" id="deskripsi_c" name="deskripsi_c" required>{{ old('deskripsi_c', $deskripsi['deskripsi_c']) }}</textarea>
                                @error('deskripsi_c')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="deskripsi_d">Deskripsi D <code>*)</code></label>
                                <textarea class="form-control" id="deskripsi_d" name="deskripsi_d" required>{{ old('deskripsi_d', $deskripsi['deskripsi_d']) }}</textarea>
                                @error('deskripsi_d')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <x-button-back link="{{ route('guru.nilai.index') }}" />
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