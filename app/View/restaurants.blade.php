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
            Discover Best Restaurants
        </h1>
    </div>
</section>

<!-- RESTAURANT LIST -->
<section class="max-w-7xl mx-auto px-6 py-16">
    <h2 class="text-3xl font-bold text-center mb-10">Popular Restaurants</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        <!-- Restaurant Card -->
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
            <img src="{{ asset('images/res1.jpg') }}"
                 class="w-full h-48 object-cover rounded-t-xl"
                 alt="Restaurant">

            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">Himalayan Grill</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Authentic Nepali & Tibetan Cuisine
                </p>

                <div class="flex items-center justify-between">
                    <span class="text-green-600 font-semibold">Open Now</span>
                    <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Book Table
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
            <img src="{{ asset('images/res2.jpg') }}"
                 class="w-full h-48 object-cover rounded-t-xl"
                 alt="Restaurant">

            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">Kathmandu Café</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Coffee, Bakery & Continental Food
                </p>

                <div class="flex items-center justify-between">
                    <span class="text-green-600 font-semibold">Open Now</span>
                    <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Book Table
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
            <img src="{{ asset('images/res3.jpg') }}"
                 class="w-full h-48 object-cover rounded-t-xl"
                 alt="Restaurant">

            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">Everest Dining</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Fine Dining & Mountain View
                </p>

                <div class="flex items-center justify-between">
                    <span class="text-red-600 font-semibold">Closed</span>
                    <a href="#" class="bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed">
                        Unavailable
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection

