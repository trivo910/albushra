<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'featured_image',
        'meta_title',
        'meta_description',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Page $page) {
            if (empty($page->slug)) {
                $page->slug = static::generateUniqueSlug($page->title);
            }
        });
    }

    public static function generateUniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $i = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        return $slug;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function setContentAttribute(?string $value): void
    {
        $this->attributes['content'] = $value === null ? null : Purifier::clean($value, 'content');
    }
}
