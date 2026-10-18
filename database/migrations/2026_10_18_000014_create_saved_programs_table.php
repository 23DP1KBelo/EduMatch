<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('saved_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('program_id')->constrained('study_programs')->cascadeOnDelete();
            $table->unique(['user_id', 'program_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saved_programs');
    }
};
