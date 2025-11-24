<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'slug',
        'is_active'
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
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
     * Get the description in the current locale
     */
    public function getDescriptionAttribute($value)
    {
        $description = json_decode($value, true);
        return $description[app()->getLocale()] ?? $description['en'] ?? '';
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
