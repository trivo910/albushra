<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'package_reviews';

    protected $fillable = [
        'package_id',
        'reviewer_name',
        'reviewer_email',
        'rating',
        'title',
        'comment',
        'status',
    ];

    protected $casts = [
        'rating' => 'decimal:2',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeRejected(Builder $query): Builder
    {
        return $query->where('status', 'rejected');
    }

    public function author(): string
    {
        return $this->reviewer_name;
    }

    protected static function booted(): void
    {
        // Recalculate the package's rating whenever a review is created,
        // updated, or deleted so the cached aggregate stays in sync.
        static::created(function (Review $review) {
            $review->package?->recalculateRating();
        });

        static::updated(function (Review $review) {
            $review->package?->recalculateRating();
        });

        static::deleted(function (Review $review) {
            $review->package?->recalculateRating();
        });
    }
}
