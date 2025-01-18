@extends('layouts.blog', ['title' => $title])

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-0 mt-16">
        <main class="lg:col-span-8">
            <div class="max-w-[690px] mx-auto">
                <div class="mb-4">
                    <p> <a href="{{ route('blog.kategori', $kategori->slug) }}" class="text-base text-blue-500 hover:underline">{{ $kategori->nama }}</a> </p>
                    <h1 class="text-3xl font-bold mb-1 text-green-500">{{ $post->title }}</h1>
                    <span class="text-gray-600 text-sm">{{ $post->created_at->format('d F Y') }}</span>
                    @if( $post->image )
                    <img src="{{ asset('storage/uploads/' . $post->image) }}" alt="{{ $post->title }}" class="w-full object-cover mt-4 mb-4 rounded-md">
                    @endif
                </div>

                <article class="prose max-w-none">
                    {!! $post->content !!}
                </article>

                <div class="mt-3 mb-6">
                    <a href="{{ route('blog.index') }}" class="text-blue-500 hover:underline">← Kembali ke Blog</a>
                </div>
            </div>
        </main>
        <aside class="lg:col-span-4">
            <div class="bg-white rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4 text-green-500">Artikel Terbaru</h3>
                <div class="space-y-4">
                    @foreach($latest as $post)
                    <div class="group">
                        <a href="{{ route('blog.post', $post->slug) }}" class="block hover:scale-105">
                            <div class="flex gap-4">
                                <div class="flex-shrink-0 w-24 h-24">
                                    @if($post->image)
                                    <img src="{{ asset('storage/uploads/' . $post->image) }}"
                                        alt="{{ $post->title }}"
                                        class="w-full h-full object-cover rounded-lg">
                                    @else
                                    <img src="https://via.placeholder.com/300x200"
                                        alt="{{ $post->title }}"
                                        class="w-full h-full object-cover rounded-lg">
                                    @endif
                                </div>
                                <div class="flex flex-col justify-center">
                                    <div class="text-sm text-gray-500">{{ $post->created_at->format('F d, Y') }}</div>
                                    <h4 class="text-sm font-medium group-hover:text-green-500 transition-colors duration-200">
                                        {{ Str::limit($post->title, 50, '...') }}
                                    </h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection