<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'room_number',
        'type',
        'price',
        'capacity',
        'description',
        'image',
        'amenities',
        'is_available',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'capacity' => 'integer',
        'is_available' => 'boolean',
        'amenities' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get all bookings for this room.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get all reviews for this room.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the average rating for this room.
     */
    public function getAverageRatingAttribute(): float
    {
        return $this->reviews()->average('rating') ?? 0;
    }

    /**
     * Get available rooms by date range.
     */
    public function scopeAvailableForDates($query, $checkInDate, $checkOutDate)
    {
        return $query->where('is_available', true)
            ->whereDoesntHave('bookings', function ($q) use ($checkInDate, $checkOutDate) {
                $q->where('status', '!=', 'cancelled')
                    ->where('check_in_date', '<', $checkOutDate)
                    ->where('check_out_date', '>', $checkInDate);
            });
    }

    /**
     * Filter by price range.
     */
    public function scopeByPriceRange($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    /**
     * Filter by room type.
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Filter by capacity.
     */
    public function scopeByCapacity($query, $capacity)
    {
        return $query->where('capacity', '>=', $capacity);
    }

    /**
     * Get only available rooms.
     */
    public function scopeActive($query)
    {
        return $query->where('is_available', true);
    }
}
