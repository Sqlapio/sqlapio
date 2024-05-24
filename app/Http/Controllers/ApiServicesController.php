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

            $params=array(
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

    static public function whatsapp_info($phone, $body)
    {

        try {
            $params = array(

                'token' => env('TOKEN_API_WHATSAPP'),
                'to' => $phone,
                'body' => $body
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.ultramsg.com/instance63635/messages/chat",
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

    static public function whatsapp_reference_info($phone, $body)
    {

        try {
            $params = array(

                'token' => env('TOKEN_API_WHATSAPP'),
                'to' => $phone,
                'body' => $body
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.ultramsg.com/instance63635/messages/chat",
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

    static public function whatsapp_location_lab()
    {

        try {
            $params=array(
                'token' => 'ypb31pibjltlbdwo',
                'to' => '04127018390',
                'address' => 'Sqlapio.com le recomienda: Laboratorios Vargas, por ser el mas cercano a su ubicacion. POR FAVOR ACCEDA AL SIGUIENTE LINK...',
                'lat' => '10.49486428',
                'lng' => '-66.91600772'
                );
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => "https://api.ultramsg.com/instance63415/messages/location",
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
}
