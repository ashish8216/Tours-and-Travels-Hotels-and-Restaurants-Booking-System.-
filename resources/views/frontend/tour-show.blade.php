@extends('frontend.layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Tour Header -->
        <div class="mb-8">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('tours.index') }}" class="text-gray-700 hover:text-blue-600">Tours</a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-500 ml-1">{{ $tour->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $tour->title }}</h1>
            <div class="flex items-center text-gray-600">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>{{ $tour->location }}</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Tour Images -->
                <div class="mb-8">
                    @if ($tour->image)
                        <div class="rounded-2xl overflow-hidden">
                            <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->title }}"
                                class="w-full h-96 object-cover"
                                onerror="this.src='{{ asset('images/default-tour.jpg') }}'">
                        </div>
                    @endif
                </div>

                <!-- Tour Details -->
                <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Tour Details</h2>

                    <div class="prose prose-lg max-w-none mb-8">
                        {!! $tour->description !!}
                    </div>

                    <!-- Inclusions & Exclusions -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        @if ($tour->inclusions)
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    What's Included
                                </h3>
                                <div class="text-gray-600">
                                    {!! nl2br(e($tour->inclusions)) !!}
                                </div>
                            </div>
                        @endif

                        @if ($tour->exclusions)
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    What's Not Included
                                </h3>
                                <div class="text-gray-600">
                                    {!! nl2br(e($tour->exclusions)) !!}
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Requirements -->
                    @if ($tour->requirements)
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">What to Bring</h3>
                            <div class="text-gray-600">
                                {!! nl2br(e($tour->requirements)) !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Booking Sidebar -->
            <div class="lg:col-span-1">
                <!-- Booking Card -->
                <div class="bg-white rounded-2xl shadow-xl sticky top-24">
                    <!-- Card Header -->
                    <div class="bg-blue-600 text-white px-6 py-4 rounded-t-2xl">
                        <h4 class="text-xl font-bold">Book This Tour</h4>
                        <p class="text-blue-100 text-sm">Starting from NPR {{ number_format($tour->price) }}</p>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                        <!-- Price Display -->
                        <div class="text-center mb-6">
                            <div class="text-3xl font-bold text-gray-900">NPR {{ number_format($tour->price) }}</div>
                            <div class="text-gray-500">per person</div>
                        </div>

                        @auth
                            <!-- ✅ LOGGED IN USER: Show Booking Form -->
                            <form id="bookingForm" x-data="bookingForm()" x-init="init()"
                                @submit.prevent="checkAvailability" novalidate> @csrf
                                <input type="hidden" name="tour_id" value="{{ $tour->id }}">

                                <!-- Date Selection -->
                                <div class="mb-6">
                                    <label class="block text-gray-700 font-medium mb-2">Select Date</label>
                                    <select name="tour_date_id" x-model="selectedDate" @change="checkAvailabilityDebounced()"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required>
                                        <option value="">Choose a date</option>
                                        @foreach ($tour->tourDates as $date)
                                            <option value="{{ $date->id }}">
                                                {{ $date->date->format('F d, Y') }}
                                                @if ($date->start_time)
                                                    ({{ $date->start_time }})
                                                @endif
                                                - {{ $date->available_slots - $date->booked_slots }} slots left
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($tour->tourDates->count() === 0)
                                        <p class="text-red-600 text-sm mt-2">
                                            No available dates. Please check back later.
                                        </p>
                                    @endif
                                </div>

                                <!-- Number of People -->
                                <div class="mb-6">
                                    <label class="block text-gray-700 font-medium mb-2">Number of People</label>
                                    <div class="flex items-center">
                                        <button type="button" @click="decrementPeople"
                                            class="px-4 py-2 border border-gray-300 rounded-l-lg hover:bg-gray-50"
                                            :disabled="people <= 1">
                                            -
                                        </button>
                                        <input type="number" name="people" x-model="people" min="1"
                                            max="{{ $tour->max_people }}"
                                            class="w-full px-4 py-2 border-t border-b border-gray-300 text-center" readonly
                                            required>
                                        <button type="button" @click="incrementPeople"
                                            class="px-4 py-2 border border-gray-300 rounded-r-lg hover:bg-gray-50"
                                            :disabled="people >= {{ $tour->max_people }}">
                                            +
                                        </button>
                                    </div>
                                    <p class="text-gray-500 text-sm mt-1">
                                        Maximum {{ $tour->max_people }} people per booking
                                    </p>
                                </div>

                                <!-- Availability Check -->
                                <div x-show="availabilityMessage" :class="availabilityClass" class="p-3 rounded-lg mb-6"
                                    x-cloak>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" :class="availabilityIconClass" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span x-text="availabilityMessage"></span>
                                    </div>
                                </div>

                                <!-- Price Summary -->
                                <div x-show="totalAmount > 0" class="mb-6 p-4 bg-gray-50 rounded-lg" x-cloak>
                                    <div class="flex justify-between mb-2">
                                        <span class="text-gray-600">Price per person:</span>
                                        <span class="font-medium">NPR <span
                                                x-text="formatPrice(pricePerPerson)"></span></span>
                                    </div>
                                    <div class="flex justify-between mb-2">
                                        <span class="text-gray-600">Number of people:</span>
                                        <span class="font-medium" x-text="people"></span>
                                    </div>
                                    <div class="border-t border-gray-200 pt-2">
                                        <div class="flex justify-between">
                                            <span class="text-lg font-bold text-gray-900">Total Amount:</span>
                                            <span class="text-xl font-bold text-blue-600">NPR <span
                                                    x-text="formatPrice(totalAmount)"></span></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Book Button -->
                                <button type="submit" x-bind:disabled="!isAvailable || isChecking"
                                    :class="{ 'opacity-50 cursor-not-allowed': !isAvailable || isChecking }"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-4 rounded-lg transition flex items-center justify-center">
                                    <span x-show="!isChecking">Book Now</span>
                                    <span x-show="isChecking" class="flex items-center">
                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        Checking...
                                    </span>
                                </button>
                            </form>
                        @else
                            <!-- ✅ NOT LOGGED IN: Show Only Login/Register Options -->
                            <div class="text-center">
                                <div class="mb-4">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Login Required</h3>
                                    <p class="text-gray-600 mb-6">Please login or create an account to book this tour.</p>
                                </div>

                                <div class="space-y-3">
                                    <a href="{{ route('login') }}?redirect={{ urlencode(url()->current()) }}"
                                        class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition text-center">
                                        Login to Book
                                    </a>

                                    <div class="text-gray-500 text-sm">
                                        <span class="inline-block mx-2">or</span>
                                    </div>

                                    <a href="{{ route('register') }}?redirect={{ urlencode(url()->current()) }}"
                                        class="block w-full bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition text-center">
                                        Create Account
                                    </a>
                                </div>

                                <!-- Additional Info (Optional) -->
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    <p class="text-gray-600 text-sm mb-2">Benefits of creating an account:</p>
                                    <ul class="text-gray-500 text-sm space-y-1 text-left">
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            View booking history
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Quick checkout for future bookings
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Receive booking confirmations
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endauth

                        <!-- Quick Info -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="flex items-center text-gray-600 mb-3">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Duration: {{ $tour->duration }}</span>
                            </div>
                            <div class="flex items-center text-gray-600 mb-3">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span>Group size: 1 - {{ $tour->max_people }} people</span>
                            </div>
                            @if ($tour->difficulty_level)
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <span>Difficulty: {{ $tour->difficulty_level }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Agent Info -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mt-8">
                    <h4 class="text-xl font-bold text-gray-900 mb-4">Tour Operator</h4>
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-lg mr-4">
                            {{ substr($tour->agent->business_name, 0, 1) }}
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-900">{{ $tour->agent->business_name }}</h5>
                            <p class="text-gray-600 text-sm">{{ $tour->agent->owner_name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function bookingForm() {
            return {
                people: 1,
                pricePerPerson: {{ $tour->price }},
                totalAmount: {{ $tour->price }},
                selectedDate: '',
                isChecking: false,
                isAvailable: false,
                availabilityMessage: '',
                availabilityClass: '',
                availabilityIconClass: '',
                autoCheckTimer: null, // For debouncing

                init() {
                    this.updateTotal();
                    // Enable button initially
                    this.isAvailable = true;
                },

                decrementPeople() {
                    if (this.people > 1) {
                        this.people--;
                        this.updateTotal();
                        this.checkAvailabilityDebounced();
                    }
                },

                incrementPeople() {
                    if (this.people < {{ $tour->max_people }}) {
                        this.people++;
                        this.updateTotal();
                        this.checkAvailabilityDebounced();
                    }
                },

                updateTotal() {
                    this.totalAmount = this.pricePerPerson * this.people;
                },

                formatPrice(price) {
                    return price.toLocaleString('en-US');
                },

                // Debounced availability check
                checkAvailabilityDebounced() {
                    clearTimeout(this.autoCheckTimer);
                    this.autoCheckTimer = setTimeout(() => {
                        if (this.selectedDate) {
                            this.performAvailabilityCheck();
                        }
                    }, 500);
                },

                async performAvailabilityCheck() {
                    if (!this.selectedDate) return;

                    this.isChecking = true;

                    try {
                        const response = await fetch('{{ route('tours.check-availability', $tour->id) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: JSON.stringify({
                                tour_date_id: this.selectedDate,
                                people: this.people
                            })
                        });

                        const data = await response.json();

                        if (data.available) {
                            this.showAvailability(data.message || 'Available!', true);
                            this.isAvailable = true;
                        } else {
                            this.showAvailability(data.message || 'Not available', false);
                            this.isAvailable = false;
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        this.showAvailability('Error checking availability', false);
                        this.isAvailable = false;
                    }

                    this.isChecking = false;
                },

                async checkAvailability() {
                    if (!this.selectedDate) {
                        this.showAvailability('Please select a date', false);
                        return;
                    }

                    await this.performAvailabilityCheck();

                    // If available, submit the form
                    if (this.isAvailable) {
                        setTimeout(() => {
                            this.submitBooking();
                        }, 1000);
                    }
                },

                submitBooking() {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route('tours.book', $tour->id) }}';
                    form.style.display = 'none';

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    form.appendChild(csrfToken);

                    const dateInput = document.createElement('input');
                    dateInput.type = 'hidden';
                    dateInput.name = 'tour_date_id';
                    dateInput.value = this.selectedDate;
                    form.appendChild(dateInput);

                    const peopleInput = document.createElement('input');
                    peopleInput.type = 'hidden';
                    peopleInput.name = 'people';
                    peopleInput.value = this.people;
                    form.appendChild(peopleInput);

                    document.body.appendChild(form);
                    form.submit();
                },

                showAvailability(message, isAvailable) {
                    this.availabilityMessage = message;
                    this.availabilityClass = isAvailable ?
                        'bg-green-50 text-green-700 border border-green-200' :
                        'bg-red-50 text-red-700 border border-red-200';
                    this.availabilityIconClass = isAvailable ? 'text-green-600' : 'text-red-600';
                }
            };
        }
    </script>
@endpush
