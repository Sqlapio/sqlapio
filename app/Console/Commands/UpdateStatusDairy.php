<?php

namespace App\Console\Commands;

use App\Http\Controllers\EstadisticaController;
use App\Models\Appointment;
use App\Models\GeneralStatistic;
use App\Models\Mes;
use App\Models\User;
use Illuminate\Console\Command;

class UpdateStatusDairy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-status-dairy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para actualizar los estatus de citas 1(sin confirmar) y 2(confirmadas) a 5(canceladas por sistema)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hoy = now()->format('Y-m-d');

        $dairy = Appointment::where('date_start', $hoy )->get();

        foreach($dairy as $item)
        {
            if($item->status == 1 || $item->status == 2){

                $item->status = 5;
                $item->color = '#0d6efd';
                $item->save();

                $numero_mes = now()->format('m');
                $mes = Mes::where('numero', $numero_mes)->first()->mes;

                $user_affected = User::where('id', $item->user_id)->first();

                if($user_affected->type_plane == 7){
                    $accumulated = new GeneralStatistic();
                    $accumulated->user_id = $user_affected->user_id;
                    $accumulated->type_plane = 7;
                    $accumulated->center = $user_affected->center_id;
                    $accumulated->dairy_no_atendida = 1;
                    $accumulated->mes = $mes;
                    $accumulated->numero_mes = $numero_mes;
                    $accumulated->date = date('d-m-Y');
                    $accumulated->save();
                }else{
                    $accumulated = new GeneralStatistic();
                    $accumulated->user_id = $item->user_id;
                    $accumulated->center = $item->center_id;
                    $accumulated->dairy_no_atendida = 1;
                    $accumulated->mes = $mes;
                    $accumulated->numero_mes = $numero_mes;
                    $accumulated->date = date('d-m-Y');
                    $accumulated->save();
                }
            }
 
        }

    }
}
