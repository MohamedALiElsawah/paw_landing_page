<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        $settings = Setting::getGroupedSettings();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable|string'
        ]);

        foreach ($validated['settings'] as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                // Handle file uploads for image type settings
                if ($setting->type === 'image' && $request->hasFile("settings.{$key}")) {
                    // Delete old image if exists
                    if ($setting->value && Storage::exists($setting->value)) {
                        Storage::delete($setting->value);
                    }

                    // Store new image
                    $path = $request->file("settings.{$key}")->store('settings', 'public');
                    $setting->value = $path;
                } else {
                    $setting->value = $value;
                }
                $setting->save();
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully!');
    }

    /**
     * Initialize default settings
     */
    public static function initializeDefaultSettings()
    {
        $defaultSettings = [
            // General Settings
            [
                'key' => 'site_name',
                'value' => 'PawApp',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Website name'
            ],
            [
                'key' => 'site_description',
                'value' => 'Your trusted pet care companion',
                'type' => 'textarea',
                'group' => 'general',
                'description' => 'Website description'
            ],
            [
                'key' => 'site_logo',
                'value' => null,
                'type' => 'image',
                'group' => 'general',
                'description' => 'Website logo'
            ],

            // Contact Settings
            [
                'key' => 'phone_number',
                'value' => '+1 (555) 123-4567',
                'type' => 'phone',
                'group' => 'contact',
                'description' => 'Primary phone number'
            ],
            [
                'key' => 'email',
                'value' => 'info@pawapp.com',
                'type' => 'email',
                'group' => 'contact',
                'description' => 'Contact email'
            ],
            [
                'key' => 'address',
                'value' => '123 Pet Street, Animal City',
                'type' => 'textarea',
                'group' => 'contact',
                'description' => 'Business address'
            ],
            [
                'key' => 'working_hours',
                'value' => 'Mon-Fri: 9AM-6PM, Sat: 10AM-4PM',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Working hours'
            ],

            // Social Media Settings
            [
                'key' => 'facebook_url',
                'value' => 'https://facebook.com/pawapp',
                'type' => 'url',
                'group' => 'social',
                'description' => 'Facebook page URL'
            ],
            [
                'key' => 'instagram_url',
                'value' => 'https://instagram.com/pawapp',
                'type' => 'url',
                'group' => 'social',
                'description' => 'Instagram profile URL'
            ],
            [
                'key' => 'twitter_url',
                'value' => 'https://twitter.com/pawapp',
                'type' => 'url',
                'group' => 'social',
                'description' => 'Twitter profile URL'
            ],
            [
                'key' => 'linkedin_url',
                'value' => 'https://linkedin.com/company/pawapp',
                'type' => 'url',
                'group' => 'social',
                'description' => 'LinkedIn company page URL'
            ],

            // SEO Settings
            [
                'key' => 'meta_title',
                'value' => 'PawApp - Pet Care Services',
                'type' => 'text',
                'group' => 'seo',
                'description' => 'Default meta title'
            ],
            [
                'key' => 'meta_description',
                'value' => 'Find the best pet care services, clinics, and stores near you.',
                'type' => 'textarea',
                'group' => 'seo',
                'description' => 'Default meta description'
            ],
            [
                'key' => 'meta_keywords',
                'value' => 'pet care, veterinary, pet stores, animal clinics',
                'type' => 'text',
                'group' => 'seo',
                'description' => 'Default meta keywords'
            ],
        ];

        foreach ($defaultSettings as $settingData) {
            Setting::firstOrCreate(
                ['key' => $settingData['key']],
                $settingData
            );
        }
    }
}
