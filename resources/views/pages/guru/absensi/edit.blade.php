@extends('layouts.master', ['title' => $title])

@section('plugins_css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                    <form action="{{ route('guru.absensi.update', $absensi->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="kelas_id">Kelas <code>*</code></label>
                                <select name="kelas_id" id="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach($kelas as $kls)
                                    <option value="{{ $kls->id }}" {{ $absensi->kelas_id == $kls->id ? 'selected' : '' }}>{{ $kls->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="tanggal">Tanggal <code>*</code></label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ $absensi->tanggal }}" required>
                                @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="guru_id">Dibuat oleh <code>*</code></label>
                                <input type="hidden" name="guru_id" value="{{ $absensi->guru_id }}">
                                <input type="text" class="form-control" value="{{ $absensi->guru->nama }}" readonly>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                            <x-button-back link="{{ route('guru.absensi.index') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page_js')
@include('layouts.sweetalert')
@endsection