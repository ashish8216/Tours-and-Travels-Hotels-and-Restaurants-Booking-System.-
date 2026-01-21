@extends('frontend.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="lg:grid lg:grid-cols-3 lg:gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <article class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                <!-- Featured Image -->
                @if($blog->featured_image)
                <div class="relative h-96">
                    <img
                        src="{{ asset('storage/' . $blog->featured_image) }}"
                        alt="{{ $blog->title }}"
                        class="w-full h-full object-cover"
                    >
                </div>
                @endif

                <!-- Article Header -->
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center text-sm text-gray-500">
                            <div class="flex items-center mr-6">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>{{ $blog->user->name }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $blog->published_at->format('F d, Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Title -->
                    <h1 class="text-4xl font-bold text-gray-900 mb-6">{{ $blog->title }}</h1>

                    <!-- Excerpt -->
                    @if($blog->excerpt)
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8 rounded-r-lg">
                        <p class="text-lg text-gray-700 italic">{{ $blog->excerpt }}</p>
                    </div>
                    @endif

                    <!-- Content -->
                    <div class="prose prose-lg max-w-none mb-8">
                        {!! $blog->content !!}
                    </div>

                    <!-- Share Buttons -->
                    <div class="border-t border-gray-200 pt-6 mt-8">
                        <div class="flex items-center">
                            <span class="text-gray-700 font-medium mr-4">Share:</span>
                            <div class="flex space-x-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                   target="_blank"
                                   class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blog->title) }}"
                                   target="_blank"
                                   class="bg-blue-400 text-white p-2 rounded-lg hover:bg-blue-500 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.213c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Related Articles -->
            @if($relatedBlogs->count() > 0)
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Related Articles</h3>
                <div class="space-y-6">
                    @foreach($relatedBlogs as $related)
                    <article class="flex items-start">
                        @if($related->featured_image)
                        <div class="flex-shrink-0 mr-4">
                            <img
                                src="{{ asset('storage/' . $related->featured_image) }}"
                                alt="{{ $related->title }}"
                                class="w-16 h-16 object-cover rounded-lg"
                            >
                        </div>
                        @endif
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">
                                <a href="{{ route('blog.show', $related->slug) }}" class="hover:text-blue-600">
                                    {{ Str::limit($related->title, 50) }}
                                </a>
                            </h4>
                            <p class="text-sm text-gray-500">{{ $related->published_at->format('M d, Y') }}</p>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Newsletter Signup -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                <h3 class="text-xl font-bold mb-3">Travel Tips Newsletter</h3>
                <p class="mb-4">Get the latest travel guides and exclusive offers directly in your inbox.</p>
                <form action="#" method="POST" class="space-y-3">
                    @csrf
                    <input
                        type="email"
                        name="email"
                        placeholder="Your email address"
                        class="w-full px-4 py-2 rounded-lg text-gray-900"
                        required
                    >
                    <button
                        type="submit"
                        class="w-full bg-white text-blue-600 font-semibold px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors"
                    >
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.prose {
    color: #374151;
}
.prose h2 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #111827;
}
.prose h3 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
    color: #1f2937;
}
.prose p {
    margin-bottom: 1rem;
    line-height: 1.7;
}
.prose ul, .prose ol {
    margin-bottom: 1rem;
    padding-left: 1.5rem;
}
.prose ul {
    list-style-type: disc;
}
.prose ol {
    list-style-type: decimal;
}
.prose li {
    margin-bottom: 0.5rem;
}
.prose img {
    border-radius: 0.5rem;
    margin: 1.5rem 0;
}
.prose blockquote {
    border-left: 4px solid #3b82f6;
    padding-left: 1rem;
    font-style: italic;
    color: #4b5563;
    margin: 1.5rem 0;
}
</style>
@endpush
