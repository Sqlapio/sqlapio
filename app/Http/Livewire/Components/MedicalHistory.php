<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UtilsController;
use App\Models\History;
use App\Models\Patient;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MedicalHistory extends Component
{

    /**
     * store history
     */
    public function store(Request $request)
    {
        try { 
            $data = json_decode($request->data);
            $patient = Patient::where('id',$data->id)->first();
            
            $patient_ci = $patient->ci;

                if($patient_ci == null){
                    $cod_patient = $patient->get_reprensetative->re_ci;
                }else{
                    $cod_patient = $patient_ci;
                }

    
            History::updateOrCreate(['patient_id' => $data->id],
            [
                'cod_history'       => 'SQ-H-'.random_int(11111111, 99999999),
                'patient_id'        => $data->id,
                'cod_patient'       => $cod_patient,
                'history_date'      => date('d-m-Y'),
                'weight'            => $data->weight,
                'height'            => $data->height,
                'reason'            => $data->reason,
                'current_illness'   => $data->current_illness,

                'strain'            => $data->strain.'/'.$data->strain_two,

                'temperature'       => $data->temperature,
                'breaths'           => $data->breaths,
                'pulse'             => $data->pulse,
                'saturation'        => $data->saturation,
                'condition'         => $data->condition,
                'applied_studies'   => $data->applied_studies,

                //Signos vitales
                'hidratado'             => (isset($data->hidratado) ? $data->hidratado : null),
                'febril'                => (isset($data->febril) ? $data->febril : null),
                'esfera_neurologica'    => (isset($data->esfera_neurologica) ? $data->esfera_neurologica : null),
                'glasgow'               => (isset($data->glasgow) ? $data->glasgow : null),
                'esfera_orl'            => (isset($data->esfera_orl) ? $data->esfera_orl : null),
                'esfera_cardiopulmonar' => (isset($data->esfera_cardiopulmonar) ? $data->esfera_cardiopulmonar : null),
                'esfera_abdominal'      => (isset($data->esfera_abdominal) ? $data->esfera_abdominal : null),
                'extremidades'          => (isset($data->extremidades) ? $data->extremidades : null),

                //Antecedentes Personales y Familiares
                'cancer'                    => (isset($data->cancer) ? $data->cancer : null),
                'diabetes'                  => (isset($data->diabetes) ? $data->diabetes : null),
                'tension_alta'              => (isset($data->tension_alta) ? $data->tension_alta : null),
                'cardiacos'                 => (isset($data->cardiacos) ? $data->cardiacos : null),
                'psiquiatricas'             => (isset($data->psiquiatricas) ? $data->psiquiatricas : null),
                'alteraciones_coagulacion'  => (isset($data->alteraciones_coagulacion) ? $data->alteraciones_coagulacion : null),
                'tranfusiones_sanguineas'   => (isset($data->tranfusiones_sanguineas) ? $data->tranfusiones_sanguineas : null),
                'COVID19'                   => (isset($data->COVID19) ? $data->COVID19 : null),
                'no_aplica'                 => (isset($data->no_aplica) ? $data->no_aplica : null),


                //Antecedentes patologicos
                'hepatitis'                 => (isset($data->hepatitis) ? $data->hepatitis : null),
                'VIH_SIDA'                  => (isset($data->VIH_SIDA) ? $data->VIH_SIDA : null),
                'gastritis_ulceras'         => (isset($data->gastritis_ulceras) ? $data->gastritis_ulceras : null),
                'neurologia'                => (isset($data->neurologia) ? $data->neurologia : null),
                'ansiedad_angustia'         => (isset($data->ansiedad_angustia) ? $data->ansiedad_angustia : null),
                'tiroides'                  => (isset($data->tiroides) ? $data->tiroides : null),
                'lupus'                     => (isset($data->lupus) ? $data->lupus : null),
                'enfermedad_autoimmune'     => (isset($data->denfermedad_autoimmune) ? $data->COVID19 : null),
                'diabetes_mellitus'         => (isset($data->diabetes_mellitus) ? $data->diabetes_mellitus : null),
                'presion_arterial_alta'     => (isset($data->presion_arterial_alta) ? $data->presion_arterial_alta : null),
                'tiene_cateter_venoso'      => (isset($data->tiene_cateter_venoso) ? $data->tiene_cateter_venoso : null),
                'fracturas'                 => (isset($data->fracturas) ? $data->fracturas : null),
                'trombosis_venosa'          => (isset($data->trombosis_venosa) ? $data->trombosis_venosa : null),
                'embolia_pulmonar'          => (isset($data->embolia_pulmonar) ? $data->embolia_pulmonar : null),
                'varices_piernas'           => (isset($data->varices_piernas) ? $data->varices_piernas : null),
                'insuficiencia_arterial'    => (isset($data->varices_piernas) ? $data->varices_piernas : null),
                'coagulación_anormal'       => (isset($data->hepacoagulación_anormaltitis) ? $data->hepacoagulación_anormaltitis : null),
                'moretones_frecuentes'      => (isset($data->moretones_frecuentes) ? $data->moretones_frecuentes : null),
                'sangrado_cirugías_previas' => (isset($data->sangrado_cirugías_previas) ? $data->sangrado_cirugías_previas : null),
                'sangrado_cepillado_dental' => (isset($data->sangrado_cepillado_dental) ? $data->sangrado_cepillado_dental : null),
                'no_aplic_pathology'        => (isset($data->no_aplic_pathology) ? $data->no_aplic_pathology : null),

                //Antecedentes no paothologicos
                'alcohol'                   => (isset($data->alcohol) ? $data->alcohol : null),
                'drogas'                    => (isset($data->drogas) ? $data->drogas : null),
                'vacunas_recientes'         => (isset($data->vacunas_recientes) ? $data->vacunas_recientes : null),
                'transfusiones_sanguíneas'  => (isset($data->transfusiones_sanguíneas) ? $data->transfusiones_sanguíneas : null),
                'no_aplica_no_pathology'    => (isset($data->no_aplica_no_pathology) ? $data->no_aplica_no_pathology : null),

                //Antecedentes ginecologicos
                'edad_primera_menstruation' => (isset($data->edad_primera_menstruation) ? $data->edad_primera_menstruation : null),
                'fecha_ultima_regla'        => (isset($data->fecha_ultima_regla) ? $data->fecha_ultima_regla : null),
                'numero_embarazos'          => (isset($data->numero_embarazos) ? $data->numero_embarazos : null),
                'numero_partos'             => (isset($data->numero_partos) ? $data->numero_partos : null),
                'numero_abortos'            => (isset($data->numero_abortos) ? $data->numero_abortos : null),
                'pregunta'                  => (isset($data->pregunta) ? $data->pregunta : null),
                'cesareas'                  => (isset($data->cesareas) ? $data->cesareas : null),
                'allergies'                 => $data->arrayAllergies,
                'history_surgical'          => $data->arrayhistory_surgical,
                'medications_supplements'   => $data->arraymedications_supplements,
                //observaciones
                'observations_ginecologica'   => $data->observations_ginecologica,
                'observations_medication'   => $data->observations_medication,   
                'observations_not_pathological'=>  $data->observations_not_pathological,
                'observations_diagnosis'    => $data->observations_diagnosis,
                'observations_back_family'  => $data->observations_back_family,
                'observations_allergies'=> $data->observations_allergies,
            ]);

            $action = '6';
            ActivityLogController::store_log($action);          
    
            return true;

        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error Livewire.Components.MedicalHistory.store()', $message);
        }
    }
    
    public function render()
    {
        return view('livewire.components.medical-history');
    }
}
