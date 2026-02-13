{{-- resources/views/frontend/my-bookings/restaurant-show.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Restaurant Reservation Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <a href="{{ route('my-bookings.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-6">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Back to My Bookings
    </a>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-900">Restaurant Reservation Details</h2>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Reservation Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Reservation Information</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-500">Reservation ID:</span>
                            <p class="font-medium">#{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Reservation Number:</span>
                            <p class="font-medium">{{ $reservation->reservation_number ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Booking Date:</span>
                            <p class="font-medium">{{ $reservation->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Status:</span>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'confirmed' => 'bg-green-100 text-green-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                    'seated' => 'bg-blue-100 text-blue-800',
                                    'completed' => 'bg-gray-100 text-gray-800'
                                ];
                                $color = $statusColors[$reservation->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $color }}">
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Restaurant Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Restaurant Information</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-500">Restaurant:</span>
                            <p class="font-medium">{{ $reservation->restaurant->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Cuisine Type:</span>
                            <p class="font-medium">{{ ucfirst($reservation->restaurant->cuisine_type ?? 'N/A') }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Location:</span>
                            <p class="font-medium">{{ $reservation->restaurant->location ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Hours:</span>
                            <p class="font-medium">
                                {{ $reservation->restaurant->opening_time ? \Carbon\Carbon::parse($reservation->restaurant->opening_time)->format('h:i A') : 'N/A' }} -
                                {{ $reservation->restaurant->closing_time ? \Carbon\Carbon::parse($reservation->restaurant->closing_time)->format('h:i A') : 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-8">

            <!-- Reservation Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Reservation Details</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-500">Date:</span>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('l, M d, Y') }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Time:</span>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('h:i A') }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Number of People:</span>
                            <p class="font-medium">{{ $reservation->number_of_people }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Table:</span>
                            <p class="font-medium">
                                {{ $reservation->table->table_name ?? 'Table ' . ($reservation->table->table_number ?? 'N/A') }}
                                <span class="text-sm text-gray-600 ml-1">
                                    ({{ ucfirst($reservation->table->type ?? 'N/A') }}, {{ $reservation->table->capacity ?? '?' }} seats)
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Guest Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Guest Information</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-500">Name:</span>
                            <p class="font-medium">{{ $reservation->customer_name }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Email:</span>
                            <p class="font-medium">{{ $reservation->customer_email }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Phone:</span>
                            <p class="font-medium">{{ $reservation->customer_phone ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Special Requests -->
            @if($reservation->special_requests)
                <hr class="my-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Special Requests</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-700">{{ $reservation->special_requests }}</p>
                    </div>
                </div>
            @endif

            <hr class="my-8">

            <!-- Contact Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Agent Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Agent Information</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-500">Agency:</span>
                            <p class="font-medium">{{ $reservation->agent->agency_name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Contact:</span>
                            <p class="font-medium">{{ $reservation->agent->phone ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Email:</span>
                            <p class="font-medium">{{ $reservation->agent->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Restaurant Contact -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Restaurant Contact</h3>
                    <div class="space-y-3">
                        @if($reservation->restaurant->phone)
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span>{{ $reservation->restaurant->phone }}</span>
                            </div>
                        @endif

                        @if($reservation->restaurant->email)
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>{{ $reservation->restaurant->email }}</span>
                            </div>
                        @endif

                        <div class="flex items-start text-gray-700">
                            <svg class="w-5 h-5 mr-2 text-gray-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>{{ $reservation->restaurant->location }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex flex-wrap gap-4">
                    @if($reservation->restaurant->phone)
                    <a href="tel:{{ $reservation->restaurant->phone }}"
                       class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-md transition duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        Call Restaurant
                    </a>
                    @endif

                    @if($reservation->restaurant->location)
                    <a href="https://maps.google.com/?q={{ urlencode($reservation->restaurant->location) }}"
                       target="_blank"
                       class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-md transition duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        View on Map
                    </a>
                    @endif

                    @if(in_array($reservation->status, ['pending', 'confirmed']))
                    <form method="POST" action="{{ route('restaurants.cancel-reservation', $reservation) }}"
                          onsubmit="return confirm('Are you sure you want to cancel this reservation?');" class="inline">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-md transition duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Cancel Reservation
                        </button>
                    </form>
                    @endif

                    <a href="{{ route('restaurants.show', $reservation->restaurant) }}"
                       class="inline-flex items-center bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-6 rounded-md transition duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        View Restaurant
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
