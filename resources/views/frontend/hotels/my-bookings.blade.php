@extends('frontend.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">My Hotel Bookings</h1>
        <p class="text-gray-600">View and manage your hotel room bookings</p>
    </div>

    <!-- Stats Summary -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Total Bookings</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $bookings->total() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Confirmed</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $bookings->where('status', 'confirmed')->count() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Pending</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $bookings->where('status', 'pending')->count() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">To Pay</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $bookings->whereIn('status', ['pending', 'confirmed'])->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <!-- Table Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900">Booking History</h2>
                @if($bookings->count() > 0)
                    <div class="text-sm text-gray-600">
                        Showing {{ $bookings->firstItem() }}-{{ $bookings->lastItem() }} of {{ $bookings->total() }} bookings
                    </div>
                @endif
            </div>
        </div>

        @if($bookings->count() > 0)
            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Booking Details
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Hotel & Room
                            </th>
                            <th scope="col" class="px 6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Dates
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($bookings as $booking)
                            @php
                                $statusColors = [
                                    'confirmed' => 'bg-green-100 text-green-800',
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'checked_in' => 'bg-blue-100 text-blue-800',
                                    'checked_out' => 'bg-gray-100 text-gray-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                ];
                                $statusClass = $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp

                            <tr class="hover:bg-gray-50 transition">
                                <!-- Booking Details -->
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="font-medium text-gray-900">#{{ $booking->id }}</div>
                                        <div class="text-sm text-gray-500">
                                            {{ $booking->created_at->format('M d, Y') }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $booking->guest_name }}
                                        </div>
                                    </div>
                                </td>

                                <!-- Hotel & Room -->
                                <td class="px-6 py-4">
                                    @if(isset($booking->hotel))
                                        <div class="font-medium text-gray-900">{{ $booking->hotel->name }}</div>
                                        <div class="text-sm text-gray-500">
                                            {{ $booking->room->room_name ?? 'Room not specified' }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $booking->hotel->city ?? '' }}
                                        </div>
                                    @else
                                        <div class="text-gray-500 italic">Hotel not found</div>
                                    @endif
                                </td>

                                <!-- Dates -->
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">
                                        {{ $booking->check_in->format('M d') }} - {{ $booking->check_out->format('M d, Y') }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $booking->check_in->diffInDays($booking->check_out) }} nights
                                    </div>
                                </td>

                                <!-- Amount -->
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">
                                        NPR {{ number_format($booking->total_amount, 2) }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        NPR {{ number_format($booking->price_per_night, 2) }}/night
                                    </div>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                    @if($booking->status === 'pending')
                                        <div class="text-xs text-gray-500 mt-1">
                                            Awaiting confirmation
                                        </div>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex flex-col space-y-2">
                                        <a href="{{ route('hotels.booking.confirmation', $booking) }}"
                                           class="text-blue-600 hover:text-blue-900 transition">
                                            View Details
                                        </a>
                                        @if(in_array($booking->status, ['pending', 'confirmed']))
                                            <form method="POST" action="{{ route('hotels.cancel-booking', $booking) }}"
                                                  class="inline" onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="text-red-600 hover:text-red-900 transition">
                                                    Cancel Booking
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($bookings->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $bookings->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No hotel bookings yet</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by booking your first hotel stay.</p>
                <div class="mt-6">
                    <a href="{{ route('hotels.index') }}"
                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Browse Hotels
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Help Section -->
    <div class="mt-8 bg-gray-50 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Need Help With Your Bookings?</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h4 class="font-medium text-gray-900 mb-2">Frequently Asked Questions</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li>• How do I modify my booking?</li>
                    <li>• What is the cancellation policy?</li>
                    <li>• How do I check in at the hotel?</li>
                    <li>• What payment methods are accepted?</li>
                </ul>
            </div>
            <div>
                <h4 class="font-medium text-gray-900 mb-2">Contact Support</h4>
                <p class="text-sm text-gray-600 mb-3">For assistance with your bookings, contact our support team:</p>
                <div class="flex items-center text-sm text-gray-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    +977-1-4412345
                </div>
                <div class="flex items-center text-sm text-gray-700 mt-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    support@toursandtravels.com
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
