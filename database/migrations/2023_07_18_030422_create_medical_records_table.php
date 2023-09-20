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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('center_id');
            $table->string('patient_id');
            $table->string('record_code')->unique();
            $table->string('record_date');
            $table->string('record_type')->nullable();
            $table->longText('background');
            $table->longText('razon');
            $table->longText('diagnosis');
            $table->longText('treatment');
            $table->longText('exams');
            $table->longText('studies');

            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
