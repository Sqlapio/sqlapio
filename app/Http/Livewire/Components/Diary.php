<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UtilsController;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Representative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Diary extends Component
{

    public function search_patients($patient_code)
    {
        try {
            $patient = Patient::where('patient_code', $patient_code)->first();
            if($patient->is_minor == 'false'){
                return $patient;
            }else{
                $patient_re = [
                "re_name" =>$patient->get_reprensetative->re_name ,
                "re_last_name" =>$patient->get_reprensetative->re_last_name ,
                "re_email"  => $patient->get_reprensetative->re_email ,
                "re_phone" => $patient->get_reprensetative->re_phone ,
                "re_ci" =>  $patient->get_reprensetative->re_ci ,
                "genere" =>  $patient->genere ,
                "age" => $patient->age ,
                "id" =>  $patient->id,
                "patient_img"=> $patient->patient_img,
                ];
                return $patient_re;
            }
        } catch (\Throwable $th) {
            dd($th);
        }

    }

    public function store(Request $request)
    {
        try {

            $rules = [
                'date_start' => 'required',
                'hour_start' => 'required',
                'center_id' => 'required'
            ];

            $msj = [
                'date_start.required' => 'Campo requerido',
                'hour_start.required' => 'Campo requerido',
                'center_id.required' => 'Campo requerido',
            ];

            $validator = Validator::make($request->all(), $rules, $msj);

            if ($validator->fails())
            {
                return response()->json([
                    'success' => 'false',
                    'errors'  => $validator->errors()->all()
                ], 400);
            }

            $date= explode('-',$request->hour_start);
            $appointment = new Appointment();
            $appointment->code = 'SQ-D-'.random_int(11111111, 99999999);
            $appointment->user_id = Auth::user()->id;
            $appointment->patient_id = $request->patient_id;
            $appointment->date_start = $request->date_start;
            $appointment->hour_start = $date[0].'-'.$date[1]." ".$request->timeIni;
            $appointment->center_id = $request->center_id;
            $appointment->price = $request->price;
            $appointment->color = $date[2];

            //Validacion para evitar que la citas se registren en mismo dia a la misma hora

            $validate_dairy = Appointment::where('date_start', $request->date_start)
            ->where('hour_start', $request->hour_start." ".$request->timeIni)
            ->where('status',1)
            ->first();

            if(isset($validate_dairy))
            {
                return response()->json([
                    'success' => 'false',
                    'errors'  => 'Ya usted tiene una cita agendada en esa posicion'
                ], 400);

            }else{

                $appointment->save();

            }

            $action = '7';
            ActivityLogController::store_log($action);

             /**
             * Logica para el envio de la notificacion
             * via correo electronico
             */
            $user = Auth::user();
            $patient = Patient::where('id', $request->patient_id)->first();
            /**
             * Paciente menor de edad
             */
            if($patient->is_minor == 'true'){
                $patient_email = $patient->get_reprensetative->re_email;
            }else{
                $patient_email = $patient->email;
            }

            $type = 'appointment';
            $mailData = [
                'dr_name'       => $user->name. ' ' .$user->last_name,
                'dr_email'      => $user->email,
                'patient_name'  => $patient->name. ' ' .$patient->last_name,
                'cod_patient'   => $patient->patient_code,
                'patient_email' => $patient_email,
                'fecha'         => $request->date_start,
                'horario'       => $date[0].' '.$request->timeIni,
                'centro'        => $appointment->get_center->description,
                'link'          => 'http://sqldevelop.sqlapio.net/confirmation/dairy/' . $appointment->code,
            ];

            UtilsController::notification_mail($mailData, $type);

            return true;

        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error Livewire.Components.Diary.store()', $message);
        }

    }

    public function cancelled($id)
    {
        try {
            $cancelled = DB::table('appointments')
                ->where('id', $id)
                /**
                 * Status 2 => FINALIZADA
                 * Status 3 => CANCELADA
                 */
                ->update(['status' => 3]);

            $action = '12';
            ActivityLogController::store_log($action);

            return true;

        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error Livewire.Components.Diary.cancelled()', $message);
        }

    }

    public function update(Request $request)
    {
        try {

            $validate = Appointment::where('date_start', $request->start)
            ->where('hour_start', 'like', '%'.$request->extendedProps['data'].'%')
            ->first();
            if($validate != null )
            {
                if($request)
                return response()->json([
                    'success' => 'false',
                    'errors'  => 'Ya usted tiene una cita agendada en esa posicion'
                ], 400);

            }else{

                DB::table('appointments')
                ->where('id', $request->id)
                ->update([
                            'date_start' => $request->start,
                        ]);

                $action = '14';
                ActivityLogController::store_log($action);
            }

            return true;

        } catch (\Throwable $th) {
            $message = $th->getMessage();
			dd('Error Livewire.Components.Diary.update()', $message);
        }

    }

    public function render()
    {
        $appointments = UtilsController::get_appointments(Auth::user()->id);
        $patient = UtilsController::get_patients();
        return view('livewire.components.diary', compact('appointments','patient'));
    }
}
