<?php

namespace Database\Seeders;

use App\Models\PathologicalBackground;
use App\Models\Pathology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PathologicalBackgroundList extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [   
                'name' => 'hepatitis',
                'text' => 'Hepatitis',
            ],
            [   
                'name' => 'VIH_SIDA',
                'text' => 'VIH/SIDA',
            ],
            [   
                'name' => 'gastritis_ulceras',
                'text' => 'Gastritis/Ulceras',
            ],
            [   
                'name' => 'neurologia',
                'text' => 'Neurología',
            ],
            [   
                'name' => 'ansiedad_angustia',
                'text' => 'Ansiedad/Angustia',
            ],
            [   
                'name' => 'tiroides',
                'text' => 'Tiroides',
            ],
            [   
                'name' => 'lupus',
                'text' => 'Lupus',
            ],
            [   
                'name' => 'enfermedad_autoimmune',
                'text' => 'Enfermedad autoimmune',
            ],
            [   
                'name' => 'diabetes_mellitus',
                'text' => 'Diabetes Mellitus',
            ],
            [   
                'name' => 'presion_arterial_alta',
                'text' => 'Presión arterial alta',
            ],
            [   
                'name' => 'tiene_cateter_venoso',
                'text' => 'Tiene cateter venoso?',
            ],
            [   
                'name' => 'fracturas',
                'text' => 'Fracturas',
            ],
            [   
                'name' => 'trombosis_venosa',
                'text' => 'Trombosis venosa',
            ],
            [   
                'name' => 'embolia_pulmonar',
                'text' => 'Embolia pulmonar',
            ],
            [   
                'name' => 'varices_piernas',
                'text' => 'Varices en piernas',
            ],
            [   
                'name' => 'insuficiencia_arterial',
                'text' => 'Insuficiencia arterial',
            ],
            [   
                'name' => 'coagulación_anormal',
                'text' => 'Coagulación anormal',
            ],
            [   
                'name' => 'moretones_frecuentes',
                'text' => 'Moretones frecuentes',
            ],
            [   
                'name' => 'sangrado_cirugias_previas',
                'text' => 'Sangrado anormal en cirugías previas',
            ],
            [   
                'name' => 'sangrado_cepillado_dental',
                'text' => 'Sangrado anormal en cepillado dental',
            ],
            [   
                'name' => 'no_aplic_pathology',
                'text' => 'No aplica',
            ],

        ];

        PathologicalBackground::insert($data);
    }
}
