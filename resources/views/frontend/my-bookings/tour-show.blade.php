{{-- resources/views/frontend/my-bookings/tour-show.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Tour Booking Details')

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
            <h2 class="text-2xl font-bold text-gray-900">Tour Booking Details</h2>
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
                            <span class="text-sm text-gray-500">Booking Number:</span>
                            <p class="font-medium">{{ $booking->booking_number ?? 'N/A' }}</p>
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
                                    'cancelled' => 'bg-red-100 text-red-800'
                                ];
                                $color = $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $color }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Payment Status:</span>
                            @php
                                $paymentColors = [
                                    'paid' => 'bg-green-100 text-green-800',
                                    'pending' => 'bg-yellow-100 text-yellow-800'
                                ];
                                $paymentColor = $paymentColors[$booking->payment_status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $paymentColor }}">
                                {{ ucfirst($booking->payment_status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Tour Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tour Information</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-500">Tour Name:</span>
                            <p class="font-medium">{{ $booking->tour->title ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Tour Date:</span>
                            <p class="font-medium">{{ $booking->tourDate->date ? \Carbon\Carbon::parse($booking->tourDate->date)->format('M d, Y') : 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Start Time:</span>
                            <p class="font-medium">{{ $booking->tourDate->start_time ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Number of People:</span>
                            <p class="font-medium">{{ $booking->number_of_people }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Price per Person:</span>
                            <p class="font-medium">Rs. {{ number_format($booking->price_per_person, 2) }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Total Amount:</span>
                            <p class="font-medium text-lg text-green-600">Rs. {{ number_format($booking->total_amount, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-8">

            <!-- Personal & Agent Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Personal Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-500">Name:</span>
                            <p class="font-medium">{{ $booking->user->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Email:</span>
                            <p class="font-medium">{{ $booking->user->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Phone:</span>
                            <p class="font-medium">{{ $booking->user->phone ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

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
            </div>

            @if($booking->special_requests)
            <hr class="my-8">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Special Requests</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700">{{ $booking->special_requests }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
