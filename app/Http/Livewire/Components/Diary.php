<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ApiServicesController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\UtilsController;
use App\Models\Appointment;
use App\Models\Center;
use App\Models\DoctorCenter;
use App\Models\Patient;
use App\Models\Representative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Illuminate\Support\Str;

class Diary extends Component
{

    // public function search_patients($patient_code)
    // {
    //     try {
    //         $patient = Patient::where('patient_code', $patient_code)->first();
    //         if ($patient->is_minor == 'false') {
    //             return $patient;
    //         } else {
    //             $patient_re = [
    //                 "re_name"      => $patient->get_reprensetative->re_name,
    //                 "re_last_name" => $patient->get_reprensetative->re_last_name,
    //                 "re_email"     => $patient->get_reprensetative->re_email,
    //                 "re_phone"     => $patient->get_reprensetative->re_phone,
    //                 "re_ci"        => $patient->get_reprensetative->re_ci,
    //                 "genere"       => $patient->genere,
    //                 "age"          => $patient->age,
    //                 "id"           => $patient->id,
    //                 "patient_img"  => $patient->patient_img,
    //             ];
    //             return $patient_re;
    //         }
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'success' => 'false',
    //             'errors'  => $th->getMessage()
    //         ], 500);
    //     }
    // }

    public function store(Request $request)
    {

        try {

            $user = Auth::user();

            /**Logica para identificar si el registro lo hace una secretaria coorporativa */
            if(isset($user->master_corporate_id) && $user->type_plane == 7){

                $info_doctor_center = DoctorCenter::where('center_id', $user->center_id)->first();
                $info_center = Center::where('id', $info_doctor_center->center_id)->first();

            }

            /**Logica para identificar si el registro lo hace una secretaria de un Medico Normal */
            if(isset($user->master_corporate_id) && $user->type_plane != 7){

                $info_doctor_center = DoctorCenter::where('center_id', $user->center_id)->first();
                $info_center = Center::where('id', $info_doctor_center->center_id)->first();

            }

            /**Logica para identificar si el registro lo hace una secretaria de un Medico Normal */
            if(!isset($user->master_corporate_id)){

                $info_doctor_center = DoctorCenter::where('center_id', $request->center_id)->first();
                $info_center = Center::where('id', $info_doctor_center->center_id)->first();

            }


            $rules = [
                'date_start' => 'required',
                'hour_start' => 'required',
            ];

            $msj = [
                'date_start.required' => __('messages.alert.fecha_cita_requerida'),
                'hour_start.required' => __('messages.alert.hora_cita_requerida'),
            ];

            $validator = Validator::make($request->all(), $rules, $msj);

            if ($validator->fails()) {
                return response()->json([
                    'success' => 'false',
                    'errors'  => $validator->errors()->all()
                ], 400);
            }

            /**
             * Logica para realizar un pre-registro del paciente
             * desde la agenda
             *
             * Se toman los datos primarios del paciente
             * y son agregados en la tabla 'patient'
             *
             * @param patient_new == "true"
             */
            $date = explode('-', $request->hour_start);
            $hour = $date[0];
            $minute = $date[1];

            if ($request->patient_new == "true") {

                $validate_dairy = Appointment::where('date_start', $request->date_start)
                    ->where('hour_start', $hour . '-' . $minute . " " . $request->timeIni)
                    ->where('status', 1)
                    ->where('user_id', (auth()->user()->role == "secretary") ? auth()->user()->get_data_corporate_master->id : auth()->user()->id)
                    ->first();

                if (isset($validate_dairy)) {
                    return response()->json([
                        'success' => 'false',
                        'errors'  => __('messages.alert.cita_otro_paciente')
                    ], 400);
                } else {

                    /**MENOR DE EDAD */
                    if ($request->is_minor == 'true') {

                        $patient = new Patient();
                        $patient->patient_code      = UtilsController::get_patient_code($request->ci_patient);
                        $patient->name              = $request->name_patient;
                        $patient->last_name         = $request->last_name_patient;
                        $patient->is_minor          = $request->is_minor;
                        $patient->birthdate         = $request->birthdate_patient;
                        $patient->age               = $request->age_patient;
                        $patient->center_id         = (Auth::user()->center_id != null) ? Auth::user()->center_id : $request->center_id;
                        $patient->user_id           = (auth()->user()->role == "secretary") ? auth()->user()->get_data_corporate_master->id : auth()->user()->id;
                        $patient->contrie_doc       = auth()->user()->contrie;
                        $patient->verification_code = Str::random(30);
                        $patient->email             = $request->email_patient;
                        $patient->phone             = $request->phone;
                        $patient->save();


                        $appointment = new Appointment();
                        $appointment->code        = 'SQ-D-' . random_int(11111111, 99999999);
                        $appointment->user_id     = (auth()->user()->role == "secretary") ? auth()->user()->get_data_corporate_master->id : auth()->user()->id;
                        $appointment->patient_id  = $patient->id;
                        $appointment->date_start  = $request->date_start;
                        $appointment->hour_start  = $hour . '-' . $minute . " " . $request->timeIni;
                        $appointment->center_id   = (Auth::user()->center_id != null) ? Auth::user()->center_id : $request->center_id;
                        $appointment->price       = $request->price;
                        $appointment->color       = $info_center->color;
                        $appointment->save();

                        $action = '23';
                        ActivityLogController::store_log($action);

                        /**Logica para guardar el acumulado de citas agendadas por el medico o secretaria */
                        EstadisticaController::accumulated_dairy_sin_confirmar($appointment->user_id, $appointment->center_id);

                        /**Envio de notificaciones */

                        /**Buscamos la direccion del centro */
                        $dir = str_replace(' ', '%20', $appointment->get_center->description);
                        $ubication = 'https://maps.google.com/maps?q=' . $dir . ',%20' . $appointment->get_center->state . '&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed';

                        $type = 'appointment';

                        $mailData = [
                            'dr_name'       => $user->name . ' ' . $user->last_name,
                            'dr_email'      => $user->email,
                            'patient_name'  => $patient->name . ' ' . $patient->last_name,
                            'cod_patient'   => $patient->patient_code,
                            'patient_email' => $request->email_patient,
                            'fecha'         => $request->date_start,
                            'horario'       => $date[0] . ' ' . $request->timeIni,
                            'centro'        => $info_center->description,
                            'piso'          => $info_doctor_center->number_floor,
                            'consultorio'   => $info_doctor_center->number_consulting_room,
                            'telefono'      => $info_doctor_center->phone_consulting_room,
                            'price'         => $appointment->price,
                            'ubication'     => $ubication,
                        ];

                        /**Notificacion por whatsapp */
                        ApiServicesController::whatsapp_welcome_pre_registro($request->phone, $ubication, $mailData);
                    }

                    /**MAYOR DE EDAD */
                    if ($request->is_minor == 'false') {

                        $patient = new Patient();
                        $patient->patient_code      = UtilsController::get_patient_code($request->ci_patient);
                        $patient->name              = $request->name_patient;
                        $patient->last_name         = $request->last_name_patient;
                        $patient->phone             = $request->phone;
                        $patient->email             = $request->email_patient;
                        $patient->is_minor          = $request->is_minor;
                        $patient->birthdate         = $request->birthdate_patient;
                        $patient->age               = $request->age_patient;
                        $patient->center_id         = (Auth::user()->center_id != null) ? Auth::user()->center_id : $request->center_id;
                        $patient->user_id           = (auth()->user()->role == "secretary") ? auth()->user()->get_data_corporate_master->id : auth()->user()->id;
                        $patient->contrie_doc       = auth()->user()->contrie;
                        $patient->verification_code = Str::random(30);
                        $patient->save();

                        $appointment = new Appointment();
                        $appointment->code          = 'SQ-D-' . random_int(11111111, 99999999);
                        $appointment->user_id       = (auth()->user()->role == "secretary") ? auth()->user()->get_data_corporate_master->id : auth()->user()->id;
                        $appointment->patient_id    = $patient->id;
                        $appointment->date_start    = $request->date_start;
                        $appointment->hour_start    = $hour . '-' . $minute . " " . $request->timeIni;
                        $appointment->center_id     = (Auth::user()->center_id != null) ? Auth::user()->center_id : $request->center_id;
                        $appointment->price         = $request->price;
                        $appointment->color         = isset($center_id_corporativo) ? Center::where('id', $center_id_corporativo)->first()->color : Center::where('id', $request->center_id)->first()->color;
                        $appointment->save();

                        $action = '23';
                        ActivityLogController::store_log($action);

                        /**Logica para guardar el acumulado de citas agendadas por el medico o secretaria */
                        EstadisticaController::accumulated_dairy_sin_confirmar($appointment->user_id, $appointment->center_id);

                        /**Envio de notificaciones */

                        /**Buscamos la direccion del centro */
                        $dir = str_replace(' ', '%20', $appointment->get_center->description);
                        $ubication = 'https://maps.google.com/maps?q=' . $dir . ',%20' . $appointment->get_center->state . '&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed';

                        $mailData = [
                            'dr_name'       => $user->name . ' ' . $user->last_name,
                            'dr_email'      => $user->email,
                            'patient_name'  => $patient->name . ' ' . $patient->last_name,
                            'cod_patient'   => $patient->patient_code,
                            'patient_email' => $request->email_patient,
                            'fecha'         => $request->date_start,
                            'horario'       => $date[0] . ' ' . $request->timeIni,
                            'centro'        => $info_center->description,
                            'piso'          => $info_doctor_center->number_floor,
                            'consultorio'   => $info_doctor_center->number_consulting_room,
                            'telefono'      => $info_doctor_center->phone_consulting_room,
                            'price'         => $appointment->price,
                            'ubication'     => $ubication,
                        ];
                    }
                }
            } else {

                $validate_dairy = Appointment::where('date_start', $request->date_start)
                    ->where('hour_start',  $hour . '-' . $minute . " " . $request->timeIni)
                    ->where('status', 1)
                    ->where('user_id', (auth()->user()->role == "secretary") ? auth()->user()->get_data_corporate_master->id : auth()->user()->id)
                    ->first();

                if (isset($validate_dairy)) {
                    return response()->json([
                        'success' => 'false',
                        'errors'  => __('messages.alert.cita_otro_paciente')
                    ], 400);
                } else {


                    $appointment = new Appointment();
                    $appointment->code          = 'SQ-D-' . random_int(11111111, 99999999);
                    $appointment->user_id       = (auth()->user()->role == "secretary") ? auth()->user()->get_data_corporate_master->id : auth()->user()->id;
                    $appointment->patient_id    = $request->patient_id;
                    $appointment->date_start    = $request->date_start;
                    $appointment->hour_start    = $hour . '-' . $minute . " " . $request->timeIni;
                    $appointment->center_id     = (Auth::user()->center_id != null) ? Auth::user()->center_id : $request->center_id;
                    $appointment->price         = $request->price;
                    $appointment->color         = $info_center->color;
                    $appointment->save();

                    /**Logica para guardar el acumulado de citas agendadas por el medico o secretaria */
                    EstadisticaController::accumulated_dairy_sin_confirmar($appointment->user_id, $appointment->center_id);

                    /**Notificacion por correo cuando el paciente existe */
                    /**preguntamos si es menor de edad o mayor */
                    $info_patient = Patient::where('id', $request->patient_id)->first();

                    /*Email para notificaciones*/
                    $patient_email = $info_patient->email;

                    /**Logica para tomar la ubicacion del centro y enviar el url de GoogleMaps en la notificacion por email */
                    if (auth()->user()->role == "medico" && auth()->user()->type_plane == "7") {

                        $data_center = auth()->user();


                        /** cuando es una secretaria de un medico corporativo */
                    } elseif (auth()->user()->role == "secretary" && auth()->user()->get_data_corporate_master->type_plane == "7") {
                        $dataCenter = auth()->user()->get_data_corporate_master;
                        $numberFloor = $dataCenter->number_floor;
                        $nameDoctor = $dataCenter->name . ' ' . $dataCenter->last_name;
                        $numberConsultingRoom = $dataCenter->number_consulting_room;
                        $phoneConsultingRoom = $dataCenter->phone_consulting_room;

                        /** cuando es una secretaria de un medico natural */
                    } elseif (auth()->user()->role == "secretary") {

                        $dataCenter = auth()->user()->get_data_corporate_master->get_doctors;

                        foreach ($dataCenter as $item) {
                            $nameDoctor = $item->name . ' ' . $item->last_name;
                            $numberFloor = $item->number_floor;
                            $numberConsultingRoom = $item->number_consulting_room;
                            $phoneConsultingRoom = $item->phone_consulting_room;
                        }
                    } else {

                        $data_center = DoctorCenter::where('user_id', $user->id)->where('center_id', $appointment->get_center->id)->first();
                    }

                    $dir = str_replace(' ', '%20', $appointment->get_center->description);
                    $ubication = 'https://maps.google.com/maps?q=' . $dir . ',%20' . $appointment->get_center->state . '&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed';


                    /**Si el medico pertenece a un plan coorporativo se toma la informacion del centro al que esta asociado */
                    if (isset($center_id_corporativo)) {
                        $type = 'appointment';
                        $mailData = [
                            'dr_name'       => auth()->user()->role == "secretary" ? $nameDoctor : $user->name . ' ' . $user->last_name,
                            'dr_email'      => $user->email,
                            'patient_name'  => $info_patient->name . ' ' . $info_patient->last_name,
                            'cod_patient'   => $info_patient->patient_code,
                            'patient_email' => $patient_email,
                            'fecha'         => $request->date_start,
                            'horario'       => $date[0] . ' ' . $request->timeIni,
                            'centro'        => $appointment->get_center->description,
                            'piso'          => auth()->user()->role == "secretary" ? $numberFloor : $data_center->number_floor,
                            'consultorio'   => auth()->user()->role == "secretary" ? $numberConsultingRoom : $data_center->number_consulting_room,
                            'telefono'      => auth()->user()->role == "secretary" ? $phoneConsultingRoom : $data_center->phone_consulting_room,
                            'price'         => $appointment->price,
                            'ubication'     => $ubication,
                            'link'          => 'https://system.sqlapio.com/confirmation/dairy/' . $appointment->code,
                            'link_cancel'   => 'https://system.sqlapio.com/cancel/dairy/' . $appointment->code,
                        ];

                        /**Notificacion por email */
                        UtilsController::notification_mail($mailData, $type);

                        /**Notificacion por whatsapp */
                        ApiServicesController::whatsapp_welcome_pre_registro($info_patient->phone, $ubication, $mailData);
                    } else {
                        $type = 'appointment';
                        $mailData = [
                            'dr_name'       => $user->name . ' ' . $user->last_name,
                            'dr_email'      => $user->email,
                            'patient_name'  => $info_patient->name . ' ' . $info_patient->last_name,
                            'cod_patient'   => $info_patient->patient_code,
                            'patient_email' => $patient_email,
                            'fecha'         => $request->date_start,
                            'horario'       => $date[0] . ' ' . $request->timeIni,
                            'centro'        => $appointment->get_center->description,
                            'piso'          => $data_center->number_floor,
                            'consultorio'   => $data_center->number_consulting_room,
                            'telefono'      => $data_center->phone_consulting_room,
                            'price'         => $appointment->price,
                            'ubication'     => $ubication,
                        ];

                        /**Notificacion por email */
                        UtilsController::notification_mail($mailData, $type);

                        /**Notificacion por whatsapp */
                        ApiServicesController::whatsapp_welcome($info_patient->phone, $ubication, $mailData);
                    }
                }
            }
            /** Fin de la funcion */

            return true;
        } catch (\Throwable $th) {
            return response()->json([
                'success' => 'false',
                'errors'  => $th->getMessage()
            ], 500);
        }
    }

