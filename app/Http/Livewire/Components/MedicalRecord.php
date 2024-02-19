<?php

namespace App\Http\Livewire\Components;


use Livewire\Component;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UtilsController;
use App\Http\Livewire\Components\Reference as ComponentsReference;
use App\Models\Appointment;
use App\Models\DoctorCenter;
use App\Models\Exam;
use App\Models\ExamPatient;
use App\Models\MedicalRecord as ModelsMedicalRecord;
use App\Models\MedicalReport;
use App\Models\Patient;
use App\Models\PhysicalExam;
use App\Models\Reference;
use App\Models\Representative;
use App\Models\Study;
use App\Models\Symptom;
use App\Models\StudyPatient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MedicalRecord extends Component
{

    public function store(Request $request)
    {

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
                'medications_supplements' => 'required',
            ];

            $msj = [
                'background'  => 'Campo requerido',
                'razon'       => 'Campo requerido',
                'diagnosis'   => 'Campo requerido',
                'medications_supplements' => 'Campo requerido',
            ];

            /** Validacion para cargar el centro correcto cuando el medico
             * esta asociado al plan corporativo
             */
            if (Auth::user()->center_id != null) {
                $center_id_corporativo = Auth::user()->center_id;
            }

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
                'center_id'     => isset($center_id_corporativo) ? $center_id_corporativo : $data->center_id,
                'record_code'   => 'SQ-C-'.random_int(11111111, 99999999),
                'record_date'   => date('d-m-Y'),
                'background'    => $data->background,
                'razon'         => $data->razon,
                'diagnosis'     => $data->diagnosis,
                'sintomas'     => $data->sintomas,
                'medications_supplements' => $data->medications_supplements,
            ]);

            /**
             * Logica para Finalizar la cita en la agenda y mostrar el
             * status de finsalizada en la tabla del dashboard
             */
            Appointment::where('patient_id', $data->id)
                ->where('user_id', $user)
                ->where('date_start', date('Y-m-d'))
                ->update([
                    'status' => 3,   /** FINALIZADA EN LA AGENDA */
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
            ComponentsReference::store($data, $medical_record_code,$medical_record);

            $action = '15';
            ActivityLogController::store_log($action);

            return true;

        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd('Error Livewire.Components.MedicalRecord.store()', $message);
        }
    }

    public function store_physical_exams(Request $request)
    {

        try {

            $rules = [
                'weight'        => 'required',
                'height'        => 'required',
                'strain'        => 'required',
                'temperature'   => 'required',
                'breaths'       => 'required',
                'pulse'         => 'required',
                'saturation'    => 'required',
                'condition'     => 'required',
            ];

            $msj = [
                'weight'        => 'Campo requerido',
                'height'        => 'Campo requerido',
                'strain'        => 'Campo requerido',
                'temperature'   => 'Campo requerido',
                'breaths'       => 'Campo requerido',
                'pulse'         => 'Campo requerido',
                'saturation'    => 'Campo requerido',
                'condition'     => 'Campo requerido',
            ];

            $validator = Validator::make($request->all(), $rules, $msj);

            if ($validator->fails()) {
                return response()->json([
                    'success' => 'false',
                    'errors'  => $validator->errors()->all()
                ], 400);
            }

            /** Validacion para cargar el centro correcto cuando el medico
             * esta asociado al plan corporativo
             */
            if (Auth::user()->center_id != null) {
                $center_id_corporativo = Auth::user()->center_id;
            }

            $physical_exams = new PhysicalExam();
            $physical_exams->patient_id = $request->patient_id;
            $physical_exams->user_id = Auth::user()->id;
            $physical_exams->center_id = isset($center_id_corporativo) ? $center_id_corporativo : $request->center_id;
            $physical_exams->date = date('d-m-Y');
            $physical_exams->weight = $request->weight;
            $physical_exams->height = $request->height;
            $physical_exams->strain = $request->strain;
            $physical_exams->temperature = $request->temperature;
            $physical_exams->breaths = $request->breaths;
            $physical_exams->pulse = $request->pulse;
            $physical_exams->saturation = $request->saturation;
            $physical_exams->condition = $request->condition;
            $physical_exams->hidratado = $request->hidratado;
            $physical_exams->eupenico = $request->eupenico;
            $physical_exams->febril = $request->febril;
            $physical_exams->esfera_neurologica = $request->esfera_neurologica;
            $physical_exams->glasgow = $request->glasgow;
            $physical_exams->esfera_orl = $request->esfera_orl;
            $physical_exams->esfera_cardiopulmonar = $request->esfera_cardiopulmonar;
            $physical_exams->esfera_abdominal = $request->esfera_abdominal;
            $physical_exams->extremidades = $request->extremidades;
            $physical_exams->observations = $request->observations;
            $physical_exams->save();

            $action = '24';
            ActivityLogController::store_log($action);

            $physical_exams = PhysicalExam::where('patient_id', $request->patient_id)->with('get_center')->get();

            return  $physical_exams;

        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd('Error Livewire.Components.MedicalRecord.store_physical_exams()', $message);
        }
    }

    public function informe_medico (Request $request)
    {

        $rules = [
            'TextInforme'  => 'required',
        ];

        $msj = [
            'TextInforme'  => 'Debe relleñar el text area para poder crear un informe válido',
        ];

        $validator = Validator::make($request->all(), $rules, $msj);

        if ($validator->fails()) {
            return response()->json([
                'success' => 'false',
                'errors'  => $validator->errors()->all()
            ], 400);
        }

        /** Validacion para cargar el centro correcto cuando el medico
         * esta asociado al plan corporativo
         */
        if (Auth::user()->center_id != null) {
            $center_id_corporativo = Auth::user()->center_id;
        }

       MedicalReport::updateOrCreate(
            ['id' => $request->medical_report_id],
            [
                'cod_medical_report' => 'SQ-MR-'.random_int(11111111, 99999999),
                'user_id'       => $request->user_id,
                'patient_id'    => $request->patient_id,
                'center_id'     => isset($center_id_corporativo) ? $center_id_corporativo : $request->center_id,
                'date'          => date('d-m-Y'),
                'description'   => $request->TextInforme,
            ]
        );


        $medical_report = UtilsController::get_medical_report($request->patient_id);


        return $medical_report ;

    }

    public function render($id)
    {
        $user_id = Auth::user()->id;
        $doctor_centers = DoctorCenter::where('user_id', $user_id)->where('status', 1)->get();
        $Patient = UtilsController::get_one_patient($id);
        $medical_record_user = UtilsController::get_medical_record_user($id);
        $medical_report = UtilsController::get_medical_report($id);
        $validate_histroy = $Patient->get_history;
        $exam = Exam::all();
        $study = Study::all();
        $symptoms = Symptom::all();
        $vital_sing = UtilsController::get_history_vital_sing();
        $get_condition = UtilsController::get_condition();
        $physical_exams = PhysicalExam::where('patient_id', $id)->get();

        return view('livewire.components.medical-record',compact(
            'Patient',
             'doctor_centers',
             'validate_histroy',
             'medical_record_user',
             'id',
             'exam',
             'study',
             'symptoms',
             'medical_report',
             'vital_sing',
             'get_condition',
            "physical_exams"
            ));
    }
}
