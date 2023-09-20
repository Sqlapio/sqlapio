<?php

namespace Database\Seeders;

use App\Models\MedicalSpeciality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalSpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Alergología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Anestesiología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Angiología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Cardiología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Endocrinología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Estomatología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Farmacología Clínica',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Gastroenterología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Genética',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Geriatría',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Hematología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Hepatología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Infectología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Medicina aeroespacial',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Medicina del deporte',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Medicina familiar y comunitaria',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Medicina física y rehabilitación',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Medicina forense',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Medicina intensiva',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Medicina interna',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Medicina preventiva y salud pública',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Medicina del trabajo',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Nefrología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Neumología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Neurología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Nutriología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Oncología médica',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Oncología radioterápica',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Pediatría',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Psiquiatría',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Reumatología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Toxicología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Cirugía cardíaca',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Cirugía general',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Cirugía oral y maxilofacial',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Cirugía ortopédica',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Cirugía pediátrica',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Cirugía plástica',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Cirugía torácica',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Cirugía vascular',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Neurocirugía',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Dermatología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Ginecología y obstetricia o tocología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Medicina de emergencia',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Oftalmología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Otorrinolaringología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Traumatología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Urología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Análisis clínico',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Anatomía patológica',
            ],[   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Bioquímica clínica',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Farmacología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Genética médica',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Inmunología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Medicina nuclear',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Microbiología y parasitología',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Neurofisiología clínica',
            ],
            [   
                'cod_specialty' => 'SQ-MS-'.random_int(11111111, 99999999),
                'description' => 'Radiología',
            ]

        ];

        MedicalSpeciality::insert($data);
    }
}
