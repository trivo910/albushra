<?php

namespace App\Models;

use App\Services\SeoAnalyzer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'featured_image',
        'featured_image_alt',
        'content',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'focus_keyword',
        'seo_score',
        'seo_score_label',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function (Blog $blog) {
            if (empty($blog->slug)) {
                $blog->slug = static::generateUniqueSlug($blog->title);
            }

            $analysis = app(SeoAnalyzer::class)->analyze([
                'focus_keyword' => $blog->focus_keyword,
                'title' => $blog->title,
                'meta_title' => $blog->meta_title,
                'meta_description' => $blog->meta_description,
                'slug' => $blog->slug,
                'content' => $blog->content,
            ]);

            $blog->seo_score = $analysis['score'];
            $blog->seo_score_label = $analysis['label'];
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

    /**
     * Strip anything not on the rich-text allow-list (scripts, iframes,
     * event handlers, javascript: URIs, ...) so a compromised admin
     * account can't use this field to inject stored XSS into the site.
     */
    public function setContentAttribute(?string $value): void
    {
        $this->attributes['content'] = $value === null ? null : Purifier::clean($value, 'content');
    }
}
