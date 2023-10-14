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
        Schema::create('references', function (Blueprint $table) {
            $table->id();
            $table->string('cod_ref')->unique(); // => SQ-REF-12345678
            $table->string('user_id');
            $table->string('patient_id');
            $table->string('medical_record_id')->nullable();            
            $table->string('center_id');
            $table->string('cod_medical_record'); //codigo de la consulta
            $table->string('date');
            $table->longText('exams')->nullable();
            $table->longText('studies')->nullable();
            $table->integer('status_ref')->default(1); //1- abierta  2- cerrada
            $table->string('laboratory_id')->nullable();
            $table->string('cod_lab')->nullable();
            $table->string('res_study')->nullable();
            $table->string('res_exam')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('references');
    }
};
