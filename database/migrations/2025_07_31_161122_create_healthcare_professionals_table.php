<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('healthcare_professionals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('specialization');
            $table->json('available_days');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('healthcare_professionals');
    }
};
