@extends('layouts.app')

@section('title', 'Booking')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">

    <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-2xl p-6 w-full max-w-4xl text-gray-800">


        <div class="flex justify-center gap-6 mb-6">
            <button class="text-blue-600 font-semibold border-b-2 border-blue-600 pb-1">
                Hotels
            </button>
            <button class="text-gray-600 hover:text-blue-600">
                Restaurants
            </button>
            <button class="text-gray-600 hover:text-blue-600">
                Tours
            </button>
        </div>

        <!-- Booking Form -->
        <form class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <div>
                <label class="text-sm text-gray-600">Destination</label>
                <input type="text" placeholder="Kathmandu"
                       class="w-full mt-1 px-4 py-2 rounded-lg border focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="text-sm text-gray-600">Check In</label>
                <input type="date"
                       class="w-full mt-1 px-4 py-2 rounded-lg border focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="text-sm text-gray-600">Guests</label>
                <select class="w-full mt-1 px-4 py-2 rounded-lg border focus:ring-2 focus:ring-blue-500 outline-none">
                    <option>1 Guest</option>
                    <option>2 Guests</option>
                    <option>3 Guests</option>
                </select>
            </div>

            <div class="flex items-end">
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
                    Search
                </button>
            </div>

        </form>
    </div>

</div>

@endsection
