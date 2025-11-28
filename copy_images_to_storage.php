<?php

// Script to copy all images from public/assets/images to storage
$sourceDir = __DIR__ . '/public/assets/images';
$storageDir = __DIR__ . '/storage/app/public/images';

// Create storage directories
$directories = [
    'clinics/image',
    'stores/image',
    'stores/logo',
    'pet_posts/image',
    'reviews/reviewer_image',
    'partners/logo',
    'banners'
];

foreach ($directories as $dir) {
    $fullPath = $storageDir . '/' . $dir;
    if (!is_dir($fullPath)) {
        mkdir($fullPath, 0755, true);
        echo "Created directory: $fullPath\n";
    }
}

// Copy images to appropriate storage directories
$imageMappings = [
    // Clinic images
    'hero1.png' => 'clinics/image/clinic1.png',
    'hero2.png' => 'clinics/image/clinic2.png',
    'hero3.png' => 'clinics/image/clinic3.png',
    'banner_c.png' => 'clinics/image/clinic4.png',
    'catBanner.png' => 'clinics/image/clinic5.png',
    'team.png' => 'clinics/image/clinic6.png',

    // Store images
    'store1.png' => 'stores/image/store1.png',
    'store2.png' => 'stores/image/store2.png',
    'store3.png' => 'stores/image/store3.png',
    'store_banner1.png' => 'stores/image/store_banner1.png',
    'store_banner2.png' => 'stores/image/store_banner2.png',
    'store_banner3.png' => 'stores/image/store_banner3.png',

    // Store logos
    'logo1.png' => 'stores/logo/logo1.png',
    'logo2.png' => 'stores/logo/logo2.png',
    'logo3.png' => 'stores/logo/logo3.png',
    'Partner logo-1.png' => 'stores/logo/partner_logo_1.png',
    'Partner logo-2.png' => 'stores/logo/partner_logo_2.png',
    'Partner logo-3.png' => 'stores/logo/partner_logo_3.png',

    // Pet post images
    'post1.png' => 'pet_posts/image/post1.png',
    'post2.png' => 'pet_posts/image/post2.png',
    'post3.png' => 'pet_posts/image/post3.png',

    // Review images
    'Image (Sarah Mohammed).png' => 'reviews/reviewer_image/reviewer1.png',
    'Image (Ahmed Al-Rashid).png' => 'reviews/reviewer_image/reviewer2.png',
    'Image (Layla Hassan).png' => 'reviews/reviewer_image/reviewer3.png',
    'team.png' => 'reviews/reviewer_image/reviewer4.png',
    'hero1.png' => 'reviews/reviewer_image/reviewer5.png',
    'hero2.png' => 'reviews/reviewer_image/reviewer6.png',
    'hero3.png' => 'reviews/reviewer_image/reviewer7.png',
    'banner_c.png' => 'reviews/reviewer_image/reviewer8.png',

    // Partner logos
    'Partner logo-1.png' => 'partners/logo/partner_logo_1.png',
    'Partner logo-2.png' => 'partners/logo/partner_logo_2.png',
    'Partner logo-3.png' => 'partners/logo/partner_logo_3.png',
    'Partner logo-4.png' => 'partners/logo/partner_logo_4.png',
    'Partner logo-5.png' => 'partners/logo/partner_logo_5.png',
    'Partner logo-6.png' => 'partners/logo/partner_logo_6.png',
    'Partner logo-7.png' => 'partners/logo/partner_logo_7.png',
    'Partner logo-8.png' => 'partners/logo/partner_logo_8.png',
];

$copiedCount = 0;
$errorCount = 0;

foreach ($imageMappings as $sourceFile => $targetPath) {
    $sourcePath = $sourceDir . '/' . $sourceFile;
    $targetFullPath = $storageDir . '/' . $targetPath;

    if (file_exists($sourcePath)) {
        if (copy($sourcePath, $targetFullPath)) {
            echo "Copied: $sourceFile -> $targetPath\n";
            $copiedCount++;
        } else {
            echo "ERROR copying: $sourceFile\n";
            $errorCount++;
        }
    } else {
        echo "Source file not found: $sourceFile\n";
        $errorCount++;
    }
}

echo "\nCopy operation completed:\n";
echo "Successfully copied: $copiedCount files\n";
echo "Errors: $errorCount files\n";

// Copy remaining images that don't have specific mappings
$allFiles = scandir($sourceDir);
$remainingFiles = array_diff($allFiles, array_merge(['.', '..'], array_keys($imageMappings)));

foreach ($remainingFiles as $file) {
    if (is_file($sourceDir . '/' . $file)) {
        $targetPath = $storageDir . '/general/' . $file;
        if (!is_dir(dirname($targetPath))) {
            mkdir(dirname($targetPath), 0755, true);
        }
        if (copy($sourceDir . '/' . $file, $targetPath)) {
            echo "Copied remaining: $file -> general/$file\n";
            $copiedCount++;
        } else {
            echo "ERROR copying remaining: $file\n";
            $errorCount++;
        }
    }
}

echo "\nFinal results:\n";
echo "Total successfully copied: $copiedCount files\n";
echo "Total errors: $errorCount files\n";
