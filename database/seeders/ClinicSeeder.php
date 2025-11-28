<?php

namespace Database\Seeders;

use App\Models\Clinic;
use Database\Seeders\Concerns\HandlesSeedImages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClinicSeeder extends Seeder
{
    use HandlesSeedImages;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clinics = [
            [
                'name' => [
                    'en' => 'PawApp HQ Clinic',
                    'ar' => 'عيادة PawApp الرئيسية'
                ],
                'location' => [
                    'en' => 'Salmiya, Block 5',
                    'ar' => 'السالمية، بلوك 5'
                ],
                'phone' => '+965 2222 3333',
                'working_hours' => [
                    'en' => 'Open 24/7',
                    'ar' => 'مفتوح 24/7'
                ],
                'distance' => 2.3,
                'latitude' => 29.3340,
                'longitude' => 48.0760,
                'image' => $this->seedImage('hero1.png', 'clinics', 'image', 'clinic1.png'),
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Al-Jahra Veterinary Center',
                    'ar' => 'المركز البيطري الجهراء'
                ],
                'location' => [
                    'en' => 'Jahraa, Main Highway',
                    'ar' => 'الجهراء، الطريق السريع الرئيسي'
                ],
                'phone' => '+965 2222 6692',
                'working_hours' => [
                    'en' => '8 AM - 10 PM',
                    'ar' => '8 صباحاً - 10 مساءً'
                ],
                'distance' => 6.3,
                'latitude' => 29.3375,
                'longitude' => 47.6581,
                'image' => $this->seedImage('hero2.png', 'clinics', 'image', 'clinic2.png'),
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Pet Zone Veterinary Clinic',
                    'ar' => 'عيادة منطقة الحيوانات الأليفة البيطرية'
                ],
                'location' => [
                    'en' => 'Hawalli, Gulf Road',
                    'ar' => 'حولي، طريق الخليج'
                ],
                'phone' => '+965 2666 7777',
                'working_hours' => [
                    'en' => '9 AM - 9 PM',
                    'ar' => '9 صباحاً - 9 مساءً'
                ],
                'distance' => 6.3,
                'latitude' => 29.3329,
                'longitude' => 48.0305,
                'image' => $this->seedImage('hero3.png', 'clinics', 'image', 'clinic3.png'),
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Kuwait City Animal Hospital',
                    'ar' => 'مستشفى مدينة الكويت للحيوانات'
                ],
                'location' => [
                    'en' => 'Kuwait City, Downtown',
                    'ar' => 'مدينة الكويت، وسط المدينة'
                ],
                'phone' => '+965 2222 8888',
                'working_hours' => [
                    'en' => '24/7 Emergency Services',
                    'ar' => 'خدمات الطوارئ 24/7'
                ],
                'distance' => 3.1,
                'latitude' => 29.3759,
                'longitude' => 47.9774,
                'image' => $this->seedImage('banner_c.png', 'clinics', 'image', 'clinic4.png'),
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Farwaniya Pet Care Center',
                    'ar' => 'مركز رعاية الحيوانات الأليفة بالفروانية'
                ],
                'location' => [
                    'en' => 'Farwaniya, Block 3',
                    'ar' => 'الفروانية، بلوك 3'
                ],
                'phone' => '+965 2222 9999',
                'working_hours' => [
                    'en' => '7 AM - 11 PM',
                    'ar' => '7 صباحاً - 11 مساءً'
                ],
                'distance' => 8.2,
                'latitude' => 29.2775,
                'longitude' => 47.9581,
                'image' => $this->seedImage('catBanner.png', 'clinics', 'image', 'clinic5.png'),
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Mubarak Al-Kabeer Animal Clinic',
                    'ar' => 'عيادة الحيوانات بمبارك الكبير'
                ],
                'location' => [
                    'en' => 'Mubarak Al-Kabeer, Medical District',
                    'ar' => 'مبارك الكبير، المنطقة الطبية'
                ],
                'phone' => '+965 2222 7777',
                'working_hours' => [
                    'en' => '8 AM - 10 PM',
                    'ar' => '8 صباحاً - 10 مساءً'
                ],
                'distance' => 5.7,
                'latitude' => 29.2575,
                'longitude' => 48.0581,
                'image' => $this->seedImage('team.png', 'clinics', 'image', 'clinic6.png'),
                'is_active' => true,
            ],
        ];

        foreach ($clinics as $clinicData) {
            // Create clinic - Laravel will handle JSON encoding automatically due to casts
            Clinic::create($clinicData);
        }
    }
}
