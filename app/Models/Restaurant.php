<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    protected $fillable = [
        'agent_id',
        'name',
        'description',
        'cuisine_type',
        'location',
        'phone',
        'email',
        'opening_time',
        'closing_time',
        'capacity',
        'image',
        'status',
    ];

    protected $casts = [
        'opening_time' => 'datetime:H:i',
        'closing_time' => 'datetime:H:i',
    ];

    /**
     * Get the agent that owns the restaurant.
     */
    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    /**
     * Get the tables for the restaurant.
     */
    public function tables(): HasMany
    {
        return $this->hasMany(RestaurantTable::class);
    }

    /**
     * Get the reservations for the restaurant.
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(RestaurantReservation::class);
    }

    /**
     * Scope a query to only include restaurants by a specific agent.
     */
    public function scopeByAgent($query, $agentId)
    {
        return $query->where('agent_id', $agentId);
    }
}
