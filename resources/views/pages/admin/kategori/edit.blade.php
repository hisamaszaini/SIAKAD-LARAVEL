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
                    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- Input Nama Kategori -->
                            <div class="form-group col-md-12 col-12">
                                <label for="nama">Nama Kategori <code>*)</code></label>
                                <input type="text" name="nama" id="nama"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    value="{{ old('nama', $kategori->nama) }}" required>
                                @error('nama')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Update -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <x-button-back link="{{ route('kategori.index') }}" />
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
