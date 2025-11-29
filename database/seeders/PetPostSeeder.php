<?php

namespace Database\Seeders;

use App\Models\PetPost;
use Database\Seeders\Concerns\HandlesSeedImages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetPostSeeder extends Seeder
{
    use HandlesSeedImages;

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
                'image' => 'images/pet_posts/image/post1.png',
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
                'image' => 'images/pet_posts/image/post2.png',
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
                'image' => 'images/pet_posts/image/post3.png',
                'slug' => 'top-rated-clinic-spotlight',
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => [
                    'en' => 'Healthy Diet Guide',
                    'ar' => 'دليل النظام الغذائي الصحي'
                ],
                'content' => [
                    'en' => 'Learn about the best nutrition practices to keep your pet healthy and energetic.',
                    'ar' => 'تعرف على أفضل ممارسات التغذية للحفاظ على صحة حيوانك الأليف وحيويته.'
                ],
                'image' => 'images/pet_posts/image/post4.png',
                'slug' => 'healthy-diet-guide',
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => [
                    'en' => 'Training Tips for Puppies',
                    'ar' => 'نصائح تدريب الجراء'
                ],
                'content' => [
                    'en' => 'Essential training techniques to help your new puppy become a well-behaved family member.',
                    'ar' => 'تقنيات التدريب الأساسية لمساعدة جروك الجديد ليصبح فرداً مهذباً في العائلة.'
                ],
                'image' => 'images/pet_posts/image/post5.png',
                'slug' => 'training-tips-puppies',
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => [
                    'en' => 'Summer Pet Safety',
                    'ar' => 'سلامة الحيوانات الأليفة في الصيف'
                ],
                'content' => [
                    'en' => 'Important tips to protect your pets from heat and ensure their comfort during summer.',
                    'ar' => 'نصائح مهمة لحماية حيواناتك الأليفة من الحرارة وضمان راحتها خلال فصل الصيف.'
                ],
                'image' => 'images/pet_posts/image/post6.png',
                'slug' => 'summer-pet-safety',
                'is_published' => true,
                'published_at' => now(),
            ],
        ];

        foreach ($posts as $post) {
            // Encode multilingual fields to JSON
            $post['title'] = json_encode($post['title']);
            $post['content'] = json_encode($post['content']);
            PetPost::create($post);
        }
    }
}
