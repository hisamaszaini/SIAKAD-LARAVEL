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
                    <form action="{{ route('blog.storepost') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf-token" autocomplete="off">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
                            <div class="col-sm-12 col-md-7">
                                <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Isi</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea id="summernote" class="summernote @error('content') is-invalid @enderror" name="content" value="{{ old('content') }}" required></textarea>
                                @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar</label>
                            <div class="col-sm-12 col-md-7">
                                <div id="image-preview" class="image-preview">
                                    <label for="image-upload" id="image-label">Choose File</label>
                                    <input type="file" name="image" id="image-upload" />
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
            callbacks: {
                onImageUpload: function(files) {
                    uploadImage(files[0]);
                }
            }
        });
    }

    function uploadImage(file) {
        let data = new FormData();
        data.append("image", file);
        let csrfToken = document.getElementById('csrf-token').value;

        $.ajax({
            url: "{{ route('upload.summernote.image') }}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: data,
            contentType: false,
            processData: false,
            success: function(response) {
                $('.summernote').summernote('insertImage', response.url);
            },
            error: function() {
                alert("Gagal mengunggah gambar.");
            }
        });
    }
</script>
@endsection

@section('page_js')
@include('layouts.previewimage')
@include('layouts.sweetalert2')
@endsection