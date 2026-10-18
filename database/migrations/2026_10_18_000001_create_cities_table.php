<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('average_living_cost', 10, 2)->nullable();
            $table->foreignId('country_id')->constrained('countries');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
