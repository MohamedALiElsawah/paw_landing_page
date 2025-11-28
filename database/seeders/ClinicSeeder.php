<?php

namespace Database\Seeders;

use App\Models\Clinic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clinics = [
            [
                'name' => [
                    'en' => 'HQ Clinic',
                    'ar' => 'عيادة المقر الرئيسي'
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
                'distance' => 2.3,
                'latitude' => 29.3340,
                'longitude' => 48.0760,
                'image' => null,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Haiat Clinic',
                    'ar' => 'عيادة الهيئة'
                ],
                'location' => [
                    'en' => 'Jahraa',
                    'ar' => 'الجهراء'
                ],
                'phone' => '+965 2222 6692',
                'working_hours' => [
                    'en' => '8 AM - 10 PM',
                    'ar' => '8 صباحاً - 10 مساءً'
                ],
                'distance' => 6.3,
                'latitude' => 29.3375,
                'longitude' => 47.6581,
                'image' => null,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Pet Zone Clinic',
                    'ar' => 'عيادة منطقة الحيوانات الأليفة'
                ],
                'location' => [
                    'en' => 'Hawalli',
                    'ar' => 'حولي'
                ],
                'phone' => '+965 2666 7777',
                'working_hours' => [
                    'en' => '9 AM - 9 PM',
                    'ar' => '9 صباحاً - 9 مساءً'
                ],
                'distance' => 6.3,
                'latitude' => 29.3329,
                'longitude' => 48.0305,
                'image' => null,
                'is_active' => true,
            ],
        ];

        foreach ($clinics as $clinic) {
            Clinic::create($clinic);
        }
    }
}
