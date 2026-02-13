@extends('frontend.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('hotels.index') }}" class="text-gray-700 hover:text-blue-600">Hotels</a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-500 ml-1">{{ $hotel->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Hotel Header -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
        <div class="relative">
            @if($hotel->image)
                <img src="{{ asset('storage/' . $hotel->image) }}"
                     alt="{{ $hotel->name }}"
                     class="w-full h-96 object-cover"
                     onerror="this.src='https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'">
            @else
                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                     alt="{{ $hotel->name }}"
                     class="w-full h-96 object-cover">
            @endif
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $hotel->name }}</h1>
                <div class="flex items-center text-white/90">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>{{ $hotel->full_address }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Info -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-6 border-b">
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $hotel->rooms_count }}</div>
                <div class="text-sm text-gray-600">Rooms</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $hotel->check_in_time->format('h:i A') }}</div>
                <div class="text-sm text-gray-600">Check-in</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $hotel->check_out_time->format('h:i A') }}</div>
                <div class="text-sm text-gray-600">Check-out</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $hotel->amenities_count }}</div>
                <div class="text-sm text-gray-600">Amenities</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Hotel Details -->
        <div class="lg:col-span-2">
            <!-- Description -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">About This Hotel</h2>
                <div class="prose max-w-none text-gray-600">
                    {!! nl2br(e($hotel->description)) !!}
                </div>
            </div>

            <!-- Amenities -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Hotel Amenities</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($hotel->amenities_list as $key => $amenity)
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            @php
                                $amenityIcons = [
                                    'wifi' => 'M2.132 13.63a14.936 14.936 0 011.48-1.023 3.219 3.219 0 004.277.785 12.015 12.015 0 015.761-1.753c2.12 0 4.161.614 5.916 1.753a3.22 3.22 0 004.277-.785 14.945 14.945 0 011.48 1.023 16.01 16.01 0 01-19.41 0zM12 16a4 4 0 100-8 4 4 0 000 8z',
                                    'parking' => 'M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z',
                                    'pool' => 'M20.5 13H3.5a1.5 1.5 0 00-1.5 1.5v1A1.5 1.5 0 003.5 17h17a1.5 1.5 0 001.5-1.5v-1a1.5 1.5 0 00-1.5-1.5zM20.5 21H3.5A1.5 1.5 0 012 19.5v-1A1.5 1.5 0 013.5 17h17a1.5 1.5 0 011.5 1.5v1a1.5 1.5 0 01-1.5 1.5zM4 13v-2h16v2H4z',
                                    'gym' => 'M13 10V3L4 14h7v7l9-11h-7z',
                                    'restaurant' => 'M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z',
                                    'breakfast' => 'M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7',
                                    'air_conditioning' => 'M4 16v-2.38a2 2 0 011.515-1.94l2-.517A2 2 0 019 11.617V8m0 0v6m0-6a2 2 0 012-2h4a2 2 0 012 2v6m0 0v2.38a2 2 0 01-1.515 1.94l-2 .517A2 2 0 0115 16.383V12',
                                    'room_service' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z',
                                ];
                                $icon = $amenityIcons[$key] ?? 'M12 14l9-5-9-5-9 5 9 5z';
                            @endphp
                            <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}" />
                            </svg>
                            <span class="text-gray-700">{{ $amenity }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Policies -->
            @if($hotel->policies)
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Hotel Policies</h2>
                    <div class="prose max-w-none text-gray-600">
                        {!! nl2br(e($hotel->policies)) !!}
                    </div>
                </div>
            @endif
        </div>

        <!-- Right Column: Available Rooms & Booking -->
        <div class="lg:col-span-1">
            <!-- Available Rooms -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Available Rooms</h2>

                @if($rooms->count() > 0)
                    <div class="space-y-6">
                        @foreach($rooms as $room)
                            <div class="border border-gray-200 rounded-xl p-5 hover:border-blue-300 transition">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900">{{ $room->room_name }}</h3>
                                        <div class="flex items-center text-sm text-gray-600 mt-1">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-4.201V5a2.5 2.5 0 00-5 0v.5" />
                                            </svg>
                                            Max {{ $room->max_guests }} guests
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-2xl font-bold text-blue-600">NPR {{ number_format($room->price_per_night) }}</div>
                                        <div class="text-sm text-gray-500">per night</div>
                                    </div>
                                </div>

                                <!-- Room Features -->
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @if($room->ac)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-800">
                                            AC
                                        </span>
                                    @endif
                                    @if($room->tv)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-green-100 text-green-800">
                                            TV
                                        </span>
                                    @endif
                                    @if($room->breakfast)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-800">
                                            Breakfast
                                        </span>
                                    @endif
                                    @if($room->attached_bathroom)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-purple-100 text-purple-800">
                                            Attached Bath
                                        </span>
                                    @endif
                                </div>

                                <!-- Book Now Form -->
                                <form method="GET" action="{{ route('hotels.book', ['hotel' => $hotel, 'room' => $room]) }}"
                                      x-data="{ checkIn: '', checkOut: '', guests: 1 }">
                                    <div class="space-y-3">
                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Check-in</label>
                                                <input type="date" name="check_in" x-model="checkIn" required
                                                       min="{{ date('Y-m-d') }}"
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Check-out</label>
                                                <input type="date" name="check_out" x-model="checkOut" required
                                                       :min="checkIn"
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Guests</label>
                                            <select name="guests" x-model="guests" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                                                @for($i = 1; $i <= $room->max_guests; $i++)
                                                    <option value="{{ $i }}">{{ $i }} {{ $i == 1 ? 'guest' : 'guests' }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <button type="submit"
                                                :disabled="!checkIn || !checkOut"
                                                :class="{ 'opacity-50 cursor-not-allowed': !checkIn || !checkOut }"
                                                class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition">
                                            Book Now
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <p class="text-gray-600">No rooms available at the moment.</p>
                    </div>
                @endif
            </div>

            <!-- Contact Info -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Contact Information</h2>
                <div class="space-y-4">
                    @if($hotel->phone)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <a href="tel:{{ $hotel->phone }}" class="text-gray-700 hover:text-blue-600">{{ $hotel->phone }}</a>
                        </div>
                    @endif
                    @if($hotel->email)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <a href="mailto:{{ $hotel->email }}" class="text-gray-700 hover:text-blue-600">{{ $hotel->email }}</a>
                        </div>
                    @endif
                    @if($hotel->website)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                            <a href="{{ $hotel->website }}" target="_blank" class="text-gray-700 hover:text-blue-600">Visit Website</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Set minimum dates for date inputs
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        const checkInInputs = document.querySelectorAll('input[name="check_in"]');
        const checkOutInputs = document.querySelectorAll('input[name="check_out"]');

        checkInInputs.forEach(input => {
            input.min = today;
        });

        // Update check-out min date when check-in changes
        checkInInputs.forEach((checkIn, index) => {
            checkIn.addEventListener('change', function() {
                if (checkOutInputs[index]) {
                    checkOutInputs[index].min = this.value;
                    if (checkOutInputs[index].value < this.value) {
                        checkOutInputs[index].value = '';
                    }
                }
            });
        });
    });
</script>
@endpush
