<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
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
                'reviewer_image' => null,
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
                'reviewer_image' => null,
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
                'reviewer_image' => null,
                'date' => 'January 2025',
                'reviewable_type' => 'App\\Models\\Store',
                'reviewable_id' => 1,
                'is_approved' => true,
            ],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
