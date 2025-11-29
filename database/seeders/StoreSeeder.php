<?php

namespace Database\Seeders;

use App\Models\Store;
use Database\Seeders\Concerns\HandlesSeedImages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    use HandlesSeedImages;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = [
            [
                'name' => [
                    'en' => 'PetFood Salmiya',
                    'ar' => 'بيت فود السالمية'
                ],
                'location' => [
                    'en' => 'Salmiya, Block 10, Kuwait',
                    'ar' => 'السالمية، بلوك 10، الكويت'
                ],
                'phone' => '+965 2222 3333',
                'working_hours' => [
                    'en' => 'Open 24/7',
                    'ar' => 'مفتوح 24/7'
                ],
                'rating' => 4.8,
                'image' => 'images/stores/image/store1.png',
                'logo' => 'images/general/logo1.png',
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'PetFood Jahraa',
                    'ar' => 'بيت فود الجهراء'
                ],
                'location' => [
                    'en' => 'Jahraa, Main Road, Kuwait',
                    'ar' => 'الجهراء، الطريق الرئيسي، الكويت'
                ],
                'phone' => '+965 2222 2334',
                'working_hours' => [
                    'en' => 'Open 24/7',
                    'ar' => 'مفتوح 24/7'
                ],
                'rating' => 4.9,
                'image' => 'images/stores/image/store2.png',
                'logo' => 'images/general/logo2.png',
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'PetFood Hawalli',
                    'ar' => 'بيت فود حولي'
                ],
                'location' => [
                    'en' => 'Hawalli, Gulf Road, Kuwait',
                    'ar' => 'حولي، طريق الخليج، الكويت'
                ],
                'phone' => '+965 2222 9202',
                'working_hours' => [
                    'en' => 'Open 24/7',
                    'ar' => 'مفتوح 24/7'
                ],
                'rating' => 4.7,
                'image' => 'images/stores/image/store3.png',
                'logo' => 'images/general/logo3.png',
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Pet Paradise',
                    'ar' => 'جنة الحيوانات الأليفة'
                ],
                'location' => [
                    'en' => 'Kuwait City, Downtown, Kuwait',
                    'ar' => 'مدينة الكويت، وسط المدينة، الكويت'
                ],
                'phone' => '+965 2222 4444',
                'working_hours' => [
                    'en' => '9AM - 10PM',
                    'ar' => '9 صباحاً - 10 مساءً'
                ],
                'rating' => 4.9,
                'image' => 'images/banners/image/store_banner1.png',
                'logo' => 'images/partners/image/Partner logo-1.png',
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Animal Kingdom',
                    'ar' => 'مملكة الحيوانات'
                ],
                'location' => [
                    'en' => 'Farwaniya, Shopping Mall, Kuwait',
                    'ar' => 'الفروانية، المركز التجاري، الكويت'
                ],
                'phone' => '+965 2222 5555',
                'working_hours' => [
                    'en' => '8AM - 11PM',
                    'ar' => '8 صباحاً - 11 مساءً'
                ],
                'rating' => 4.8,
                'image' => 'images/banners/image/store_banner2.png',
                'logo' => 'images/partners/image/Partner logo-2.png',
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Pet Care Plus',
                    'ar' => 'بيت كير بلس'
                ],
                'location' => [
                    'en' => 'Mubarak Al-Kabeer, Medical Center, Kuwait',
                    'ar' => 'مبارك الكبير، المركز الطبي، الكويت'
                ],
                'phone' => '+965 2222 6666',
                'working_hours' => [
                    'en' => '24/7 Emergency',
                    'ar' => 'طوارئ 24/7'
                ],
                'rating' => 5.0,
                'image' => 'images/banners/image/store_banner3.png',
                'logo' => 'images/partners/image/Partner logo-3.png',
                'is_active' => true,
            ],
        ];

        foreach ($stores as $store) {
            // Encode multilingual fields to JSON
            $store['name'] = json_encode($store['name']);
            $store['location'] = json_encode($store['location']);
            $store['working_hours'] = json_encode($store['working_hours']);
            Store::create($store);
        }
    }
}
