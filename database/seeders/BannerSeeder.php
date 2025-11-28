<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'title_en' => 'New Pet Profiles Feature Now Available',
                'title_ar' => 'ميزة ملفات الحيوانات الأليفة الجديدة متاحة الآن',
                'description_en' => 'Create detailed profiles for your pets with photos, medical history, and preferences',
                'description_ar' => 'أنشئ ملفات تفصيلية لحيواناتك الأليفة مع الصور والتاريخ الطبي والتفضيلات',
                'image_url' => null,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title_en' => 'Welcome Our New Partner Clinic: Happy Vet',
                'title_ar' => 'مرحباً بعيادتنا الشريكة الجديدة: هابي فيت',
                'description_en' => 'Now serving pets with premium veterinary care and emergency services',
                'description_ar' => 'تخدم الآن الحيوانات الأليفة برعاية بيطرية متميزة وخدمات الطوارئ',
                'image_url' => null,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title_en' => '25% OFF PawApp Store Products This Week',
                'title_ar' => 'خصم 25% على منتجات متجر PawApp هذا الأسبوع',
                'description_en' => 'Get amazing discounts on pet food, toys, and accessories. Limited time offer!',
                'description_ar' => 'احصل على خصومات مذهلة على طعام الحيوانات الأليفة والألعاب والملحقات. عرض لفترة محدودة!',
                'image_url' => null,
                'is_active' => true,
                'order' => 3,
            ],
        ];

        foreach ($banners as $bannerData) {
            Banner::create($bannerData);
        }

        $this->command->info('Banners seeded successfully!');
    }
}
