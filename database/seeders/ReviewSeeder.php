<?php

namespace Database\Seeders;

use App\Models\Review;
use Database\Seeders\Concerns\HandlesSeedImages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    use HandlesSeedImages;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            [
                'reviewer_name' => [
                    'en' => 'Sarah Mohammed',
                    'ar' => 'سارة محمد'
                ],
                'content' => [
                    'en' => 'PawApp has made pet care so much easier! I can find everything I need in one place. The Dr. Bo feature is amazing!',
                    'ar' => 'جعلت PawApp رعاية الحيوانات الأليفة أسهل بكثير! يمكنني العثور على كل ما أحتاجه في مكان واحد. ميزة دكتور بو رائعة!'
                ],
                'rating' => 5,
                'reviewer_image' => $this->seedImage('Image (Sarah Mohammed).png', 'reviews', 'reviewer_image', 'reviewer1.png'),
                'date' => 'January 2025',
                'reviewable_type' => 'App\\Models\\Service',
                'reviewable_id' => 1,
                'is_approved' => true,
            ],
            [
                'reviewer_name' => [
                    'en' => 'Ahmed Al-Rashid',
                    'ar' => 'أحمد الرشيد'
                ],
                'content' => [
                    'en' => 'The clinic finder saved my cat\'s life during an emergency. Fast, reliable, and easy to use. Highly recommend!',
                    'ar' => 'أنقذ مكتشف العيادات حياة قطتي خلال حالة طارئة. سريع وموثوق وسهل الاستخدام. أوصي بشدة!'
                ],
                'rating' => 5,
                'reviewer_image' => $this->seedImage('Image (Ahmed Al-Rashid).png', 'reviews', 'reviewer_image', 'reviewer2.png'),
                'date' => 'December 2024',
                'reviewable_type' => 'App\\Models\\Clinic',
                'reviewable_id' => 1,
                'is_approved' => true,
            ],
            [
                'reviewer_name' => [
                    'en' => 'Layla Hassan',
                    'ar' => 'ليلى حسن'
                ],
                'content' => [
                    'en' => 'Love the store! Great prices and fast delivery. My dog loves all the products I ordered. Thank you PawApp!',
                    'ar' => 'أحب المتجر! أسعار رائعة وتوصيل سريع. كلبي يحب جميع المنتجات التي طلبتها. شكراً PawApp!'
                ],
                'rating' => 5,
                'reviewer_image' => $this->seedImage('Image (Layla Hassan).png', 'reviews', 'reviewer_image', 'reviewer3.png'),
                'date' => 'January 2025',
                'reviewable_type' => 'App\\Models\\Store',
                'reviewable_id' => 1,
                'is_approved' => true,
            ],
            [
                'reviewer_name' => [
                    'en' => 'Mohammed Ali',
                    'ar' => 'محمد علي'
                ],
                'content' => [
                    'en' => 'Excellent service! The app helped me find the perfect vet for my sick bird. Very professional and caring.',
                    'ar' => 'خدمة ممتازة! ساعدني التطبيق في العثور على الطبيب البيطري المثالي لطائري المريض. محترفون ومهتمون جداً.'
                ],
                'rating' => 5,
                'reviewer_image' => $this->seedImage('team.png', 'reviews', 'reviewer_image', 'reviewer4.png'),
                'date' => 'February 2025',
                'reviewable_type' => 'App\\Models\\Clinic',
                'reviewable_id' => 2,
                'is_approved' => true,
            ],
            [
                'reviewer_name' => [
                    'en' => 'Fatima Ahmed',
                    'ar' => 'فاطمة أحمد'
                ],
                'content' => [
                    'en' => 'The pet posts are so informative! I learned so much about cat care. Keep up the great work!',
                    'ar' => 'منشورات الحيوانات الأليفة مفيدة جداً! تعلمت الكثير عن رعاية القطط. استمروا في العمل الرائع!'
                ],
                'rating' => 5,
                'reviewer_image' => $this->seedImage('hero1.png', 'reviews', 'reviewer_image', 'reviewer5.png'),
                'date' => 'January 2025',
                'reviewable_type' => 'App\\Models\\PetPost',
                'reviewable_id' => 1,
                'is_approved' => true,
            ],
            [
                'reviewer_name' => [
                    'en' => 'Khalid Omar',
                    'ar' => 'خالد عمر'
                ],
                'content' => [
                    'en' => 'Fast delivery and great quality products. My dog loves the new toys I ordered. Will definitely shop again!',
                    'ar' => 'توصيل سريع ومنتجات عالية الجودة. كلبي يحب الألعاب الجديدة التي طلبتها. سأتسوق بالتأكيد مرة أخرى!'
                ],
                'rating' => 5,
                'reviewer_image' => $this->seedImage('hero2.png', 'reviews', 'reviewer_image', 'reviewer6.png'),
                'date' => 'March 2025',
                'reviewable_type' => 'App\\Models\\Store',
                'reviewable_id' => 3,
                'is_approved' => true,
            ],
            [
                'reviewer_name' => [
                    'en' => 'Noura Abdullah',
                    'ar' => 'نورة عبدالله'
                ],
                'content' => [
                    'en' => 'The emergency clinic service was incredible! They saved my puppy within minutes. Thank you PawApp!',
                    'ar' => 'خدمة العيادة الطارئة كانت مذهلة! أنقذوا جروي خلال دقائق. شكراً PawApp!'
                ],
                'rating' => 5,
                'reviewer_image' => $this->seedImage('hero3.png', 'reviews', 'reviewer_image', 'reviewer7.png'),
                'date' => 'April 2025',
                'reviewable_type' => 'App\\Models\\Clinic',
                'reviewable_id' => 3,
                'is_approved' => true,
            ],
            [
                'reviewer_name' => [
                    'en' => 'Omar Hassan',
                    'ar' => 'عمر حسن'
                ],
                'content' => [
                    'en' => 'Dr. Bo is a game-changer! The AI assistant helped me understand my cat\'s behavior better.',
                    'ar' => 'دكتور بو يغير قواعد اللعبة! ساعدني المساعد الذكي في فهم سلوك قطتي بشكل أفضل.'
                ],
                'rating' => 5,
                'reviewer_image' => $this->seedImage('banner_c.png', 'reviews', 'reviewer_image', 'reviewer8.png'),
                'date' => 'March 2025',
                'reviewable_type' => 'App\\Models\\Service',
                'reviewable_id' => 4,
                'is_approved' => true,
            ],
        ];

        foreach ($reviews as $review) {
            // Encode multilingual fields to JSON
            $review['reviewer_name'] = json_encode($review['reviewer_name']);
            $review['content'] = json_encode($review['content']);
            Review::create($review);
        }
    }
}
