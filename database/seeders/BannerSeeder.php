<?php

namespace Database\Seeders;

use App\Models\Banner;
use Database\Seeders\Concerns\HandlesSeedImages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    use HandlesSeedImages;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'title_en' => 'New pet profiles feature now available',
                'title_ar' => 'ميزة ملفات الحيوانات الأليفة الجديدة متاحة الآن',
                'description_en' => 'Discover amazing features for your pets',
                'description_ar' => 'اكتشف الميزات الرائعة لحيواناتك الأليفة',
                'image_url' => $this->seedImage('hero2.png', 'banners', 'image', 'hero2.png', 'banners'),
                'secondary_image_url' => $this->seedImage('banner_c.png', 'banners', 'image', 'hero2_secondary.png', 'banners'),
                'third_image_url' => $this->seedImage('hero2.png', 'banners', 'image', 'hero2_leo.png', 'banners'),
                'is_active' => true,
                'is_default' => true,
                'order' => 1,
                'button_text_en' => 'Learn More',
                'button_text_ar' => 'تعرف أكثر',
                'button_url' => '#'
            ],
            [
                'title_en' => 'Find the best pet clinics near you',
                'title_ar' => 'ابحث عن أفضل عيادات الحيوانات الأليفة بالقرب منك',
                'description_en' => 'Connect with trusted veterinarians and pet care specialists',
                'description_ar' => 'تواصل مع أطباء بيطريين موثوقين ومتخصصي رعاية الحيوانات الأليفة',
                'image_url' => $this->seedImage('hero3.png', 'banners', 'image', 'hero3.png', 'banners'),
                'secondary_image_url' => $this->seedImage('hero_cover.svg', 'banners', 'image', 'hero1_secondary.svg', 'banners'),
                'third_image_url' => $this->seedImage('hero2.png', 'banners', 'image', 'hero3_leo.png', 'banners'),
                'is_active' => true,
                'order' => 2,
                'button_text_en' => 'Find Clinics',
                'button_text_ar' => 'ابحث عن العيادات',
                'button_url' => '#clinics'
            ],
            [
                'title_en' => 'Shop premium pet products',
                'title_ar' => 'تسوق منتجات الحيوانات الأليفة المميزة',
                'description_en' => 'Get exclusive offers on food, toys, and accessories',
                'description_ar' => 'احصل على عروض حصرية على الطعام والألعاب والملحقات',
                'image_url' => $this->seedImage('hero1.png', 'banners', 'image', 'hero1.png', 'banners'),
                'secondary_image_url' => $this->seedImage('Top Image Container.png', 'banners', 'image', 'hero3_secondary.png', 'banners'),
                'third_image_url' => $this->seedImage('hero2.png', 'banners', 'image', 'hero1_leo.png', 'banners'),
                'is_active' => true,
                'order' => 3,
                'button_text_en' => 'Visit Store',
                'button_text_ar' => 'زيارة المتجر',
                'button_url' => '#store'
            ],
            [
                'title_en' => 'Meet Dr. Bo - Your AI Pet Assistant',
                'title_ar' => 'تعرف على دكتور بو - مساعدك الذكي للحيوانات الأليفة',
                'description_en' => 'Get instant answers to all your pet care questions',
                'description_ar' => 'احصل على إجابات فورية لجميع أسئلتك حول رعاية الحيوانات الأليفة',
                'image_url' => $this->seedImage('catBanner.png', 'banners', 'image', 'catBanner.png', 'banners'),
                'secondary_image_url' => $this->seedImage('Pawmic1 1.png', 'banners', 'image', 'catBanner_secondary.png', 'banners'),
                'third_image_url' => $this->seedImage('hero2.png', 'banners', 'image', 'catBanner_leo.png', 'banners'),
                'is_active' => true,
                'order' => 4,
                'button_text_en' => 'Talk to Dr. Bo',
                'button_text_ar' => 'تحدث مع دكتور بو',
                'button_url' => '#dr-bo'
            ],
        ];

        foreach ($banners as $bannerData) {
            Banner::create($bannerData);
        }

        $this->command->info('Banners seeded successfully!');
    }
}
