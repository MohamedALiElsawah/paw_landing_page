<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->json('reviewer_name'); // For Arabic/English support
            $table->json('content'); // For Arabic/English support
            $table->integer('rating');
            $table->string('reviewer_image')->nullable();
            $table->string('date');
            $table->morphs('reviewable'); // For clinics, stores, or services
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
