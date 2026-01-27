<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Agent extends Model
{
    protected $fillable = [
        'user_id',
        'business_name',
        'business_type',
        'registration_number',
        'phone',
        'address',
        'website',
        'logo',
        'description',
        'is_verified',
        'verification_status',
        'verified_at',
    ];

    protected $casts = [
        'business_type' => 'array',
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
    ];

    /**
     * Get the user that owns the agent.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the restaurant for the agent.
     */
    public function restaurant(): HasOne
    {
        return $this->hasOne(Restaurant::class);
    }

    /**
     * Get the hotel for the agent.
     */
    public function hotel(): HasOne
    {
        return $this->hasOne(Hotel::class);
    }

    /**
     * Get the tour for the agent.
     */
    public function tour(): HasOne
    {
        return $this->hasOne(Tour::class);
    }

    /**
     * Check if agent has a specific service.
     */
    public function hasService(string $service): bool
    {
        return in_array($service, $this->business_type ?? []);
    }

    /**
     * Check if agent has restaurant.
     */
    public function hasRestaurant(): bool
    {
        return $this->hasService('restaurant') && $this->restaurant()->exists();
    }

    /**
     * Check if agent has hotel.
     */
    public function hasHotel(): bool
    {
        return $this->hasService('hotel') && $this->hotel()->exists();
    }

    /**
     * Check if agent has tour.
     */
    public function hasTour(): bool
    {
        return $this->hasService('tour_guide') && $this->tour()->exists();
    }

    /**
     * Get the active services count.
     */
    public function getActiveServicesCountAttribute(): int
    {
        return count($this->business_type ?? []);
    }

    /**
     * Get the business type as formatted string.
     */
    public function getBusinessTypeLabelAttribute(): string
    {
        $labels = [
            'hotel' => 'Hotel',
            'restaurant' => 'Restaurant',
            'tour_guide' => 'Tour Guide',
        ];

        $types = [];
        foreach ($this->business_type ?? [] as $type) {
            if (isset($labels[$type])) {
                $types[] = $labels[$type];
            }
        }

        return implode(', ', $types);
    }

    /**
     * Get all business entities for this agent.
     */
    public function getBusinessEntitiesAttribute(): array
    {
        $entities = [];

        if ($this->hasRestaurant()) {
            $entities['restaurant'] = $this->restaurant;
        }

        if ($this->hasHotel()) {
            $entities['hotel'] = $this->hotel;
        }

        if ($this->hasTour()) {
            $entities['tour'] = $this->tour;
        }

        return $entities;
    }
}
