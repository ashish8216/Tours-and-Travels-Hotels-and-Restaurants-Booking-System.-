@extends('agent.layout')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $hotel->name }}</h1>
            <div class="flex items-center space-x-4 mt-2 text-gray-600">
                <span class="flex items-center">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    {{ $hotel->address }}
                </span>
                <span class="flex items-center">
                    <i class="fas fa-clock mr-2"></i>
                    Check-in: {{ \Carbon\Carbon::parse($hotel->check_in_time)->format('h:i A') }} •
                    Check-out: {{ \Carbon\Carbon::parse($hotel->check_out_time)->format('h:i A') }}
                </span>
            </div>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('agent.hotels.edit', $hotel) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                Edit Hotel
            </a>
        </div>
    </div>

    <!-- Image -->
    @if($hotel->image)
        <div class="mb-8">
            <img src="{{ asset('storage/' . $hotel->image) }}" alt="{{ $hotel->name }}" class="w-full h-64 object-cover rounded-lg">
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 text-blue-600 rounded-lg mr-4">
                    <i class="fas fa-door-open text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Rooms</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $hotel->rooms_count }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 text-green-600 rounded-lg mr-4">
                    <i class="fas fa-calendar-check text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Bookings</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $hotel->bookings_count }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 bg-amber-100 text-amber-600 rounded-lg mr-4">
                    <i class="fas fa-star text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <p class="text-2xl font-bold text-gray-800 capitalize">{{ $hotel->status }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid md:grid-cols-3 gap-8">
        <!-- Left Column -->
        <div class="md:col-span-2 space-y-6">
            <!-- Description -->
            @if($hotel->description)
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">About Hotel</h2>
                    <p class="text-gray-700">{{ $hotel->description }}</p>
                </div>
            @endif

            <!-- Today's Activity -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Today's Activity</h2>

                <!-- Check-ins -->
                @if($todayCheckins->count() > 0)
                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-medium text-gray-800">Today's Check-ins</h3>
                            <span class="text-sm text-gray-500">{{ $todayCheckins->count() }} guests</span>
                        </div>
                        <div class="space-y-2">
                            @foreach($todayCheckins as $booking)
                                <div class="border border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $booking->guest_name ?? 'N/A' }}</p>
                                            <p class="text-sm text-gray-600">
                                                Room: {{ $booking->room->room_name ?? '—' }} •
                                                Check-in: {{ $booking->check_in_time ? \Carbon\Carbon::parse($booking->check_in_time)->format('h:i A') : '—' }}
                                            </p>
                                        </div>
                                        <span class="px-3 py-1 text-xs font-medium rounded-full
                                            {{ $booking->status === 'checked_in' ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800' }}">
                                            {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Check-outs -->
                @if($todayCheckouts->count() > 0)
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-medium text-gray-800">Today's Check-outs</h3>
                            <span class="text-sm text-gray-500">{{ $todayCheckouts->count() }} guests</span>
                        </div>
                        <div class="space-y-2">
                            @foreach($todayCheckouts as $booking)
                                <div class="border border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $booking->guest_name ?? 'N/A' }}</p>
                                            <p class="text-sm text-gray-600">
                                                Room: {{ $booking->room->room_name ?? '—' }} •
                                                Check-out: {{ $booking->check_out_time ? \Carbon\Carbon::parse($booking->check_out_time)->format('h:i A') : '—' }}
                                            </p>
                                        </div>
                                        <span class="px-3 py-1 text-xs font-medium rounded-full
                                            {{ $booking->status === 'checked_out' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($todayCheckins->count() == 0 && $todayCheckouts->count() == 0)
                    <p class="text-gray-500 text-center py-4">No check-ins or check-outs today.</p>
                @endif
            </div>

            <!-- Policies -->
            @if($hotel->policies)
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Hotel Policies</h2>
                    <div class="text-gray-700 whitespace-pre-line">{{ $hotel->policies }}</div>
                </div>
            @endif
        </div>

        <!-- Right Column -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('agent.rooms.index') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-lg font-semibold transition">
                        <i class="fas fa-door-open mr-2"></i> Manage Rooms
                    </a>
                    <a href="{{ route('agent.room-bookings.create') }}" class="block w-full bg-green-600 hover:bg-green-700 text-white text-center py-3 rounded-lg font-semibold transition">
                        <i class="fas fa-calendar-plus mr-2"></i> New Booking
                    </a>
                    <a href="{{ route('agent.room-bookings.index') }}" class="block w-full bg-purple-600 hover:bg-purple-700 text-white text-center py-3 rounded-lg font-semibold transition">
                        <i class="fas fa-list-alt mr-2"></i> View Bookings
                    </a>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Contact Information</h3>
                <div class="space-y-3">
                    @if($hotel->phone)
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-phone mr-3 text-gray-500"></i>
                            <span>{{ $hotel->phone }}</span>
                        </div>
                    @endif
                    @if($hotel->email)
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-envelope mr-3 text-gray-500"></i>
                            <span>{{ $hotel->email }}</span>
                        </div>
                    @endif
                    @if($hotel->website)
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-globe mr-3 text-gray-500"></i>
                            <a href="{{ $hotel->website }}" target="_blank" class="text-blue-600 hover:underline">{{ $hotel->website }}</a>
                        </div>
                    @endif
                    <div class="flex items-start text-gray-700">
                        <i class="fas fa-map-marker-alt mr-3 text-gray-500 mt-1"></i>
                        <div>
                            <p class="font-medium">{{ $hotel->name }}</p>
                            <p class="text-sm">{{ $hotel->address }}</p>
                            @if($hotel->city || $hotel->state)
                                <p class="text-sm">{{ $hotel->city }}{{ $hotel->city && $hotel->state ? ', ' : '' }}{{ $hotel->state }}</p>
                            @endif
                            @if($hotel->country || $hotel->zip_code)
                                <p class="text-sm">{{ $hotel->country }}{{ $hotel->zip_code ? ' ' . $hotel->zip_code : '' }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Amenities -->
            @php
                $amenities = json_decode($hotel->amenities ?? '[]', true) ?? [];
            @endphp
            @if(count($amenities) > 0)
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Amenities</h3>
                    <div class="flex flex-wrap gap-2">
                        @php
                            $amenityLabels = [
                                'wifi' => '<i class="fas fa-wifi mr-1"></i> WiFi',
                                'parking' => '<i class="fas fa-parking mr-1"></i> Parking',
                                'pool' => '<i class="fas fa-swimming-pool mr-1"></i> Pool',
                                'gym' => '<i class="fas fa-dumbbell mr-1"></i> Gym',
                                'spa' => '<i class="fas fa-spa mr-1"></i> Spa',
                                'restaurant' => '<i class="fas fa-utensils mr-1"></i> Restaurant',
                                'bar' => '<i class="fas fa-glass-martini-alt mr-1"></i> Bar',
                                'breakfast' => '<i class="fas fa-coffee mr-1"></i> Breakfast',
                                'air_conditioning' => '<i class="fas fa-snowflake mr-1"></i> AC',
                                'room_service' => '<i class="fas fa-concierge-bell mr-1"></i> Room Service',
                                'laundry' => '<i class="fas fa-tshirt mr-1"></i> Laundry',
                                'concierge' => '<i class="fas fa-user-tie mr-1"></i> Concierge',
                                'business_center' => '<i class="fas fa-briefcase mr-1"></i> Business Center',
                                'meeting_rooms' => '<i class="fas fa-users mr-1"></i> Meeting Rooms',
                                'airport_shuttle' => '<i class="fas fa-shuttle-van mr-1"></i> Airport Shuttle',
                                'pet_friendly' => '<i class="fas fa-paw mr-1"></i> Pet Friendly',
                                'family_rooms' => '<i class="fas fa-home mr-1"></i> Family Rooms',
                                'non_smoking' => '<i class="fas fa-smoking-ban mr-1"></i> Non-Smoking',
                                'accessible' => '<i class="fas fa-wheelchair mr-1"></i> Accessible',
                            ];
                        @endphp
                        @foreach($amenities as $amenity)
                            @if(isset($amenityLabels[$amenity]))
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-800">
                                    {!! $amenityLabels[$amenity] !!}
                                </span>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
