<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('program_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_field_id')->constrained('study_fields')->cascadeOnDelete();
            $table->foreignId('program_id')->constrained('study_programs')->cascadeOnDelete();
            $table->unique(['study_field_id', 'program_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_fields');
    }
};
