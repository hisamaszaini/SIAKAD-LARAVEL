@extends('layouts.blog', ['title' => $title])

@section('content')
<div class="container max-w-7xl mx-auto pt-28 px-4">
    <h1 class="text-3xl font-bold mb-12 text-center" data-aos="fade-down">{{ $title }}</h1>

    @if ($posts->isEmpty())
        <p class="text-center text-gray-500">Belum ada postingan di kategori ini.</p>
    @else
        <!-- List Posts -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-aos="fade-up" data-aos-duration="1000">
            @foreach ($posts as $post)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform hover:scale-105">
                <!-- Post Thumbnail -->
                <img src="{{ $post->image ? asset('storage/uploads/' . $post->image) : 'https://via.placeholder.com/400x250' }}" 
                    alt="{{ $post->title }}" class="w-full h-48 object-cover">

                <!-- Post Content -->
                <div class="p-6">
                    <h2 class="text-xl font-bold mb-2">
                        <a href="{{ route('blog.post', $post->slug) }}" class="hover:text-blue-600">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p class="text-gray-600 text-sm mb-4">
                    {{ Str::limit(strip_tags($post->content), 100) }}
                    </p>
                    <div class="text-gray-500 text-xs flex items-center justify-between">
                        <span>{{ $post->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    @endif
</div>
@endsection
