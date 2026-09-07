<?php

namespace App\Models;

use App\Support\MapEmbedSanitizer;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'site_logo',
        'phone',
        'phone_secondary',
        'landline_1',
        'landline_2',
        'email',
        'address',
        'branch_address',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'youtube_url',
        'linkedin_url',
        'whatsapp_number',
        'whatsapp_greeting',
        'ga_code',
        'gtm_code',
        'meta_title',
        'meta_description',
        'map_embed',
    ];

    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }

    public function setMapEmbedAttribute(?string $value): void
    {
        $this->attributes['map_embed'] = MapEmbedSanitizer::sanitize($value);
    }
}
