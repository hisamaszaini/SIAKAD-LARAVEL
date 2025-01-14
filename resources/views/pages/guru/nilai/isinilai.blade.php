@extends('layouts.master', ['title' => 'Input Kehadiran'])

@section('plugins_css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<section class="section">
    @include('layouts.sectionheader')
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Isi Nilai {{ $mapel->nama }} Kelas {{ $kelas->nama }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('guru.nilairapot.store', $jadwal_id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="jadwal_id" value="{{ $jadwal_id }}">
                    <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
                    <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                    <input type="hidden" name="guru_id" value="{{ $guru->id }}">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Nilai Pengetahuan</th>
                                <th>Predikat Pengetahuan</th>
                                <th>Nilai Keterampilan</th>
                                <th>Predikat Keterampilan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswa as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <input type="hidden" name="siswa_id[]" value="{{ $s->id }}">
                                    {{ $s->nama }}
                                </td>
                                <td>
                                    <input type="number" class="form-control @error('p_nilai.'.$loop->index) is-invalid @enderror" name="p_nilai[]" value="{{ old('p_nilai.'.$loop->index, $rapot[$s->id]->p_nilai ?? '') }}" placeholder="Nilai Pengetahuan" required>
                                    @error('p_nilai.'.$loop->index)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control" name="p_predikat[]" required>
                                        <option value="auto" {{ old('p_predikat.'.$loop->index, $rapot[$s->id]->p_predikat ?? '') == 'auto' ? 'selected' : '' }}>Auto</option>
                                        <option value="A" {{ old('p_predikat.'.$loop->index, $rapot[$s->id]->p_predikat ?? '') == 'A' ? 'selected' : '' }}>A</option>
                                        <option value="B" {{ old('p_predikat.'.$loop->index, $rapot[$s->id]->p_predikat ?? '') == 'B' ? 'selected' : '' }}>B</option>
                                        <option value="C" {{ old('p_predikat.'.$loop->index, $rapot[$s->id]->p_predikat ?? '') == 'C' ? 'selected' : '' }}>C</option>
                                        <option value="D" {{ old('p_predikat.'.$loop->index, $rapot[$s->id]->p_predikat ?? '') == 'D' ? 'selected' : '' }}>D</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control @error('k_nilai.'.$loop->index) is-invalid @enderror" name="k_nilai[]" value="{{ old('k_nilai.'.$loop->index, $rapot[$s->id]->k_nilai ?? '') }}" placeholder="Nilai Keterampilan" required>
                                    @error('k_nilai.'.$loop->index)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control" name="k_predikat[]" required>
                                        <option value="auto" {{ old('k_predikat.'.$loop->index, $rapot[$s->id]->k_predikat ?? '') == 'auto' ? 'selected' : '' }}>Auto</option>
                                        <option value="A" {{ old('k_predikat.'.$loop->index, $rapot[$s->id]->k_predikat ?? '') == 'A' ? 'selected' : '' }}>A</option>
                                        <option value="B" {{ old('k_predikat.'.$loop->index, $rapot[$s->id]->k_predikat ?? '') == 'B' ? 'selected' : '' }}>B</option>
                                        <option value="C" {{ old('k_predikat.'.$loop->index, $rapot[$s->id]->k_predikat ?? '') == 'C' ? 'selected' : '' }}>C</option>
                                        <option value="D" {{ old('k_predikat.'.$loop->index, $rapot[$s->id]->k_predikat ?? '') == 'D' ? 'selected' : '' }}>D</option>
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                        <a href="{{ route('guru.nilai.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
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