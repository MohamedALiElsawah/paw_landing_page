<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ImageService;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'order',
        'is_active'
    ];

    protected $casts = [
        'name' => 'array',
        'is_active' => 'boolean'
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
     * Get translation for a specific field and locale
     */
    public function getTranslation($field, $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        $translations = json_decode($this->attributes[$field] ?? '{}', true);
        return $translations[$locale] ?? '';
    }

    /**
     * Get logo URL for display
     */
    public function getLogoUrlAttribute(): ?string
    {
        return ImageService::getImageUrl($this->attributes['logo'] ?? null);
    }

    /**
     * Get the logo path for storage
     */
    public function getLogoPathAttribute(): ?string
    {
        return $this->attributes['logo'] ?? null;
    }
}
