<?php

namespace App\Console\Commands;

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
        $hoy = '2024-08-26';
        $dairy = Appointment::whereBetween('status', [1, 2])->where('date_start', $hoy )->get();
            $item->save();
        }

    }
}
