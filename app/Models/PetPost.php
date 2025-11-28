<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ImageService;

class PetPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'slug',
        'is_published',
        'published_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime'
    ];

    /**
     * Get the title in the current locale
     */
    public function getTitleAttribute($value)
    {
        if (is_array($value)) {
            return $value[app()->getLocale()] ?? $value['en'] ?? '';
        }

        $title = json_decode($value, true);
        return $title[app()->getLocale()] ?? $title['en'] ?? '';
    }

    /**
     * Get the content in the current locale
     */
    public function getContentAttribute($value)
    {
        if (is_array($value)) {
            return $value[app()->getLocale()] ?? $value['en'] ?? '';
        }

        $content = json_decode($value, true);
        return $content[app()->getLocale()] ?? $content['en'] ?? '';
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
     * Get the image path for storage
     */
    public function getImagePathAttribute(): ?string
    {
        return $this->attributes['image'] ?? null;
    }
}
