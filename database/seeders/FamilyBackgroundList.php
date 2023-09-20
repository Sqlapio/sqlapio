<?php

namespace Database\Seeders;

use App\Models\FamilyBackground;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamilyBackgroundList extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [   
                'name' => 'cancer',
                'text' => 'Cancer',
            ],
            [   
                'name' => 'diabetes',
                'text' => 'Diabetes',
            ],
            [   
                'name' => 'tension_alta',
                'text' => 'Tension alta',
            ],
            [   
                'name' => 'cardiacos',
                'text' => 'Cardiacos',
            ],
            [   
                'name' => 'psiquiatricas',
                'text' => 'Psiquiátricas',
            ],
            [   
                'name' => 'alteraciones_coagulacion',
                'text' => 'Alteraciones en coagulación',
            ],
            [   
                'name' => 'trombosis_embolas',
                'text' => 'Trombosis/Embolas',
            ],
            [   
                'name' => 'tranfusiones_sanguineas',
                'text' => 'Tranfusiones sanguineas',
            ],
            [   
                'name' => 'COVID19',
                'text' => 'COVID19',
            ],
            [   
                'name' => 'no_aplica',
                'text' => 'No aplica',
            ],

        ];

        FamilyBackground::insert($data);
    }
}
