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
     * Get setting value by key
     */
    public static function getValue($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
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
