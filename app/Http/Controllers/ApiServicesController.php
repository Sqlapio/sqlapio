<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiServicesController extends Controller
{
    static public function sms_welcome($phone, $caption, $image)
    {

        try {
            $params = array(

                'token' => env('TOKEN_API_WHATSAPP'),
                'to' => $phone,
                'image' => $image,
                'caption' => $caption
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.ultramsg.com/instance63635/messages/image",
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

    static public function sms_info($phone, $body)
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

    static public function sms_reference_info($phone, $body)
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

    static public function sms_location_lab()
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

    static function getDefaultPaymentMethodProperty()
    {
        return auth()->user()->defaultPaymentMethod();
    }

    static function addPaymentMethod($paymentMethod)
    {
        auth()->user()->addPaymentMethod($paymentMethod);

        if (!auth()->user()->hasDefaultPaymentMethod()) {
           return auth()->user()->updateDefaultPaymentMethod($paymentMethod);

        }

    }

    static function deletePaymentMethod($paymentMethod) {

        auth()->user()->deletePaymentMethod($paymentMethod);

    }

    static function defaultPaymentMethod($paymentMethod) {

      auth()->user()->updateDefaultPaymentMethod($paymentMethod);

    }

    static function newSubscription($plan)
    {

        if(!auth()->user()->defaultPaymentMethod()) {

            $this->emit('error', 'No tienes un metodo de pago registrado!');
            return;
        }

        try {
            if (auth()->user()->subscribed('Plan Ilimitado')) {

                auth()->user()->subscription('Plan Ilimitado')->swap($plan);
                return;
            }

            auth()->user()->newSubscription('Plan Ilimitado', $plan)->create($this->defaultPaymentMethod->id);

            auth()->user()->refresh();

        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }


    }

    static function cancelSubscription() {

        auth()->user()->subscription('Plan Ilimitado')->canceled();
    }

    static function resumeSubscription() {
        auth()->user()->subscription('Plan Ilimitado')->resume();
    }

}
