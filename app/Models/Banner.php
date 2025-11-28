<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    protected $fillable = [
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'image_url',
        'secondary_image_url',
        'third_image_url',
        'is_active',
        'is_default',
        'order',
        'button_text_en',
        'button_text_ar',
        'button_url'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
        'order' => 'integer'
    ];

    /**
     * Get localized title based on current locale
     */
    public function getTitleAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"title_{$locale}"} ?: $this->title_en;
    }

    /**
     * Get localized description based on current locale
     */
    public function getDescriptionAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"description_{$locale}"} ?: $this->description_en;
    }

    /**
     * Get localized button text based on current locale
     */
    public function getButtonTextAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"button_text_{$locale}"} ?: $this->button_text_en;
    }

    /**
     * Get the actual image URL or fallback to default hero2.png
     */
    public function getImageUrlAttribute($value)
    {
        return $this->resolveBannerImageUrl($value) ?? asset('assets/images/hero2.png');
    }

    /**
     * Get the secondary image URL or null
     */
    public function getSecondaryImageUrlAttribute($value)
    {
        return $this->resolveBannerImageUrl($value);
    }

    /**
     * Get the third image URL or fallback to default hero2.png
     */
    public function getThirdImageUrlAttribute($value)
    {
        return $this->resolveBannerImageUrl($value) ?? asset('assets/images/hero2.png');
    }

    private function resolveBannerImageUrl(?string $value): ?string
    {
        if (!$value) {
            return null;
        }

        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }

        if (str_contains($value, 'banners/')) {
            if (Storage::disk('public')->exists($value)) {
                return Storage::url($value);
            }

            return asset('assets/images/' . basename($value));
        }

        if (Storage::disk('public')->exists('banners/' . $value)) {
            return Storage::url('banners/' . $value);
        }

        return asset('assets/images/' . $value);
    }

    /**
     * Scope to get active banners ordered by order
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    /**
     * Scope to get default banner
     */
    public function scopeDefault($query)
    {
        return $query->where('is_default', true)->where('is_active', true);
    }
}
