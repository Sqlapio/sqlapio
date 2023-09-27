<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\UtilsController;
use App\Models\ExamPatient;
use App\Models\Reference as ModelsReference;
use App\Models\StudyPatient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Reference extends Component
{
    static function store($data, $medical_record_code)
    {

        /**
         * Logica para guardar los examenes y estudios
         * solicitados por el medico y generar la 
         * referencia
         */

        $user = Auth::user()->id;

        $reference = new ModelsReference();
        $reference->cod_ref = 'SQ-REF-' . random_int(11111111, 99999999);
        $reference->user_id = $user;
        $reference->patient_id = $data->id;
        $reference->center_id = $data->center_id;
        $reference->cod_medical_record = $medical_record_code;
        $reference->date = date('d-m-Y');
        $reference->exams = $data->exams;
        $reference->studies = $data->studies;
        $reference->save();

        /**
         * Logica para aumentar el contador
         * de almacenamiento para el numero 
         * de referencia cargadas por el medico.
         * 
         * Esta logica se aplica al tema de los planes
         */
        UtilsController::update_ref_counter($user);

        /**
         * Logica para cargar los examenes
         * cargados en la referencia.
         */

        if (isset($data->exams_array)) {

            $data_exams = json_decode($data->exams_array);

            for ($i = 0; $i < count($data_exams); $i++) {
                $exams_patient = new ExamPatient();
                $exams_patient->record_code = $reference->cod_medical_record;
                $exams_patient->cod_ref = $reference->cod_ref;
                $exams_patient->cod_exam = $data_exams[$i]->code_exams;
                $exams_patient->description = UtilsController::get_description_exam($data_exams[$i]->code_exams);
                $exams_patient->ref_id = $reference->id;
                $exams_patient->user_id = $user;
                $exams_patient->center_id = $data->center_id;
                $exams_patient->patient_id = $data->id;
                $exams_patient->date = date('d-m-Y');
                $exams_patient->save();
            }
        }

        /**
         * Logica para cargar los examenes
         * cargados en la referencia.
         */

        if (isset($data->studies_array)) {

            $data_studies = json_decode($data->studies_array);

            for ($i = 0; $i < count($data_studies); $i++) {
                $studies_patient = new StudyPatient();
                $studies_patient->record_code = $reference->cod_medical_record;
                $studies_patient->cod_ref = $reference->cod_ref;
                $studies_patient->cod_study = $data_studies[$i]->code_studies;
                $studies_patient->description = UtilsController::get_description_study($data_studies[$i]->code_studies);
                $studies_patient->ref_id = $reference->id;
                $studies_patient->user_id = $user;
                $studies_patient->center_id = $data->center_id;
                $studies_patient->patient_id = $data->id;
                $studies_patient->date = date('d-m-Y');
                $studies_patient->save();
            }
        }
    }
    public function render()
    {
        return view('livewire.components.reference');
    }
}
