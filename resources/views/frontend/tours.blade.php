@extends('frontend.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Page Header -->
    <div class="mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Explore Our Tours</h1>
        <p class="text-lg text-gray-600">
            Discover amazing adventures with experienced local guides
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Filters Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Filter Tours</h3>

                <form method="GET" action="{{ route('tours.index') }}">
                    <!-- Search -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Search</label>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Tour name or keyword"
                        >
                    </div>

                    <!-- Location -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Location</label>
                        <select
                            name="location"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="">All Locations</option>
                            @foreach($locations as $location)
                                <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                                    {{ $location }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Difficulty Level -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Difficulty</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="difficulty" value=""
                                       class="mr-2" {{ !request('difficulty') ? 'checked' : '' }}>
                                <span class="text-gray-700">All Levels</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="difficulty" value="Easy"
                                       class="mr-2" {{ request('difficulty') == 'Easy' ? 'checked' : '' }}>
                                <span class="text-gray-700">Easy</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="difficulty" value="Moderate"
                                       class="mr-2" {{ request('difficulty') == 'Moderate' ? 'checked' : '' }}>
                                <span class="text-gray-700">Moderate</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="difficulty" value="Hard"
                                       class="mr-2" {{ request('difficulty') == 'Hard' ? 'checked' : '' }}>
                                <span class="text-gray-700">Hard</span>
                            </label>
                        </div>
                    </div>

                    <!-- Duration -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Max Duration (hours)</label>
                        <select
                            name="duration"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="">Any Duration</option>
                            <option value="2" {{ request('duration') == '2' ? 'selected' : '' }}>Up to 2 hours</option>
                            <option value="4" {{ request('duration') == '4' ? 'selected' : '' }}>Up to 4 hours</option>
                            <option value="8" {{ request('duration') == '8' ? 'selected' : '' }}>Up to 8 hours</option>
                            <option value="24" {{ request('duration') == '24' ? 'selected' : '' }}>Full day</option>
                            <option value="72" {{ request('duration') == '72' ? 'selected' : '' }}>Multi-day</option>
                        </select>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Price Range (NPR)</label>
                        <div class="grid grid-cols-2 gap-2">
                            <input
                                type="number"
                                name="min_price"
                                value="{{ request('min_price') }}"
                                placeholder="Min"
                                class="px-3 py-2 border border-gray-300 rounded-lg"
                            >
                            <input
                                type="number"
                                name="max_price"
                                value="{{ request('max_price') }}"
                                placeholder="Max"
                                class="px-3 py-2 border border-gray-300 rounded-lg"
                            >
                        </div>
                    </div>

                    <!-- Sort By -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Sort By</label>
                        <select
                            name="sort"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Newest</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Name A-Z</option>
                        </select>
                    </div>

                    <!-- Filter Buttons -->
                    <div class="flex space-x-2">
                        <button
                            type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition"
                        >
                            Apply Filters
                        </button>
                        <a
                            href="{{ route('tours.index') }}"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition"
                        >
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tours Grid -->
        <div class="lg:col-span-3">
            @if($tours->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($tours as $tour)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <!-- Tour Image -->
                            @if($tour->image)
                                <a href="{{ route('tours.show', $tour->id) }}" class="block">
                                    <img
                                        src="{{ asset('storage/' . $tour->image) }}"
                                        alt="{{ $tour->title }}"
                                        class="w-full h-48 object-cover"
                                        onerror="this.src='{{ asset('images/default-tour.jpg') }}'"
                                    >
                                </a>
                            @endif

                            <!-- Tour Info -->
                            <div class="p-6">
                                <!-- Location & Difficulty Badges -->
                                <div class="flex justify-between items-center mb-3">
                                    <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                                        {{ $tour->location }}
                                    </span>
                                    @if($tour->difficulty_level)
                                        <span class="inline-block bg-gray-100 text-gray-800 text-xs font-semibold px-3 py-1 rounded-full">
                                            {{ $tour->difficulty_level }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Title -->
                                <h3 class="text-xl font-bold text-gray-900 mb-2">
                                    <a href="{{ route('tours.show', $tour->id) }}" class="hover:text-blue-600">
                                        {{ $tour->title }}
                                    </a>
                                </h3>

                                <!-- Description Excerpt -->
                                <p class="text-gray-600 mb-4 line-clamp-2">
                                    {{ Str::limit(strip_tags($tour->description), 100) }}
                                </p>

                                <!-- Duration & Max People -->
                                <div class="flex items-center text-gray-500 text-sm mb-4">
                                    <span class="flex items-center mr-4">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $tour->duration }}
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        Max {{ $tour->max_people }} people
                                    </span>
                                </div>

                                <!-- Price & Book Button -->
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-2xl font-bold text-gray-900">NPR {{ number_format($tour->price) }}</span>
                                        <span class="text-gray-500 text-sm block">per person</span>
                                    </div>
                                    <a href="{{ route('tours.show', $tour->id) }}"
                                       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                                        View Details
                                    </a>
                                </div>

                                <!-- Available Dates -->
                                @if($tour->tourDates->count() > 0)
                                    <div class="mt-4 pt-4 border-t border-gray-100">
                                        <p class="text-sm text-gray-500 mb-2">Next available dates:</p>
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($tour->tourDates->take(3) as $date)
                                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">
                                                    {{ $date->date->format('M d') }}
                                                </span>
                                            @endforeach
                                            @if($tour->tourDates->count() > 3)
                                                <span class="text-xs text-gray-500">+{{ $tour->tourDates->count() - 3 }} more</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $tours->links() }}
                </div>
            @else
                <!-- No Tours Found -->
                <div class="text-center py-16">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Tours Found</h3>
                    <p class="text-gray-500 mb-6">Try adjusting your filters or check back later.</p>
                    <a href="{{ route('tours.index') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition">
                        Clear Filters
                    </a>
                </div>
            @endif
        </div>
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
</style>
@endpush
