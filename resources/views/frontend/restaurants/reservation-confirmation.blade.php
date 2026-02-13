{{-- resources/views/frontend/restaurants/reservation-confirmation.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Reservation Confirmed')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <!-- Success Header -->
        <div class="bg-white rounded-lg border border-gray-200 p-8 text-center mb-6">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Reservation Confirmed!</h1>
            <p class="text-gray-600">Your table has been reserved successfully.</p>
            <p class="text-gray-500 text-sm mt-2">Reservation Number: <span class="font-mono font-semibold">{{ $reservation->reservation_number }}</span></p>
        </div>

        <!-- Reservation Details -->
        <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Reservation Details</h2>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <div class="mb-3">
                        <span class="text-sm text-gray-500">Restaurant</span>
                        <p class="font-semibold text-gray-900">{{ $reservation->restaurant->name }}</p>
                    </div>
                    <div class="mb-3">
                        <span class="text-sm text-gray-500">Location</span>
                        <p class="font-semibold text-gray-900">{{ $reservation->restaurant->location }}</p>
                    </div>
                    <div class="mb-3">
                        <span class="text-sm text-gray-500">Table</span>
                        <p class="font-semibold text-gray-900">
                            {{ $reservation->table->table_name ?? 'Table ' . $reservation->table->table_number }}
                            <span class="text-sm text-gray-600 ml-1">({{ ucfirst($reservation->table->type) }}, {{ $reservation->table->capacity }} seats)</span>
                        </p>
                    </div>
                </div>

                <div>
                    <div class="mb-3">
                        <span class="text-sm text-gray-500">Date</span>
                        <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('l, M d, Y') }}</p>
                    </div>
                    <div class="mb-3">
                        <span class="text-sm text-gray-500">Time</span>
                        <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('h:i A') }}</p>
                    </div>
                    <div class="mb-3">
                        <span class="text-sm text-gray-500">Number of Guests</span>
                        <p class="font-semibold text-gray-900">{{ $reservation->number_of_people }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Guest Information</h2>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <div class="mb-3">
                        <span class="text-sm text-gray-500">Name</span>
                        <p class="font-semibold text-gray-900">{{ $reservation->customer_name }}</p>
                    </div>
                    <div class="mb-3">
                        <span class="text-sm text-gray-500">Email</span>
                        <p class="font-semibold text-gray-900">{{ $reservation->customer_email }}</p>
                    </div>
                </div>

                <div>
                    <div class="mb-3">
                        <span class="text-sm text-gray-500">Phone</span>
                        <p class="font-semibold text-gray-900">{{ $reservation->customer_phone ?? 'Not provided' }}</p>
                    </div>
                    <div class="mb-3">
                        <span class="text-sm text-gray-500">Status</span>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                            {{ $reservation->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($reservation->status) }}
                        </span>
                    </div>
                </div>
            </div>

            @if($reservation->special_requests)
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <span class="text-sm text-gray-500">Special Requests</span>
                    <p class="text-gray-700 mt-1">{{ $reservation->special_requests }}</p>
                </div>
            @endif
        </div>

        <!-- Restaurant Contact -->
        <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Restaurant Contact</h2>

            <div class="grid md:grid-cols-2 gap-6">
                @if($reservation->restaurant->phone)
                    <div class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>{{ $reservation->restaurant->phone }}</span>
                    </div>
                @endif

                @if($reservation->restaurant->email)
                    <div class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $reservation->restaurant->email }}</span>
                    </div>
                @endif

                <div class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>{{ $reservation->restaurant->location }}</span>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-between items-center">
            <a href="{{ route('restaurants.show', $reservation->restaurant) }}"
               class="inline-flex items-center text-blue-600 hover:text-blue-800">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Restaurant
            </a>

            <div class="flex space-x-3">
                <a href="{{ route('my-bookings.index') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300">
                    View My Bookings
                </a>

                @if(in_array($reservation->status, ['pending', 'confirmed']))
                    <form method="POST" action="{{ route('restaurants.cancel-reservation', $reservation) }}"
                          onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                        @csrf
                        <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300">
                            Cancel Reservation
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
