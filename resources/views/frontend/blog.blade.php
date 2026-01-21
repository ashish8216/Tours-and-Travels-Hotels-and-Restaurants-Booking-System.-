@extends('frontend.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Page Header -->
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Travel Blog</h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto">
            Discover amazing travel stories, tips, and guides for your next adventure in Nepal and beyond.
        </p>
    </div>

    <!-- Featured Blog Post -->
    @if($featuredBlog)
    <div class="mb-12">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            @if($featuredBlog->featured_image)
            <div class="relative h-96">
                <img
                    src="{{ asset('storage/' . $featuredBlog->featured_image) }}"
                    alt="{{ $featuredBlog->title }}"
                    class="w-full h-full object-cover"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                    <span class="inline-block bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold mb-3">
                        Featured
                    </span>
                    <h2 class="text-3xl font-bold mb-3">
                        <a href="{{ route('blog.show', $featuredBlog->slug) }}" class="hover:text-blue-200">
                            {{ $featuredBlog->title }}
                        </a>
                    </h2>
                    <p class="text-lg mb-4 line-clamp-2">{{ $featuredBlog->excerpt }}</p>
                    <div class="flex items-center">
                        <div class="flex items-center mr-6">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>{{ $featuredBlog->user->name }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ $featuredBlog->published_at->format('F d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="p-8">
                <span class="inline-block bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold mb-3">
                    Featured
                </span>
                <h2 class="text-3xl font-bold text-gray-900 mb-3">
                    <a href="{{ route('blog.show', $featuredBlog->slug) }}" class="hover:text-blue-600">
                        {{ $featuredBlog->title }}
                    </a>
                </h2>
                <p class="text-gray-600 text-lg mb-4">{{ $featuredBlog->excerpt }}</p>
                <div class="flex items-center text-gray-500">
                    <div class="flex items-center mr-6">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>{{ $featuredBlog->user->name }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $featuredBlog->published_at->format('F d, Y') }}</span>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Blog Grid -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Latest Articles</h2>

        @if($blogs->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($blogs as $blog)
            <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                @if($blog->featured_image)
                <a href="{{ route('blog.show', $blog->slug) }}" class="block">
                    <img
                        src="{{ asset('storage/' . $blog->featured_image) }}"
                        alt="{{ $blog->title }}"
                        class="w-full h-48 object-cover"
                    >
                </a>
                @endif
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span class="flex items-center mr-4">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ $blog->user->name }}
                        </span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $blog->published_at->format('M d, Y') }}
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        <a href="{{ route('blog.show', $blog->slug) }}" class="hover:text-blue-600">
                            {{ $blog->title }}
                        </a>
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ $blog->excerpt ?: Str::limit(strip_tags($blog->content), 150) }}
                    </p>
                    <a href="{{ route('blog.show', $blog->slug) }}"
                       class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800">
                        Read More
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <div class="text-gray-400 mb-4">
                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No Articles Yet</h3>
            <p class="text-gray-500">Check back soon for travel tips and stories!</p>
        </div>
        @endif

        <!-- Pagination -->
        @if($blogs->hasPages())
        <div class="mt-12">
            {{ $blogs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
.line-clamp-2 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
}
.line-clamp-3 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 3;
}
</style>
@endpush
