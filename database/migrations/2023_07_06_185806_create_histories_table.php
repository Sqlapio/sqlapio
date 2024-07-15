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

            //Antecedentes Personales y Familiares
            $table->text('FB_EC')->nullable();
            $table->text('FB_HA')->nullable();
            $table->text('FB_D')->nullable();
            $table->text('FB_C')->nullable();
            $table->text('FB_C_input')->nullable();
            $table->text('FB_AL')->nullable();
            $table->text('FB_EM')->nullable();
            $table->text('FB_EDP')->nullable();
            $table->text('FB_TSM')->nullable();
            $table->text('FB_AR')->nullable();
            $table->text('FB_LES')->nullable();
            $table->text('FB_EHC')->nullable();
            $table->text('FB_TDT')->nullable();
            $table->text('FB_ER')->nullable();
            $table->text('FB_DM')->nullable();
            $table->text('FB_NA')->nullable();

            //Antecedentes personales patológicos
            $table->text('PB_HA')->nullable();
            $table->text('PB_EC')->nullable();
            $table->text('PB_A')->nullable();
            $table->text('PB_EPOC')->nullable();
            $table->text('PB_ADS')->nullable();
            $table->text('PB_D')->nullable();
            $table->text('PB_H')->nullable();
            $table->text('PB_C')->nullable();
            $table->text('FB_C_input')->nullable();
            $table->text('PB_P')->nullable();
            $table->text('PB_AL')->nullable();
            $table->text('PB_M')->nullable();
            $table->text('PB_AR')->nullable();
            $table->text('PB_EM')->nullable();
            $table->text('PB_U')->nullable();
            $table->text('PB_G')->nullable();
            $table->text('PB_SII')->nullable();
            $table->text('PB_TDT')->nullable();
            $table->text('PB_EHC')->nullable();
            $table->text('PB_ERC')->nullable();
            $table->text('PB_OO')->nullable();
            $table->text('PB_FA')->nullable();
            $table->text('PB_GLA')->nullable();
            $table->text('PB_PCODC')->nullable();
            $table->text('PB_TS')->nullable();
            $table->text('PB_NA')->nullable();

            //Historia no patológica
            $table->text('NPB_CA')->nullable();
            $table->text('NPB_CFGYPL')->nullable();
            $table->text('NPB_CFAAA')->nullable();
            $table->text('NPB_CC')->nullable();
            $table->text('NPB_CCD')->nullable();
            $table->text('NPB_UFMVL')->nullable();
            $table->text('NPB_EF')->nullable();
            $table->text('NPB_SIPD')->nullable();
            $table->text('NPB_NA')->nullable();

            //Inmunizacion
            $table->text('IM_V')->nullable();
            $table->text('IM_BCG')->nullable();
            $table->text('IM_HB')->nullable();
            $table->text('IM_DTP')->nullable();
            $table->text('IM_IPV_OPV')->nullable();
            $table->text('IM_HIB')->nullable();
            $table->text('IM_PCV')->nullable();
            $table->text('IM_R')->nullable();
            $table->text('IM_MMR')->nullable();
            $table->text('IM_V')->nullable();
            $table->text('IM_I')->nullable();
            $table->text('IM_HA')->nullable();
            $table->text('IM_M')->nullable();
            $table->text('IM_VPH')->nullable();
            $table->text('IM_N')->nullable();
            $table->text('IM_HZ')->nullable();
            $table->text('IM_NA')->nullable();

            //info covid19
            $table->text('IMC19_covid')->nullable();
            $table->text('IMC19_dosis')->nullable();
            $table->text('IMC19_fecha_ultima_dosis')->nullable();
            $table->text('IMC19_marca')->nullable();

            //Enfermedades Mentales
            $table->text('EM_DMR')->nullable();
            $table->text('EM_TB')->nullable();
            $table->text('EM_TAG')->nullable();
            $table->text('EM_TCO')->nullable();
            $table->text('EM_TP')->nullable();
            $table->text('EM_TEPT')->nullable();
            $table->text('EM_E')->nullable();
            $table->text('EM_TLP')->nullable();
            $table->text('EM_TAAB')->nullable();
            $table->text('EM_TCS')->nullable();
            $table->text('EM_TCS')->nullable();
            $table->text('EM_NA')->nullable();

            //Historia ginecologicos si aplica
            $table->text('GINE_menarquia')->nullable();
            $table->text('GINE_duracion')->nullable();
            $table->text('GINE_infecciones')->nullable();
            $table->text('GINE_metodo_anti')->nullable();
            $table->text('GINE_ex_gine_previos')->nullable();
            $table->text('OBSTE_gravides')->nullable();
            $table->text('OBSTE_partos')->nullable();
            $table->text('OBSTE_cesareas')->nullable();
            $table->text('OBSTE_abortos')->nullable();
            $table->text('OBSTE_complicaciones')->nullable();
            $table->text('MENOSPA_fecha_ini')->nullable();
            $table->text('MENOSPA_sintomas')->nullable();
            $table->text('MENOSPA_tratamiento')->nullable();
            $table->text('ACTSEX_activo')->nullable();
            $table->text('ACTSEX_enfermedades_ts')->nullable();

            // alergias
            $table->json('allergies')->nullable();

            // antecedentes quirurjicos
            $table->json('history_surgical')->nullable();

            // medicamentos y suplementos
            $table->json('medications_supplements')->nullable();
            //observaciones
            $table->string('observations_inmunization')->nullable();
            $table->string('observations_mental_healths')->nullable();
            $table->string('observations_ginecologica')->nullable();
            $table->string('observations_allergies')->nullable();
            $table->string('observations_medication')->nullable();
            $table->string('observations_back_family')->nullable();
            $table->string('observations_diagnosis')->nullable();
            $table->string('observations_not_pathological')->nullable();

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
