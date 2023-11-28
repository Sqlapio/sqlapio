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
            $table->string('user_id')->nullable();
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
            $table->text('hidratado')->nullable()->default('0');
            $table->text('eupenico')->nullable()->default('0');
            $table->text('febril')->nullable()->default('0');
            $table->text('esfera_neurologica')->nullable()->default('0');
            $table->text('glasgow')->nullable()->default('0');
            $table->text('esfera_orl')->nullable()->default('0');
            $table->text('esfera_cardiopulmonar')->nullable()->default('0');
            $table->text('esfera_abdominal')->nullable()->default('0');
            $table->text('extremidades')->nullable()->default('0');

            //Antecedentes Personales y Familiares
            $table->text('cancer')->nullable()->default('0');
            $table->text('diabetes')->nullable()->default('0');
            $table->text('tension_alta')->nullable()->default('0');
            $table->text('cardiacos')->nullable()->default('0');
            $table->text('psiquiatricas')->nullable()->default('0');
            $table->text('alteraciones_coagulacion')->nullable()->default('0');
            $table->text('trombosis_embolas')->nullable()->default('0');
            $table->text('tranfusiones_sanguineas')->nullable()->default('0');
            $table->text('COVID19')->nullable()->default('0');
            $table->text('no_aplica_back')->nullable()->default('0');

            //Antecedentes personales patológicos
            $table->text('hepatitis')->nullable()->default('0');
            $table->text('VIH_SIDA')->nullable()->default('0');
            $table->text('gastritis_ulceras')->nullable()->default('0');
            $table->text('neurologia')->nullable()->default('0');
            $table->text('ansiedad_angustia')->nullable()->default('0');
            $table->text('tiroides')->nullable()->default('0');
            $table->text('lupus')->nullable()->default('0');
            $table->text('enfermedad_autoimmune')->nullable()->default('0');
            $table->text('diabetes_mellitus')->nullable()->default('0');
            $table->text('presion_arterial_alta')->nullable()->default('0');
            $table->text('tiene_cateter_venoso')->nullable()->default('0');
            $table->text('fracturas')->nullable()->default('0');
            $table->text('trombosis_venosa')->nullable()->default('0');
            $table->text('embolia_pulmonar')->nullable()->default('0');
            $table->text('varices_piernas')->nullable()->default('0');
            $table->text('insuficiencia_arterial')->nullable()->default('0');
            $table->text('coagulacion_anormal')->nullable()->default('0');
            $table->text('moretones_frecuentes')->nullable()->default('0');
            $table->text('sangrado_cirugias_previas')->nullable()->default('0');
            $table->text('sangrado_cepillado_dental')->nullable()->default('0');
            $table->text('no_aplic_pathology')->nullable()->default('0');

            //Historia no patológica
            $table->text('alcohol')->nullable()->default('0');
            $table->text('drogas')->nullable()->default('0');
            $table->text('vacunas_recientes')->nullable()->default('0');
            $table->text('transfusiones_sanguineas')->nullable()->default('0');
            $table->text('no_aplica_no_pathology')->nullable()->default('0');

            //Historia ginecologicos si aplica
            $table->text('edad_primera_menstruation')->nullable()->default('0');
            $table->text('fecha_ultima_regla')->nullable()->default('0');
            $table->text('numero_embarazos')->nullable()->default('0');
            $table->text('numero_partos')->nullable()->default('0');
            $table->text('numero_abortos')->nullable()->default('0');
            $table->text('pregunta')->nullable()->default('0');
            $table->text('cesareas')->nullable()->default('0');

            // alergias
            $table->json('allergies')->nullable()->default('0');

            // antecedentes quirurjicos
            $table->json('history_surgical')->nullable()->default('0');

            // medicamentos y suplementos
            $table->json('medications_supplements')->nullable()->default('0');
            //observaciones
            $table->string('observations_ginecologica')->nullable()->default('Sin observaciones');
            $table->string('observations_allergies')->nullable()->default('Sin observaciones');
            $table->string('observations_medication')->nullable()->default('Sin observaciones');
            $table->string('observations_back_family')->nullable()->default('Sin observaciones');
            $table->string('observations_diagnosis')->nullable()->default('Sin observaciones');
            $table->string('observations_not_pathological')->nullable()->default('Sin observaciones');

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
