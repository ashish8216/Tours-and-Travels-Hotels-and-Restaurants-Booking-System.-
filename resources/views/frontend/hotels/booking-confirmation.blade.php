@extends('frontend.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Success Message -->
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <!-- Success Icon -->
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Booking Submitted!</h1>
                <p class="text-gray-600">Your hotel booking request has been received successfully.</p>
                <p class="text-gray-600">Booking Reference: <span class="font-bold">#{{ $booking->id }}</span></p>
            </div>

            <!-- Booking Details -->
            <div class="border-t border-b border-gray-200 py-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Booking Details</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Hotel Information -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Hotel Information</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Hotel:</span>
                                <span class="font-medium">{{ $hotel->name ?? 'Not specified' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Room:</span>
                                <span class="font-medium">{{ $booking->room->room_name ?? 'Not specified' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Location:</span>
                                <span class="font-medium">{{ $hotel->city ?? '' }}, {{ $hotel->country ?? '' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Check-in:</span>
                                <span class="font-medium">{{ $booking->check_in->format('F d, Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Check-out:</span>
                                <span class="font-medium">{{ $booking->check_out->format('F d, Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Nights:</span>
                                <span class="font-medium">{{ $booking->check_in->diffInDays($booking->check_out) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Summary -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Booking Summary</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Booking ID:</span>
                                <span class="font-medium">#{{ $booking->id }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Booking Date:</span>
                                <span class="font-medium">{{ $booking->created_at->format('F d, Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Guest Name:</span>
                                <span class="font-medium">{{ $booking->guest_name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Guest Phone:</span>
                                <span class="font-medium">{{ $booking->guest_phone }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Price per Night:</span>
                                <span class="font-medium">NPR {{ number_format($booking->price_per_night, 2) }}</span>
                            </div>
                            <div class="flex justify-between border-t border-gray-200 pt-3">
                                <span class="text-lg font-bold text-gray-900">Total Amount:</span>
                                <span class="text-xl font-bold text-blue-600">NPR {{ number_format($booking->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Status -->
            <div class="py-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Booking Status</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Status Information -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Current Status</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Status:</span>
                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                    @if($booking->status == 'confirmed') bg-green-100 text-green-800
                                    @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($booking->status == 'checked_in') bg-blue-100 text-blue-800
                                    @elseif($booking->status == 'cancelled') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                            @if($booking->status_updated_at)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Last Updated:</span>
                                <span class="font-medium">{{ $booking->status_updated_at->format('F d, Y h:i A') }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- What's Next -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">What's Next?</h3>
                        <ol class="list-decimal pl-5 space-y-2 text-gray-700">
                            <li>You will receive a confirmation email shortly</li>
                            <li>The hotel will review your booking within 24 hours</li>
                            <li>Payment will be collected during check-in at the hotel</li>
                            <li>Arrive at the hotel during check-in hours</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            @if($hotel)
                <div class="bg-blue-50 rounded-xl p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Hotel Contact Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if($hotel->phone)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <div>
                                    <div class="text-sm text-gray-600">Phone</div>
                                    <a href="tel:{{ $hotel->phone }}" class="font-medium text-gray-900">{{ $hotel->phone }}</a>
                                </div>
                            </div>
                        @endif
                        @if($hotel->email)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <div class="text-sm text-gray-600">Email</div>
                                    <a href="mailto:{{ $hotel->email }}" class="font-medium text-gray-900">{{ $hotel->email }}</a>
                                </div>
                            </div>
                        @endif
                        @if($hotel->address)
                            <div class="flex items-start md:col-span-2">
                                <svg class="w-5 h-5 text-blue-600 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <div class="text-sm text-gray-600">Address</div>
                                    <div class="font-medium text-gray-900">{{ $hotel->full_address }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Important Notes -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 mb-8">
                <h3 class="text-lg font-semibold text-yellow-900 mb-4">Important Notes</h3>
                <ul class="list-disc pl-5 space-y-2 text-yellow-800">
                    <li>Please keep your booking reference number for future communication</li>
                    <li>Cancellations must be made at least 24 hours before check-in time</li>
                    <li>Bring a valid government-issued ID during check-in</li>
                    <li>Check-in time: {{ $hotel->check_in_time->format('h:i A') ?? '2:00 PM' }}</li>
                    <li>Check-out time: {{ $hotel->check_out_time->format('h:i A') ?? '12:00 PM' }}</li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('hotels.show', $hotel ?? '#') }}"
                   class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition text-center">
                    View Hotel Details
                </a>
                <a href="{{ route('hotels.my-bookings') }}"
                   class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-6 py-3 rounded-lg transition text-center">
                    View My Bookings
                </a>
                <a href="{{ route('hotels.index') }}"
                   class="flex-1 border border-blue-600 text-blue-600 hover:bg-blue-50 font-semibold px-6 py-3 rounded-lg transition text-center">
                    Browse More Hotels
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
