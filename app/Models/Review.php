<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ImageService;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'reviewer_name',
        'content',
        'rating',
        'reviewer_image',
        'date',
        'reviewable_type',
        'reviewable_id',
        'is_approved'
    ];

    protected $casts = [
        'reviewer_name' => 'array',
        'content' => 'array',
        'is_approved' => 'boolean'
    ];

    /**
     * Get the reviewer name in the current locale
     */
    public function getReviewerNameAttribute($value)
    {
        $name = json_decode($value, true);
        return $name[app()->getLocale()] ?? $name['en'] ?? '';
    }

    /**
     * Get the content in the current locale
     */
    public function getContentAttribute($value)
    {
        $content = json_decode($value, true);
        return $content[app()->getLocale()] ?? $content['en'] ?? '';
    }

    /**
     * Get the parent reviewable model (clinic, store, or service)
     */
    public function reviewable()
    {
        return $this->morphTo();
    }

    /**
     * Get translation for a specific field and locale
     */
    public function getTranslation($field, $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        $translations = json_decode($this->attributes[$field] ?? '{}', true);
        return $translations[$locale] ?? '';
    }

    /**
     * Get reviewer image URL for display
     */
    public function getReviewerImageUrlAttribute(): ?string
    {
        return ImageService::getImageUrl($this->attributes['reviewer_image'] ?? null);
    }

    /**
     * Get the reviewer image path for storage
     */
    public function getReviewerImagePathAttribute(): ?string
    {
        return $this->attributes['reviewer_image'] ?? null;
    }
}
