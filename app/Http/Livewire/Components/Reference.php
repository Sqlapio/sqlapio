<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ApiServicesController;
use App\Http\Controllers\UtilsController;
use App\Models\Center;
use App\Models\ExamPatient;
use App\Models\Patient;
use App\Models\Reference as ModelsReference;
use App\Models\Representative;
use App\Models\StudyPatient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Reference extends Component
{
    static function store($data, $medical_record_code,$medical_record)
    {

        /**
         * Logica para guardar los examenes y estudios
         * solicitados por el medico y generar la
         * referencia
         */

        $user = Auth::user();

        /** Validacion para cargar el centro correcto cuando el medico
             * esta asociado al plan corporativo
             */
            if ($user->center_id != null) {
                $center_id_corporativo = $user->center_id;
            }

        $reference = new ModelsReference();
        $reference->cod_ref = 'SQ-REF-' . random_int(11111111, 99999999);
        $reference->user_id = $user->id;
        $reference->patient_id = $data->id;
        $reference->center_id = isset($center_id_corporativo) ? $center_id_corporativo : $data->center_id;
        $reference->cod_medical_record = $medical_record_code;
        $reference->date = date('d-m-Y');
        $reference->medical_record_id = $medical_record->id;
        $reference->save();

        /**
         * Logica para aumentar el contador
         * de almacenamiento para el numero
         * de referencia cargadas por el medico.
         *
         * Esta logica se aplica al tema de los planes
         */
        UtilsController::update_ref_counter($user->id);

        /**
         * Notificacion al paciente
         * por haber sido registrado
         * en nuestro sistema
         */
        $type = 'reference';
        $patient = Patient::where('id', $reference->patient_id)->first();
        /**
         * Si es menor de edad
         */
        if($patient->is_minor == 'true'){
            $patient_email = Representative::where('patient_id', $reference->patient_id)->first()->re_email;
        }else{
            $patient_email = $patient->email;
        }

        /**
         * Envio de notificacion al whatsaap del paciente
         * indicando en codigo de referencia de los examenes
         * y/o estudio solicitados por el medico
         */

        // $center = Center::where('id', $data->center_id)->first()->description;
        // $patient = Patient::where('id', $data->id)->first();
        // $body = 'Sr(a). '
        //         .$patient->name.' '.$patient->last_name.
        //         ' acaba de recibir un consulta medica con el Dr(a). '
        //         .$user->name.' '.$user->last_name.' en el centro de salud: '
        //         .$center. '. El medico indico realizar ciertos Examenes y/o Estudios, el numero de Referencia es: '
        //         .$reference->cod_ref;

        // if($patient->is_minor == 'true'){
        //     $patient_phone = preg_replace('/[\(\)\-\" "]+/', '', $patient->get_reprensetative->re_phone);
        // }else{
        //     $patient_phone = preg_replace('/[\(\)\-\" "]+/', '', $patient->phone);
        // }

        // ApiServicesController::sms_reference_info($patient_phone, $body);

        /**
         * Funcion para recomendar el laboratorio
         * mas sercano
         */
        ApiServicesController::sms_location_lab();


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
                $exams_patient->user_id = $user->id;
                $exams_patient->center_id = isset($center_id_corporativo) ? $center_id_corporativo : $data->center_id;
                $exams_patient->patient_id = $data->id;
                $exams_patient->medical_record_id = $medical_record->id;
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
                $studies_patient->user_id = $user->id;
                $studies_patient->center_id = isset($center_id_corporativo) ? $center_id_corporativo : $data->center_id;
                $studies_patient->patient_id = $data->id;
                $studies_patient->medical_record_id = $medical_record->id;
                $studies_patient->date = date('d-m-Y');
                $studies_patient->save();
            }
        }


        if(isset($center_id_corporativo))
        {
            $mailData = [
                'dr_name' => $user->name . ' ' . $user->last_name,
                'center' => Center::where('id', $center_id_corporativo)->first()->description,
                'patient_name' => $patient->name . ' ' . $patient->last_name,
                'medical_record_code' => $reference->cod_medical_record,
                'reference_code' => $reference->cod_ref,
                'reference_date' => $reference->date,
                'patient_email' => $patient_email,
                'patient_exam' =>  $data_exams,
                'patient_study' =>  $data_studies ,
            ];

            UtilsController::notification_mail($mailData, $type);

        }else{

            $mailData = [
                'dr_name' => $user->name . ' ' . $user->last_name,
                'center' => Center::where('id', $reference->center_id)->first()->description,
                'patient_name' => $patient->name . ' ' . $patient->last_name,
                'medical_record_code' => $reference->cod_medical_record,
                'reference_code' => $reference->cod_ref,
                'reference_date' => $reference->date,
                'patient_email' => $patient_email,
                'patient_exam' =>  $data_exams,
                'patient_study' =>  $data_studies ,
            ];

            UtilsController::notification_mail($mailData, $type);
        }


    }

    public function render()
    {
        return view('livewire.components.reference');
    }
}
