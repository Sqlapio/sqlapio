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
        $treatmentReminder = Treatment::whereBetween('hours', [4, 12])->get();
        foreach ($treatmentReminder as $value) {

            $doctor = User::where('id', $value->user_id)->first();
            $patient = Patient::where('id', $value->patient_id)->first();

            /**Obtenego el nombre del centro para poder crear el url de googleMpas */
            $caption = <<<HTML
            *RECORDATORIO DE TRATAMIENTO:*

            Le informamos que para el día de hoy tiene una cita médica agendada.

            *Tratamiento Asignado por:*
            *Doctor(a):* {$doctor->name} {$doctor->last_name}

            *Tratamiento*
            *Medicamento:* {$value->medicine}
            *Indicación:* {$value->indication}
            *Cada* {$value->hours} Horas
            *Duración del Tratamiento:* {$value->treatmentDuration}
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
        }

    }
}
