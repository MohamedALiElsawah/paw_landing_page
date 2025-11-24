<?php

namespace App\Console\Commands;

use App\Services\TranslationService;
use Illuminate\Console\Command;

class SeedArabicTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:seed-arabic {--force : Force update all translations}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed missing Arabic translations for all models';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Seeding Arabic translations...');

        if ($this->option('force')) {
            $this->info('Force mode: Updating all translations...');
        } else {
            $this->info('Checking for missing Arabic translations...');
        }

        $models = [
            \App\Models\Service::class => ['name', 'description'],
            \App\Models\Clinic::class => ['name', 'location', 'working_hours'],
            \App\Models\Store::class => ['name', 'location', 'working_hours'],
            \App\Models\PetPost::class => ['title', 'content'],
            \App\Models\Review::class => ['reviewer_name', 'content'],
            \App\Models\Partner::class => ['name'],
        ];

        $totalUpdated = 0;

        foreach ($models as $modelClass => $translatableFields) {
            $this->info("Processing {$modelClass}...");

            $records = $modelClass::all();
            $modelUpdated = 0;

            foreach ($records as $record) {
                $needsUpdate = false;
                $updates = [];

                foreach ($translatableFields as $field) {
                    $currentValue = $record->getAttribute($field);

                    if (is_array($currentValue)) {
                        // Check if Arabic translation is missing or empty
                        if ($this->option('force') || !isset($currentValue['ar']) || empty($currentValue['ar'])) {
                            $currentValue['ar'] = TranslationService::translateToArabic($currentValue['en'] ?? '');
                            $updates[$field] = $currentValue;
                            $needsUpdate = true;
                        }
                    } else {
                        // Convert single value to multilingual
                        $updates[$field] = [
                            'en' => $currentValue,
                            'ar' => TranslationService::translateToArabic($currentValue)
                        ];
                        $needsUpdate = true;
                    }
                }

                if ($needsUpdate) {
                    $record->update($updates);
                    $modelUpdated++;
                    $totalUpdated++;
                }
            }

            $this->info("Updated {$modelUpdated} records for {$modelClass}");
        }

        $this->info("Arabic translations completed! Total records updated: {$totalUpdated}");

        if ($totalUpdated === 0) {
            $this->info('All Arabic translations are already up to date.');
            $this->info('Use --force option to update all translations regardless.');
        }
    }
}
