{{-- resources/views/frontend/home.blade.php --}}
@extends('frontend.layouts.app')

@section('content')
<!-- Hero Section with Background Image -->
<section class="relative py-20 px-4 sm:px-6 lg:px-8 overflow-hidden min-h-[600px] flex items-center">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/hero-bg.jpeg') }}"
             alt="Travel Background"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-black/30"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto w-full">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Hero Content -->
            <div class="text-white">
                <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full mb-6 border border-white/20">
                    <span class="w-2 h-2 bg-blue-400 rounded-full animate-pulse mr-2"></span>
                    <span class="text-sm font-medium text-white">Your Travel Journey Starts Here</span>
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    Explore Amazing
                    <span class="text-yellow-400">Places</span>
                </h1>

                <p class="text-lg md:text-xl text-gray-200 mb-8 max-w-2xl leading-relaxed">
                    Discover and book the best tours, hotels, and restaurants around the world with ease. Your next adventure is just a click away.
                </p>

                <!-- Quick Links -->
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('tours.index') }}"
                       class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Explore Tours
                    </a>

                    <a href="{{ route('hotels.index') }}"
                       class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Find Hotels
                    </a>

                    <a href="{{ route('restaurants.index') }}"
                       class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Reserve Restaurants
                    </a>
                </div>

                <!-- Trust Badges -->
                <div class="flex items-center gap-6 mt-10">
                    <div class="flex items-center bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full border border-white/20">
                        <svg class="w-5 h-5 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span class="text-white text-sm font-medium">4.8/5 Rating</span>
                    </div>

                    <div class="flex items-center bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full border border-white/20">
                        <svg class="w-5 h-5 text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-white text-sm font-medium">10k+ Bookings</span>
                    </div>
                </div>
            </div>

            <!-- Hero Image Card -->
            <div class="relative">
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl p-6 border border-white/20 transform hover:scale-105 transition-all duration-500">
                    <div class="rounded-xl aspect-video overflow-hidden relative group">
                        <!-- Travel Destination Image -->
                        <img src="{{ asset('images/travel-destination.jpeg') }}"
                             alt="Beautiful travel destination"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                        <!-- Overlay Content -->
                        <div class="absolute bottom-4 left-4 text-white">
                            <span class="bg-blue-600/90 backdrop-blur-sm px-4 py-1.5 rounded-full text-xs font-semibold inline-flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                Bali, Indonesia
                            </span>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span class="bg-yellow-400/90 backdrop-blur-sm text-gray-900 px-3 py-1.5 rounded-full text-xs font-semibold inline-flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                4.9 ★
                            </span>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-4 mt-6">
                        <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg p-3 hover:bg-white/20 transition">
                            <div class="text-2xl font-bold text-white">{{ $tours_count ?? '50+' }}</div>
                            <div class="text-xs text-gray-200 mt-1">Tours</div>
                        </div>
                        <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg p-3 hover:bg-white/20 transition">
                            <div class="text-2xl font-bold text-white">{{ $hotels_count ?? '100+' }}</div>
                            <div class="text-xs text-gray-200 mt-1">Hotels</div>
                        </div>
                        <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg p-3 hover:bg-white/20 transition">
                            <div class="text-2xl font-bold text-white">{{ $restaurants_count ?? '80+' }}</div>
                            <div class="text-xs text-gray-200 mt-1">Restaurants</div>
                        </div>
                    </div>
                </div>

                <!-- Decorative Elements -->
                <div class="absolute -top-4 -right-4 w-24 h-24 bg-yellow-400/20 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-blue-400/20 rounded-full blur-2xl"></div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section - Clean White -->
