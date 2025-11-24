<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = [
            [
                'name' => [
                    'en' => 'PetFood',
                    'ar' => 'بيت فود'
                ],
                'location' => [
                    'en' => 'Salmiya',
                    'ar' => 'السالمية'
                ],
                'phone' => '+965 2222 3333',
                'working_hours' => [
                    'en' => 'Open 24/7',
                    'ar' => 'مفتوح 24/7'
                ],
                'rating' => 4.8,
                'image' => null,
                'logo' => null,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'PetFood',
                    'ar' => 'بيت فود'
                ],
                'location' => [
                    'en' => 'Jahraa',
                    'ar' => 'الجهراء'
                ],
                'phone' => '+965 2222 2334',
                'working_hours' => [
                    'en' => 'Open 24/7',
                    'ar' => 'مفتوح 24/7'
                ],
                'rating' => 4.9,
                'image' => null,
                'logo' => null,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'PetFood',
                    'ar' => 'بيت فود'
                ],
                'location' => [
                    'en' => 'Hawalli',
                    'ar' => 'حولي'
                ],
                'phone' => '+965 2222 9202',
                'working_hours' => [
                    'en' => 'Open 24/7',
                    'ar' => 'مفتوح 24/7'
                ],
                'rating' => 4.7,
                'image' => null,
                'logo' => null,
                'is_active' => true,
            ],
        ];

        foreach ($stores as $store) {
            Store::create($store);
        }
    }
}
