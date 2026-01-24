@extends('layouts.app')

@section('title', 'Restaurants')

@section('content')

<!-- HERO SECTION -->
<section class="relative h-[50vh]">
    <img src="{{ asset('images/restaurant-hero.jpg') }}"
         class="absolute inset-0 w-full h-full object-cover"
         alt="Restaurants">

    <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white">
            Best Restaurants
        </h1>
    </div>
</section>

<!-- RESTAURANT LIST -->
<section class="max-w-7xl mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold text-center mb-4">
        Explore Top Restaurants
    </h2>
    <p class="text-center text-gray-600 mb-10">
        Discover the best places to eat with comfort and style
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        <!-- CARD 1 -->
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
            <img src="{{ asset('images/restaurant1.jpg') }}"
                 class="w-full h-48 object-cover rounded-t-xl"
                 alt="Restaurant">

            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">
                    Himalayan Cuisine
                </h3>
                <p class="text-gray-600 text-sm mb-4">
                    Authentic Nepali food with traditional flavors
                </p>

                <div class="flex justify-between items-center">
                    <span class="text-yellow-500 font-medium">⭐ 4.5</span>
                    <a href="#"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Reserve
                    </a>
                </div>
            </div>
        </div>

        <!-- CARD 2 -->
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
            <img src="{{ asset('images/restaurant2.jpg') }}"
                 class="w-full h-48 object-cover rounded-t-xl"
                 alt="Restaurant">

            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">
                    Urban Grill
                </h3>
                <p class="text-gray-600 text-sm mb-4">
                    Modern dining with international cuisine
                </p>

                <div class="flex justify-between items-center">
                    <span class="text-yellow-500 font-medium">⭐ 4.3</span>
                    <a href="#"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Reserve
                    </a>
                </div>
            </div>
        </div>

        <!-- CARD 3 -->
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
            <img src="{{ asset('images/restaurant3.jpg') }}"
                 class="w-full h-48 object-cover rounded-t-xl"
                 alt="Restaurant">

            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">
                    Lakeside Café
                </h3>
                <p class="text-gray-600 text-sm mb-4">
                    Relaxed dining with scenic views
                </p>

                <div class="flex justify-between items-center">
                    <span class="text-yellow-500 font-medium">⭐ 4.7</span>
                    <a href="#"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Reserve
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
