<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtyList extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
                [
                    'description' => 'Anestesiología'
                ],
                [
                    'description' => 'Cardiología'
                ],
                [
                    'description' => 'Cirugía General'
                ],
                [
                    'description' => 'Cirugía Plastica'
                ],
                [
                    'description' => 'Coloproctología'
                ],
                [
                    'description' => 'Dermatología'
                ],
                [
                    'description' => 'Endocrinología'
                ],
                [
                    'description' => 'Fertilidad Femenina'
                ],
                [
                    'description' => 'Fertilidad Masculina'
                ],
                [
                    'description' => 'Fisiatría'
                ],
                [
                    'description' => 'Foniatría'
                ],
                [
                    'description' => 'Gastroenterología'
                ],
                [
                    'description' => 'Ginecología'
                ],
                [
                    'description' => 'Gineco Obstetricia'
                ],
                [
                    'description' => 'Hematología'
                ],
                [
                    'description' => 'Infectología'
                ],
                [
                    'description' => 'Mastología'
                ],
                [
                    'description' => 'Medicina Crítica'
                ],
                [
                    'description' => 'Medicina Interna'
                ],
                [
                    'description' => 'Medicina General'
                ],
                [
                    'description' => 'Nefrología'
                ],
                [
                    'description' => 'Neumonología'
                ],
                [
                    'description' => 'Neurocirugía'
                ],
                [
                    'description' => 'Neurología'
                ],
                [
                    'description' => 'Neurología Infantil'
                ],
                [
                    'description' => 'Nutrición'
                ],
                [
                    'description' => 'Oftalmología'
                ],
                [
                    'description' => 'Odontología'
                ],
                [
                    'description' => 'Oncología'
                ],
                [
                    'description' => 'Otorrinolaringología'
                ],
                [
                    'description' => 'Psicología'
                ],
                [
                    'description' => 'Psicopedagogía'
                ],
                [
                    'description' => 'Psiquiatría'
                ],
                [
                    'description' => 'Radiología e Imágenes'
                ],
                [
                    'description' => 'Pediatría'
                ],
                [
                    'description' => 'Reumatología'
                ],
                [
                    'description' => 'Sexología'
                ],
                [
                    'description' => 'Traumatología'
                ],
                [
                    'description' => 'Urología'
                ],
                [
                    'description' => 'Urología Oncológica'
                ]
        ];

        Specialty::insert($data);

    }
}
