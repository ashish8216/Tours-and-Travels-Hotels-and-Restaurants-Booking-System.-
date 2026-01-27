@extends('agent.layout')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Edit Hotel</h1>
        <p class="text-gray-600 mt-1">Update hotel details</p>
    </div>

    <form action="{{ route('agent.hotels.update', $hotel) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6">
        @csrf
        @method('PUT')

        <!-- Basic Information -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Basic Information</h2>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Hotel Name *</label>
                <input type="text" name="name" value="{{ old('name', $hotel->name) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea name="description" rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description', $hotel->description) }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Address Information -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Address Information</h2>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Address *</label>
                <textarea name="address" rows="2" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('address', $hotel->address) }}</textarea>
                @error('address')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">City</label>
                    <input type="text" name="city" value="{{ old('city', $hotel->city) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('city')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">State</label>
                    <input type="text" name="state" value="{{ old('state', $hotel->state) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('state')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Country</label>
                    <input type="text" name="country" value="{{ old('country', $hotel->country) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('country')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">ZIP Code</label>
                    <input type="text" name="zip_code" value="{{ old('zip_code', $hotel->zip_code) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('zip_code')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Contact Information</h2>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $hotel->phone) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('phone')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $hotel->email) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-gray-700 font-medium mb-2">Website</label>
                <input type="url" name="website" value="{{ old('website', $hotel->website) }}" placeholder="https://"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('website')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Check-in/Check-out Times -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Check-in & Check-out Times</h2>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Check-in Time *</label>
                    <input type="time" name="check_in_time" value="{{ old('check_in_time', optional($hotel->check_in_time)->format('H:i') ?? '14:00') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('check_in_time')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Check-out Time *</label>
                    <input type="time" name="check_out_time" value="{{ old('check_out_time', optional($hotel->check_out_time)->format('H:i') ?? '12:00') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('check_out_time')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Amenities -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Amenities</h2>
            @php
                $amenities = json_decode($hotel->amenities ?? '[]', true) ?? [];
                $allAmenities = [
                    'wifi' => 'WiFi',
                    'parking' => 'Parking',
                    'pool' => 'Swimming Pool',
                    'gym' => 'Gym',
                    'spa' => 'Spa',
                    'restaurant' => 'Restaurant',
                    'bar' => 'Bar',
                    'breakfast' => 'Breakfast Included',
                    'air_conditioning' => 'Air Conditioning',
                    'room_service' => '24/7 Room Service',
                    'laundry' => 'Laundry Service',
                    'concierge' => 'Concierge',
                    'business_center' => 'Business Center',
                    'meeting_rooms' => 'Meeting Rooms',
                    'airport_shuttle' => 'Airport Shuttle',
                    'pet_friendly' => 'Pet Friendly',
                    'family_rooms' => 'Family Rooms',
                    'non_smoking' => 'Non-Smoking Rooms',
                    'accessible' => 'Accessible Rooms',
                ];
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                @foreach($allAmenities as $key => $label)
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="amenities[]" value="{{ $key }}"
                            {{ in_array($key, $amenities) ? 'checked' : '' }}
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-2 text-gray-700">{{ $label }}</span>
                    </label>
                @endforeach
            </div>
            @error('amenities')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Policies -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Hotel Policies</h2>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Policies & Information</label>
                <textarea name="policies" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('policies', $hotel->policies) }}</textarea>
                <p class="text-sm text-gray-500 mt-1">Check-in/check-out policies, cancellation policies, etc.</p>
                @error('policies')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Image -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Hotel Image</h2>
            @if($hotel->image)
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Current Image</label>
                    <img src="{{ asset('storage/' . $hotel->image) }}" alt="Current image" class="w-32 h-32 object-cover rounded-lg mb-2">
                    <a href="{{ asset('storage/' . $hotel->image) }}" target="_blank" class="text-sm text-blue-600 hover:underline">View full size</a>
                </div>
            @endif
            <div>
                <label class="block text-gray-700 font-medium mb-2">Change Image</label>
                <input type="file" name="image" accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image</p>
                @error('image')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Status -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Status</h2>
            <div class="flex gap-4">
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="status" value="active" {{ old('status', $hotel->status) === 'active' ? 'checked' : '' }} required
                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                    <span class="ml-2 text-gray-700">Active</span>
                </label>
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="status" value="inactive" {{ old('status', $hotel->status) === 'inactive' ? 'checked' : '' }}
                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                    <span class="ml-2 text-gray-700">Inactive</span>
                </label>
            </div>
            @error('status')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Actions -->
        <div class="flex gap-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition">
                Update Hotel
            </button>
            <a href="{{ route('agent.hotels.show', $hotel) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-8 py-3 rounded-lg font-semibold transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
