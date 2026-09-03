<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'phone',
        'phone_secondary',
        'email',
        'address',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'youtube_url',
        'linkedin_url',
        'whatsapp_number',
        'whatsapp_greeting',
        'ga_code',
        'gtm_code',
        'hero_image_1',
        'hero_image_2',
        'hero_image_3',
        'meta_title',
        'meta_description',
        'map_embed',
    ];

    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
