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

                $doctor = User::where('id', $appointment->user_id)->first();
                $center = Center::where('id', $appointment->center_id)->first();
                $patient = Patient::where('id', $appointment->patient_id)->first();
                $doctor_center = DoctorCenter::where('user_id', $doctor->id)->where('center_id', $appointment->center_id)->first();

                /**Obtenego el nombre del centro para poder crear el url de googleMpas */
                $dir = str_replace(' ', '%20', $center->description);
                $ubication = 'https://maps.google.com/maps?q=' . $dir . ',%20' . $center->state . '&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed';

                $body = <<<HTML
                *RECORDATORIO DE CITA:*

                Le informamos que para el día de hoy tiene una cita médica agendada.

                *Fecha:* {$appointment->date_start}
                *Hora:* {$appointment->hour_start}
                *Doctor(a):* {$doctor->name} {$doctor->last_name}
                *Centro:* {$center->description}
                *Piso:* {$doctor_center->number_floor}
                *Consultorio:* {$doctor_center->number_consulting_room}

                *Ubicación:* {$ubication}
                HTML;

                $params = array(
                    'token' => env('TOKEN_API_WHATSAPP'),
                    'to' => $patient->phone,
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
            }
        } catch (\Throwable $th) {
            $message = $th->getMessage();
        }

        $this->info('La Notificacion de Recordatorio se envio de forma correcta');
        //
    }
}
