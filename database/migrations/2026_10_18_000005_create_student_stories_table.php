<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_stories', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('title');
            $table->text('description');
            $table->boolean('status')->default(false);
            $table->foreignId('university_id')->constrained('universities');
            $table->foreignId('program_id')->constrained('study_programs');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_stories');
    }
};
