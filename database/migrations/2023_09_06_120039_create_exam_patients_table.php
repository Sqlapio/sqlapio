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
        Schema::create('exam_patients', function (Blueprint $table) {
            $table->id();
            $table->string('record_code');
            $table->string('cod_ref');
            $table->string('cod_exam');
            $table->string('description');
            $table->string('ref_id');
            $table->string('user_id');
            $table->string('center_id');
            $table->string('patient_id');
            $table->string('medical_record_id');
            $table->string('date');
            $table->string('status')->default(1);
            $table->string('laboratory_id')->nullable();
            $table->string('cod_lab')->nullable();
            $table->string('file')->nullable();
            $table->string('date_result')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_patients');
    }
};
