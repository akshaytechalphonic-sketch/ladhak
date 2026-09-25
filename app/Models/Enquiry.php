<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'is_responded',
        'package_id',
        'travel_date',
        'adults',
        'children',
    ];

    protected function casts(): array
    {
        return [
            'is_responded' => 'boolean',
            'travel_date' => 'date',
            'adults' => 'integer',
            'children' => 'integer',
        ];
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
