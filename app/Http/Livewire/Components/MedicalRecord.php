<?php

namespace App\Http\Livewire\Components;


use Livewire\Component;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UtilsController;
use App\Http\Livewire\Components\Reference as ComponentsReference;
use App\Models\DoctorCenter;
use App\Models\Exam;
use App\Models\ExamPatient;
use App\Models\MedicalRecord as ModelsMedicalRecord;
use App\Models\Patient;
use App\Models\Reference;
use App\Models\Representative;
use App\Models\Study;
use App\Models\StudyPatient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MedicalRecord extends Component
{

    public function store(Request $request){

        try {
            
            $data = json_decode($request->data);
            $user = Auth::user()->id;

            /**
             * Paciente mayor de edad
             */
            $patient = Patient::where('id', $data->id)->first();
            $is_minor = $patient->is_minor;
            $ci = $patient->ci;           
            
            /**
             * Paciente menor de edad
             */
            if($is_minor === "true"){
                $patient_minor = Representative::where('patient_id', $data->id)->first();
                $patient_email = $patient_minor->email_re;
                $ci = $patient_minor->re_ci;             
            }

            $rules = [
                'background'  => 'required',
                'razon'       => 'required',
                'diagnosis'   => 'required',
                'treatment'   => 'required',
                'exams'       => 'required',
                'studies'     => 'required',
            ];

            $msj = [
                'background'  => 'Campo requerido',
                'razon'       => 'Campo requerido',
                'diagnosis'   => 'Campo requerido',
                'treatment'   => 'Campo requerido',
                'exams'       => 'Campo requerido',
                'studies'     => 'Campo requerido',
            ];

            // $validator = Validator::make($request->data, $rules, $msj);

            // if ($validator->fails()) {
            //     return response()->json([
            //         'success' => 'false',
            //         'errors'  => $validator->errors()->all()
            //     ], 400);
            // }
            
            $medical_record = ModelsMedicalRecord::updateOrCreate(['id' => $data->medical_record_id],
            [
                /**
                 * @method store()
                 * 
                 * Este metodo recibe como llaves principales el id del medico, id del paciente y el
                 * id del centro.
                 */
                'user_id'       => $user,
                'patient_id'    => $data->id,
                'center_id'     => $data->center_id,
                'record_code'   => 'SQ-C-'.random_int(11111111, 99999999),
                'record_date'   => date('d-m-Y'),
                'background'    => $data->background,
                'razon'         => $data->razon,
                'diagnosis'     => $data->diagnosis,
                'treatment'     => $data->treatment,
                'exams'         => $data->exams,
                'studies'       => $data->studies,
            ]);

            $action = '11';
            ActivityLogController::store_log($action);

            /**
             * Logica para aumentar el contador
             * de almacenamiento para el numero 
             * de consultas cargadas por el medico.
             * 
             * Esta logica se aplica al tema de los planes
             */
            UtilsController::update_mr_counter($user);

            /**
             * Logica para guardar los examenes y estudios
             * solicitados por el medico y generar la 
             * referencia
             */
            $medical_record_code = $medical_record['record_code'];
            ComponentsReference::store($data, $medical_record_code);

            // $reference = new Reference();
            // $reference->cod_ref = 'SQ-REF-'.random_int(11111111, 99999999);
            // $reference->user_id = $user;
            // $reference->patient_id = $data->id;
            // $reference->center_id = $data->center_id;
            // $reference->cod_medical_record = $medical_record['record_code'];
            // $reference->date = date('d-m-Y');
            // $reference->exams = $data->exams;
            // $reference->studies = $data->studies;
            // $reference->save();

            /**
             * Logica para cargar los examenes
             * cargados en la referencia.
             */
            
            // if(isset($data->exams_array)){

            //     $data_exams = json_decode($data->exams_array);
    
            //     for ($i = 0; $i < count($data_exams); $i++){
            //         $exams_patient = new ExamPatient();
            //         $exams_patient->record_code = $reference->cod_medical_record;
            //         $exams_patient->cod_ref = $reference->cod_ref;
            //         $exams_patient->cod_exam = $data_exams[$i]->code_exams;
            //         $exams_patient->description = UtilsController::get_description_exam($data_exams[$i]->code_exams);
            //         $exams_patient->ref_id = $reference->id;
            //         $exams_patient->user_id = $user;
            //         $exams_patient->center_id = $data->center_id;
            //         $exams_patient->patient_id = $data->id;
            //         $exams_patient->date = date('d-m-Y');
            //         $exams_patient->save();
            //     }
            // }

            /**
             * Logica para cargar los examenes
             * cargados en la referencia.
             */

            // if(isset($data->studies_array)){

            //     $data_studies = json_decode($data->studies_array);

            //     for ($i = 0; $i < count($data_studies); $i++){
            //         $studies_patient = new StudyPatient();
            //         $studies_patient->record_code = $reference->cod_medical_record;
            //         $studies_patient->cod_ref = $reference->cod_ref;
            //         $studies_patient->cod_study = $data_studies[$i]->code_studies;
            //         $studies_patient->description = UtilsController::get_description_study($data_studies[$i]->code_studies);
            //         $studies_patient->ref_id = $reference->id;
            //         $studies_patient->user_id = $user;
            //         $studies_patient->center_id = $data->center_id;
            //         $studies_patient->patient_id = $data->id;
            //         $studies_patient->date = date('d-m-Y');
            //         $studies_patient->save();
            //     }
            // }
             
            $action = '15';
            ActivityLogController::store_log($action);

            return true;

        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd('Error Livewire.Components.MedicalRecord.store()', $message);
        }
    }

    public function render($id)
    {
        $user_id = Auth::user()->id;
        $doctor_centers = DoctorCenter::where('user_id', $user_id)->where('status', 1)->get();
        $Patient = UtilsController::get_one_patient($id);
        $medical_record_user = UtilsController::get_medical_record_user($id);
        $validate_histroy = $Patient->get_history;
        $exam = Exam::all();    
        $study = Study::all();      
        return view('livewire.components.medical-record',compact('Patient', 'doctor_centers','validate_histroy','medical_record_user','id','exam','study'));
    }
}
