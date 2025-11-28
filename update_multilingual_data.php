<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Updating Pet Posts and Reviews with multilingual data...\n\n";

// Update Pet Posts
$petPostsData = [
    [
        'id' => 1,
        'title' => ['en' => 'Heartwarming Adoption Story', 'ar' => 'قصة تبني مؤثرة'],
        'content' => ['en' => 'Meet Bella, a rescued pup who found her forever home and brought joy to her new family.', 'ar' => 'تعرف على بيلا، جرو تم إنقاذه وجد منزله الدائم وجلب السعادة لعائلته الجديدة.']
    ],
    [
        'id' => 2,
        'title' => ['en' => 'Essential Grooming Tips', 'ar' => 'نصائح أساسية للعناية'],
        'content' => ['en' => 'Keep your pet looking and feeling great with these simple at-home grooming routines.', 'ar' => 'حافظ على مظهر حيوانك الأليف وشعوره بالراحة مع هذه الروتينات البسيطة للعناية في المنزل.']
    ],
    [
        'id' => 3,
        'title' => ['en' => 'Top-Rated Clinic Spotlight', 'ar' => 'تسليط الضوء على العيادة الأعلى تقييماً'],
        'content' => ['en' => 'Discover our featured veterinary clinic offering exceptional care and emergency services.', 'ar' => 'اكتشف عيادتنا البيطرية المميزة التي تقدم رعاية استثنائية وخدمات الطوارئ.']
    ],
    [
        'id' => 4,
        'title' => ['en' => 'Healthy Diet Guide', 'ar' => 'دليل النظام الغذائي الصحي'],
        'content' => ['en' => 'Learn about the best nutrition practices to keep your pet healthy and energetic.', 'ar' => 'تعرف على أفضل ممارسات التغذية للحفاظ على صحة حيوانك الأليف وحيويته.']
    ],
    [
        'id' => 5,
        'title' => ['en' => 'Training Tips for Puppies', 'ar' => 'نصائح تدريب الجراء'],
        'content' => ['en' => 'Essential training techniques to help your new puppy become a well-behaved family member.', 'ar' => 'تقنيات التدريب الأساسية لمساعدة جروك الجديد ليصبح فرداً مهذباً في العائلة.']
    ],
    [
        'id' => 6,
        'title' => ['en' => 'Summer Pet Safety', 'ar' => 'سلامة الحيوانات الأليفة في الصيف'],
        'content' => ['en' => 'Important tips to protect your pets from heat and ensure their comfort during summer.', 'ar' => 'نصائح مهمة لحماية حيواناتك الأليفة من الحرارة وضمان راحتها خلال فصل الصيف.']
    ]
];

foreach ($petPostsData as $postData) {
    $post = App\Models\PetPost::find($postData['id']);
    if ($post) {
        $post->title = json_encode($postData['title']);
        $post->content = json_encode($postData['content']);
        $post->save();
        echo "Updated Pet Post ID: {$postData['id']}\n";
    }
}

// Update Reviews
$reviewsData = [
    [
        'id' => 1,
        'reviewer_name' => ['en' => 'Sarah Mohammed', 'ar' => 'سارة محمد'],
        'content' => ['en' => 'PawApp has made pet care so much easier! I can find everything I need in one place. The Dr. Bo feature is amazing!', 'ar' => 'جعلت PawApp رعاية الحيوانات الأليفة أسهل بكثير! يمكنني العثور على كل ما أحتاجه في مكان واحد. ميزة دكتور بو رائعة!']
    ],
    [
        'id' => 2,
        'reviewer_name' => ['en' => 'Ahmed Al-Rashid', 'ar' => 'أحمد الرشيد'],
        'content' => ['en' => 'The clinic finder saved my cat\'s life during an emergency. Fast, reliable, and easy to use. Highly recommend!', 'ar' => 'أنقذ مكتشف العيادات حياة قطتي خلال حالة طارئة. سريع وموثوق وسهل الاستخدام. أوصي بشدة!']
    ],
    [
        'id' => 3,
        'reviewer_name' => ['en' => 'Layla Hassan', 'ar' => 'ليلى حسن'],
        'content' => ['en' => 'Love the store! Great prices and fast delivery. My dog loves all the products I ordered. Thank you PawApp!', 'ar' => 'أحب المتجر! أسعار رائعة وتوصيل سريع. كلبي يحب جميع المنتجات التي طلبتها. شكراً PawApp!']
    ],
    [
        'id' => 4,
        'reviewer_name' => ['en' => 'Mohammed Ali', 'ar' => 'محمد علي'],
        'content' => ['en' => 'Excellent service! The app helped me find the perfect vet for my sick bird. Very professional and caring.', 'ar' => 'خدمة ممتازة! ساعدني التطبيق في العثور على الطبيب البيطري المثالي لطائري المريض. محترفون ومهتمون جداً.']
    ],
    [
        'id' => 5,
        'reviewer_name' => ['en' => 'Fatima Ahmed', 'ar' => 'فاطمة أحمد'],
        'content' => ['en' => 'The pet posts are so informative! I learned so much about cat care. Keep up the great work!', 'ar' => 'منشورات الحيوانات الأليفة مفيدة جداً! تعلمت الكثير عن رعاية القطط. استمروا في العمل الرائع!']
    ],
    [
        'id' => 6,
        'reviewer_name' => ['en' => 'Khalid Omar', 'ar' => 'خالد عمر'],
        'content' => ['en' => 'Fast delivery and great quality products. My dog loves the new toys I ordered. Will definitely shop again!', 'ar' => 'توصيل سريع ومنتجات عالية الجودة. كلبي يحب الألعاب الجديدة التي طلبتها. سأتسوق بالتأكيد مرة أخرى!']
    ],
    [
        'id' => 7,
        'reviewer_name' => ['en' => 'Noura Abdullah', 'ar' => 'نورة عبدالله'],
        'content' => ['en' => 'The emergency clinic service was incredible! They saved my puppy within minutes. Thank you PawApp!', 'ar' => 'خدمة العيادة الطارئة كانت مذهلة! أنقذوا جروي خلال دقائق. شكراً PawApp!']
    ],
    [
        'id' => 8,
        'reviewer_name' => ['en' => 'Omar Hassan', 'ar' => 'عمر حسن'],
        'content' => ['en' => 'Dr. Bo is a game-changer! The AI assistant helped me understand my cat\'s behavior better.', 'ar' => 'دكتور بو يغير قواعد اللعبة! ساعدني المساعد الذكي في فهم سلوك قطتي بشكل أفضل.']
    ]
];

foreach ($reviewsData as $reviewData) {
    $review = App\Models\Review::find($reviewData['id']);
    if ($review) {
        $review->reviewer_name = json_encode($reviewData['reviewer_name']);
        $review->content = json_encode($reviewData['content']);
        $review->save();
        echo "Updated Review ID: {$reviewData['id']}\n";
    }
}

echo "\nUpdate completed successfully!\n";
