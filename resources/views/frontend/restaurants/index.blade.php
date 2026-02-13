{{-- resources/views/frontend/restaurants/index.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Restaurants')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Find Restaurants</h1>
            <p class="text-gray-600">Discover the best dining experiences</p>
        </div>

        <!-- Sort Dropdown -->
        <div class="mt-4 md:mt-0">
            <select id="sort" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" onchange="window.location.href = '{{ route('restaurants.index') }}?sort=' + this.value + '&order={{ request('order', 'desc') }}'">
                <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Newest First</option>
                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                <option value="capacity" {{ request('sort') == 'capacity' ? 'selected' : '' }}>Capacity</option>
            </select>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Filters Sidebar -->
        <div class="lg:w-64 flex-shrink-0">
            <div class="bg-white rounded-lg border border-gray-200 p-6 sticky top-24">
                <h3 class="font-semibold text-lg text-gray-900 mb-4">Filters</h3>

                <form method="GET" action="{{ route('restaurants.index') }}" id="filter-form">
                    <!-- Search -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Restaurant or cuisine..."
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Cuisine Type -->
                    @if($cuisines->count() > 0)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cuisine</label>
                        <select name="cuisine" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">All Cuisines</option>
                            @foreach($cuisines as $cuisine)
                                <option value="{{ $cuisine }}" {{ request('cuisine') == $cuisine ? 'selected' : '' }}>
                                    {{ ucfirst($cuisine) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <!-- Location -->
                    @if($locations->count() > 0)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <select name="location" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">All Locations</option>
                            @foreach($locations as $location)
                                <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                                    {{ $location }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <!-- Capacity -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Capacity</label>
                        <select name="capacity" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Any</option>
                            <option value="2" {{ request('capacity') == '2' ? 'selected' : '' }}>2+ People</option>
                            <option value="4" {{ request('capacity') == '4' ? 'selected' : '' }}>4+ People</option>
                            <option value="6" {{ request('capacity') == '6' ? 'selected' : '' }}>6+ People</option>
                            <option value="8" {{ request('capacity') == '8' ? 'selected' : '' }}>8+ People</option>
                            <option value="10" {{ request('capacity') == '10' ? 'selected' : '' }}>10+ People</option>
                        </select>
                    </div>

                    <div class="flex space-x-3">
                        <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                            Apply Filters
                        </button>
                        <a href="{{ route('restaurants.index') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition duration-300 text-center">
                            Clear
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Restaurants Grid -->
        <div class="flex-1">
            @if($restaurants->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($restaurants as $restaurant)
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-lg transition duration-300">
                            <!-- Restaurant Image -->
                            <div class="relative h-48 bg-gray-200">
                                @if($restaurant->image)
                                    <img src="{{ asset('storage/' . $restaurant->image) }}" alt="{{ $restaurant->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-20 h-20 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm0 2h12v10H4V5zm2 2v2h2V7H6zm4 0v2h2V7h-2zm4 0v2h2V7h-2zm-8 4v2h2v-2H6zm4 0v2h2v-2h-2zm4 0v2h2v-2h-2z"/>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Cuisine Badge -->
                                @if($restaurant->cuisine_type)
                                    <span class="absolute top-4 right-4 bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        {{ ucfirst($restaurant->cuisine_type) }}
                                    </span>
                                @endif
                            </div>

                            <!-- Restaurant Info -->
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-xl font-bold text-gray-900">
                                        <a href="{{ route('restaurants.show', $restaurant) }}" class="hover:text-blue-600 transition">
                                            {{ $restaurant->name }}
                                        </a>
                                    </h3>
                                </div>

                                <!-- Location -->
                                <div class="flex items-center text-gray-600 mb-2">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="text-sm">{{ $restaurant->location }}</span>
                                </div>

                                <!-- Hours & Capacity -->
                                <div class="flex items-center space-x-4 mb-3">
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-sm">{{ \Carbon\Carbon::parse($restaurant->opening_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($restaurant->closing_time)->format('h:i A') }}</span>
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.67 0c-.18-.64-.28-1.31-.28-2s.1-1.36.28-2m-13.67 0c.18.64.28 1.31.28 2s-.1 1.36-.28 2"/>
                                        </svg>
                                        <span class="text-sm">Up to {{ $restaurant->capacity }}</span>
                                    </div>
                                </div>

                                <!-- Description (truncated) -->
                                @if($restaurant->description)
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                        {{ Str::limit($restaurant->description, 100) }}
                                    </p>
                                @endif

                                <div class="flex space-x-2">
                                    <a href="{{ route('restaurants.show', $restaurant) }}"
                                       class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center font-medium py-2 px-4 rounded-lg transition duration-300">
                                        View Details
                                    </a>
                                    @auth
                                        <a href="{{ route('restaurants.reserve', $restaurant) }}?date={{ request('date', now()->format('Y-m-d')) }}&time={{ request('time', '19:00') }}&guests={{ request('guests', 2) }}"
                                           class="flex-1 bg-green-600 hover:bg-green-700 text-white text-center font-medium py-2 px-4 rounded-lg transition duration-300">
                                            Reserve
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $restaurants->links() }}
                </div>
            @else
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                No restaurants found matching your criteria.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
