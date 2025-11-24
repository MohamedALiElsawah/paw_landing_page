<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'title' => 'array',
        'content' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime'
    ];

    /**
     * Get the title in the current locale
     */
    public function getTitleAttribute($value)
    {
        $title = json_decode($value, true);
        return $title[app()->getLocale()] ?? $title['en'] ?? '';
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
     * Get translation for a specific field and locale
     */
    public function getTranslation($field, $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        $translations = json_decode($this->attributes[$field] ?? '{}', true);
        return $translations[$locale] ?? '';
    }
}
