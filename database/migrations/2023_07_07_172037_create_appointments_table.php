<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('user_id');
            $table->string('patient_id');
            $table->string('center_id');
            $table->string('date_start');
            $table->string('hour_start');
            $table->string('price')->nullable();
            $table->integer('status')->default(1);
            $table->integer('confirmation')->default(0); // 1 -> confirmada por el paciente
            $table->string('color');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
