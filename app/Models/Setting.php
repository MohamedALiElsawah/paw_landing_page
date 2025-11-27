<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'description'
    ];

    /**
     * Get setting value by key with translation support
     */
    public static function getValue($key, $default = null, $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        $setting = static::where('key', $key)->first();

        if (!$setting) {
            return $default;
        }

        // If setting type is json, parse and return translated value
        if ($setting->type === 'json') {
            $translations = json_decode($setting->value, true);
            return $translations[$locale] ?? $translations['en'] ?? $default;
        }

        return $setting->value ?: $default;
    }

    /**
     * Set setting value by key
     */
    public static function setValue($key, $value, $type = 'text', $group = 'general', $description = null)
    {
        $setting = static::firstOrNew(['key' => $key]);
        $setting->value = $value;
        $setting->type = $type;
        $setting->group = $group;
        $setting->description = $description;
        $setting->save();
        return $setting;
    }

    /**
     * Get all settings grouped by group
     */
    public static function getGroupedSettings()
    {
        return static::all()->groupBy('group');
    }
}
