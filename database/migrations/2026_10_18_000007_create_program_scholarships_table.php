<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('program_scholarships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scholarship_id')->constrained('scholarships')->cascadeOnDelete();
            $table->foreignId('program_id')->constrained('study_programs')->cascadeOnDelete();
            $table->unique(['scholarship_id', 'program_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_scholarships');
    }
};
