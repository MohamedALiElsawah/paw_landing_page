<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TranslationService
{
    /**
     * Translate text from English to Arabic
     */
    public static function translateToArabic(string $text): string
    {
        try {
            // For production, you would use a proper translation API like Google Translate
            // For now, we'll use a simple mapping for common terms and fallback to the text

            $commonTranslations = [
                'Clinics' => 'العيادات',
                'Pet Posts' => 'منشورات الحيوانات الأليفة',
                'Store' => 'المتجر',
                'Dr. Bo' => 'دكتور بو',
                'Find trusted veterinary clinics near you' => 'ابحث عن عيادات بيطرية موثوقة بالقرب منك',
                'Browse stories, tips, and pet care content' => 'تصفح القصص والنصائح ومحتوى رعاية الحيوانات الأليفة',
                'Shop for pet food, toys, and accessories' => 'تسوق طعام الحيوانات الأليفة والألعاب والاكسسوارات',
                'Your smart AI assistant for pet care' => 'مساعدك الذكي بالذكاء الاصطناعي للعناية بالحيوانات الأليفة',
                'HQ Clinic' => 'عيادة المقر الرئيسي',
                'Haiat Clinic' => 'عيادة الهيئة',
                'Pet Zone Clinic' => 'عيادة منطقة الحيوانات الأليفة',
                'Salmiya' => 'السالمية',
                'Jahraa' => 'الجهراء',
                'Hawalli' => 'حولي',
                'Open 24/7' => 'مفتوح 24/7',
                '8 AM - 10 PM' => '8 صباحاً - 10 مساءً',
                '9 AM - 9 PM' => '9 صباحاً - 9 مساءً',
                'PetFood' => 'بيت فود',
                'Heartwarming Adoption Story' => 'قصة تبني مؤثرة',
                'Essential Grooming Tips' => 'نصائح أساسية للعناية',
                'Top-Rated Clinic Spotlight' => 'تسليط الضوء على العيادة الأعلى تقييماً',
                'Meet Bella, a rescued pup who found her forever home and brought joy to her new family.' => 'تعرف على بيلا، جرو تم إنقاذه وجد منزله الدائم وجلب السعادة لعائلته الجديدة.',
                'Keep your pet looking and feeling great with these simple at-home grooming routines.' => 'حافظ على مظهر حيوانك الأليف وشعوره بالراحة مع هذه الروتينات البسيطة للعناية في المنزل.',
                'Discover our featured veterinary clinic offering exceptional care and emergency services.' => 'اكتشف عيادتنا البيطرية المميزة التي تقدم رعاية استثنائية وخدمات الطوارئ.',
                'Sarah Mohammed' => 'سارة محمد',
                'Ahmed Al-Rashid' => 'أحمد الرشيد',
                'Layla Hassan' => 'ليلى حسن',
                'PawApp has made pet care so much easier! I can find everything I need in one place. The Dr. Bo feature is amazing!' => 'جعلت PawApp رعاية الحيوانات الأليفة أسهل بكثير! يمكنني العثور على كل ما أحتاجه في مكان واحد. ميزة دكتور بو رائعة!',
                'The clinic finder saved my cat\'s life during an emergency. Fast, reliable, and easy to use. Highly recommend!' => 'أنقذ مكتشف العيادات حياة قطتي خلال حالة طارئة. سريع وموثوق وسهل الاستخدام. أوصي بشدة!',
                'Love the store! Great prices and fast delivery. My dog loves all the products I ordered. Thank you PawApp!' => 'أحب المتجر! أسعار رائعة وتوصيل سريع. كلبي يحب جميع المنتجات التي طلبتها. شكراً PawApp!',
                'Partner 1' => 'الشريك 1',
                'Partner 2' => 'الشريك 2',
                'Partner 3' => 'الشريك 3',
                'Partner 4' => 'الشريك 4',
                'Partner 5' => 'الشريك 5',
                'Partner 6' => 'الشريك 6',
                'Partner 7' => 'الشريك 7',
                'Partner 8' => 'الشريك 8',
            ];

            return $commonTranslations[$text] ?? $text;

            // Uncomment for production with Google Translate API
            /*
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://translation.googleapis.com/language/translate/v2', [
                'q' => $text,
                'target' => 'ar',
                'key' => config('services.google.translate_key'),
            ]);

            if ($response->successful()) {
                return $response->json('data.translations.0.translatedText');
            }
            */
        } catch (\Exception $e) {
            Log::error('Translation failed: ' . $e->getMessage());
            return $text; // Return original text if translation fails
        }
    }

    /**
     * Ensure Arabic translations exist for a model
     */
    public static function ensureArabicTranslations($model, array $translatableFields)
    {
        $translations = [];

        foreach ($translatableFields as $field) {
            $currentValue = $model->getAttribute($field);

            if (is_array($currentValue)) {
                // If already has translations, ensure Arabic exists
                if (!isset($currentValue['ar']) || empty($currentValue['ar'])) {
                    $currentValue['ar'] = self::translateToArabic($currentValue['en'] ?? '');
                }
            } else {
                // If single value, assume it's English and create translations
                $currentValue = [
                    'en' => $currentValue,
                    'ar' => self::translateToArabic($currentValue)
                ];
            }

            $translations[$field] = $currentValue;
        }

        return $translations;
    }

    /**
     * Check if Arabic translations are missing and seed them
     */
    public static function seedMissingArabicTranslations()
    {
        $models = [
            \App\Models\Service::class => ['name', 'description'],
            \App\Models\Clinic::class => ['name', 'location', 'working_hours'],
            \App\Models\Store::class => ['name', 'location', 'working_hours'],
            \App\Models\PetPost::class => ['title', 'content'],
            \App\Models\Review::class => ['reviewer_name', 'content'],
            \App\Models\Partner::class => ['name'],
        ];

        foreach ($models as $modelClass => $translatableFields) {
            $records = $modelClass::all();

            foreach ($records as $record) {
                $needsUpdate = false;
                $updates = [];

                foreach ($translatableFields as $field) {
                    $currentValue = $record->getAttribute($field);

                    if (is_array($currentValue)) {
                        // Check if Arabic translation is missing or empty
                        if (!isset($currentValue['ar']) || empty($currentValue['ar'])) {
                            $currentValue['ar'] = self::translateToArabic($currentValue['en'] ?? '');
                            $updates[$field] = $currentValue;
                            $needsUpdate = true;
                        }
                    } else {
                        // Convert single value to multilingual
                        $updates[$field] = [
                            'en' => $currentValue,
                            'ar' => self::translateToArabic($currentValue)
                        ];
                        $needsUpdate = true;
                    }
                }

                if ($needsUpdate) {
                    $record->update($updates);
                    Log::info("Updated Arabic translations for {$modelClass} ID: {$record->id}");
                }
            }
        }
    }
}
