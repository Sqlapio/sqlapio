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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('cod_history')->unique();
            $table->string('patient_id');
            // codigo del paciente = cedula del paciente
            $table->string('cod_patient');
            // fecha de registro de la historia clinica
            $table->string('history_date');
            // peso
            $table->decimal('weight', 5, 5);
            // altura
            $table->decimal('height', 5, 5);
            // antecedentes familiares
            $table->json('back_family')->nullable();
            // alergias
            $table->json('allergies')->nullable();
            // antecedentes no patologicos
            $table->json('history_non_pathological')->nullable();
            // antecedentes patologicos
            $table->json('history_pathological')->nullable();
            // antecedentes quirurjicos
            $table->json('history_surgical')->nullable();
            // antecedentes ginecologicos si aplica
            $table->json('history_gynecological')->nullable();
            // medicamentos y suplementos
            $table->json('medications_supplements')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
