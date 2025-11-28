<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'image_url',
        'is_active',
        'order',
        'button_text_en',
        'button_text_ar',
        'button_url'
    ];

    protected $casts = [
        'is_active' => 'boolean',
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
        return $value ?: asset('assets/images/hero2.png');
    }

    /**
     * Scope to get active banners ordered by order
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
