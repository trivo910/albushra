<?php

namespace App\Models;

use App\Support\MapEmbedSanitizer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'price',
        'duration',
        'tour_type',
        'group_size',
        'languages',
        'description',
        'included',
        'excluded',
        'map_embed',
        'rating',
        'rating_count',
        'is_featured',
        'thumbnail',
        'thumbnail_alt',
        'status',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'included' => 'array',
        'excluded' => 'array',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
        'rating' => 'decimal:2',
        'rating_count' => 'integer',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Package $package) {
            if (empty($package->slug)) {
                $package->slug = static::generateUniqueSlug($package->title);
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

    public function images(): HasMany
    {
        return $this->hasMany(PackageImage::class)->orderBy('sort_order');
    }

    public function enquiries(): HasMany
    {
        return $this->hasMany(Enquiry::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function approvedReviews(): HasMany
    {
        return $this->reviews()->approved();
    }

    public function recalculateRating(): void
    {
        $stats = $this->approvedReviews()->selectRaw('AVG(rating) as avg_rating, COUNT(*) as count')->first();

        $this->updateQuietly([
            'rating' => $stats->avg_rating ?? 0,
            'rating_count' => $stats->count ?? 0,
        ]);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function setDescriptionAttribute(?string $value): void
    {
        $this->attributes['description'] = $value === null ? null : Purifier::clean($value, 'content');
    }

    public function setMapEmbedAttribute(?string $value): void
    {
        $this->attributes['map_embed'] = MapEmbedSanitizer::sanitize($value);
    }
}
