<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = [
        'agent_id',
        'hotel_id',
        'room_name',
        'price_per_night',
        'max_guests',
        'ac',
        'tv',
        'breakfast',
        'attached_bathroom',
        'availability',
    ];

    // Add the hotel relationship
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(RoomImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(RoomImage::class)->where('is_primary', true);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(RoomBooking::class);
    }
}
