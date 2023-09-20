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
            $table->string('patient_id')->nullable();
            // codigo del paciente = cedula del paciente
            $table->string('cod_patient');
            // fecha de registro de la historia clinica
            $table->string('history_date');
            // peso
            $table->string('weight');
            // altura
            $table->string('height');
            /**
             * Campos agregados para mejorar la
             * historia del paciente
             */
            $table->string('reason');
            $table->string('current_illness');
            $table->string('strain');
            $table->string('temperature');
            $table->string('breaths');
            $table->string('pulse');
            $table->string('saturation');
            $table->string('condition');
            $table->string('applied_studies')->nullable();
            $table->json('info_add')->nullable();


            //signos vitales
            $table->text('hidratado')->nullable();
            $table->text('eupenico')->nullable();
            $table->text('febril')->nullable();
            $table->text('esfera_neurologica')->nullable();
            $table->text('glasgow')->nullable();
            $table->text('esfera_orl')->nullable();
            $table->text('esfera_cardiopulmonar')->nullable();
            $table->text('esfera_abdominal')->nullable();
            $table->text('extremidades')->nullable();

            //Antecedentes Personales y Familiares
            $table->text('cancer')->nullable();
            $table->text('diabetes')->nullable();
            $table->text('tension_alta')->nullable();
            $table->text('cardiacos')->nullable();
            $table->text('psiquiatricas')->nullable();
            $table->text('alteraciones_coagulacion')->nullable();
            $table->text('trombosis_embolas')->nullable();
            $table->text('tranfusiones_sanguineas')->nullable();
            $table->text('COVID19')->nullable();
            $table->text('no_aplica_back')->nullable();

            //Antecedentes personales patológicos
            $table->text('hepatitis')->nullable();
            $table->text('VIH_SIDA')->nullable();
            $table->text('gastritis_ulceras')->nullable();
            $table->text('neurologia')->nullable();
            $table->text('ansiedad_angustia')->nullable();
            $table->text('tiroides')->nullable();
            $table->text('lupus')->nullable();
            $table->text('enfermedad_autoimmune')->nullable();
            $table->text('diabetes_mellitus')->nullable();
            $table->text('presion_arterial_alta')->nullable();
            $table->text('tiene_cateter_venoso')->nullable();
            $table->text('fracturas')->nullable();
            $table->text('trombosis_venosa')->nullable();
            $table->text('embolia_pulmonar')->nullable();
            $table->text('varices_piernas')->nullable();
            $table->text('insuficiencia_arterial')->nullable();
            $table->text('coagulacion_anormal')->nullable();
            $table->text('moretones_frecuentes')->nullable();
            $table->text('sangrado_cirugias_previas')->nullable();
            $table->text('sangrado_cepillado_dental')->nullable();
            $table->text('no_aplic_pathology')->nullable();

            //Historia no patológica
            $table->text('alcohol')->nullable();
            $table->text('drogas')->nullable();
            $table->text('vacunas_recientes')->nullable();
            $table->text('transfusiones_sanguineas')->nullable();
            $table->text('no_aplica_no_pathology')->nullable();

            //Historia ginecologicos si aplica
            $table->text('edad_primera_menstruation')->nullable();
            $table->text('fecha_ultima_regla')->nullable();
            $table->text('numero_embarazos')->nullable();
            $table->text('numero_partos')->nullable();
            $table->text('numero_abortos')->nullable();
            $table->text('pregunta')->nullable();
            $table->text('cesareas')->nullable();

            // alergias
            $table->json('allergies')->nullable();

            // antecedentes quirurjicos
            $table->json('history_surgical')->nullable();

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
