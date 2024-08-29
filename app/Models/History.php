<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class History extends Model
{
    use HasFactory;

    /**
     * Define table
     */
    protected $table = 'histories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'patient_id',
        'cod_history',
        'cod_patient',
        'history_date',
        'user_id',
        'weight',
        'height',
        'reason',
        'current_illness',
        'strain',
        'temperature',
        'breaths',
        'pulse',
        'saturation',
        'condition',
        'applied_studies',
        'info_add',

        //Signos vitales
        'hidratado',
        'eupenio',
        'febril',
        'esfera_neurologica',
        'glasgow',
        'esfera_orl',
        'esfera_cardiopulmonar',
        'esfera_abdominal',
        'extremidades',

        //Antecedentes Personales y Familiares
        'FB_EC',
        'FB_HA',
        'FB_D',
        'FB_C',
        'FB_C_input',
        'FB_AL',
        'FB_EM',
        'FB_EDP',
        'FB_TSM',
        'FB_AR',
        'FB_LES',
        'FB_EHC',
        'FB_TDT',
        'FB_ER',
        'FB_DM',
        'FB_NA',
        //Antecedentes personales patológicos
        'PB_HA',
        'PB_EC',
        'PB_A',
        'PB_EPOC',
        'PB_ADS',
        'PB_D',
        'PB_H',
        'PB_C',
        'PB_C_input',
        'PB_P',
        'PB_AL',
        'PB_M',
        'PB_AR',
        'PB_EM',
        'PB_U',
        'PB_G',
        'PB_SII',
        'PB_TDT',
        'PB_EHC',
        'PB_ERC',
        'PB_OO',
        'PB_FA',
        'PB_GLA',
        'PB_PCODC',
        'PB_TS',
        'PB_NA',
        //Historia no patológica
        'NPB_CA',
        'NPB_CFGYPL',
        'NPB_CFAAA',
        'NPB_CC',
        'NPB_CCD',
        'NPB_UFMVL',
        'NPB_EF',
        'NPB_SIPD',
        'NPB_NA',
        //INMUNIZACION
        'IM_V',
        'IM_V_input',
        'IM_BCG',
        'IM_HB',
        'IM_DTP',
        'IM_IPV_OPV',
        'IM_HIB',
        'IM_PCV',
        'IM_R',
        'IM_MMR',
        'IM_V',
        'IM_I',
        'IM_HA',
        'IM_M',
        'IM_VPH',
        'IM_N',
        'IM_HZ',
        'IM_NA',
        'IM_O',

        //info covid19
        'IMC19_covid',
        'IMC19_dosis',
        'IMC19_fecha_ultima_dosis',
        'IMC19_marca',

        //ENFERMEDADES MENTALES
        'EM_DMR',
        'EM_TB',
        'EM_TAG',
        'EM_TCO',
        'EM_TP',
        'EM_TEPT',
        'EM_E',
        'EM_TLP',
        'EM_TAAB',
        'EM_TCS',
        'EM_NA',

        //Historia ginecologicos si aplica
        'GINE_menarquia',
        'GINE_fecha_ultimo_pe',
        'GINE_duracion',
        'GINE_infecciones',
        'GINE_metodo_anti',
        'GINE_ex_gine_previos',
        'OBSTE_gravides',
        'OBSTE_partos',
        'OBSTE_cesareas',
        'OBSTE_abortos',
        'OBSTE_complicaciones',
        'MENOSPA_fecha_ini',
        'MENOSPA_sintomas',
        'MENOSPA_tratamiento',
        'ACTSEX_activo',
        'ACTSEX_enfermedades_ts',

        // Dispositivos medicos
        'MD_MP',
        'MD_DAI',
        'MD_IC',
        'MD_SC',
        'MD_PCR',
        'MD_BI',
        'MD_CVC',
        'MD_VC',
        'MD_ID',
        'MD_NEME',
        'MD_IR',
        'MD_DFV',
        'MD_MQ',
        'MD_PP',
        'MD_DII',
        'MD_NA',

        'allergies',
        'history_surgical',
        'medications_supplements',

        //observaciones
        'observations_ginecologica',
        'observations_allergies',
        'observations_medication',
        'observations_back_family',
        'observations_diagnosis',
        'observations_not_pathological',
        'observations_quirurgicas',
        'observations_inmunization',
        'observations_mental_healths',
        'observations_medical_devices'
    ];

    public function  get_paciente(): HasOne
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }


    public function  get_center(): HasOne
    {
        return $this->hasOne(Center::class, 'id', 'center_id');
    }

    public function  get_center_data(): HasOne
    {
        return $this->hasOne(DoctorCenter::class, 'id', 'center_id');
    }

}
