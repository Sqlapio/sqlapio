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
        'cancer',
        'diabetes',
        'tension_alta',
        'cardiacos',
        'psiquiatricas',
        'alteraciones_coagulacion',
        'trombosis_embolas',
        'tranfusiones_sanguineas',
        'COVID19',
        'no_aplica_back',

        //Antecedentes personales patológicos
        'hepatitis',
        'VIH_SIDA',
        'gastritis_ulceras',
        'neurologia',
        'ansiedad_angustia',
        'tiroides',
        'lupus',
        'enfermedad_autoimmune',
        'diabetes_mellitus',
        'presion_arterial_alta',
        'tiene_cateter_venoso',
        'fracturas',
        'trombosis_venosa',
        'embolia_pulmonar',
        'varices_piernas',
        'insuficiencia_arterial',
        'coagulacion_anormal',
        'moretones_frecuentes',
        'sangrado_cirugias_previas',
        'sangrado_cepillado_dental',
        'no_aplic_pathology',


        //Historia no patológica
        'alcohol',
        'drogas',
        'vacunas_recientes',
        'transfusiones_sanguineas',
        'no_aplica_no_pathology',

        //Historia ginecologicos si aplica
        'edad_primera_menstruation',
        'fecha_ultima_regla',
        'numero_embarazos',
        'numero_partos',
        'numero_abortos',
        'pregunta',
        'cesareas',
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
