<?php

namespace Database\Seeders;

use App\Models\NonPathologicalBackground;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NonPathologicalBackgroundList extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [   
                'name' => 'alcohol',
                'text' => 'Alcohol',
            ],
            [   
                'name' => 'drogas',
                'text' => 'Drogas',
            ],
            [   
                'name' => 'vacunas_recientes',
                'text' => 'Vacunas recientes',
            ],
            [   
                'name' => 'transfusiones_sanguineas',
                'text' => 'Transfusiones sanguíneas',
            ],
            [   
                'name' => 'no_aplica_no_pathology',
                'text' => 'No aplica',
            ],

        ];

        NonPathologicalBackground::insert($data);
    }
}
