<?php

namespace Database\Seeders;

use App\Models\PetPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => [
                    'en' => 'Heartwarming Adoption Story',
                    'ar' => 'قصة تبني مؤثرة'
                ],
                'content' => [
                    'en' => 'Meet Bella, a rescued pup who found her forever home and brought joy to her new family.',
                    'ar' => 'تعرف على بيلا، جرو تم إنقاذه وجد منزله الدائم وجلب السعادة لعائلته الجديدة.'
                ],
                'image' => 'assets/images/post1.png',
                'slug' => 'heartwarming-adoption-story',
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => [
                    'en' => 'Essential Grooming Tips',
                    'ar' => 'نصائح أساسية للعناية'
                ],
                'content' => [
                    'en' => 'Keep your pet looking and feeling great with these simple at-home grooming routines.',
                    'ar' => 'حافظ على مظهر حيوانك الأليف وشعوره بالراحة مع هذه الروتينات البسيطة للعناية في المنزل.'
                ],
                'image' => 'assets/images/post2.png',
                'slug' => 'essential-grooming-tips',
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => [
                    'en' => 'Top-Rated Clinic Spotlight',
                    'ar' => 'تسليط الضوء على العيادة الأعلى تقييماً'
                ],
                'content' => [
                    'en' => 'Discover our featured veterinary clinic offering exceptional care and emergency services.',
                    'ar' => 'اكتشف عيادتنا البيطرية المميزة التي تقدم رعاية استثنائية وخدمات الطوارئ.'
                ],
                'image' => 'assets/images/post3.png',
                'slug' => 'top-rated-clinic-spotlight',
                'is_published' => true,
                'published_at' => now(),
            ],
        ];

        foreach ($posts as $post) {
            PetPost::create($post);
        }
    }
}
