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
        // Remove the amenities cast for now since it's not working
        // 'amenities' => 'array',
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
        $amenities = $this->amenities;

        // If amenities is null or empty, return empty array
        if (empty($amenities)) {
            return [];
        }

        // Try to decode as JSON first (for data like "[\"wifi\",\"parking\"]")
        if (is_string($amenities) && str_starts_with($amenities, '[')) {
            $decoded = json_decode($amenities, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $amenities = $decoded;
            }
        }

        // If still a string, try to explode by comma (for legacy data)
        if (is_string($amenities) && !is_array($amenities)) {
            $amenities = explode(',', $amenities);
        }

        // Ensure we have an array
        if (!is_array($amenities)) {
            return [];
        }

        // Clean up array values
        $amenities = array_map('trim', $amenities);
        $amenities = array_filter($amenities); // Remove empty values

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
            // Remove quotes if present
            $amenity = trim($amenity, '"\'');

            if (isset($amenityLabels[$amenity])) {
                $formattedAmenities[$amenity] = $amenityLabels[$amenity];
            } elseif (!empty($amenity)) {
                // If not in our labels list, use the amenity as is
                $formattedAmenities[$amenity] = ucwords(str_replace('_', ' ', $amenity));
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
        $amenitiesList = $this->amenities_list;
        return array_key_exists($amenity, $amenitiesList);
    }

    /**
     * Get available amenities count.
     */
    public function getAmenitiesCountAttribute(): int
    {
        $amenitiesList = $this->amenities_list;
        return count($amenitiesList);
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

    /**
     * Set amenities attribute - ensure it's stored properly
     */
    public function setAmenitiesAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['amenities'] = json_encode($value);
        } elseif (is_string($value) && !empty($value)) {
            // If it's already a JSON string, keep it
            if (json_decode($value) !== null) {
                $this->attributes['amenities'] = $value;
            } else {
                // If it's a comma-separated string, convert to array then JSON
                $array = array_map('trim', explode(',', $value));
                $this->attributes['amenities'] = json_encode($array);
            }
        } else {
            $this->attributes['amenities'] = json_encode([]);
        }
    }

    /**
     * Get amenities as array directly
     */
    public function getAmenitiesArrayAttribute(): array
    {
        return $this->amenities_list;
    }
}
