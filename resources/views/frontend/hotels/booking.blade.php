@extends('frontend.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Progress Steps -->
    <div class="mb-8">
        <div class="flex justify-center items-center">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">1</div>
                <div class="ml-2 text-sm font-medium text-blue-600">Select Dates</div>
            </div>
            <div class="w-16 h-1 bg-blue-600 mx-2"></div>
            <div class="flex items-center">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">2</div>
                <div class="ml-2 text-sm font-medium text-blue-600">Guest Details</div>
            </div>
            <div class="w-16 h-1 bg-blue-600 mx-2"></div>
            <div class="flex items-center">
                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold">3</div>
                <div class="ml-2 text-sm font-medium text-gray-600">Confirmation</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Booking Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Guest Information</h2>

                <form method="POST" action="{{ route('hotels.store-booking', ['hotel' => $hotel, 'room' => $room]) }}">
                    @csrf
                    <input type="hidden" name="check_in" value="{{ $check_in->format('Y-m-d') }}">
                    <input type="hidden" name="check_out" value="{{ $check_out->format('Y-m-d') }}">
                    <input type="hidden" name="guests" value="{{ request('guests', 1) }}">

                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                <input type="text" name="guest_name" required
                                       value="{{ Auth::check() ? Auth::user()->name : '' }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                                <input type="tel" name="guest_phone" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                            <input type="email" value="{{ Auth::check() ? Auth::user()->email : '' }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50" readonly>
                            <p class="text-sm text-gray-500 mt-1">Email cannot be changed for booking</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Special Requests (Optional)</label>
                            <textarea name="special_requests" rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      placeholder="Any special requirements or requests..."></textarea>
                        </div>

                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Booking Terms</h3>
                            <div class="space-y-3 text-sm text-gray-600">
                                <div class="flex items-start">
                                    <input type="checkbox" id="terms" required
                                           class="mt-1 mr-3 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <label for="terms">
                                        I agree to the hotel's cancellation policy and terms of service.
                                        Cancellations must be made at least 24 hours before check-in time.
                                    </label>
                                </div>
                                <div class="flex items-start">
                                    <input type="checkbox" id="privacy" required
                                           class="mt-1 mr-3 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <label for="privacy">
                                        I have read and agree to the privacy policy regarding my personal information.
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between pt-6 border-t border-gray-200">
                            <a href="{{ route('hotels.show', $hotel) }}"
                               class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                ← Back to Hotel
                            </a>
                            <button type="submit"
                                    class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                                Confirm Booking
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Column: Booking Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Booking Summary</h2>

                <!-- Hotel Info -->
                <div class="mb-6">
                    <h3 class="font-bold text-gray-900 mb-2">{{ $hotel->name }}</h3>
                    <p class="text-sm text-gray-600 mb-4">{{ $hotel->city }}, {{ $hotel->country }}</p>

                    <!-- Room Info -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-4">
                        <h4 class="font-semibold text-gray-900 mb-2">{{ $room->room_name }}</h4>
                        <div class="flex flex-wrap gap-2 mb-3">
                            @if($room->ac)
                                <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded">AC</span>
                            @endif
                            @if($room->tv)
                                <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded">TV</span>
                            @endif
                            @if($room->breakfast)
                                <span class="text-xs px-2 py-1 bg-yellow-100 text-yellow-800 rounded">Breakfast</span>
                            @endif
                            @if($room->attached_bathroom)
                                <span class="text-xs px-2 py-1 bg-purple-100 text-purple-800 rounded">Attached Bath</span>
                            @endif
                        </div>
                        <div class="text-sm text-gray-600">
                            Max {{ $room->max_guests }} guests
                        </div>
                    </div>
                </div>

                <!-- Dates -->
                <div class="border-t border-gray-200 pt-4 mb-4">
                    <div class="flex justify-between items-center mb-3">
                        <div>
                            <div class="text-sm text-gray-600">Check-in</div>
                            <div class="font-semibold text-gray-900">{{ $check_in->format('F d, Y') }}</div>
                            <div class="text-sm text-gray-600">{{ $hotel->check_in_time->format('h:i A') }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">{{ $nights }}</div>
                            <div class="text-sm text-gray-600">nights</div>
                        </div>
                        <div class="text-right">
                            <div class="text-sm text-gray-600">Check-out</div>
                            <div class="font-semibold text-gray-900">{{ $check_out->format('F d, Y') }}</div>
                            <div class="text-sm text-gray-600">{{ $hotel->check_out_time->format('h:i A') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Price Breakdown -->
                <div class="border-t border-gray-200 pt-4">
                    <h3 class="font-semibold text-gray-900 mb-3">Price Details</h3>
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Room price ({{ $nights }} nights)</span>
                            <span>NPR {{ number_format($room->price_per_night * $nights) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Service fee</span>
                            <span>NPR 0</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Taxes</span>
                            <span>Included</span>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-gray-900">Total Amount</span>
                            <span class="text-2xl font-bold text-blue-600">NPR {{ number_format($total_amount) }}</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Pay at hotel during check-in</p>
                    </div>
                </div>

                <!-- Important Notes -->
                <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <h4 class="font-semibold text-yellow-900 mb-2">Important Notes</h4>
                    <ul class="text-sm text-yellow-800 space-y-1">
                        <li>• Booking confirmation subject to availability</li>
                        <li>• Free cancellation until 24 hours before check-in</li>
                        <li>• Bring valid ID during check-in</li>
                        <li>• Early check-in/late check-out subject to availability</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
