<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'agent_id',
        'name',
        'description',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
        'phone',
        'email',
        'website',
        'check_in_time',
        'check_out_time',
        'amenities',
        'policies',
        'image',
        'status',
    ];

    protected $casts = [
        'check_in_time' => 'datetime:H:i',
        'check_out_time' => 'datetime:H:i',
        'amenities' => 'array',
    ];

    /**
     * Get the agent that owns the hotel.
     */
    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    /**
     * Get the rooms for the hotel (using agent_id).
     */
    public function rooms()
    {
        return \App\Models\Room::where('agent_id', $this->agent_id);
    }

    /**
     * Get the bookings for the hotel (using agent_id).
     */
    public function bookings()
    {
        return \App\Models\RoomBooking::where('agent_id', $this->agent_id);
    }

    /**
     * Get the amenities as formatted array.
     */
    public function getAmenitiesListAttribute(): array
    {
        $amenities = $this->amenities ?? [];
        $amenityLabels = [
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

        $formattedAmenities = [];
        foreach ($amenities as $amenity) {
            if (isset($amenityLabels[$amenity])) {
                $formattedAmenities[$amenity] = $amenityLabels[$amenity];
            }
        }

        return $formattedAmenities;
    }

    /**
     * Get the full address.
     */
    public function getFullAddressAttribute(): string
    {
        $parts = [];
        if ($this->address) $parts[] = $this->address;
        if ($this->city) $parts[] = $this->city;
        if ($this->state) $parts[] = $this->state;
        if ($this->country) $parts[] = $this->country;
        if ($this->zip_code) $parts[] = $this->zip_code;

        return implode(', ', $parts);
    }

    /**
     * Check if hotel has a specific amenity.
     */
    public function hasAmenity(string $amenity): bool
    {
        $amenities = $this->amenities ?? [];
        return in_array($amenity, $amenities);
    }

    /**
     * Get available amenities count.
     */
    public function getAmenitiesCountAttribute(): int
    {
        return count($this->amenities ?? []);
    }

    /**
     * Get rooms count attribute.
     */
    public function getRoomsCountAttribute(): int
    {
        return Room::where('agent_id', $this->agent_id)->count();
    }

    /**
     * Get bookings count attribute.
     */
    public function getBookingsCountAttribute(): int
    {
        return \App\Models\RoomBooking::where('agent_id', $this->agent_id)->count();
    }
}
