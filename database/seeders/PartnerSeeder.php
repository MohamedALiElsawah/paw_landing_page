<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name' => [
                    'en' => 'Partner 1',
                    'ar' => 'الشريك 1'
                ],
                'logo' => 'assets/images/Partner logo-1.png',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Partner 2',
                    'ar' => 'الشريك 2'
                ],
                'logo' => 'assets/images/Partner logo-2.png',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Partner 3',
                    'ar' => 'الشريك 3'
                ],
                'logo' => 'assets/images/Partner logo-3.png',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Partner 4',
                    'ar' => 'الشريك 4'
                ],
                'logo' => 'assets/images/Partner logo-4.png',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Partner 5',
                    'ar' => 'الشريك 5'
                ],
                'logo' => 'assets/images/Partner logo-5.png',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Partner 6',
                    'ar' => 'الشريك 6'
                ],
                'logo' => 'assets/images/Partner logo-6.png',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Partner 7',
                    'ar' => 'الشريك 7'
                ],
                'logo' => 'assets/images/Partner logo-7.png',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Partner 8',
                    'ar' => 'الشريك 8'
                ],
                'logo' => 'assets/images/Partner logo-8.png',
                'order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
