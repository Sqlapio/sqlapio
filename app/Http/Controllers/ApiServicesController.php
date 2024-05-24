<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiServicesController extends Controller
{
    static public function whatsapp_welcome($phone, $ubicacion, array $data)
    {

        try {

            $body = <<<HTML
            *CITA MÉDICA:*

            Le informamos que tiene una cita médica agendada.

            *Fecha:* {$data['fecha']}
            *Hora:* {$data['horario']}
            *Doctor(a):* {$data['dr_name']}
            *Centro:* {$data['centro']}
            *Piso:* {$data['piso']}
            *Consultorio:* {$data['consultorio']}

            *Ubicacion GoogleMpas:* {$data['ubication']}
            HTML;

            $params = array(
                'token' => env('TOKEN_API_WHATSAPP'),
                'to' => $phone,
                'body' => $body
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => env('CURLOPT_URL'),
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

            $caption = <<<HTML
            *BIENVENIDO:*

            Usted acaba de actualizar sus datos como Doctor en SQLAPIO.

            *Doctor(a):* {$data['doctor']}
            *Especialidad:* {$data['specialty']}
            HTML;

            $params = array(
                'token' => env('TOKEN_API_WHATSAPP'),
                'to' => $data['phone'],
                'image' => env('IMAGE_REGISTER_DOCTOR'),
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

    static public function whatsapp_register_patient($phone, array $data)
    {

        try {

            $body = <<<HTML
            *BIENVENIDO*

            Le informamos que acaba de ser registrada como paciente en SQLAPIO.

            *Paciente:* {$data['patient_name']}

            Su Doctor será:

            *Doctor(a):* {$data['dr_name']}
            *Centro:* {$data['center']}
            *Piso:* {$data['center_piso']}
            *Consultorio:* {$data['center_consulting_room']}
            HTML;

            $params = array(
                'token' => env('TOKEN_API_WHATSAPP'),
                'to' => $phone,
                'body' => $body
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => env('CURLOPT_URL'),
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


}
