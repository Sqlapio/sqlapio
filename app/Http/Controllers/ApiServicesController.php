<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Center;
use App\Models\User;
use App\Models\Patient;
use App\Models\DoctorCenter;
use Illuminate\Http\Request;

class ApiServicesController extends Controller
{
    static public function whatsapp_welcome($phone, $ubicacion, array $data)
    {
        try {

            $hora_format = '';

            if ($data['horario']) {
                $hora_format = $data['horario'];
            }

            if ($data['horario'] == '13:00 pm') {
                $hora_format = '01:00 pm';
            }

            if ($data['horario'] == '14:00 pm') {
                $hora_format = '02:00 pm';
            }

            if ($data['horario'] == '15:00 pm') {
                $hora_format = '03:00 pm';
            }

            if ($data['horario'] == '16:00 pm') {
                $hora_format = '04:00 pm';
            }

            if ($data['horario'] == '17:00 pm') {
                $hora_format = '05:00 pm';
            }

            if ($data['horario'] == '18:00 pm') {
                $hora_format = '06:00 pm';
            }

            if ($data['horario'] == '19:00 pm') {
                $hora_format = '07:00 pm';
            }

            if ($data['horario'] == '20:00 pm') {
                $hora_format = '08:00 pm';
            }
            
            $cita_medica = __('messages.whatsapp.cita_medica');
            $text3 = __('messages.whatsapp.text3');
            $sr = __('messages.whatsapp.sr');
            $fecha = __('messages.whatsapp.fecha');
            $hora = __('messages.whatsapp.hora');
            $doctor = __('messages.whatsapp.doctor');
            $centro = __('messages.whatsapp.centro');
            $piso = __('messages.whatsapp.piso');
            $consultorio = __('messages.whatsapp.consultorio');
            $ubicacion = __('messages.whatsapp.ubicacion');

            $body = <<<HTML
            *{$cita_medica}:*

            {$sr}. {$data['patient_name']},
            {$text3}.

            *{$fecha}:* {$data['fecha']}
            *{$hora}:* {$hora_format}
            *{$doctor}:* {$data['dr_name']}
            *{$centro}:* {$data['centro']}
            *{$piso}:* {$data['piso']}
            *{$consultorio}:* {$data['consultorio']}

            *{$ubicacion}:* {$data['ubication']}
            HTML;

            $params = array(
                'token' => env('TOKEN_API_WHATSAPP'),
                'to' => $phone,
                'image' => env('BANNER_SQLAPIO'),
                'caption' => $body
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => env('CURLOPT_URL_IMAGE'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => http_build_query($params),
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd('Error UtilsController.sms_welcome()', $message);
        }
    }

    static public function whatsapp_register_doctor(array $data)
    {

        try {

            $doctor = __('messages.whatsapp.doctor');
            $bienvenido = __('messages.whatsapp.bienvenido');
            $text4 = __('messages.whatsapp.text4');
            $especialidad = __('messages.whatsapp.especialidad');

            $caption = <<<HTML
            *{$bienvenido}:*

            {$text4}.

            *{$doctor}:* {$data['doctor']}
            *{$especialidad}:* {$data['specialty']}
            HTML;

            $params = array(
                'token' => env('TOKEN_API_WHATSAPP'),
                'to' => $data['phone'],
                'image' => env('BANNER_SQLAPIO'),
                'caption' => $caption
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => env('CURLOPT_URL_IMAGE'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => http_build_query($params),
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd('Error UtilsController.sms_welcome()', $message);
        }
    }

    static public function whatsapp_register_patient_doctor($phone, array $data)
    {

        try {

            $doctor = __('messages.whatsapp.doctor');
            $email = __('messages.whatsapp.email');
            $codigo = __('messages.whatsapp.codigo');
            $paciente = __('messages.whatsapp.paciente');
            $telefono = __('messages.whatsapp.telefono');
            $notificacion = __('messages.whatsapp.notificacion');
            $informamos = __('messages.whatsapp.informamos');

            $body = <<<HTML
            *{$notificacion}*

            {$doctor}. {$data['dr_name']},
            {$informamos}.

            *{$paciente}:* {$data['patient_name']}
            *{$codigo}:* {$data['patient_code']}
            *{$email}:* {$data['patient_email']}
            *{$telefono}:* {$data['patient_phone']}
            HTML;

            $params = array(
                'token' => env('TOKEN_API_WHATSAPP'),
                'to' => $phone,
                'image' => env('BANNER_SQLAPIO'),
                'caption' => $body
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => env('CURLOPT_URL_IMAGE'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => http_build_query($params),
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd($th);
        }
    }

    static public function whatsapp_register_patient($phone, array $data)
    {

        try {

            $registrado = __('messages.whatsapp.registrado');
            $sr = __('messages.whatsapp.sr');
            $medico = __('messages.whatsapp.medico');
            $centro_salud = __('messages.whatsapp.centro_salud');
            $doctor = __('messages.whatsapp.doctor');
            $centro = __('messages.whatsapp.centro');
            $piso = __('messages.whatsapp.piso');
            $consultorio = __('messages.whatsapp.consultorio');
            $especialidad = __('messages.whatsapp.especialidad');
            $telefono = __('messages.whatsapp.telefono');

            $caption = <<<HTML
            {$sr}. {$data['patient_name']},
            {$registrado}.

            *{$medico}:*
            *{$doctor}:* {$data['dr_name']}
            *{$especialidad}:* {$data['specialty']}

            *{$centro_salud}*
            *{$centro}:* {$data['center']}
            *{$piso}:* {$data['center_piso']}
            *{$consultorio}:* {$data['center_consulting_room']}
            *{$telefono}:* {$data['center_phone']}
            HTML;

            $params = array(
                'token' => env('TOKEN_API_WHATSAPP'),
                'to' => $phone,
                'image' => env('BANNER_SQLAPIO'),
                'caption' => $caption
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => env('CURLOPT_URL_IMAGE'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => http_build_query($params),
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd($th);
        }
    }

    static public function whatsapp_location_lab(array $data_exams, array $data_studies, array $data, $phone)
    {
        /**Creo un array para los examenes */
        $array_ex = [];
        for ($i=0; $i < count($data_exams); $i++) {
            $ex = $data_exams[$i]->description;
            array_push($array_ex, $ex);# code...
        }

        /**Creo un array para los examenes */
        $array_es = [];
        for ($i=0; $i < count($data_studies); $i++) {
            $es = $data_studies[$i]->description;
            array_push($array_es, $es);# code...
        }

        $list_ex = join(', ', $array_ex);
        $list_es = join(', ', $array_es);
        $examenes = __('messages.whatsapp.examenes');
        $estudios = __('messages.whatsapp.estudios');
        $sr = __('messages.whatsapp.sr');
        $text = __('messages.whatsapp.text');
        $text2 = __('messages.whatsapp.text2');

        $caption = <<<HTML
            {$sr}. {$data['patient_name']},
            {$text}: *{$data['dr_name']}*, {$text2}:

            *{$examenes}:*
            {$list_ex}

            *{$estudios}:*
            {$list_es}
            HTML;

        try {
            $params = array(
                'token' => env('TOKEN_API_WHATSAPP'),
                'to' => $phone,
                'image' => env('BANNER_SQLAPIO'),
                'caption' => $caption
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => env('CURLOPT_URL_IMAGE'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => http_build_query($params),
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd('Error UtilsController.sms_info()', $message);
        }
    }

    static public function whatsapp_portal_patiente($phone, array $data)
    {

        try {

            $sr = __('messages.whatsapp.sr');
            $acceso = __('messages.whatsapp.acceso');
            $contasena = __('messages.whatsapp.informamos');
            $link = __('messages.whatsapp.informamos');

            $caption = <<<HTML
            {$sr}. {$data['patient_name']},
            {$acceso}.

            *{$contasena}:*
            *{$data['password']}*

            *{$link}*
            https://system.sqlapio.com/public/patient/query-detaly-patient

            HTML;

            $params = array(
                'token' => env('TOKEN_API_WHATSAPP'),
                'to' => $phone,
                'image' => env('BANNER_SQLAPIO'),
                'caption' => $caption
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => env('CURLOPT_URL_IMAGE'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => http_build_query($params),
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd($th);
        }
    }

    static public function whatsapp_send_dash($code)
    {

        try {


            $cita = Appointment::where('id', $code)->first();
            $dr = User::where('id', $cita->user_id)->first();
            $cen = Center::where('id', $cita->center_id)->first();
            $patient = Patient::where('id', $cita->patient_id)->first();
            $doctor_center = DoctorCenter::where('user_id', $dr->id)->where('center_id', $cita->center_id)->first();

            $hora_format = '';


                if ($cita->hour_start) {
                    $hora_format = substr($cita->hour_start, 6);
                }

                if (substr($cita->hour_start, 6) == '13:00 pm') {
                    $hora_format = '01:00 pm';
                }

                if (substr($cita->hour_start, 6) == '14:00 pm') {
                    $hora_format = '02:00 pm';
                }

                if (substr($cita->hour_start, 6) == '15:00 pm') {
                    $hora_format = '03:00 pm';
                }

                if (substr($cita->hour_start, 6) == '16:00 pm') {
                    $hora_format = '04:00 pm';
                }

                if (substr($cita->hour_start, 6) == '17:00 pm') {
                    $hora_format = '05:00 pm';
                }

                if (substr($cita->hour_start, 6) == '18:00 pm') {
                    $hora_format = '06:00 pm';
                }

                if (substr($cita->hour_start, 6) == '19:00 pm') {
                    $hora_format = '07:00 pm';
                }

                if (substr($cita->hour_start, 6) == '20:00 pm') {
                    $hora_format = '08:00 pm';
                }

            /**Obtenego el nombre del centro para poder crear el url de googleMpas */
            $dir = str_replace(' ', '%20', $cen->description);
            // $hour_format = substr($cita->hour_start, 6);
            $ubication = 'https://maps.google.com/maps?q=' . $dir . ',%20' . $cen->state . '&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed';

            $cita_medica = __('messages.whatsapp.cita_medica');
            $sr = __('messages.whatsapp.sr');
            $text3 = __('messages.whatsapp.text3');
            $fecha = __('messages.whatsapp.fecha');
            $hora = __('messages.whatsapp.hora');
            $doctor = __('messages.whatsapp.doctor');
            $centro = __('messages.whatsapp.centro');
            $piso = __('messages.whatsapp.piso');
            $consultorio = __('messages.whatsapp.consultorio');
            $ubicacion = __('messages.whatsapp.ubicacion');

            $body = <<<HTML
            *{$cita_medica}:*

            {$sr}. {$patient->name} {$patient->last_name},
            {$text3}.

            *{$fecha}:* {$cita->date_start}
            *{$hora}:* {$hora_format}
            *{$doctor}:* {$dr->name} {$dr->last_name}
            *{$centro}:* {$cen->description}
            *{$piso}:* {$doctor_center->number_floor}
            *{$consultorio}:* {$doctor_center->number_consulting_room}

            *{$ubicacion}:* {$ubication}

            HTML;

            $params = array(
                'token' => env('TOKEN_API_WHATSAPP'),
                'to' =>  $patient->phone,
                'image' => env('BANNER_SQLAPIO'),
                'caption' => $body
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => env('CURLOPT_URL_IMAGE'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => http_build_query($params),
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            return true;
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd('Error UtilsController.sms_welcome()', $message);
        }
    }


}
