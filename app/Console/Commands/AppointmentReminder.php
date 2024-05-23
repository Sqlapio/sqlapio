<?php

namespace App\Console\Commands;


use App\Models\Appointment;
use App\Models\Center;
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
        $todayAppointment = Appointment::where('date_start', date('Y-m-d'))->get();

        foreach ($todayAppointment as $appointment) {

            $doctor = User::where('id', $appointment->user_id)->first();
            $center = Center::where('id', $appointment->center_id)->first();
            $patient = Patient::where('id', $appointment->patient_id)->first();

            try {

                $body = <<<HTML
                *CITA MÉDICA:*

                Le informamos que tiene una cita médica agendada.

                *Fecha:* {$appointment->date_start}
                *Hora:* {$appointment->hour_start}
                *Doctor(a):* {$doctor->name} {$doctor->last_name}
                *Centro:* {$center->description}
                HTML;

                $params=array(
                    'token' => '863lb4l0wmldpl3s',
                    'to' => $patient->phone,
                    'body' => $body
                    );
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => "https://api.ultramsg.com/instance83564/messages/chat",
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
            $this->info('notificacion 1');
        //
    }
}
