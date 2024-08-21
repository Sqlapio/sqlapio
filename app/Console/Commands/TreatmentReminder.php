<?php

namespace App\Console\Commands;

use App\Models\Center;
use App\Models\MedicalRecord;
use App\Models\MedicalReport;
use App\Models\Patient;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Console\Command;

class TreatmentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:treatment-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $treatmentReminder = Treatment::all();
        foreach ($treatmentReminder as $reminder) {

            $cadena = $reminder->treatmentDuration;

            if(str_contains($cadena, 'dia') || str_contains($cadena, 'dias'))
            {
                $int_var = (int)filter_var($cadena, FILTER_SANITIZE_NUMBER_INT);
                $total_dias = $int_var;
            }
            elseif(str_contains($cadena, 'semana') || str_contains($cadena, 'semanas'))
            {
                $int_var = (int)filter_var($cadena, FILTER_SANITIZE_NUMBER_INT);
                $total_dias = $int_var * 7;
            }
            elseif(str_contains($cadena, 'mes') || str_contains($cadena, 'meses'))
            {
                $int_var = (int)filter_var($cadena, FILTER_SANITIZE_NUMBER_INT);
                $total_dias = $int_var * 30;
            }
            elseif(str_contains($cadena, 'año'))
            {
                $int_var = (int)filter_var($cadena, FILTER_SANITIZE_NUMBER_INT);
                $total_dias = $int_var * 365;
            }
            else
            {
                $total_dias = 0;
            }

            if($total_dias != $reminder->count_notifications_send)
            {
                $count = $reminder->count_notifications_send + 1;
                $doctor = User::where('id', $reminder->user_id)->first();
                $patient = Patient::where('id', $reminder->patient_id)->first();

                /**Obtenego el nombre del centro para poder crear el url de googleMpas */
                $caption = <<<HTML
                *RECORDATORIO DE TRATAMIENTO:*

                *Se tomó su medicamento?. Recuerde que debe hacerlo...*

                *Tratamiento Asignado por:*
                *Doctor(a):* {$doctor->name} {$doctor->last_name}

                *Tratamiento*
                *Medicamento:* {$reminder->medicine}
                *Indicación:* {$reminder->indication}
                *Cada* {$reminder->hours} Horas
                *Duración del Tratamiento:* {$reminder->treatmentDuration}
                HTML;

                $params = array(
                    'token' => env('TOKEN_API_WHATSAPP'),
                    'to' => $patient->phone,
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

                if(isset($response))
                {
                    $reminder->update([
                        'count_notifications_send' => $count
                    ]);
                }
            }
        }
        // foreach ($treatmentReminder as $reminder) {

        //     $doctor = User::where('id', $value->user_id)->first();
        //     $patient = Patient::where('id', $value->patient_id)->first();

        //     /**Obtenego el nombre del centro para poder crear el url de googleMpas */
        //     $caption = <<<HTML
        //     *RECORDATORIO DE TRATAMIENTO:*

        //     *Se tomó su medicamento?. Recuerde que debe hacerlo...*

        //     *Tratamiento Asignado por:*
        //     *Doctor(a):* {$doctor->name} {$doctor->last_name}

        //     *Tratamiento*
        //     *Medicamento:* {$value->medicine}
        //     *Indicación:* {$value->indication}
        //     *Cada* {$value->hours} Horas
        //     *Duración del Tratamiento:* {$value->treatmentDuration}
        //     HTML;

        //     $params = array(
        //         'token' => env('TOKEN_API_WHATSAPP'),
        //         'to' => $patient->phone,
        //         'image' => env('BANNER_SQLAPIO'),
        //         'caption' => $caption
        //     );
        //     $curl = curl_init();
        //     curl_setopt_array($curl, array(
        //         CURLOPT_URL => env('CURLOPT_URL_IMAGE'),
        //         CURLOPT_RETURNTRANSFER => true,
        //         CURLOPT_ENCODING => "",
        //         CURLOPT_MAXREDIRS => 10,
        //         CURLOPT_TIMEOUT => 30,
        //         CURLOPT_SSL_VERIFYHOST => 0,
        //         CURLOPT_SSL_VERIFYPEER => 0,
        //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //         CURLOPT_CUSTOMREQUEST => "POST",
        //         CURLOPT_POSTFIELDS => http_build_query($params),
        //         CURLOPT_HTTPHEADER => array(
        //             "content-type: application/x-www-form-urlencoded"
        //         ),
        //     ));

        //     $response = curl_exec($curl);
        //     $err = curl_error($curl);

        //     curl_close($curl);
        // }

    }
}
