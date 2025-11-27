<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomePageSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Banner Settings
            [
                'key' => 'banner_text',
                'value' => json_encode([
                    'en' => 'New pet profiles feature now available',
                    'ar' => 'ميزة ملفات الحيوانات الأليفة الجديدة متاحة الآن'
                ]),
                'type' => 'json',
                'group' => 'banner',
                'description' => 'Text displayed in the dynamic banner'
            ],

            // Hero Section Settings
            [
                'key' => 'hero_title',
                'value' => json_encode([
                    'en' => 'All Your Pet Needs in One App',
                    'ar' => 'كل احتياجات حيوانك الأليف في تطبيق واحد'
                ]),
                'type' => 'json',
                'group' => 'hero',
                'description' => 'Main hero title'
            ],
            [
                'key' => 'hero_description',
                'value' => json_encode([
                    'en' => 'Complete pet care in your hands. Easily and quickly find everything using a single app.',
                    'ar' => 'رعاية حيوانك الأليف الكاملة بين يديك. ابحث بسهولة وسرعة عن كل شيء باستخدام تطبيق واحد.'
                ]),
                'type' => 'json',
                'group' => 'hero',
                'description' => 'Hero section description'
            ],

            // Services Section Settings
            [
                'key' => 'services_description',
                'value' => json_encode([
                    'en' => 'Everything you need for complete pet care in one app',
                    'ar' => 'كل ما تحتاجه للعناية الكاملة بحيوانك الأليف في تطبيق واحد'
                ]),
                'type' => 'json',
                'group' => 'services',
                'description' => 'Services section description'
            ],

            // Store Banner Settings
            [
                'key' => 'store_discount',
                'value' => json_encode([
                    'en' => '25% OFF',
                    'ar' => 'خصم 25%'
                ]),
                'type' => 'json',
                'group' => 'store',
                'description' => 'Store discount badge text'
            ],
            [
                'key' => 'store_banner_text',
                'value' => json_encode([
                    'en' => 'Visit the PawApp Store for exclusive offers!',
                    'ar' => 'زر متجر PawApp للحصول على عروض حصرية!'
                ]),
                'type' => 'json',
                'group' => 'store',
                'description' => 'Store banner text'
            ],

            // Delivery Info
            [
                'key' => 'delivery_info',
                'value' => json_encode([
                    'en' => 'Free delivery over $50',
                    'ar' => 'توصيل مجاني للطلبات فوق 50 دولار'
                ]),
                'type' => 'json',
                'group' => 'store',
                'description' => 'Delivery information text'
            ],

            // Dr. Bo Section Settings
            [
                'key' => 'dr_bo_title',
                'value' => json_encode([
                    'en' => 'Meet Dr. Bo',
                    'ar' => 'تعرف على دكتور بو'
                ]),
                'type' => 'json',
                'group' => 'dr_bo',
                'description' => 'Dr. Bo section title'
            ],
            [
                'key' => 'dr_bo_subtitle',
                'value' => json_encode([
                    'en' => 'Your smart AI assistant',
                    'ar' => 'مساعدك الذكي بالذكاء الاصطناعي'
                ]),
                'type' => 'json',
                'group' => 'dr_bo',
                'description' => 'Dr. Bo subtitle'
            ],
            [
                'key' => 'dr_bo_description',
                'value' => json_encode([
                    'en' => 'Ask me anything about pet health, nutrition, behavior...',
                    'ar' => 'اسألني أي شيء عن صحة الحيوانات الأليفة، التغذية، السلوك...'
                ]),
                'type' => 'json',
                'group' => 'dr_bo',
                'description' => 'Dr. Bo description text'
            ],
            [
                'key' => 'dr_bo_status',
                'value' => json_encode([
                    'en' => 'Always here to help',
                    'ar' => 'دائماً هنا للمساعدة'
                ]),
                'type' => 'json',
                'group' => 'dr_bo',
                'description' => 'Dr. Bo status text'
            ],
            [
                'key' => 'dr_bo_example_question',
                'value' => json_encode([
                    'en' => 'My dog isn\'t eating well today. Should I be worried?',
                    'ar' => 'كلبي لا يأكل جيداً اليوم. هل يجب أن أقلق؟'
                ]),
                'type' => 'json',
                'group' => 'dr_bo',
                'description' => 'Example question for Dr. Bo chat'
            ],
            [
                'key' => 'dr_bo_example_answer',
                'value' => json_encode([
                    'en' => 'Don\'t worry! It\'s normal for dogs to have occasional appetite changes. Monitor for 24 hours. If symptoms persist or worsen, consult a vet.',
                    'ar' => 'لا تقلق! من الطبيعي أن تتغير شهية الكلاب أحياناً. راقب لمدة 24 ساعة. إذا استمرت الأعراض أو ساءت، استشر طبيباً بيطرياً.'
                ]),
                'type' => 'json',
                'group' => 'dr_bo',
                'description' => 'Example answer for Dr. Bo chat'
            ],

            // Pet Posts Settings
            [
                'key' => 'pet_posts_description',
                'value' => json_encode([
                    'en' => 'Browse stories, tips, and pet care content.',
                    'ar' => 'تصفح القصص، النصائح، ومحتوى العناية بالحيوانات الأليفة.'
                ]),
                'type' => 'json',
                'group' => 'pet_posts',
                'description' => 'Pet posts section description'
            ],

            // Stats Section Settings (keep as text since they're numbers/symbols)
            [
                'key' => 'stats_rating',
                'value' => '4.9/5',
                'type' => 'text',
                'group' => 'stats',
                'description' => 'Average rating statistic'
            ],
            [
                'key' => 'stats_users',
                'value' => '10K+',
                'type' => 'text',
                'group' => 'stats',
                'description' => 'Users statistic'
            ],
            [
                'key' => 'stats_clinics',
                'value' => '500+',
                'type' => 'text',
                'group' => 'stats',
                'description' => 'Clinics statistic'
            ],
            [
                'key' => 'stats_support',
                'value' => '24/7',
                'type' => 'text',
                'group' => 'stats',
                'description' => 'Support statistic'
            ],

            // About Us Settings
            [
                'key' => 'about_intro',
                'value' => json_encode([
                    'en' => 'PawApp — where every pet finds care, love, and connection.',
                    'ar' => 'PawApp — حيث يجد كل حيوان أليف الرعاية، الحب، والاتصال.'
                ]),
                'type' => 'json',
                'group' => 'about',
                'description' => 'About us introduction'
            ],
            [
                'key' => 'about_description',
                'value' => json_encode([
                    'en' => 'We make pet care simple and smart — from finding trusted vets to shopping for essentials and chatting with our AI friend Dr. Bo.',
                    'ar' => 'نجعل العناية بالحيوانات الأليفة بسيطة وذكية — من العثور على أطباء بيطريين موثوقين إلى التسوق للضروريات والدردشة مع صديقنا الذكي دكتور بو.'
                ]),
                'type' => 'json',
                'group' => 'about',
                'description' => 'About us description'
            ],
            [
                'key' => 'about_mission',
                'value' => json_encode([
                    'en' => 'Our goal is to create a better world for pets and their humans — because your pet deserves the best.',
                    'ar' => 'هدفنا هو خلق عالم أفضل للحيوانات الأليفة وأصحابها — لأن حيوانك الأليف يستحق الأفضل.'
                ]),
                'type' => 'json',
                'group' => 'about',
                'description' => 'About us mission statement'
            ],

            // Contact Section Settings
            [
                'key' => 'contact_subtitle',
                'value' => json_encode([
                    'en' => 'Let\'s talk with us',
                    'ar' => 'دعنا نتحدث معنا'
                ]),
                'type' => 'json',
                'group' => 'contact',
                'description' => 'Contact section subtitle'
            ],
            [
                'key' => 'contact_description',
                'value' => json_encode([
                    'en' => 'Questions, comments, or suggestions? Simply fill in the form and we\'ll be in touch shortly.',
                    'ar' => 'أسئلة، تعليقات، أو اقتراحات؟ ببساطة املأ النموذج وسنتواصل معك قريباً.'
                ]),
                'type' => 'json',
                'group' => 'contact',
                'description' => 'Contact section description'
            ],

            // Footer Settings
            [
                'key' => 'footer_description',
                'value' => json_encode([
                    'en' => 'Your complete pet care companion. Everything your pet needs in one place.',
                    'ar' => 'رفيقك الكامل في العناية بالحيوانات الأليفة. كل ما يحتاجه حيوانك الأليف في مكان واحد.'
                ]),
                'type' => 'json',
                'group' => 'footer',
                'description' => 'Footer description text'
            ],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
