<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('career_study_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_field_id')->constrained('career_fields')->cascadeOnDelete();
            $table->foreignId('study_field_id')->constrained('study_fields')->cascadeOnDelete();
            $table->unique(['career_field_id', 'study_field_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_study_fields');
    }
};
