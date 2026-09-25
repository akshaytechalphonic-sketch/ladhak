<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Room extends Model
{
    protected $fillable = [
        'hotel_id',
        'room_type',
        'slug',
        'price',
        'capacity',
        'is_available',
        'images',
        'size',
        'bed_type',
        'view_type',
        'description',
        'rate_plans',
        'inclusions',
        'exclusions',
    ];

    protected function casts(): array
    {
        return [
            'is_available' => 'boolean',
            'images'       => 'array',
            'price'        => 'decimal:2',
            'rate_plans'   => 'array',
            'inclusions'   => 'array',
            'exclusions'   => 'array',
        ];
    }

    // Use slug for route model binding
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted()
    {
        static::saving(function ($room) {
            if (empty($room->slug) || $room->isDirty('room_type')) {
                $room->slug = static::generateSlug($room->room_type, $room->id);
            }
        });
    }

    // Generate a unique slug from room_type
    public static function generateSlug(string $roomType, ?int $excludeId = null): string
    {
        $base = Str::slug($roomType ?: 'room');
        $slug = $base;
        $i = 1;
        while (
            static::where('slug', $slug)
                ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
