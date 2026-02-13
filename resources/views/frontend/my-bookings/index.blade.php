{{-- resources/views/frontend/my-bookings/index.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'My Bookings')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">My Bookings</h1>

    <!-- Tabs for different booking types -->
    <div class="border-b border-gray-200 mb-8">
        <nav class="-mb-px flex space-x-8 overflow-x-auto pb-1">
            <a href="#all" class="tab-link border-b-2 border-blue-600 text-blue-600 py-4 px-1 text-sm font-medium whitespace-nowrap">
                All Bookings
            </a>
            <a href="#tour" class="tab-link border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-1 text-sm font-medium whitespace-nowrap">
                Tour Bookings ({{ $tourBookings->count() }})
            </a>
            <a href="#hotel" class="tab-link border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-1 text-sm font-medium whitespace-nowrap">
                Hotel Bookings ({{ $roomBookings->count() }})
            </a>
            <a href="#restaurant" class="tab-link border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-1 text-sm font-medium whitespace-nowrap">
                Restaurant Reservations ({{ $restaurantReservations->count() ?? 0 }})
            </a>
        </nav>
    </div>

    <!-- All Bookings Tab -->
    <div id="all" class="tab-pane active">
        @if($tourBookings->count() > 0 || $roomBookings->count() > 0 || (isset($restaurantReservations) && $restaurantReservations->count() > 0))
            @php
                $allBookings = collect();

                foreach($tourBookings as $booking) {
                    $allBookings->push((object)[
                        'id' => $booking->id,
                        'type' => 'tour',
                        'title' => $booking->tour->title ?? 'N/A',
                        'booking_date' => $booking->created_at,
                        'status' => $booking->status,
                        'amount' => $booking->total_amount,
                        'start_date' => $booking->tourDate->date ?? null,
                        'end_date' => null,
                        'location' => $booking->tour->location ?? null,
                        'details_link' => route('my-bookings.tour.show', $booking->id)
                    ]);
                }

                foreach($roomBookings as $booking) {
                    $allBookings->push((object)[
                        'id' => $booking->id,
                        'type' => 'hotel',
                        'title' => $booking->room->hotel->name ?? 'N/A',
                        'booking_date' => $booking->created_at,
                        'status' => $booking->status,
                        'amount' => $booking->total_amount,
                        'start_date' => $booking->check_in,
                        'end_date' => $booking->check_out,
                        'location' => $booking->room->hotel->address ?? null,
                        'details_link' => route('my-bookings.room.show', $booking->id)
                    ]);
                }

                if(isset($restaurantReservations)) {
                    foreach($restaurantReservations as $reservation) {
                        $allBookings->push((object)[
                            'id' => $reservation->id,
                            'type' => 'restaurant',
                            'title' => $reservation->restaurant->name ?? 'N/A',
                            'booking_date' => $reservation->created_at,
                            'status' => $reservation->status,
                            'amount' => null,
                            'start_date' => $reservation->reservation_date,
                            'end_date' => null,
                            'time' => $reservation->reservation_time,
                            'location' => $reservation->restaurant->location ?? null,
                            'details_link' => route('my-bookings.restaurant.show', $reservation->id)
                        ]);
                    }
                }

                $allBookings = $allBookings->sortByDesc('booking_date');
            @endphp

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dates / Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($allBookings as $booking)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $typeColors = [
                                            'tour' => 'bg-blue-100 text-blue-800',
                                            'hotel' => 'bg-green-100 text-green-800',
                                            'restaurant' => 'bg-purple-100 text-purple-800'
                                        ];
                                        $typeColor = $typeColors[$booking->type] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $typeColor }}">
                                        {{ ucfirst($booking->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->booking_date->format('M d, Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($booking->type == 'tour')
                                        {{ $booking->start_date ? \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') : 'N/A' }}
                                    @elseif($booking->type == 'hotel')
                                        {{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}
                                    @elseif($booking->type == 'restaurant')
                                        {{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}
                                        @if(isset($booking->time))
                                            at {{ \Carbon\Carbon::parse($booking->time)->format('h:i A') }}
                                        @endif
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    @if($booking->amount)
                                        Rs. {{ number_format($booking->amount, 2) }}
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'confirmed' => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                            'checked_in' => 'bg-blue-100 text-blue-800',
                                            'checked_out' => 'bg-gray-100 text-gray-800',
                                            'seated' => 'bg-indigo-100 text-indigo-800',
                                            'completed' => 'bg-gray-100 text-gray-800'
                                        ];
                                        $color = $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                        {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ $booking->details_link }}" class="text-blue-600 hover:text-blue-900">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            You have no bookings yet.
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Tour Bookings Tab -->
    <div id="tour" class="tab-pane hidden">
        @if($tourBookings->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($tourBookings as $booking)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $booking->tour->title ?? 'N/A' }}</h3>
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

                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $booking->tourDate->date ? \Carbon\Carbon::parse($booking->tourDate->date)->format('M d, Y') : 'N/A' }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $booking->tour->location ?? 'N/A' }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.67 0c-.18-.64-.28-1.31-.28-2s.1-1.36.28-2m-13.67 0c.18.64.28 1.31.28 2s-.1 1.36-.28 2"/>
                                </svg>
                                {{ $booking->number_of_people }} people
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Rs. {{ number_format($booking->total_amount, 2) }}
                            </div>
                        </div>

                        <a href="{{ route('my-bookings.tour.show', $booking->id) }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300">
                            View Details
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            No tour bookings found.
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Hotel Bookings Tab -->
    <div id="hotel" class="tab-pane hidden">
        @if($roomBookings->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($roomBookings as $booking)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $booking->room->hotel->name ?? 'N/A' }}</h3>
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

                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                {{ $booking->room->room_name ?? 'N/A' }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($booking->check_in)->format('M d') }} - {{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Rs. {{ number_format($booking->total_amount, 2) }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $booking->room->hotel->address ?? 'N/A' }}
                            </div>
                        </div>

                        <a href="{{ route('my-bookings.room.show', $booking->id) }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300">
                            View Details
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            No hotel bookings found.
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Restaurant Reservations Tab -->
    <div id="restaurant" class="tab-pane hidden">
        @if(isset($restaurantReservations) && $restaurantReservations->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($restaurantReservations as $reservation)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $reservation->restaurant->name ?? 'N/A' }}</h3>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'confirmed' => 'bg-green-100 text-green-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                    'seated' => 'bg-indigo-100 text-indigo-800',
                                    'completed' => 'bg-gray-100 text-gray-800'
                                ];
                                $color = $statusColors[$reservation->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $color }}">
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </div>

                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $reservation->restaurant->location ?? 'N/A' }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('M d, Y') }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('h:i A') }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.67 0c-.18-.64-.28-1.31-.28-2s.1-1.36.28-2m-13.67 0c.18.64.28 1.31.28 2s-.1 1.36-.28 2"/>
                                </svg>
                                {{ $reservation->number_of_people }} people
                            </div>
                            @if($reservation->table)
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                {{ $reservation->table->table_name ?? 'Table ' . ($reservation->table->table_number ?? 'N/A') }}
                                ({{ $reservation->table->capacity ?? '?' }} seats)
                            </div>
                            @endif
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-5m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $reservation->cuisine_type ?? $reservation->restaurant->cuisine_type ?? 'Various Cuisines' }}
                            </div>
                        </div>

                        <a href="{{ route('my-bookings.restaurant.show', $reservation->id) }}" class="block w-full text-center bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded-md transition duration-300">
                            View Details
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            No restaurant reservations found.
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabs = document.querySelectorAll('.tab-link');
    const panes = document.querySelectorAll('.tab-pane');

    // Function to show a specific tab
    function showTab(tabId) {
        // Hide all panes
        panes.forEach(pane => {
            pane.classList.add('hidden');
            pane.classList.remove('active');
        });

        // Remove active class from all tabs
        tabs.forEach(tab => {
            tab.classList.remove('border-blue-600', 'text-blue-600');
            tab.classList.add('border-transparent', 'text-gray-500');
        });

        // Show selected pane
        const activePane = document.getElementById(tabId);
        if (activePane) {
            activePane.classList.remove('hidden');
            activePane.classList.add('active');
        }

        // Activate selected tab
        const activeTab = document.querySelector(`.tab-link[href="#${tabId}"]`);
        if (activeTab) {
            activeTab.classList.remove('border-transparent', 'text-gray-500');
            activeTab.classList.add('border-blue-600', 'text-blue-600');
        }

        // Update URL hash
        window.location.hash = tabId;
    }

    // Add click event to tabs
    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            const tabId = this.getAttribute('href').substring(1);
            showTab(tabId);
        });
    });

    // Check URL hash on load
    const hash = window.location.hash.substring(1);
    if (hash && ['all', 'tour', 'hotel', 'restaurant'].includes(hash)) {
        showTab(hash);
    } else {
        // Default to first tab
        showTab('all');
    }
});
</script>
@endpush
