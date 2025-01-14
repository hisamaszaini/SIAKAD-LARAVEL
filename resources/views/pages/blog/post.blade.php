@extends('layouts.blog', ['title' => $title])

@section('content')
<div class="container max-w-7xl max-w-7xl mx-auto pt-28 px-4 sm:px-6 lg:px-8">
    <!-- Post Header -->
    <div class="mb-12">
        <h1 class="text-4xl font-bold text-center mb-4">{{ $post->title }}</h1>
        <p class="text-gray-600 text-center">
            Kategori: <a href="{{ route('blog.kategori', $kategori->slug) }}" class="text-blue-500 hover:underline">{{ $kategori->nama }}</a>
            | Diposting pada {{ $post->created_at->format('d M Y') }}
        </p>
    </div>

    <!-- Post Content -->
    <div class="prose max-w-none mx-auto">
        {!! $post->content !!}
    </div>

    <!-- Post Navigation -->
    <div class="mt-12 flex justify-between">
        <a href="{{ route('blog.index') }}" class="text-blue-500 hover:underline">← Kembali ke Blog</a>
    </div>
</div>
@endsection
