<?php

namespace App\Console\Commands;


use App\Models\Appointment;
use App\Models\Center;
use App\Models\DoctorCenter;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Console\Command;

class AppointmentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:appointment-reminder';

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
        try {

            $todayAppointment = Appointment::where('date_start', date('Y-m-d'))->get();

            foreach ($todayAppointment as $appointment) {

                $cita_medica = __('messages.whatsapp.recordatorio_cita');
                $text_cita = __('messages.whatsapp.text3');
                $sr = __('messages.whatsapp.sr');
                $fecha = __('messages.whatsapp.fecha');
                $hora = __('messages.whatsapp.hora');
                $dr = __('messages.whatsapp.doctor');
                $centro = __('messages.whatsapp.centro');
                $piso = __('messages.whatsapp.piso');
                $consultorio = __('messages.whatsapp.consultorio');
                $ubicacion = __('messages.whatsapp.ubicacion');
                $precio = __('messages.whatsapp.precio');

                $doctor = User::where('id', $appointment->user_id)->first();
                $center = Center::where('id', $appointment->center_id)->first();
                $patient = Patient::where('id', $appointment->patient_id)->first();
                $doctor_center = DoctorCenter::where('user_id', $doctor->id)->where('center_id', $appointment->center_id)->first();
                $confirmar = 'https://system.sqlapio.com/confirmation/dairy/'.$appointment->code;
                $cancelar = 'https://system.sqlapio.com/cancel/dairy/'.$appointment->code;

                /**Obtenego el nombre del centro para poder crear el url de googleMpas */
                $dir = str_replace(' ', '%20', $center->description);
                $ubication = 'https://maps.google.com/maps?q=' . $dir . ',%20' . $center->state . '&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed';

                $caption = <<<HTML
                *{$cita_medica}:*

                {$sr}. {$patient->name},
                {$text_cita}.

                *{$fecha}:* {$appointment->date_start}
                *{$hora}:* {$appointment->hour_start}
                *{$dr}:* {$doctor->name} {$doctor->last_name}
                *{$centro}:* {$center->description}
                *{$piso}:* {$doctor_center->number_floor}
                *{$consultorio}:* {$doctor_center->number_consulting_room}
                *Confirmar cita:* {$confirmar}
                *Cancelar cita:*  {$cancelar}
                *{$precio}:* {$appointment->precio} $

                *{$ubicacion}:* {$ubication}
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
        } catch (\Throwable $th) {
            $message = $th->getMessage();
        }

        $this->info('La Notificacion de Recordatorio se envio de forma correcta');
        //
    }
}
