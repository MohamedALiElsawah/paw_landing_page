<?php

namespace Database\Seeders;

use App\Models\Partner;
use Database\Seeders\Concerns\HandlesSeedImages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    use HandlesSeedImages;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name' => [
                    'en' => 'Happy Vet Clinic',
                    'ar' => 'عيادة هابي فيت'
                ],
                'logo' => 'images/partners/image/Partner logo-1.png',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Pet Paradise Store',
                    'ar' => 'متجر جنة الحيوانات الأليفة'
                ],
                'logo' => 'images/partners/image/Partner logo-2.png',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Animal Kingdom',
                    'ar' => 'مملكة الحيوانات'
                ],
                'logo' => 'images/partners/image/Partner logo-3.png',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Pet Care Plus',
                    'ar' => 'بيت كير بلس'
                ],
                'logo' => 'images/partners/image/Partner logo-4.png',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Vet Express',
                    'ar' => 'فيت إكسبريس'
                ],
                'logo' => 'images/partners/image/Partner logo-5.png',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Pet Food Kuwait',
                    'ar' => 'بيت فود الكويت'
                ],
                'logo' => 'images/partners/image/Partner logo-6.png',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Animal Health Center',
                    'ar' => 'مركز صحة الحيوان'
                ],
                'logo' => 'images/partners/image/Partner logo-7.png',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Pet Grooming Experts',
                    'ar' => 'خبراء العناية بالحيوانات الأليفة'
                ],
                'logo' => 'images/partners/image/Partner logo-8.png',
                'order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($partners as $partner) {
            // Encode multilingual fields to JSON
            $partner['name'] = json_encode($partner['name']);
            Partner::create($partner);
        }
    }
}
