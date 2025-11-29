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
        // Build validation rules dynamically
        $validationRules = [
            'settings' => 'required|array',
            'multilingual_settings' => 'sometimes|array',
            'multilingual_settings.*' => 'sometimes|array',
            'multilingual_settings.*.en' => 'nullable|string',
            'multilingual_settings.*.ar' => 'nullable|string'
        ];

        // Add file validation for image type settings
        foreach ($request->all()['settings'] ?? [] as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($setting && $setting->type === 'image' && $request->hasFile("settings.{$key}")) {
                $validationRules["settings.{$key}"] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,bmp,ico|max:2048';
            } else {
                $validationRules["settings.{$key}"] = 'nullable|string';
            }
        }

        $validated = $request->validate($validationRules);

        // Update regular settings
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

        // Update multilingual settings
        if (isset($validated['multilingual_settings'])) {
            foreach ($validated['multilingual_settings'] as $key => $translations) {
                $setting = Setting::where('key', $key)->first();
                if ($setting) {
                    // Store translations as JSON
                    $setting->value = json_encode($translations);
                    $setting->is_multilingual = true;
                    $setting->save();
                }
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
                'description' => 'Website name',
                'is_multilingual' => true
            ],
            [
                'key' => 'site_description',
                'value' => 'Your trusted pet care companion',
                'type' => 'textarea',
                'group' => 'general',
                'description' => 'Website description',
                'is_multilingual' => true
            ],
            [
                'key' => 'site_logo',
                'value' => null,
                'type' => 'image',
                'group' => 'general',
                'description' => 'Website logo',
                'is_multilingual' => false
            ],

            // Contact Settings
            [
                'key' => 'phone_number',
                'value' => '+1 (555) 123-4567',
                'type' => 'phone',
                'group' => 'contact',
                'description' => 'Primary phone number',
                'is_multilingual' => false
            ],
            [
                'key' => 'email',
                'value' => 'info@pawapp.com',
                'type' => 'email',
                'group' => 'contact',
                'description' => 'Contact email',
                'is_multilingual' => false
            ],
            [
                'key' => 'address',
                'value' => '123 Pet Street, Animal City',
                'type' => 'textarea',
                'group' => 'contact',
                'description' => 'Business address',
                'is_multilingual' => true
            ],
            [
                'key' => 'working_hours',
                'value' => 'Mon-Fri: 9AM-6PM, Sat: 10AM-4PM',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Working hours',
                'is_multilingual' => true
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
            // Hero Section Settings
            [
                'key' => 'hero_title',
                'value' => 'All Your Pet Needs in One App',
                'type' => 'text',
                'group' => 'hero',
                'description' => 'Main hero section title',
                'is_multilingual' => true
            ],
            [
                'key' => 'hero_description',
                'value' => 'Complete pet care in your hands. Easily and quickly find everything using a single app.',
                'type' => 'textarea',
                'group' => 'hero',
                'description' => 'Hero section description',
                'is_multilingual' => true
            ],

            // Services Settings
            [
                'key' => 'services_description',
                'value' => 'Everything you need for complete pet care in one app',
                'type' => 'textarea',
                'group' => 'services',
                'description' => 'Services section description',
                'is_multilingual' => true
            ],

            // Store Settings
            [
                'key' => 'store_discount',
                'value' => '25% OFF',
                'type' => 'text',
                'group' => 'store',
                'description' => 'Store banner discount text',
                'is_multilingual' => false
            ],
            [
                'key' => 'store_banner_text',
                'value' => 'Visit the PawApp Store for exclusive offers!',
                'type' => 'text',
                'group' => 'store',
                'description' => 'Store banner main text',
                'is_multilingual' => true
            ],
            [
                'key' => 'delivery_info',
                'value' => 'Free delivery over $50',
                'type' => 'text',
                'group' => 'store',
                'description' => 'Delivery information',
                'is_multilingual' => true
            ],

            // Dr. Bo Settings
            [
                'key' => 'dr_bo_title',
                'value' => 'Meet Dr. Bo',
                'type' => 'text',
                'group' => 'dr_bo',
                'description' => 'Dr. Bo section title',
                'is_multilingual' => true
            ],
            [
                'key' => 'dr_bo_subtitle',
                'value' => 'Your smart AI assistant',
                'type' => 'text',
                'group' => 'dr_bo',
                'description' => 'Dr. Bo subtitle',
                'is_multilingual' => true
            ],
            [
                'key' => 'dr_bo_description',
                'value' => 'Ask me anything about pet health, nutrition, behavior...',
                'type' => 'textarea',
                'group' => 'dr_bo',
                'description' => 'Dr. Bo typing text',
                'is_multilingual' => true
            ],
            [
                'key' => 'dr_bo_status',
                'value' => 'Always here to help',
                'type' => 'text',
                'group' => 'dr_bo',
                'description' => 'Dr. Bo status text',
                'is_multilingual' => true
            ],
            [
                'key' => 'dr_bo_example_question',
                'value' => 'My dog isn\'t eating well today. Should I be worried?',
                'type' => 'textarea',
                'group' => 'dr_bo',
                'description' => 'Example question for Dr. Bo',
                'is_multilingual' => true
            ],
            [
                'key' => 'dr_bo_example_answer',
                'value' => 'Don\'t worry! It\'s normal for dogs to have occasional appetite changes. Monitor for 24 hours. If symptoms persist or worsen, consult a vet.',
                'type' => 'textarea',
                'group' => 'dr_bo',
                'description' => 'Example answer from Dr. Bo',
                'is_multilingual' => true
            ],

            // Pet Posts Settings
            [
                'key' => 'pet_posts_description',
                'value' => 'Browse stories, tips, and pet care content.',
                'type' => 'textarea',
                'group' => 'pet_posts',
                'description' => 'Pet posts section description',
                'is_multilingual' => true
            ],

            // Stats Settings
            [
                'key' => 'stats_rating',
                'value' => '4.9/5',
                'type' => 'text',
                'group' => 'stats',
                'description' => 'Average rating statistic',
                'is_multilingual' => false
            ],
            [
                'key' => 'stats_users',
                'value' => '10K+',
                'type' => 'text',
                'group' => 'stats',
                'description' => 'Happy users statistic',
                'is_multilingual' => false
            ],
            [
                'key' => 'stats_clinics',
                'value' => '500+',
                'type' => 'text',
                'group' => 'stats',
                'description' => 'Partner clinics statistic',
                'is_multilingual' => false
            ],
            [
                'key' => 'stats_support',
                'value' => '24/7',
                'type' => 'text',
                'group' => 'stats',
                'description' => 'Support availability statistic',
                'is_multilingual' => false
            ],

            // About Settings
            [
                'key' => 'about_intro',
                'value' => 'PawApp — where every pet finds care, love, and connection.',
                'type' => 'textarea',
                'group' => 'about',
                'description' => 'About us introduction',
                'is_multilingual' => true
            ],
            [
                'key' => 'about_description',
                'value' => 'We make pet care simple and smart — from finding trusted vets to shopping for essentials and chatting with our AI friend Dr. Bo.',
                'type' => 'textarea',
                'group' => 'about',
                'description' => 'About us description',
                'is_multilingual' => true
            ],
            [
                'key' => 'about_mission',
                'value' => 'Our goal is to create a better world for pets and their humans — because your pet deserves the best.',
                'type' => 'textarea',
                'group' => 'about',
                'description' => 'About us mission statement',
                'is_multilingual' => true
            ],
            [
                'key' => 'about_us_image',
                'value' => null,
                'type' => 'image',
                'group' => 'about',
                'description' => 'About us section image',
                'is_multilingual' => false
            ],

            // Footer Settings
            [
                'key' => 'footer_description',
                'value' => 'Your complete pet care companion. Everything your pet needs in one place.',
                'type' => 'textarea',
                'group' => 'footer',
                'description' => 'Footer description text',
                'is_multilingual' => true
            ],

            // Banner Settings
            [
                'key' => 'banner_title',
                'value' => 'Welcome to PawApp',
                'type' => 'text',
                'group' => 'banner',
                'description' => 'Banner title text',
                'is_multilingual' => true
            ],
            [
                'key' => 'banner_description',
                'value' => 'Discover amazing features for your pets',
                'type' => 'textarea',
                'group' => 'banner',
                'description' => 'Banner description text',
                'is_multilingual' => true
            ],

            // Contact Settings (additional)
            [
                'key' => 'contact_subtitle',
                'value' => 'Let\'s talk with us',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Contact section subtitle',
                'is_multilingual' => true
            ],
            [
                'key' => 'contact_description',
                'value' => 'Questions, comments, or suggestions? Simply fill in the form and we\'ll be in touch shortly.',
                'type' => 'textarea',
                'group' => 'contact',
                'description' => 'Contact section description',
                'is_multilingual' => true
            ],
            // Additional missing settings
            [
                'key' => 'top_header_text',
                'value' => 'Download PawApp Now - Your Complete Pet Care Companion',
                'type' => 'text',
                'group' => 'banner',
                'description' => 'Top header banner text',
                'is_multilingual' => true
            ],
            [
                'key' => 'clinics_button_text',
                'value' => 'Find Nearest Clinic',
                'type' => 'text',
                'group' => 'clinics',
                'description' => 'Clinics section button text',
                'is_multilingual' => true
            ],
            [
                'key' => 'dr_bo_button_text',
                'value' => 'Talk to Dr. Bo Now',
                'type' => 'text',
                'group' => 'dr_bo',
                'description' => 'Dr. Bo section button text',
                'is_multilingual' => true
            ],
            [
                'key' => 'dr_bo_typing_text',
                'value' => 'Ask Dr. Bo anything...',
                'type' => 'text',
                'group' => 'dr_bo',
                'description' => 'Dr. Bo typing indicator text',
                'is_multilingual' => true
            ],
            [
                'key' => 'store_button_text',
                'value' => 'Visit Store',
                'type' => 'text',
                'group' => 'store',
                'description' => 'Store section button text',
                'is_multilingual' => true
            ],
            [
                'key' => 'store_description',
                'value' => 'Discover the best pet stores with exclusive offers and quality products',
                'type' => 'textarea',
                'group' => 'store',
                'description' => 'Recommended stores section description',
                'is_multilingual' => true
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
