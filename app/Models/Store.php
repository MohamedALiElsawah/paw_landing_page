<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ImageService;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'phone',
        'working_hours',
        'rating',
        'image',
        'logo',
        'is_active',
        'order'
    ];

    protected $casts = [
        'name' => 'array',
        'location' => 'array',
        'working_hours' => 'array',
        'is_active' => 'boolean',
        'rating' => 'decimal:1',
        'order' => 'integer'
    ];

    /**
     * Get the name in the current locale
     */
    public function getNameAttribute($value)
    {
        $name = json_decode($value, true);
        return $name[app()->getLocale()] ?? $name['en'] ?? '';
    }

    /**
     * Get the location in the current locale
     */
    public function getLocationAttribute($value)
    {
        $location = json_decode($value, true);
        return $location[app()->getLocale()] ?? $location['en'] ?? '';
    }

    /**
     * Get the working hours in the current locale
     */
    public function getWorkingHoursAttribute($value)
    {
        $hours = json_decode($value, true);
        return $hours[app()->getLocale()] ?? $hours['en'] ?? '';
    }

    /**
     * Relationship with reviews
     */
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
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
     * Get image URL for display
     */
    public function getImageUrlAttribute(): ?string
    {
        return ImageService::getImageUrl($this->attributes['image'] ?? null);
    }

    /**
     * Get logo URL for display
     */
    public function getLogoUrlAttribute(): ?string
    {
        return ImageService::getImageUrl($this->attributes['logo'] ?? null);
    }

    /**
     * Get the image path for storage
     */
    public function getImagePathAttribute(): ?string
    {
        return $this->attributes['image'] ?? null;
    }

    /**
     * Get the logo path for storage
     */
    public function getLogoPathAttribute(): ?string
    {
        return $this->attributes['logo'] ?? null;
    }
}
