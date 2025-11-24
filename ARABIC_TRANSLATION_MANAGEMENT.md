# Arabic Translation Management System

## Overview

This document explains how the Arabic version and data management system works in the PawApp Laravel application. The system ensures that all content is available in both English and Arabic, with automatic translation capabilities for missing Arabic content.

## Architecture

### 1. Database Models with Multilingual Support

All main models (`Service`, `Clinic`, `Store`, `PetPost`, `Review`, `Partner`) support multilingual content through JSON fields:

```php
protected $casts = [
    'name' => 'array',
    'description' => 'array',
    // ... other fields
];
```

Each model includes accessor methods that automatically return the content in the current locale:

```php
public function getNameAttribute($value)
{
    $name = json_decode($value, true);
    return $name[app()->getLocale()] ?? $name['en'] ?? '';
}
```

### 2. Translation Service

The `TranslationService` provides:

-   **Automatic Translation**: Translates English text to Arabic using a built-in dictionary
-   **Translation Validation**: Ensures Arabic translations exist for all content
-   **Bulk Processing**: Can process all models to fill missing Arabic translations

### 3. Language Switching

-   **Frontend**: Language switcher in header and sidebar (supports RTL for Arabic)
-   **Backend**: Locale middleware that sets the application locale for each request
-   **Admin/Dashboard**: Always English only with LTR direction
-   **Routes**: `/locale/{locale}` route for changing languages

## How It Works

### Data Storage

Content is stored as JSON objects in the database:

```json
{
    "name": {
        "en": "Clinics",
        "ar": "العيادات"
    },
    "description": {
        "en": "Find trusted veterinary clinics near you",
        "ar": "ابحث عن عيادات بيطرية موثوقة بالقرب منك"
    }
}
```

### Automatic Translation

When Arabic content is missing, the system automatically translates from English:

1. **Check for missing translations**: System detects when `ar` key is missing or empty
2. **Translate from English**: Uses the built-in translation dictionary
3. **Update database**: Saves the Arabic translation alongside English

### Frontend Display

The frontend automatically displays content in the current locale:

```blade
{{ $service->name }} {{-- Shows English or Arabic based on current locale --}}
{{ __('Home') }} {{-- Uses Laravel translation system --}}
```

## Usage

### 1. Seeding Arabic Translations

**Automatic Seeding** (included in DatabaseSeeder):

```bash
php artisan db:seed
```

**Manual Seeding**:

```bash
php artisan db:seed --class=ArabicTranslationSeeder
```

**Console Command**:

```bash
php artisan translations:seed-arabic
php artisan translations:seed-arabic --force  # Force update all translations
```

### 2. Adding New Content

When adding new content through the CRM/admin panel:

-   **English content is required** (used as source for translations)
-   **Arabic content is optional** (will be auto-generated if missing)
-   The system will automatically ensure Arabic translations exist

### 3. Manual Translation Management

**Check for missing translations**:

```php
use App\Services\TranslationService;

// Check and fix missing translations for a specific model
TranslationService::seedMissingArabicTranslations();

// Ensure translations for a specific record
$translations = TranslationService::ensureArabicTranslations($model, ['name', 'description']);
```

## CRM Integration

### Data Management

1. **English as Source**: All content should be entered in English first
2. **Automatic Arabic Generation**: System automatically creates Arabic translations
3. **Manual Override**: Arabic content can be manually edited in the admin panel

### Admin Panel Features

-   **Language Toggle**: Switch between English and Arabic views
-   **Translation Status**: View which content needs Arabic translations
-   **Bulk Translation**: Translate multiple items at once

## Configuration

### Adding New Models

To add multilingual support to a new model:

1. **Update Migration**:

```php
$table->json('name'); // Instead of string
$table->json('description'); // Instead of text
```

2. **Update Model**:

```php
protected $casts = [
    'name' => 'array',
    'description' => 'array',
];

// Add accessor methods
public function getNameAttribute($value)
{
    $name = json_decode($value, true);
    return $name[app()->getLocale()] ?? $name['en'] ?? '';
}
```

3. **Update Translation Service**:

```php
$models = [
    \App\Models\YourNewModel::class => ['name', 'description'],
    // ... existing models
];
```

### Custom Translation API

For production use, you can integrate with Google Translate API:

1. **Update TranslationService**:

```php
// Uncomment the Google Translate API section
$response = Http::withHeaders([
    'Content-Type' => 'application/json',
])->post('https://translation.googleapis.com/language/translate/v2', [
    'q' => $text,
    'target' => 'ar',
    'key' => config('services.google.translate_key'),
]);
```

2. **Add API Key to .env**:

```env
GOOGLE_TRANSLATE_API_KEY=your_api_key_here
```

## Testing

### Verify Arabic Content

1. **Switch to Arabic**: Click the Arabic language button
2. **Check Content**: Verify all text appears in Arabic
3. **Test Language Switching**: Switch back to English and verify content

### Test Translation System

```bash
# Test the translation command
php artisan translations:seed-arabic

# Force update to test translation quality
php artisan translations:seed-arabic --force
```

## Troubleshooting

### Common Issues

1. **Missing Arabic Content**:

    - Run: `php artisan translations:seed-arabic`
    - Check if English source content exists

2. **Translation Quality**:

    - Review the translation dictionary in `TranslationService`
    - Consider integrating with professional translation API

3. **Language Not Switching**:
    - Check if LocaleMiddleware is registered in `bootstrap/app.php`
    - Verify session is working correctly

### Monitoring

-   Check Laravel logs for translation errors
-   Monitor which content gets auto-translated
-   Review translation quality periodically

## Best Practices

1. **Always provide English content** as the source for translations
2. **Review auto-translated content** for accuracy
3. **Use the force option sparingly** to avoid overwriting manual translations
4. **Monitor translation quality** and update the dictionary as needed
5. **Test both languages** after content updates

## Future Enhancements

1. **Translation Memory**: Store and reuse translations
2. **Quality Metrics**: Track translation accuracy
3. **Manual Review Workflow**: Approve/reject auto-translations
4. **Multi-language Support**: Add support for additional languages
5. **Translation Versioning**: Track changes to translations
