<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('test_attempts', function (Blueprint $table) {
            $table->id();
            $table->dateTime('started_at');
            $table->dateTime('completed_at')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('test_id')->constrained('tests');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_attempts');
    }
};
