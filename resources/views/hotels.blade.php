@extends('layouts.app')

@section('title', 'Hotels in Nepal')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-center mb-8">Top Hotels in Nepal</h1>

    <p class="text-center text-gray-600 mb-12">
        Explore the best places to stay while traveling across Nepal. Comfort and convenience await!
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Hotel Card 1 -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:scale-105 transition-transform">
            <img src="{{ asset('images/hotel1.jpg') }}" alt="Hotel Annapurna" class="w-full h-48 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-semibold mb-2">Hotel Annapurna</h2>
                <p class="text-gray-600 mb-4">Located in the heart of Kathmandu, this hotel offers stunning mountain views and luxurious rooms.</p>
                <div class="flex justify-between items-center">
                    <span class="font-bold text-lg">₹5,000/night</span>
                    <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Book Now</a>
                </div>
            </div>
        </div>

        <!-- Hotel Card 2 -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:scale-105 transition-transform">
            <img src="{{ asset('images/hotel2.jpg') }}" alt="Hyatt Regency" class="w-full h-48 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-semibold mb-2">Hyatt Regency Kathmandu</h2>
                <p class="text-gray-600 mb-4">A luxurious retreat in Kathmandu offering world-class amenities and beautiful gardens.</p>
                <div class="flex justify-between items-center">
                    <span class="font-bold text-lg">₹7,500/night</span>
                    <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Book Now</a>
                </div>
            </div>
        </div>

        <!-- Hotel Card 3 -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:scale-105 transition-transform">
            <img src="{{ asset('images/hotel3.jpg') }}" alt="Pokhara Grande" class="w-full h-48 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-semibold mb-2">Pokhara Grande</h2>
                <p class="text-gray-600 mb-4">A peaceful lakeside hotel in Pokhara with amazing views of the Himalayas and Fewa Lake.</p>
                <div class="flex justify-between items-center">
                    <span class="font-bold text-lg">₹6,200/night</span>
                    <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Book Now</a>
                </div>
            </div>
        </div>

        <!-- Hotel Card 4 -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:scale-105 transition-transform">
            <img src="{{ asset('images/hotel4.jpg') }}" alt="The Everest View" class="w-full h-48 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-semibold mb-2">The Everest View Hotel</h2>
                <p class="text-gray-600 mb-4">Experience breathtaking views of Mount Everest from the comfort of this iconic hotel.</p>
                <div class="flex justify-between items-center">
                    <span class="font-bold text-lg">₹9,000/night</span>
                    <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Book Now</a>
                </div>
            </div>
        </div>

        <!-- Hotel Card 5 -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:scale-105 transition-transform">
            <img src="{{ asset('images/hotel5.jpg') }}" alt="Lumbini Retreat" class="w-full h-48 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-semibold mb-2">Lumbini Retreat</h2>
                <p class="text-gray-600 mb-4">A serene getaway near the birthplace of Lord Buddha with tranquil gardens and luxury rooms.</p>
                <div class="flex justify-between items-center">
                    <span class="font-bold text-lg">₹4,800/night</span>
                    <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Book Now</a>
                </div>
            </div>
        </div>

        <!-- Hotel Card 6 -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:scale-105 transition-transform">
            <img src="{{ asset('images/hotel6.jpg') }}" alt="Chitwan Jungle Lodge" class="w-full h-48 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-semibold mb-2">Chitwan Jungle Lodge</h2>
                <p class="text-gray-600 mb-4">Stay close to nature in Chitwan National Park with jungle safaris and luxury accommodations.</p>
                <div class="flex justify-between items-center">
                    <span class="font-bold text-lg">₹5,500/night</span>
                    <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Book Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
