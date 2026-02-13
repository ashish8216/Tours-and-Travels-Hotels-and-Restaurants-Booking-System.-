{{-- resources/views/frontend/restaurants/reservation.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Reserve Table - ' . $restaurant->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <!-- Back Button -->
        <a href="{{ route('restaurants.show', $restaurant) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Restaurant
        </a>

        <!-- Restaurant Info -->
        <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
            <div class="flex items-start">
                @if($restaurant->image)
                    <div class="w-24 h-24 rounded-lg overflow-hidden flex-shrink-0">
                        <img src="{{ asset('storage/' . $restaurant->image) }}" alt="{{ $restaurant->name }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm0 2h12v10H4V5zm2 2v2h2V7H6zm4 0v2h2V7h-2zm4 0v2h2V7h-2zm-8 4v2h2v-2H6zm4 0v2h2v-2h-2zm4 0v2h2v-2h-2z"/>
                        </svg>
                    </div>
                @endif
                <div class="ml-4">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $restaurant->name }}</h1>
                    <div class="flex items-center text-gray-600 mt-1">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-sm">{{ $restaurant->location }}</span>
                    </div>
                    <div class="flex items-center text-gray-600 mt-1">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm">{{ \Carbon\Carbon::parse($restaurant->opening_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($restaurant->closing_time)->format('h:i A') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reservation Form -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Complete Your Reservation</h2>

            <!-- Selected Details -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <h3 class="font-semibold text-blue-800 mb-2">Selected Details</h3>
                <div class="grid md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Date:</span>
                        <span class="font-medium ml-2">{{ \Carbon\Carbon::parse($request->date)->format('M d, Y') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Time:</span>
                        <span class="font-medium ml-2">{{ \Carbon\Carbon::parse($request->time)->format('h:i A') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Guests:</span>
                        <span class="font-medium ml-2">{{ $request->guests }}</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('restaurants.store-reservation', $restaurant) }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="date" value="{{ $request->date }}">
                <input type="hidden" name="time" value="{{ $request->time }}">
                <input type="hidden" name="guests" value="{{ $request->guests }}">

                <!-- Table Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Table</label>
                    <select name="restaurant_table_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Choose a table...</option>
                        @foreach($availableTables as $table)
                            <option value="{{ $table->id }}">
                                {{ $table->table_name ?? 'Table ' . $table->table_number }}
                                - {{ ucfirst($table->type) }}
                                - {{ $table->capacity }} seats
                            </option>
                        @endforeach
                    </select>
                    @error('restaurant_table_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Customer Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Your Name</label>
                    <input type="text" name="customer_name" value="{{ old('customer_name', Auth::user()->name) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('customer_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="customer_email" value="{{ old('customer_email', Auth::user()->email) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('customer_email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input type="tel" name="customer_phone" value="{{ old('customer_phone') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="e.g., 9812345678">
                    @error('customer_phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Special Requests -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Special Requests (Optional)</label>
                    <textarea name="special_requests" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Any dietary requirements, special occasions, or preferences...">{{ old('special_requests') }}</textarea>
                    @error('special_requests')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                    Confirm Reservation
                </button>
            </form>

            <p class="text-xs text-gray-500 mt-4 text-center">
                By making a reservation, you agree to our cancellation policy. You can cancel or modify your reservation up to 2 hours before the scheduled time.
            </p>
        </div>
    </div>
</div>
@endsection
