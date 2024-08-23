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
            $user_id = Auth::user()->id;
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
                'cod_history'               => 'SQ-H-'.random_int(11111111, 99999999),
                'patient_id'                => $data->id,
                'user_id'                   => $user_id,
                'cod_patient'               => $cod_patient,
                'history_date'              => date('d-m-Y'),

                //Antecedentes Personales y Familiares
                'FB_EC'      => (isset($data->FB_EC) ? $data->FB_EC : null),
                'FB_HA'      => (isset($data->FB_HA) ? $data->FB_HA : null),
                'FB_D'       => (isset($data->FB_D) ? $data->FB_D : null),
                'FB_C'       => (isset($data->FB_C) ? $data->FB_C : null),
                'FB_C_input' => (isset($data->FB_C_input) ? $data->FB_C_input : null),
                'FB_AL'      => (isset($data->FB_AL) ? $data->FB_AL : null),
                'FB_EM'      => (isset($data->FB_EM) ? $data->FB_EM : null),
                'FB_EDP'     => (isset($data->FB_EDP) ? $data->FB_EDP : null),
                'FB_TSM'     => (isset($data->FB_TSM) ? $data->FB_TSM : null),
                'FB_AR'      => (isset($data->FB_AR) ? $data->FB_AR : null),
                'FB_LES'     => (isset($data->FB_LES) ? $data->FB_LES : null),
                'FB_EHC'     => (isset($data->FB_EHC) ? $data->FB_EHC : null),
                'FB_TDT'     => (isset($data->FB_TDT) ? $data->FB_TDT : null),
                'FB_ER'      => (isset($data->FB_ER) ? $data->FB_ER : null),
                'FB_DM'      => (isset($data->FB_DM) ? $data->FB_DM : null),
                'FB_NA'      => (isset($data->FB_NA) ? $data->FB_NA : null),

                //Antecedentes patologicos
                'PB_HA'    => (isset($data->PB_HA) ? $data->PB_HA : null),
                'PB_EC'    => (isset($data->PB_EC) ? $data->PB_EC : null),
                'PB_A'     => (isset($data->PB_A) ? $data->PB_A : null),
                'PB_EPOC'  => (isset($data->PB_EPOC) ? $data->PB_EPOC : null),
                'PB_ADS'   => (isset($data->PB_ADS) ? $data->PB_ADS : null),
                'PB_D'     => (isset($data-> PB_D) ? $data-> PB_D : null),
                'PB_H'     => (isset($data->PB_H) ? $data->PB_H : null),
                'PB_C'     => (isset($data->PB_C) ? $data->PB_C : null),
                'PB_P'     => (isset($data->PB_P) ? $data->PB_P : null),
                'PB_AL'    => (isset($data->PB_AL) ? $data->PB_AL : null),
                'PB_M'     => (isset($data->PB_M) ? $data->PB_M : null),
                'PB_AR'    => (isset($data->PB_AR) ? $data->PB_AR : null),
                'PB_EM'    => (isset($data->PB_EM) ? $data->PB_EM : null),
                'PB_U'     => (isset($data->PB_U) ? $data->PB_U : null),
                'PB_G'     => (isset($data->PB_G) ? $data->PB_G : null),
                'PB_SII'   => (isset($data->PB_SII) ? $data->PB_SII : null),
                'PB_TDT'   => (isset($data->PB_TDT) ? $data->PB_TDT : null),
                'PB_EHC'   => (isset($data->PB_TDT) ? $data->PB_TDT : null),
                'PB_ERC'   => (isset($data->PB_TDT) ? $data->PB_TDT : null),
                'PB_OO'    => (isset($data->PB_TDT) ? $data->PB_TDT : null),
                'PB_FA'    => (isset($data->PB_FA) ? $data->PB_FA : null),
                'PB_GLA'   => (isset($data->PB_GLA) ? $data->PB_GLA : null),
                'PB_PCODC' => (isset($data->PB_PCODC) ? $data->PB_PCODC : null),
                'PB_TS'    => (isset($data->PB_TS) ? $data->PB_TS : null),
                'PB_NA'    => (isset($data->PB_NA) ? $data->PB_NA : null),

                //Antecedentes no paothologicos
                'NPB_CA'      => (isset($data->NPB_CA) ? $data->NPB_CA : null),
                'NPB_CFGYPL'  => (isset($data->NPB_CFGYPL) ? $data->NPB_CFGYPL : null),
                'NPB_CFAAA'   => (isset($data->NPB_CFAAA) ? $data->NPB_CFAAA : null),
                'NPB_CC'      => (isset($data->NPB_CC) ? $data->NPB_CC : null),
                'NPB_CCD'     => (isset($data->NPB_CCD) ? $data->NPB_CCD : null),
                'NPB_UFMVL'   => (isset($data->NPB_UFMVL) ? $data->NPB_UFMVL : null),
                'NPB_EF'      => (isset($data->NPB_EF) ? $data->NPB_EF : null),
                'NPB_SIPD'    => (isset($data->NPB_SIPD) ? $data->NPB_SIPD : null),
                'NPB_NA'      => (isset($data->NPB_NA) ? $data->NPB_NA : null),

                //Enfermedades Mentales
                'EM_DMR'                   => (isset($data->EM_DMR) ? $data->EM_DMR : null),
                'EM_TB'                    => (isset($data->EM_TB) ? $data->EM_TB : null),
                'EM_TAG'                   => (isset($data->EM_TAG) ? $data->EM_TAG : null),
                'EM_TCO'                   => (isset($data->EM_TCO) ? $data->EM_TCO : null),
                'EM_TP'                    => (isset($data->EM_TP) ? $data->EM_TP : null),
                'EM_TEPT'                  => (isset($data->EM_TEPT) ? $data->EM_TEPT : null),
                'EM_E'                     => (isset($data->EM_E) ? $data->EM_E : null),
                'EM_TLP'                   => (isset($data->EM_TLP) ? $data->EM_TLP : null),
                'EM_TAAB'                  => (isset($data->EM_TAAB) ? $data->EM_TAAB : null),
                'EM_TCS'                   => (isset($data->EM_TCS) ? $data->EM_TCS : null),
                'EM_NA'                    => (isset($data->EM_NA) ? $data->EM_NA : null),

                //INMUNIZACION
                'IM_V'                    => (isset($data->IM_V) ? $data->IM_V : null),
                'IM_BCG'                  => (isset($data->IM_BCG) ? $data->IM_BCG : null),
                'IM_HB'                   => (isset($data->IM_HB) ? $data->IM_HB : null),
                'IM_DTP'                  => (isset($data->IM_DTP) ? $data->IM_DTP : null),
                'IM_IPV_OPV'              => (isset($data->IM_IPV_OPV) ? $data->IM_IPV_OPV : null),
                'IM_HIB'                  => (isset($data->IM_HIB) ? $data->IM_HIB : null),
                'IM_PCV'                  => (isset($data->IM_PCV) ? $data->IM_PCV : null),
                'IM_R'                    => (isset($data->IM_R) ? $data->IM_R : null),
                'IM_MMR'                  => (isset($data->IM_MMR) ? $data->IM_MMR : null),
                'IM_V'                    => (isset($data->IM_V) ? $data->IM_V : null),
                'IM_I'                    => (isset($data->IM_I) ? $data->IM_I : null),
                'IM_HA'                   => (isset($data->IM_HA) ? $data->IM_HA : null),
                'IM_M'                    => (isset($data->IM_M) ? $data->IM_M : null),
                'IM_VPH'                  => (isset($data->IM_VPH) ? $data->IM_VPH : null),
                'IM_N'                    => (isset($data->IM_N) ? $data->IM_N : null),
                'IM_HZ'                   => (isset($data->IM_HZ) ? $data->IM_HZ : null),
                'IM_NA'                   => (isset($data->IM_NA) ? $data->IM_NA : null),
                'IM_O'                    => (isset($data->IM_O) ? $data->IM_O : null),
                'IM_V_input'              => (isset($data->IM_V_input) ? $data->IM_V_input : null),

                //info covid19
                'IMC19_covid'               => (isset($data->IMC19_covid) ? $data->IMC19_covid : null),
                'IMC19_dosis'               => (isset($data->IMC19_dosis) ? $data->IMC19_dosis : null),
                'IMC19_fecha_ultima_dosis'  => (isset($data->IMC19_fecha_ultima_dosis) ? $data->IMC19_fecha_ultima_dosis : null),
                'IMC19_marca'               => (isset($data->IMC19_marca) ? $data->IMC19_marca : null),

                //Antecedentes ginecologicos
                'GINE_menarquia'            => (isset($data->GINE_menarquia) ? $data->GINE_menarquia : null),
                'GINE_fecha_ultimo_pe'      => (isset($data->GINE_fecha_ultimo_pe) ? $data->GINE_fecha_ultimo_pe : null),
                'GINE_duracion'             => (isset($data->GINE_duracion) ? $data->GINE_duracion : null),
                'GINE_infecciones'          => (isset($data->GINE_infecciones) ? $data->GINE_infecciones : null),
                'GINE_metodo_anti'          => (isset($data->GINE_metodo_anti) ? $data->GINE_metodo_anti : null),
                'GINE_ex_gine_previos'      => (isset($data->GINE_ex_gine_previos) ? $data->GINE_ex_gine_previos : null),
                'OBSTE_gravides'            => (isset($data->OBSTE_gravides) ? $data->OBSTE_gravides : null),
                'OBSTE_partos'              => (isset($data->OBSTE_partos) ? $data->OBSTE_partos : null),
                'OBSTE_cesareas'            => (isset($data->OBSTE_cesareas) ? $data->OBSTE_cesareas : null),
                'OBSTE_abortos'             => (isset($data->OBSTE_abortos) ? $data->OBSTE_abortos : null),
                'OBSTE_complicaciones'      => (isset($data->OBSTE_complicaciones) ? $data->OBSTE_complicaciones : null),
                'MENOSPA_fecha_ini'         => (isset($data->MENOSPA_fecha_ini) ? $data->MENOSPA_fecha_ini : null),
                'MENOSPA_sintomas'          => (isset($data->MENOSPA_sintomas) ? $data->MENOSPA_sintomas : null),
                'MENOSPA_tratamiento'       => (isset($data->MENOSPA_tratamiento) ? $data->MENOSPA_tratamiento : null),
                'ACTSEX_activo'             => (isset($data->ACTSEX_activo) ? $data->ACTSEX_activo : null),
                'ACTSEX_enfermedades_ts'    => (isset($data->ACTSEX_enfermedades_ts) ? $data->ACTSEX_enfermedades_ts : null),

                // Dispositivos medicos
                'MD_MP'   => (isset($data->MD_MP) ? $data->MD_MP : null),
                'MD_DAI'  => (isset($data->MD_DAI) ? $data->MD_DAI : null),
                'MD_IC'   => (isset($data->MD_IC) ? $data->MD_IC : null),
                'MD_SC'   => (isset($data->MD_SC) ? $data->MD_SC : null),
                'MD_PCR'  => (isset($data->MD_PCR) ? $data->MD_PCR : null),
                'MD_BI'   => (isset($data->MD_BI) ? $data->MD_BI : null),
                'MD_CVC'  => (isset($data->MD_CVC) ? $data->MD_CVC : null),
                'MD_VC'   => (isset($data->MD_VC) ? $data->MD_VC : null),
                'MD_ID'   => (isset($data->MD_ID) ? $data->MD_ID : null),
                'MD_NEME' => (isset($data->MD_NEME) ? $data->MD_NEME : null),
                'MD_IR'   => (isset($data->MD_IR) ? $data->MD_IR : null),
                'MD_DFV'  => (isset($data->MD_DFV) ? $data->MD_DFV : null),
                'MD_MQ'   => (isset($data->MD_MQ) ? $data->MD_MQ : null),
                'MD_PP'   => (isset($data->MD_PP) ? $data->MD_PP : null),
                'MD_DII'  => (isset($data->MD_DII) ? $data->MD_DII : null),
                'MD_NA'   => (isset($data->MD_NA) ? $data->MD_NA : null),


                'allergies'                 => (isset($data->arrayAllergies) ? $data->arrayAllergies : []),
                'history_surgical'          => (isset($data->arrayhistory_surgical) ? $data->arrayhistory_surgical : []),
                'medications_supplements'   => (isset($data->arraymedications_supplements) ? $data->arraymedications_supplements : []),

                //observaciones
                'observations_ginecologica'     =>(isset($data->observations_ginecologica) ? $data->observations_ginecologica : null) ,
                'observations_medication'       => $data->observations_medication,
                'observations_not_pathological' => $data->observations_not_pathological,
                'observations_diagnosis'        => $data->observations_diagnosis,
                'observations_back_family'      => $data->observations_back_family,
                'observations_allergies'        => $data->observations_allergies,
                'observations_quirurgicas'      => $data->observations_quirurgicas,
                'observations_inmunization'     =>(isset($data->observations_inmunization) ? $data->observations_inmunization : null) ,
                'observations_mental_healths'   =>(isset($data->observations_mental_healths) ? $data->observations_mental_healths : null) ,
                'observations_medical_devices'  =>(isset($data->observations_medical_devices) ? $data->observations_medical_devices : null) ,
            ]);

            $action = '6';
            ActivityLogController::store_log($action);

            return true;

        } catch (\Throwable $th) {
            return response()->json([
                'success' => 'false',
                'errors'  => $th->getMessage()
            ], 500);
        }
    }

    public function render()
    {
        return view('livewire.components.medical-history');
    }
}