<section class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-2 bg-blue-50 rounded-full text-sm font-semibold text-blue-600 mb-4">
                Why Choose Us
            </span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Experience the Difference</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">We make your travel experience seamless and memorable with our premium services</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white rounded-2xl p-8 text-center border border-gray-100 hover:border-blue-200 hover:shadow-lg transition-all duration-300 group">
                <div class="w-16 h-16 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Easy Booking</h3>
                <p class="text-gray-600 leading-relaxed">Simple and fast booking process for tours, hotels, and restaurants in just a few clicks.</p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white rounded-2xl p-8 text-center border border-gray-100 hover:border-green-200 hover:shadow-lg transition-all duration-300 group">
                <div class="w-16 h-16 bg-green-50 rounded-xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Best Prices</h3>
                <p class="text-gray-600 leading-relaxed">Get the best deals and exclusive offers on all bookings with our price match guarantee.</p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white rounded-2xl p-8 text-center border border-gray-100 hover:border-purple-200 hover:shadow-lg transition-all duration-300 group">
                <div class="w-16 h-16 bg-purple-50 rounded-xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">24/7 Support</h3>
                <p class="text-gray-600 leading-relaxed">Our dedicated support team is always ready to help you anytime, anywhere.</p>
            </div>
        </div>
    </div>
</section>

