@extends('frontend.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Hero Section -->
    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Find Your Perfect Stay</h1>
        <p class="text-gray-600">Discover amazing hotels across Nepal at the best prices</p>
    </div>

    <!-- Search & Filters -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
        <form method="GET" action="{{ route('hotels.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search Input -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search Hotels</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Search by hotel name, city, or address">
                    </div>
                </div>

                <!-- City Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                    <select name="city" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">All Cities</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort Options -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                    <select name="sort" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Newest First</option>
                        <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name: A to Z</option>
                    </select>
                </div>
            </div>

            <!-- Amenities Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Amenities</label>
                <div class="flex flex-wrap gap-2">
                    @php
                        $amenitiesList = [
                            'wifi' => 'WiFi',
                            'parking' => 'Parking',
                            'pool' => 'Swimming Pool',
                            'gym' => 'Gym',
                            'restaurant' => 'Restaurant',
                            'breakfast' => 'Breakfast',
                            'air_conditioning' => 'AC',
                            'room_service' => 'Room Service',
                        ];
                        $selectedAmenities = explode(',', request('amenities', ''));
                    @endphp

                    @foreach($amenitiesList as $key => $label)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="amenities[]" value="{{ $key }}"
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                   {{ in_array($key, $selectedAmenities) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                <div class="text-sm text-gray-600">
                    {{ $hotels->total() }} hotels found
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('hotels.index') }}"
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Clear Filters
                    </a>
                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                        Search Hotels
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Hotels Grid -->
    @if($hotels->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($hotels as $hotel)
                @php
                    // Get minimum room price for this hotel
                    $minPrice = \App\Models\Room::where('hotel_id', $hotel->id)
                                                ->where('availability', 'available')
                                                ->min('price_per_night');
                @endphp

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <!-- Hotel Image -->
                    <div class="h-48 overflow-hidden">
                        @if($hotel->image)
                            <img src="{{ asset('storage/' . $hotel->image) }}"
                                 alt="{{ $hotel->name }}"
                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                 onerror="this.src='https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'">
                        @else
                            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                 alt="{{ $hotel->name }}"
                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        @endif
                        @if($minPrice)
                            <div class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-lg">
                                From NPR {{ number_format($minPrice) }}/night
                            </div>
                        @endif
                    </div>

                    <!-- Hotel Info -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-xl font-bold text-gray-900">{{ $hotel->name }}</h3>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="ml-1 text-sm text-gray-600">4.5</span>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="flex items-center text-gray-600 mb-3">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-sm">{{ $hotel->city }}, {{ $hotel->country }}</span>
                        </div>

                        <!-- Amenities Preview -->
                        <div class="mb-4">
                            <div class="flex flex-wrap gap-2 mb-2">
                                @foreach(array_slice($hotel->amenities_list, 0, 3) as $amenity)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-800">
                                        {{ $amenity }}
                                    </span>
                                @endforeach
                                @if(count($hotel->amenities_list) > 3)
                                    <span class="text-xs text-gray-500">+{{ count($hotel->amenities_list) - 3 }} more</span>
                                @endif
                            </div>
                        </div>

                        <!-- Hotel Details -->
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <div class="text-2xl font-bold text-blue-600">
                                        @if($minPrice)
                                            NPR {{ number_format($minPrice) }}
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                    <div class="text-sm text-gray-500">per night</div>
                                </div>
                                <a href="{{ route('hotels.show', $hotel) }}"
                                   class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mb-8">
            {{ $hotels->links() }}
        </div>
    @else
        <!-- No Results -->
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Hotels Found</h3>
            <p class="text-gray-600 mb-6">Try adjusting your search filters to find more hotels.</p>
            <a href="{{ route('hotels.index') }}"
               class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                Clear All Filters
            </a>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
    }
    .pagination li {
        margin: 0 4px;
    }
    .pagination li a,
    .pagination li span {
        display: inline-block;
        padding: 8px 16px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        color: #374151;
        text-decoration: none;
        transition: all 0.2s;
    }
    .pagination li a:hover {
        background-color: #f3f4f6;
    }
    .pagination li.active span {
        background-color: #3b82f6;
        color: white;
        border-color: #3b82f6;
    }
</style>
@endpush
