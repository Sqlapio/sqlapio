<?php

namespace Database\Seeders;

use App\Models\StatusDairy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusDairyList extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            //Hematología y Coagulación

            [
                'description' => 'Sin confirmar',
                'class' => 'secondary',


            ],
            [
                'description' => 'Confirmada',
                'class' => 'success',
            ],
            [
                'description' => 'Finalizada',
                'class' => 'danger',
            ],
            [
                'description' => 'Cancelada',
                'class' => 'warning',
            ],


        ];

        StatusDairy::insert($data);

    }
}
