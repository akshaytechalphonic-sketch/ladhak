<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'site_tagline',
        'site_logo',
        'site_favicon',
        'site_signature',
        'contact_email',
        'contact_phone',
        'phone_two',
        'whatsapp_number',
        'address',
        'google_map_link',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'youtube_url',
        'seo_meta_title',
        'seo_meta_description',
        'seo_meta_keywords',
        'copyright_text',
    ];
}
