<?php

namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name',
        'location',
        'slug',
        'destination_id',
        'description',
        'amenities',
        'images',
        'star_rating',
        'managed_by',
        'usps',
        'landmarks',
        'airports',
        'attractions',
        'map_embed_url',
    ];
    
    protected function casts(): array
    {
        return [
            'amenities'   => 'array',
            'images'      => 'array',
            'usps'        => 'array',
            'landmarks'   => 'array',
            'airports'    => 'array',
            'attractions' => 'array',
        ];
    }

     public static function generateSlug($name)
    {
        $slug = Str::slug($name);
        $count = self::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function destination(){
        return $this->belongsTo(Destination::class,'destination_id','id');
    }
}

