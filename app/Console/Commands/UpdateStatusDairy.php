<?php

namespace App\Console\Commands;

use App\Http\Controllers\EstadisticaController;
use App\Models\Appointment;
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

        $dairy = Appointment::whereBetween('status', [1, 2])->where('date_start', $hoy )->get();
        foreach($dairy as $item)
        {
            $item->status = 5;
            $item->save();

            EstadisticaController::accumulated_dairy_no_atendidas($item->user_id, $item->center_id);
        }


    }
}
