<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('healthcare_professional_id')->constrained()->onDelete('cascade');
            $table->date('appointment_date');
            $table->timestamp('appointment_time');
            $table->enum('status', ['scheduled', 'cancelled', 'completed'])->default('scheduled');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('appointments');
    }
};
