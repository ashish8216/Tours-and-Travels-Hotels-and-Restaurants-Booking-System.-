@extends('frontend.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
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
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Booking Confirmed!</h1>
                <p class="text-gray-600">Your booking has been successfully submitted.</p>
                <p class="text-gray-600">Booking Reference: <span class="font-bold">{{ $booking->booking_number }}</span></p>
            </div>

            <!-- Booking Details -->
            <div class="border-t border-b border-gray-200 py-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Booking Details</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Tour Information</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tour:</span>
                                <span class="font-medium">{{ $booking->tour->title }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Location:</span>
                                <span class="font-medium">{{ $booking->tour->location }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Date:</span>
                                <span class="font-medium">{{ $booking->tourDate->date->format('F d, Y') }}</span>
                            </div>
                            @if($booking->tourDate->start_time)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Time:</span>
                                <span class="font-medium">{{ $booking->tourDate->start_time }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Booking Summary</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Booking Number:</span>
                                <span class="font-medium">{{ $booking->booking_number }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Number of People:</span>
                                <span class="font-medium">{{ $booking->number_of_people }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Price per Person:</span>
                                <span class="font-medium">NPR {{ number_format($booking->price_per_person, 2) }}</span>
                            </div>
                            <div class="flex justify-between border-t border-gray-200 pt-3">
                                <span class="text-lg font-bold text-gray-900">Total Amount:</span>
                                <span class="text-xl font-bold text-blue-600">NPR {{ number_format($booking->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="py-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Customer Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Personal Details</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Name:</span>
                                <span class="font-medium">{{ $booking->user->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Email:</span>
                                <span class="font-medium">{{ $booking->user->email }}</span>
                            </div>
                            @if($booking->user->phone)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Phone:</span>
                                <span class="font-medium">{{ $booking->user->phone }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Booking Status</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Status:</span>
                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                    @if($booking->status == 'confirmed') bg-green-100 text-green-800
                                    @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($booking->status == 'cancelled') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Payment Status:</span>
                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                    @if($booking->payment_status == 'paid') bg-green-100 text-green-800
                                    @elseif($booking->payment_status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($booking->payment_status == 'failed') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($booking->payment_status) }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Booking Date:</span>
                                <span class="font-medium">{{ $booking->created_at->format('F d, Y h:i A') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="bg-blue-50 rounded-xl p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">What's Next?</h3>
                <ol class="list-decimal pl-5 space-y-3 text-gray-700">
                    <li>You will receive a confirmation email shortly</li>
                    <li>The tour operator will review your booking and contact you within 24 hours</li>
                    <li>Make payment as instructed by the tour operator</li>
                    <li>Arrive at the meeting point 15 minutes before the scheduled time</li>
                </ol>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('tours.show', $booking->tour_id) }}"
                   class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition text-center">
                    View Tour Details
                </a>
                <a href="{{ route('dashboard') }}"
                   class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-6 py-3 rounded-lg transition text-center">
                    Go to Dashboard
                </a>
                <a href="{{ route('tours.index') }}"
                   class="flex-1 border border-blue-600 text-blue-600 hover:bg-blue-50 font-semibold px-6 py-3 rounded-lg transition text-center">
                    Browse More Tours
                </a>
            </div>
        </div>

        <!-- Important Notes -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-yellow-900 mb-4">Important Notes</h3>
            <ul class="list-disc pl-5 space-y-2 text-yellow-800">
                <li>Please keep your booking number safe for future reference</li>
                <li>Cancellations must be made at least 24 hours in advance</li>
                <li>Bring a valid ID on the day of the tour</li>
                <li>Contact the tour operator directly for any changes or questions</li>
                <li>Review the tour's terms and conditions for refund policies</li>
            </ul>
        </div>
    </div>
</div>
@endsection
