<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('checklists', function (Blueprint $table) {
            $table->id();
            $table->string('task_name');
            $table->dateTime('deadline')->nullable();
            $table->enum('status', ['done', 'toDo'])->default('toDo');
            $table->foreignId('application_id')->constrained('applications')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('checklists');
    }
};
