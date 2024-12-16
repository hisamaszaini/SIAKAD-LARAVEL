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
                    <form action="{{ route('jadwal.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="kelas_id">Kelas <code>*</code></label>
                                <select name="kelas_id" id="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach($kelas as $kls)
                                    <option value="{{ $kls->id }}" {{ old('kelas_id') == $kls->id ? 'selected' : '' }}>{{ $kls->nama_kls }}</option>
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="mapel_id">Mata Pelajaran <code>*</code></label>
                                <select name="mapel_id" id="mapel_id" class="form-control @error('mapel_id') is-invalid @enderror" required>
                                    <option value="">Pilih Mata Pelajaran</option>
                                    @foreach($mapel as $mpl)
                                    <option value="{{ $mpl->id }}" {{ old('mapel_id') == $mpl->id ? 'selected' : '' }}>{{ $mpl->nama_mapel }}</option>
                                    @endforeach
                                </select>
                                @error('mapel_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="ruang_id">Ruang <code>*</code></label>
                                <select name="ruang_id" id="ruang_id" class="form-control @error('ruang_id') is-invalid @enderror" required>
                                    <option value="">Pilih Ruang</option>
                                    @foreach($ruang as $rng)
                                    <option value="{{ $rng->id }}" {{ old('ruang_id') == $rng->id ? 'selected' : '' }}>{{ $rng->nama_ruang }}</option>
                                    @endforeach
                                </select>
                                @error('ruang_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="guru_id">Guru <code>*</code></label>
                                <select name="guru_id" id="guru_id" class="form-control @error('guru_id') is-invalid @enderror" required>
                                    <option value="">Pilih Guru</option>
                                    @foreach($guru as $gr)
                                    <option value="{{ $gr->id }}" {{ old('guru_id') == $gr->id ? 'selected' : '' }}>{{ $gr->nama_guru }}</option>
                                    @endforeach
                                </select>
                                @error('guru_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="jam_pelajaran_id">Jam Pelajaran <code>*</code></label>
                                <select name="jam_pelajaran_id" id="jam_pelajaran_id" class="form-control @error('jam_pelajaran_id') is-invalid @enderror" required>
                                    <option value="">Pilih Jam</option>
                                    @foreach($jamPelajaran as $jam)
                                    <option value="{{ $jam->id }}" {{ old('jam_pelajaran_id') == $jam->id ? 'selected' : '' }}>{{ $jam->nama_jam }} ({{ $jam->jam_mulai }} - {{ $jam->jam_selesai }})</option>
                                    @endforeach
                                </select>
                                @error('jam_pelajaran_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="hari_id">Hari <code>*</code></label>
                                <select name="hari_id" id="hari_id" class="form-control @error('hari_id') is-invalid @enderror" required>
                                    <option value="">Pilih Hari</option>
                                    @foreach($hari as $hr)
                                    <option value="{{ $hr->id }}" {{ old('hari_id') == $hr->id ? 'selected' : '' }}>{{ $hr->nama_hari }}</option>
                                    @endforeach
                                </select>
                                @error('hari_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <x-button-back link="{{ route('jadwal.index') }}" />
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