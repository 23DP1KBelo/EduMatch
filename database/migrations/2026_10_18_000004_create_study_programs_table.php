<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('study_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('language');
            $table->string('duration');
            $table->string('degree_level');
            $table->text('admission_requirements')->nullable();
            $table->date('application_deadline')->nullable();
            $table->decimal('tuition_fees', 12, 2)->nullable();
            $table->foreignId('university_id')->constrained('universities');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('study_programs');
    }
};
