<?php

namespace Database\Seeders;

use App\Models\VitalSign;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VitalSignList extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [   
                'name' => 'hidratado',
                'text' => 'Hidratado',
            ],
            [   
                'name' => 'eupenico',
                'text' => 'Eupenico',
            ],
            [   
                'name' => 'febril',
                'text' => 'Febril',
            ],
            [   
                'name' => 'esfera_neurologica',
                'text' => 'Esfera Neurologica (orientado en tiempo espacio y persona, fuerza muscular etc)',
            ],
            [   
                'name' => 'glasgow',
                'text' => 'Glasgow (puntuación de la escala)',
            ],
            [   
                'name' => 'esfera_orl',
                'text' => 'Esfera ORL (oídos, nariz, boca, cuello)',
            ],
            [   
                'name' => 'esfera_cardiopulmonar',
                'text' => 'Esfera cardiopulmonar (corazón y pulmones)',
            ],
            [   
                'name' => 'esfera_abdominal',
                'text' => 'Esfera abdominal (semiología abdominal)',
            ],
            [   
                'name' => 'extremidades',
                'text' => 'Extremidades (si aplica)',
            ],

        ];

        VitalSign::insert($data);
    }
}
