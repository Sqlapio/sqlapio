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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('patient_id');
            $table->string('center_id');
            $table->longText('reason_visit');
            $table->longText('physical_exam');
            $table->longText('diagnosis');
            $table->string('medication');
            $table->string('image_exam');
            $table->string('image_other');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
