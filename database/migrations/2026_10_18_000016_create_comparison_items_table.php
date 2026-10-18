<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comparison_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('study_programs')->cascadeOnDelete();
            $table->foreignId('comparison_id')->constrained('program_comparisons')->cascadeOnDelete();
            $table->unique(['program_id', 'comparison_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comparison_items');
    }
};
