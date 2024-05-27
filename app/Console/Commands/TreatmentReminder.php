<?php

namespace App\Console\Commands;

use App\Models\MedicalRecord;
use App\Models\MedicalReport;
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
        $treatmentReminder = MedicalRecord::where()
    }
}