    public function cancelled($id)
    {

        try {

            $cancelled = DB::table('appointments')
                ->where('id', $id)
                ->update([
                    'status' => 4,
                    'color' => '#dc3545'
                ]);

            $action = '12';
            ActivityLogController::store_log($action);

            $dairy = Appointment::where('id', $id)->first();

            EstadisticaController::accumulated_dairy_cancelada($dairy->user_id, $dairy->center_id);

            return true;
        } catch (\Throwable $th) {
            return response()->json([
                'success' => 'false',
                'errors'  => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {

            $validate = Appointment::where('date_start', $request->start)
                ->where('hour_start', 'like', '%' . $request->extendedProps['data'] . '%')
                ->where('user_id', (auth()->user()->role == "secretary") ? auth()->user()->get_data_corporate_master->id : auth()->user()->id)
                ->first();
            if ($validate != null) {
                if ($request)
                    return response()->json([
                        'success' => 'false',
                        'errors'  => __('messages.alert.cita_agendada')
                    ], 400);
            } else {

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
            return response()->json([
                'success' => 'false',
                'errors'  => $th->getMessage()
            ], 500);
        }
    }

    public function render()
    {
        $appointments = UtilsController::get_appointments((auth()->user()->role == "secretary") ? auth()->user()->get_data_corporate_master->id : auth()->user()->id);

        $id = (auth()->user()->role == "secretary") ? auth()->user()->get_data_corporate_master->contrie : auth()->user()->contrie;

        $patient = UtilsController::get_patients($id);

        $centers = DoctorCenter::where('user_id', Auth::user()->id)->where('status', 1)->get();

        return view('livewire.components.diary', compact('appointments', 'patient', 'centers'));
    }
}
