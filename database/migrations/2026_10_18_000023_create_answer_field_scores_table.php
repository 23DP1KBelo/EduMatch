<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('answer_field_scores', function (Blueprint $table) {
            $table->id();
            $table->decimal('points', 8, 2);
            $table->foreignId('option_id')->constrained('answer_options')->cascadeOnDelete();
            $table->foreignId('career_field_id')->constrained('career_fields')->cascadeOnDelete();
            $table->unique(['option_id', 'career_field_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('answer_field_scores');
    }
};
