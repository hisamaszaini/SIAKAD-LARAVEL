@extends('layouts.master', ['title' => $title])

@section('plugins_css')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">

<!-- JS -->
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
                    <form action="{{ route('blog.updatepost', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $post->title) }}" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control @error('kategori_id') is-invalid @enderror" name="kategori_id">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}" {{ $k->id == $post->kategori_id ? 'selected' : '' }}>
                                        {{ $k->nama }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Isi Konten</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea id="summernote" class="summernote @error('content') is-invalid @enderror" name="content" required>{{ old('content', $post->content) }}</textarea>
                                @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar</label>
                            <div class="col-sm-12 col-md-7">
                                <div id="image-preview" class="image-preview" style="border: 1px dashed #ccc; height: 200px; position: relative;">
                                    @if($post->image)
                                    <img src="{{ asset('storage/uploads/' . $post->image) }}" alt="Gambar Lama" style="width: 100%; height: 100%; object-fit: cover;" />
                                    @endif
                                    <label for="image-upload" id="image-label" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(255, 255, 255, 0.7); padding: 5px; cursor: pointer;">Choose File</label>
                                    <input type="file" name="image" id="image-upload" style="display: none;" />
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <x-button-back link="{{ route('blog.listpost') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('plugins_js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>
<script>
    if (jQuery().summernote) {
        $(".summernote").summernote({
            dialogsInBody: true,
            minHeight: 250,
        });
    };
</script>
@endsection

@section('page_js')
@include('layouts.previewimage')
@include('layouts.sweetalert2')
@endsection