<?php

namespace App\Http\Livewire\Components;

use App\Models\ExamPatient;
use App\Models\Laboratory as ModelsLaboratory;
use App\Models\Patient;
use App\Models\StudyPatient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Laboratory extends Component
{

    static function res_exams()
    {
        try {
            
            $user = Auth::user();

            $laboratory = ModelsLaboratory::where('user_id', $user->id)->first();

            /**
             * Logica para recuperar los examenes realizados
             * por cada laboratorio
             */
            if($laboratory != null)
            {
            $data_exam_res = [];
            $exams_res = ExamPatient::where('laboratory_id', $laboratory->id)
                ->where('status', '2')
                ->get();
                foreach ($exams_res as $key => $value) 
                {
                    $patient = Patient::where('id', $value->patient_id)->first();
                    if($patient->is_minor != 'true'){
                        $data_exam_res[$key] = [
                            'date_ref'          => $value->date,
                            'date_upload_res'   => $value->date_result,
                            'cod_ref'       => $value->cod_ref,
                            'cod_exam'      => $value->cod_exam,
                            'description'   => $value->description,
                            'patient_info'  => [
                                'full_name'     => $patient->name.' '.$patient->last_name,
                                'name'          => $patient->name,
                                'last_name'     => $patient->last_name,
                                'ci'            => $patient->ci,
                                'email'         => $patient->email,
                                'genere'        => $patient->genere,
                            ]
                        ];
                    }else{
                        $data_exam_res[$key] = [
                            'date_ref'          => $value->date,
                            'date_upload_res'   => $value->date_result,
                            'cod_ref'       => $value->cod_ref,
                            'cod_exam'      => $value->cod_exam,
                            'description'   => $value->description,
                            'patient_info'  => [
                                'is_minor'      => $patient->is_minor,
                                'full_name'     => $patient->name.' '.$patient->last_name,
                                'name'          => $patient->name,
                                'ci'         => $patient->get_reprensetative->re_ci,
                                're_name'       => $patient->get_reprensetative->re_name,
                                're_last_name'  => $patient->get_reprensetative->re_last_name,
                                're_email'      => $patient->get_reprensetative->re_email,
                                'genere'        => $patient->genere,
                            ]
                        ];
                    }
                }
            //     if(isset($data_exam_res)){
            //         return $data_exam_res;
            //     }else{
            //         return false;
            //     }
            // }else{

            //     return false;
            }
            return $data_exam_res;
        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error livewire.Laboratory.references_res()', $message);
        }
        
    }

    static function res_studies()
    {
        try {
            
            $user = Auth::user();

            $laboratory = ModelsLaboratory::where('user_id', $user->id)->first();

            /**
             * Logica para recuperar los examenes realizados
             * por cada laboratorio
             */
            if($laboratory != null)
            {
            $data_study_res = [];
            $study_res = StudyPatient::where('laboratory_id', $laboratory->id)
                ->where('status', '2')
                ->get();
                    foreach ($study_res as $key => $value)
                    {
                        $patient = Patient::where('id', $value->patient_id)->first();
                        if($patient->is_minor != 'true'){
                            $data_study_res[$key] = [
                                'date_ref'          => $value->date,
                                'date_upload_res'   => $value->date_result,
                                'cod_ref'       => $value->cod_ref,
                                'cod_study'      => $value->cod_study,
                                'description'   => $value->description,
                                'patient_info'  => [
                                    'full_name'     => $patient->name.' '.$patient->last_name,
                                    'name'          => $patient->name,
                                    'last_name'     => $patient->last_name,
                                    'ci'            => $patient->ci,
                                    'email'         => $patient->email,
                                    'genere'        => $patient->genere,
                                ]
                            ];
                        }else{
                            $data_study_res[$key] = [
                                'date_ref'          => $value->date,
                                'date_upload_res'   => $value->date_result,
                                'cod_ref'       => $value->cod_ref,
                                'cod_study'      => $value->cod_study,
                                'description'   => $value->description,
                                'patient_info'  => [
                                    'is_minor'      => $patient->is_minor,
                                    'full_name'     => $patient->name.' '.$patient->last_name,
                                    'name'          => $patient->name,
                                    'ci'         => $patient->get_reprensetative->re_ci,
                                    're_name'       => $patient->get_reprensetative->re_name,
                                    're_last_name'  => $patient->get_reprensetative->re_last_name,
                                    're_email'      => $patient->get_reprensetative->re_email,
                                    'genere'        => $patient->genere,
                                ]
                            ];
                        }
                    }
                    // if(isset($data_study_res)){
                    //     return $data_study_res;
                    // }else{
                    //     return false;
                    // }
            // }else{
            //     return $data_study_res;
            }
            return $data_study_res;

        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error livewire.Laboratory.references_res()', $message);
        }
        
    }   

    public function render()
    {
        return view('livewire.components.laboratory');
    }
}
