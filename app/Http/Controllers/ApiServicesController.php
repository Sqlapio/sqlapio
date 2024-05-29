<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiServicesController extends Controller
{
    static public function whatsapp_welcome($phone, $ubicacion, array $data)
    {

        try {

            $cita_medica = __('messages.whatsapp.cita_medica');
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

            {$text3}.

            *{$fecha}:* {$data['fecha']}
            *{$hora}:* {$data['horario']}
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
            $pacientes = __('messages.whatsapp.pacientes');
            $telefono = __('messages.whatsapp.telefono');
            $notificacion = __('messages.whatsapp.notificacion');
            $informamos = __('messages.whatsapp.informamos');

            $body = <<<HTML
            *{$notificacion}*

            {$doctor}. {$data['dr_name']},
            {$informamos}.

            *{$pacientes}:* {$data['patient_name']}
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


}
