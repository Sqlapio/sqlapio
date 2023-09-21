<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlansList extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            //Hematología y Coagulación

            [   
                'cod_plan' => 'SQ-PL-A',
                'type_plane' => 'Plan A',
                'total_patient' => 10,
                'total_medical_record' => 50,
            ],
            [   
                'cod_plan' => 'SQ-PL-B',
                'type_plane' => 'Plan B',
                'total_patient' => 20,
                'total_medical_record' => 100,
            ],
            [   
                'cod_plan' => 'SQ-PL-C',
                'type_plane' => 'Plan C',
                'total_patient' => 30,
                'total_medical_record' => 150,
            ],
            

        ];

        Plan::insert($data);

    }
}
