<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => [
                    'en' => 'Clinics',
                    'ar' => 'العيادات'
                ],
                'description' => [
                    'en' => 'Find trusted veterinary clinics near you',
                    'ar' => 'ابحث عن عيادات بيطرية موثوقة بالقرب منك'
                ],
                'icon' => 'fas fa-clinic-medical',
                'slug' => 'clinics',
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Pet Posts',
                    'ar' => 'منشورات الحيوانات الأليفة'
                ],
                'description' => [
                    'en' => 'Browse stories, tips, and pet care content',
                    'ar' => 'تصفح القصص والنصائح ومحتوى رعاية الحيوانات الأليفة'
                ],
                'icon' => 'fas fa-images',
                'slug' => 'pet-posts',
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Store',
                    'ar' => 'المتجر'
                ],
                'description' => [
                    'en' => 'Shop for pet food, toys, and accessories',
                    'ar' => 'تسوق طعام الحيوانات الأليفة والألعاب والاكسسوارات'
                ],
                'icon' => 'fas fa-store',
                'slug' => 'store',
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Dr. Bo',
                    'ar' => 'دكتور بو'
                ],
                'description' => [
                    'en' => 'Your smart AI assistant for pet care',
                    'ar' => 'مساعدك الذكي بالذكاء الاصطناعي للعناية بالحيوانات الأليفة'
                ],
                'icon' => 'fas fa-robot',
                'slug' => 'dr-bo',
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