<!-- Popular Tours Section - Light Gray -->
<section class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-center mb-12">
            <div>
                <span class="inline-block px-4 py-2 bg-blue-50 rounded-full text-sm font-semibold text-blue-600 mb-4">
                    Popular Choices
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Popular Tours</h2>
                <p class="text-lg text-gray-600">Most booked tours this month</p>
            </div>
            <a href="{{ route('tours.index') }}" class="mt-4 md:mt-0 inline-flex items-center px-6 py-3 bg-white hover:bg-gray-100 text-gray-700 font-semibold rounded-lg border border-gray-200 transition-all duration-300 group">
                View All Tours
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($popularTours ?? [] as $tour)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 group border border-gray-100">
                    <div class="h-48 bg-gray-100 relative overflow-hidden rounded-t-xl">
                        @if($tour->image)
                            <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-blue-50">
                                <svg class="w-16 h-16 text-blue-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3 bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                            {{ $tour->duration_days ?? $tour->duration_hours ?? '1 day' }}
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-gray-900 mb-2 truncate">{{ $tour->title }}</h3>
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="truncate">{{ $tour->location ?? 'Various Locations' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-sm text-gray-500">from</span>
                                <span class="text-xl font-bold text-blue-600 ml-1">Rs. {{ number_format($tour->price, 2) }}</span>
                            </div>
                            <a href="{{ route('tours.show', $tour->id) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-sm">
                                Book Now
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                @for($i = 0; $i < 4; $i++)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden animate-pulse border border-gray-100">
                        <div class="h-48 bg-gray-200"></div>
                        <div class="p-5">
                            <div class="h-5 bg-gray-200 rounded w-3/4 mb-3"></div>
                            <div class="h-4 bg-gray-200 rounded w-1/2 mb-3"></div>
                            <div class="flex justify-between">
                                <div class="h-6 bg-gray-200 rounded w-1/3"></div>
                                <div class="h-6 bg-gray-200 rounded w-1/4"></div>
                            </div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
    </div>
</section>

<!-- Featured Hotels Section - White -->
<section class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-center mb-12">
            <div>
                <span class="inline-block px-4 py-2 bg-green-50 rounded-full text-sm font-semibold text-green-600 mb-4">
                    Top Rated
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Featured Hotels</h2>
                <p class="text-lg text-gray-600">Top-rated hotels for your stay</p>
            </div>
            <a href="{{ route('hotels.index') }}" class="mt-4 md:mt-0 inline-flex items-center px-6 py-3 bg-white hover:bg-gray-100 text-gray-700 font-semibold rounded-lg border border-gray-200 transition-all duration-300 group">
                View All Hotels
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($featuredHotels ?? [] as $hotel)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 group border border-gray-100">
                    <div class="h-48 bg-gray-100 relative overflow-hidden rounded-t-xl">
                        @if($hotel->image)
                            <img src="{{ asset('storage/' . $hotel->image) }}" alt="{{ $hotel->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-green-100 to-green-50">
                                <svg class="w-16 h-16 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm0 2h12v10H4V5zm2 2v2h2V7H6zm4 0v2h2V7h-2zm4 0v2h2V7h-2zm-8 4v2h2v-2H6zm4 0v2h2v-2h-2zm4 0v2h2v-2h-2z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3 bg-green-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                            {{ $hotel->rooms_count ?? 0 }} Rooms
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-gray-900 mb-2 truncate">{{ $hotel->name }}</h3>
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="truncate">{{ $hotel->city ?? $hotel->address ?? 'Various Locations' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-sm text-gray-500">from</span>
                                <span class="text-xl font-bold text-green-600 ml-1">Rs. {{ number_format($hotel->min_price ?? 5000, 2) }}</span>
                            </div>
                            <a href="{{ route('hotels.show', $hotel->id) }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-semibold text-sm">
                                View Rooms
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                @for($i = 0; $i < 4; $i++)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden animate-pulse border border-gray-100">
                        <div class="h-48 bg-gray-200"></div>
                        <div class="p-5">
                            <div class="h-5 bg-gray-200 rounded w-3/4 mb-3"></div>
                            <div class="h-4 bg-gray-200 rounded w-1/2 mb-3"></div>
                            <div class="flex justify-between">
                                <div class="h-6 bg-gray-200 rounded w-1/3"></div>
                                <div class="h-6 bg-gray-200 rounded w-1/4"></div>
                            </div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
    </div>
</section>

<!-- Popular Restaurants Section - Light Gray -->
<section class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-center mb-12">
            <div>
                <span class="inline-block px-4 py-2 bg-purple-50 rounded-full text-sm font-semibold text-purple-600 mb-4">
                    Dining Experiences
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Popular Restaurants</h2>
                <p class="text-lg text-gray-600">Highly rated dining experiences</p>
            </div>
            <a href="{{ route('restaurants.index') }}" class="mt-4 md:mt-0 inline-flex items-center px-6 py-3 bg-white hover:bg-gray-100 text-gray-700 font-semibold rounded-lg border border-gray-200 transition-all duration-300 group">
                View All Restaurants
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($popularRestaurants ?? [] as $restaurant)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 group border border-gray-100">
                    <div class="h-48 bg-gray-100 relative overflow-hidden rounded-t-xl">
                        @if($restaurant->image)
                            <img src="{{ asset('storage/' . $restaurant->image) }}" alt="{{ $restaurant->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-purple-100 to-purple-50">
                                <svg class="w-16 h-16 text-purple-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm0 2h12v10H4V5zm2 2v2h2V7H6zm4 0v2h2V7h-2zm4 0v2h2V7h-2zm-8 4v2h2v-2H6zm4 0v2h2v-2h-2zm4 0v2h2v-2h-2z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3 bg-purple-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                            {{ $restaurant->cuisine_type ?? 'Various' }}
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-gray-900 mb-2 truncate">{{ $restaurant->name }}</h3>
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="truncate">{{ $restaurant->location ?? 'Various Locations' }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($restaurant->opening_time)->format('h:i A') }}</span>
                                <span class="mx-1">-</span>
                                <span>{{ \Carbon\Carbon::parse($restaurant->closing_time)->format('h:i A') }}</span>
                            </div>
                            <a href="{{ route('restaurants.show', $restaurant->id) }}" class="inline-flex items-center text-purple-600 hover:text-purple-800 font-semibold text-sm">
                                Reserve
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                @for($i = 0; $i < 4; $i++)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden animate-pulse border border-gray-100">
                        <div class="h-48 bg-gray-200"></div>
                        <div class="p-5">
                            <div class="h-5 bg-gray-200 rounded w-3/4 mb-3"></div>
                            <div class="h-4 bg-gray-200 rounded w-1/2 mb-3"></div>
                            <div class="h-4 bg-gray-200 rounded w-2/3"></div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section - Clean Gradient -->
<section class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-12 md:p-16 text-center text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/10 rounded-full -ml-32 -mb-32"></div>

            <div class="relative z-10">
                <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold text-white mb-6 border border-white/30">
                    Start Your Adventure
                </span>

                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">Ready to Start Your Journey?</h2>
                <p class="text-lg md:text-xl text-blue-100 mb-10 max-w-3xl mx-auto leading-relaxed">
                    Join thousands of travelers who have already discovered amazing experiences with us. Your next adventure awaits!
                </p>

                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('register') }}"
                       class="px-8 py-4 bg-white text-blue-600 hover:bg-gray-100 font-semibold rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        Sign Up Now
                    </a>

                    <a href="{{ route('tours.index') }}"
                       class="px-8 py-4 bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-600 font-semibold rounded-lg transition-all duration-300 transform hover:-translate-y-1">
                        Explore Tours
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
