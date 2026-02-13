{{-- resources/views/frontend/my-bookings/room-show.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Hotel Booking Details')

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
            <h2 class="text-2xl font-bold text-gray-900">Hotel Booking Details</h2>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Booking Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Booking Information</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-500">Booking ID:</span>
                            <p class="font-medium">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Booking Date:</span>
                            <p class="font-medium">{{ $booking->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Status:</span>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'confirmed' => 'bg-green-100 text-green-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                    'checked_in' => 'bg-blue-100 text-blue-800',
                                    'checked_out' => 'bg-gray-100 text-gray-800'
                                ];
                                $color = $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $color }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Booking Source:</span>
                            <p class="font-medium capitalize">{{ $booking->booking_source }}</p>
                        </div>
                    </div>
                </div>

                <!-- Hotel & Room Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Hotel & Room Information</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-500">Hotel:</span>
                            <p class="font-medium">{{ $booking->room->hotel->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Room:</span>
                            <p class="font-medium">{{ $booking->room->room_name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Room Type:</span>
                            <p class="font-medium">{{ $booking->room->room_type ?? 'Standard' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Max Guests:</span>
                            <p class="font-medium">{{ $booking->room->max_guests }}</p>
                        </div>
                        @if($booking->room)
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500">Amenities:</span>
                            <div class="ml-2 flex flex-wrap gap-1">
                                @if($booking->room->ac)
                                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded">AC</span>
                                @endif
                                @if($booking->room->tv)
                                <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded">TV</span>
                                @endif
                                @if($booking->room->breakfast)
                                <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded">Breakfast</span>
                                @endif
                                @if($booking->room->attached_bathroom)
                                <span class="px-2 py-1 text-xs bg-purple-100 text-purple-800 rounded">Bathroom</span>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <hr class="my-8">

            <!-- Stay Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Stay Details</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-500">Check-in:</span>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Check-out:</span>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Nights:</span>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($booking->check_out)->diffInDays(\Carbon\Carbon::parse($booking->check_in)) }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Price per Night:</span>
                            <p class="font-medium">Rs. {{ number_format($booking->price_per_night, 2) }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Total Amount:</span>
                            <p class="font-medium text-lg text-green-600">Rs. {{ number_format($booking->total_amount, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Guest Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Guest Information</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-500">Name:</span>
                            <p class="font-medium">{{ $booking->guest_name }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Phone:</span>
                            <p class="font-medium">{{ $booking->guest_phone }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Email:</span>
                            <p class="font-medium">{{ $booking->user->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-8">

            <!-- Contact Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Agent Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Agent Information</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-500">Agency:</span>
                            <p class="font-medium">{{ $booking->agent->agency_name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Contact:</span>
                            <p class="font-medium">{{ $booking->agent->phone ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Email:</span>
                            <p class="font-medium">{{ $booking->agent->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Hotel Contact -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Hotel Contact</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-500">Address:</span>
                            <p class="font-medium">{{ $booking->room->hotel->address ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Phone:</span>
                            <p class="font-medium">{{ $booking->room->hotel->phone ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Check-in Time:</span>
                            <p class="font-medium">{{ $booking->room->hotel->check_in_time ?? '14:00' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Check-out Time:</span>
                            <p class="font-medium">{{ $booking->room->hotel->check_out_time ?? '12:00' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <hr class="my-8">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Important Information</h3>
                <div class="bg-blue-50 rounded-lg p-4">
                    <ul class="list-disc pl-5 space-y-2 text-sm text-gray-700">
                        <li>Please arrive at the hotel during check-in hours ({{ $booking->room->hotel->check_in_time ?? '14:00' }})</li>
                        <li>Check-out time is {{ $booking->room->hotel->check_out_time ?? '12:00' }}. Late check-out may incur additional charges</li>
                        <li>Please carry a valid ID proof at the time of check-in</li>
                        <li>Contact the hotel directly for any special requests or queries</li>
                        @if($booking->room->hotel && $booking->room->hotel->policies)
                        <li><strong>Hotel Policies:</strong> {{ $booking->room->hotel->policies }}</li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Contact Buttons -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex flex-wrap gap-4">
                    @if($booking->room->hotel && $booking->room->hotel->phone)
                    <a href="tel:{{ $booking->room->hotel->phone }}"
                       class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-md transition duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        Call Hotel
                    </a>
                    @elseif($booking->agent && $booking->agent->phone)
                    <a href="tel:{{ $booking->agent->phone }}"
                       class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-md transition duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        Call Agent
                    </a>
                    @endif

                    @if($booking->room->hotel && $booking->room->hotel->address)
                    <a href="https://maps.google.com/?q={{ urlencode($booking->room->hotel->address) }}"
                       target="_blank"
                       class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-md transition duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        View on Map
                    </a>
                    @endif

                    <a href="{{ route('my-bookings.index') }}"
                       class="inline-flex items-center bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-6 rounded-md transition duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Bookings
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
