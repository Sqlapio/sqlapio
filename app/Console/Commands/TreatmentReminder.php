<?php

namespace App\Console\Commands;

use App\Models\Center;
use App\Models\MedicalRecord;
use App\Models\MedicalReport;
use App\Models\Patient;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
        try {

            $patients = Patient::all();
    
            foreach ($patients as $item) {
    
                /**Obtengo tdos los tratamientos diferentes que pueda tener el paciente */
                $treatmentReminder_patient = Treatment::where('patient_id', $item->id)
                    ->where('send_status', 'activa')
                    ->select([DB::raw("record_code as codigo")])
                    ->groupBy('codigo')
                    ->get()->pluck('codigo');
                dump($treatmentReminder_patient);
                /**
                 * @param $treatmentReminder_patient
                 * for() para recorrer el array de los codigos de consultas ya que el paciente
                 * puede tener mas de una consulta y mas de un tratamiento.
                 */
                for ($i = 0; $i < count($treatmentReminder_patient); $i++) {
    
                    /**
                     * @param array[]
                     * Array vacio poara almacenar la cantidad dias de los tratamientos */
                    $dias = [];
    
                    /**
                     * @param $treatmentReminder_patient[$i]
                     * En la tabla de tratamientos pregunto los tratamiento asociados al codigo de la consulta
                     */
                    $treatment = Treatment::where('record_code', $treatmentReminder_patient[$i])
                        ->where('send_status', 'activa')->get()->toArray();
    
                    /**
                     * @param $treatment, $dias[], $medicine[], $indication[], $treatmentDuration[]
                     *
                     * 1.-> for() para calcular el numero de dias de cada tratamiento
                     * y seleccionar el numero mayor, que sera el numero de veces
                     * que se envie la notificacion.
                     *
                     * 2.-> Este for() tambien se utiliza para optener los diferentes tratamientos que
                     * posee el paciente de acuerdo con el codigo de la consulta.
                     */
                    $medicine           = [];
                    $indication         = [];
                    $treatmentDuration  = [];
    
                    for ($j = 0; $j < count($treatment); $j++) {
    
                        $cadena = $treatment[$j]['treatmentDuration'];
    
                        if (str_contains($cadena, 'dia') || str_contains($cadena, 'días')) {
                            $int_var = (int)filter_var($cadena, FILTER_SANITIZE_NUMBER_INT);
                            $total_dias = $int_var;
                        } elseif (str_contains($cadena, 'semana') || str_contains($cadena, 'semanas')) {
                            $int_var = (int)filter_var($cadena, FILTER_SANITIZE_NUMBER_INT);
                            $total_dias = $int_var * 7;
                        } elseif (str_contains($cadena, 'mes') || str_contains($cadena, 'meses')) {
                            $int_var = (int)filter_var($cadena, FILTER_SANITIZE_NUMBER_INT);
                            $total_dias = $int_var * 30;
                        } elseif (str_contains($cadena, 'año')) {
                            $int_var = (int)filter_var($cadena, FILTER_SANITIZE_NUMBER_INT);
                            $total_dias = $int_var * 365;
                        } else {
                            $total_dias = 0;
                        }
    
                        // array_push($dias, $total_dias);
                        $dias[$j] = $total_dias;
                        $medicine[$j] = $treatment[$j]['medicine'];
                        $indication[$j] = $treatment[$j]['indication'];
                        $treatmentDuration[$j] = $treatment[$j]['treatmentDuration'];
                    }
    
                    $doctor = User::where('id', $item->user_id)->first();
                    $patient_phone = Patient::where('id', $item->id)->first()->phone;
    
                    $list_medicine = join(', ', $medicine);
    
                    $caption = <<<EOF
                        *RECORDATORIO DE TRATAMIENTO:*
    
                        *RECORDATORIO DE TRATAMIENTO:*
    
                        *Se tomó su medicamento?. Recuerde que debe hacerlo...*
    
                        *Tratamiento Asignado por:*
                        *Doctor(a):* {$doctor->name} {$doctor->last_name}
    
                        *TRATAMIENTO*
    
                        *Medicamentos:*
                        {$list_medicine}
                        EOF;
    
                    $params = array(
                        'token' => env('TOKEN_API_WHATSAPP'),
                        'to' => $patient_phone,
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
    
                    /**
                     * Este if() se encarga de actualizar el contador de envio de tratamientos
                     * para evitar que al terminar el tiempo del tratamiento la notificacion
                     * se siga enviando.
                     */
                    if (isset($response)) {
                        $update = Treatment::where('record_code', $treatmentReminder_patient[$i])->where('send_status', 'activa')->get();
                            foreach ($update as $key => $value) 
                            {
                                $value->count_notifications_send = $value->count_notifications_send + 1;
                                    if($value->count_notifications_send == max($dias))
                                    {
                                        $value->send_status = 'inactiva';
                                    }
                                $value->save();
                            }
                    }else{
                        dd($err);
                    }
    
                }
    
            }
    
        } catch (\Throwable $th) {
            dd($th);
        }

    }
}
