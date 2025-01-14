@extends('layouts.master', ['title' => $title])

@section('plugins_css')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="/assets/css/custom.css">

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<section class="section">
    @include('layouts.sectionheader')
    <div class="section-body">
        <div class="card">
            <div class="card-body">

                <div class="d-flex bd-highlight mb-3 align-items-center">
                    <div class="p-2 bd-highlight">
                        <form action="{{ route('blog.listpost') }}" method="GET">
                            <input type="text" class="form-sam ml-0" name="cari" value="{{ $cari }}">
                            <span>
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="submit" value="Cari">
                            </span>
                        </form>
                    </div>
                    <div class="ml-auto p-2 bd-highlight">
                        <x-button-create link="{{ route('blog.createpost') }}"></x-button-create>
                    </div>
                </div>

                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th class="text-center py-2 min-row"> <input type="checkbox" id="chkCheckAll"> All</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Tanggal</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                        @forelse ($posts as $post)
                        <tr id="sid{{ $post->id }}">
                            <td class="text-center">
                                <input type="checkbox" name="ids" class="checkBoxClass" value="{{ $post->id }}">
                            </td>
                            <td>{{ Str::limit($post->title, 25, ' ...') }}</td>
                            <td>{{ $post->kategori_id ? $post->kategori->nama : 'Tak Berkategori' }}</td>
                            <td>{{ $post->users->name }}</td>
                            <td>{{ $post->created_at->format('d F Y') }}</td>
                            <td class="text-center min-row">
                                <x-button-edit link="{{  route('blog.editpost', $post->id) }}" />
                                <x-button-delete link="{{ route('blog.destroypost', $post->id) }}" />
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Data tidak ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-between flex-row-reverse mt-3">
                    <div>
                        {{ $posts->links('layouts.pagination') }}
                    </div>
                    <div>
                        <a href="#" class="btn btn-sm btn-danger mb-2" id="deleteAllSelectedRecord" data-toggle="tooltip" data-placement="top" title="Hapus Terpilih"> <i class="fas fa-trash-alt mr-2"></i> Hapus Terpilih
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('plugins_js')

@endsection

@section('page_js')
@include('layouts.sweetalert2')
@endsection