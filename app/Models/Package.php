<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Package extends Model
{
    protected $fillable = [
        'destination_id',
        'service_id',
        'title',
        'slug',
        'duration',
        'price',
        'start_location',
        'difficulty',
        'best_season',
        'description',
        'inclusions',
        'exclusions',
        'itinerary',
        'images',
        'status',
        'featured',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected function casts(): array
    {
        return [
            'inclusions' => 'array',
            'exclusions' => 'array',
            'itinerary'  => 'array',
            'images'      => 'array',
            'status'      => 'boolean',
            'featured'    => 'boolean',
            'price'       => 'decimal:2',
        ];
    }

    public static function generateSlug($title)
    {
        $slug = Str::slug($title);
        $count = self::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function enquiries()
    {
        return $this->hasMany(Enquiry::class);
    }
}
