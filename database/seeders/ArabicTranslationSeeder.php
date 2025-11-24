<?php

namespace Database\Seeders;

use App\Services\TranslationService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArabicTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding missing Arabic translations...');

        TranslationService::seedMissingArabicTranslations();

        $this->command->info('Arabic translations seeded successfully!');
    }
}
