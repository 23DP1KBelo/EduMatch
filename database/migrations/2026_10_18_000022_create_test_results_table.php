<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->decimal('score', 8, 2);
            $table->foreignId('career_field_id')->constrained('career_fields');
            $table->foreignId('attempt_id')->constrained('test_attempts')->cascadeOnDelete();
            $table->unique(['career_field_id', 'attempt_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};
