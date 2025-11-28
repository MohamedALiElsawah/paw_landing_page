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
                'logo' => $this->seedImage('Partner logo-1.png', 'partners', 'logo', 'partner_logo_1.png'),
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Pet Paradise Store',
                    'ar' => 'متجر جنة الحيوانات الأليفة'
                ],
                'logo' => $this->seedImage('Partner logo-2.png', 'partners', 'logo', 'partner_logo_2.png'),
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Animal Kingdom',
                    'ar' => 'مملكة الحيوانات'
                ],
                'logo' => $this->seedImage('Partner logo-3.png', 'partners', 'logo', 'partner_logo_3.png'),
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Pet Care Plus',
                    'ar' => 'بيت كير بلس'
                ],
                'logo' => $this->seedImage('Partner logo-4.png', 'partners', 'logo', 'partner_logo_4.png'),
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Vet Express',
                    'ar' => 'فيت إكسبريس'
                ],
                'logo' => $this->seedImage('Partner logo-5.png', 'partners', 'logo', 'partner_logo_5.png'),
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Pet Food Kuwait',
                    'ar' => 'بيت فود الكويت'
                ],
                'logo' => $this->seedImage('Partner logo-6.png', 'partners', 'logo', 'partner_logo_6.png'),
                'order' => 6,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Animal Health Center',
                    'ar' => 'مركز صحة الحيوان'
                ],
                'logo' => $this->seedImage('Partner logo-7.png', 'partners', 'logo', 'partner_logo_7.png'),
                'order' => 7,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Pet Grooming Experts',
                    'ar' => 'خبراء العناية بالحيوانات الأليفة'
                ],
                'logo' => $this->seedImage('Partner logo-8.png', 'partners', 'logo', 'partner_logo_8.png'),
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
