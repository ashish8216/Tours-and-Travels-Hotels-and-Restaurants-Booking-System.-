{{-- resources/views/frontend/restaurants/show.blade.php --}}
@extends('frontend.layouts.app')

@section('title', $restaurant->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Back Button -->
    <a href="{{ route('restaurants.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-6">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Back to Restaurants
    </a>

    <!-- Restaurant Header -->
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden mb-8">
        <div class="relative h-80 bg-gray-200">
            @if($restaurant->image)
                <img src="{{ asset('storage/' . $restaurant->image) }}" alt="{{ $restaurant->name }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center">
                    <svg class="w-40 h-40 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm0 2h12v10H4V5zm2 2v2h2V7H6zm4 0v2h2V7h-2zm4 0v2h2V7h-2zm-8 4v2h2v-2H6zm4 0v2h2v-2h-2zm4 0v2h2v-2h-2z"/>
                    </svg>
                </div>
            @endif

            @if($restaurant->cuisine_type)
                <span class="absolute top-6 right-6 bg-blue-600 text-white px-4 py-2 rounded-full font-semibold">
                    {{ ucfirst($restaurant->cuisine_type) }}
                </span>
            @endif
        </div>

        <div class="p-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $restaurant->name }}</h1>

                    <!-- Location -->
                    <div class="flex items-center text-gray-600 mb-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>{{ $restaurant->location }}</span>
                    </div>

                    <!-- Hours -->
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Open: {{ \Carbon\Carbon::parse($restaurant->opening_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($restaurant->closing_time)->format('h:i A') }}</span>
                    </div>
                </div>

                @auth
                    <a href="{{ route('restaurants.reserve', $restaurant) }}"
                       class="mt-4 md:mt-0 bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                        Reserve a Table
                    </a>
                @endauth
            </div>

            <!-- Contact Info -->
            <div class="flex flex-wrap gap-4 mt-4 pt-4 border-t border-gray-200">
                @if($restaurant->phone)
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>{{ $restaurant->phone }}</span>
                    </div>
                @endif

                @if($restaurant->email)
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $restaurant->email }}</span>
                    </div>
                @endif

                <div class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.67 0c-.18-.64-.28-1.31-.28-2s.1-1.36.28-2m-13.67 0c.18.64.28 1.31.28 2s-.1 1.36-.28 2"/>
                    </svg>
                    <span>Capacity: {{ $restaurant->capacity }} guests</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Left Column - Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Description -->
            @if($restaurant->description)
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">About {{ $restaurant->name }}</h2>
                    <p class="text-gray-700 whitespace-pre-line">{{ $restaurant->description }}</p>
                </div>
            @endif

            <!-- Table Availability Checker -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Check Availability</h2>

                <form id="availability-form" class="space-y-4">
                    @csrf
                    <div class="grid md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                            <input type="date" name="date" id="date"
                                   min="{{ now()->format('Y-m-d') }}"
                                   value="{{ now()->format('Y-m-d') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Time</label>
                            <select name="time" id="time"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @for($i = 11; $i <= 22; $i++)
                                    <option value="{{ sprintf('%02d:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                                    <option value="{{ sprintf('%02d:30', $i) }}">{{ sprintf('%02d:30', $i) }}</option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Guests</label>
                            <select name="guests" id="guests"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ $i }} {{ $i == 1 ? 'Guest' : 'Guests' }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300">
                        Check Availability
                    </button>
                </form>

                <!-- Availability Results -->
                <div id="availability-results" class="mt-6 hidden">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div id="availability-message" class="mb-3"></div>
                        <div id="tables-list" class="space-y-2"></div>
                        <div id="reserve-button-container" class="mt-4 hidden">
                            <a href="#" id="reserve-link" class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300">
                                Proceed to Reserve
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Table Info -->
        <div class="space-y-6">
            <!-- Table Types -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Dining Areas</h3>

                @php
                    $tableTypes = $restaurant->tables()
                        ->where('status', 'available')
                        ->get()
                        ->groupBy('type');
                @endphp

                @if($tableTypes->count() > 0)
                    <div class="space-y-4">
                        @foreach($tableTypes as $type => $tables)
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-medium text-gray-800 capitalize">{{ str_replace('_', ' ', $type) }}</span>
                                    <span class="text-sm text-gray-600">{{ $tables->count() }} tables</span>
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($tables->take(5) as $table)
                                        <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded">
                                            {{ $table->table_name ?? 'Table ' . $table->table_number }}
                                            <span class="ml-1 text-gray-500">({{ $table->capacity }})</span>
                                        </span>
                                    @endforeach
                                    @if($tables->count() > 5)
                                        <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded">
                                            +{{ $tables->count() - 5 }} more
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600">No tables available at the moment.</p>
                @endif
            </div>

            <!-- Quick Reserve -->
            @auth
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg p-6 text-white">
                    <h3 class="text-lg font-bold mb-2">Reserve Your Table</h3>
                    <p class="text-blue-100 mb-4">Book your table now and enjoy a wonderful dining experience.</p>
                    <a href="{{ route('restaurants.reserve', $restaurant) }}"
                       class="block w-full bg-white text-blue-600 hover:bg-gray-100 text-center font-semibold py-3 px-4 rounded-lg transition duration-300">
                        Make a Reservation
                    </a>
                </div>
            @else
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg p-6 text-white">
                    <h3 class="text-lg font-bold mb-2">Sign In to Reserve</h3>
                    <p class="text-blue-100 mb-4">Please login to make a reservation at {{ $restaurant->name }}.</p>
                    <a href="{{ route('login') }}?redirect={{ urlencode(route('restaurants.show', $restaurant)) }}"
                       class="block w-full bg-white text-blue-600 hover:bg-gray-100 text-center font-semibold py-3 px-4 rounded-lg transition duration-300">
                        Login / Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('availability-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const restaurantId = {{ $restaurant->id }};
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;
    const guests = document.getElementById('guests').value;

    fetch(`/restaurants/${restaurantId}/check-availability`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ date, time, guests })
    })
    .then(response => response.json())
    .then(data => {
        const resultsDiv = document.getElementById('availability-results');
        const messageDiv = document.getElementById('availability-message');
        const tablesList = document.getElementById('tables-list');
        const reserveBtnContainer = document.getElementById('reserve-button-container');
        const reserveLink = document.getElementById('reserve-link');

        resultsDiv.classList.remove('hidden');

        if (data.available) {
            messageDiv.innerHTML = `<span class="text-green-600 font-semibold">✓ Tables available for ${guests} guests at ${time} on ${date}</span>`;

            let html = '<div class="mt-3"><h4 class="font-medium text-gray-800 mb-2">Available Tables:</h4>';

            data.tables.forEach(group => {
                html += `<div class="mb-2">
                            <span class="text-sm text-gray-600">${group.capacity} seats:</span>
                            <span class="text-sm font-semibold ml-2">${group.count} tables</span>
                         </div>`;
            });

            html += '</div>';
            tablesList.innerHTML = html;

            @auth
                reserveBtnContainer.classList.remove('hidden');
                reserveLink.href = `/restaurants/${restaurantId}/reserve?date=${date}&time=${time}&guests=${guests}`;
            @else
                reserveBtnContainer.classList.add('hidden');
                messageDiv.innerHTML += '<div class="mt-3 text-sm text-blue-600">Please login to reserve a table.</div>';
            @endauth
        } else {
            messageDiv.innerHTML = '<span class="text-red-600 font-semibold">✗ No tables available for the selected criteria.</span>';
            tablesList.innerHTML = '';
            reserveBtnContainer.classList.add('hidden');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
</script>
@endpush
@endsection
