<?php

namespace App\Models;

use App\Services\SeoAnalyzer;
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
        'featured_image_alt',
        'meta_title',
        'meta_description',
        'focus_keyword',
        'seo_score',
        'seo_score_label',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function (Page $page) {
            if (empty($page->slug)) {
                $page->slug = static::generateUniqueSlug($page->title);
            }

            $analysis = app(SeoAnalyzer::class)->analyze([
                'focus_keyword' => $page->focus_keyword,
                'title' => $page->title,
                'meta_title' => $page->meta_title,
                'meta_description' => $page->meta_description,
                'slug' => $page->slug,
                'content' => $page->content,
            ]);

            $page->seo_score = $analysis['score'];
            $page->seo_score_label = $analysis['label'];
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
