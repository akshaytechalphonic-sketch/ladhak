<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = [
        'page_id',
        'section_name',
        'title',
        'description',
        'image',
        'extra_data',
        'status',
    ];

    protected $casts = [
        'extra_data' => 'array',
        'status' => 'boolean',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
