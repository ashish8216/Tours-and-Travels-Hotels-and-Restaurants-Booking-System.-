@extends('frontend.layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 text-white overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                alt="Nepal Landscape" class="w-full h-full object-cover opacity-20">
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Your Complete Travel Solution</h1>
                <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">
                    Tours • Hotels • Restaurants - One platform for all your travel needs in Nepal
                </p>
            </div>
        </div>

        <!-- Wave Divider -->
        <div class="absolute bottom-0 w-full">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-16 text-white fill-current">
                <path d="M1200 120L0 16.48 0 0 1200 0 1200 120z"></path>
            </svg>
        </div>
    </div>

    <!-- Our Services -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Comprehensive Services</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">
                    From adventure tours to comfortable stays and culinary experiences, we've got you covered
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <!-- Tours Service -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                            alt="Adventure Tours" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Adventure Tours</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Experience the thrill of Nepal with our curated adventure tours. From Himalayan treks to cultural expeditions.
                        </p>
                        <ul class="space-y-2 text-gray-600 text-sm">
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Trekking & Hiking
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Cultural Tours
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Adventure Sports
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Hotels Service -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                            alt="Hotel Booking" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Hotel Bookings</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Find your perfect stay. From luxury resorts to budget-friendly accommodations across Nepal.
                        </p>
                        <ul class="space-y-2 text-gray-600 text-sm">
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Best Price Guarantee
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Instant Confirmation
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Flexible Cancellation
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Restaurants Service -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                            alt="Restaurant Reservations" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Restaurant Reservations</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Discover Nepal's culinary scene. Book tables at the best restaurants, cafes, and local eateries.
                        </p>
                        <ul class="space-y-2 text-gray-600 text-sm">
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Top-rated Restaurants
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Instant Table Booking
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Local & International Cuisine
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- How It Works -->
            <div class="bg-gradient-to-r from-blue-50 to-gray-50 rounded-3xl p-8 md:p-12">
                <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">How Our Platform Works</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                            1
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">Browse</h4>
                        <p class="text-gray-600 text-sm">Explore tours, hotels, and restaurants</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                            2
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">Select</h4>
                        <p class="text-gray-600 text-sm">Choose your preferred options and dates</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                            3
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">Book</h4>
                        <p class="text-gray-600 text-sm">Secure booking with instant confirmation</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                            4
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">Enjoy</h4>
                        <p class="text-gray-600 text-sm">Experience seamless travel services</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Vision for Nepal Tourism</h2>
                    <div class="space-y-4 text-gray-600">
                        <p>
                            Founded in 2023, <span class="font-semibold text-blue-600">Tours & Travels Nepal</span> was born from
                            a simple idea: to create a unified platform where travelers could plan their entire Nepal experience.
                        </p>
                        <p>
                            We recognized that planning a trip often meant visiting multiple websites for tours,
                            hotels, and dining. Our mission was to simplify this process while promoting sustainable
                            tourism and supporting local businesses.
                        </p>
                        <p>
                            Today, we partner with over 200 verified tour operators, 150+ hotels, and 100+ restaurants
                            across Nepal, ensuring quality and authenticity in every experience we offer.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-4">
                        <div class="bg-white p-6 rounded-2xl shadow-md">
                            <div class="text-3xl font-bold text-blue-600 mb-2">200+</div>
                            <div class="text-gray-600">Partner Tour Operators</div>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-md">
                            <div class="text-3xl font-bold text-green-600 mb-2">150+</div>
                            <div class="text-gray-600">Verified Hotels</div>
                        </div>
                    </div>
                    <div class="space-y-4 pt-8">
                        <div class="bg-white p-6 rounded-2xl shadow-md">
                            <div class="text-3xl font-bold text-yellow-600 mb-2">100+</div>
                            <div class="text-gray-600">Restaurant Partners</div>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-md">
                            <div class="text-3xl font-bold text-purple-600 mb-2">24/7</div>
                            <div class="text-gray-600">Customer Support</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Travelers Choose Us</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">
                    The benefits of using our integrated platform
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-gray-50 p-6 rounded-2xl text-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Verified Partners</h3>
                    <p class="text-gray-600 text-sm">All services vetted for quality and reliability</p>
                </div>

                <div class="bg-gray-50 p-6 rounded-2xl text-center">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Secure Booking</h3>
                    <p class="text-gray-600 text-sm">SSL encryption and secure payment processing</p>
                </div>

                <div class="bg-gray-50 p-6 rounded-2xl text-center">
                    <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">24/7 Support</h3>
                    <p class="text-gray-600 text-sm">Round-the-clock customer assistance</p>
                </div>

                <div class="bg-gray-50 p-6 rounded-2xl text-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Best Price</h3>
                    <p class="text-gray-600 text-sm">Price match guarantee on all bookings</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-blue-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-4">Start Your Nepal Adventure</h2>
                    <p class="text-blue-100 mb-8">
                        Whether you're seeking Himalayan adventures, comfortable stays, or culinary delights,
                        we provide everything you need for a memorable Nepal experience.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('tours.index') }}"
                           class="bg-white text-blue-600 hover:bg-blue-50 font-bold px-6 py-3 rounded-xl text-center transition">
                            Explore Tours
                        </a>
                        <a href="#"
                           class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-600 font-bold px-6 py-3 rounded-xl text-center transition">
                            Find Hotels
                        </a>
                        <a href="#"
                           class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-600 font-bold px-6 py-3 rounded-xl text-center transition">
                            Book Restaurants
                        </a>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                    <h3 class="text-xl font-bold text-white mb-4">Project Features</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center text-blue-100">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Complete Tour Booking System
                        </li>
                        <li class="flex items-center text-blue-100">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Hotel/Room Reservation
                        </li>
                        <li class="flex items-center text-blue-100">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Restaurant Table Booking
                        </li>
                        <li class="flex items-center text-blue-100">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            User Authentication & Dashboard
                        </li>
                        <li class="flex items-center text-blue-100">
                            <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Admin Management Panel
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
