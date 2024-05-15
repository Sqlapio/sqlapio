<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfessionList extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            //Hematología y Coagulación

            [
                'description' => 'Abogado',
            ],
            [
                'description' => 'Administrador',
            ],
            [
                'description' => 'Agricultor',
            ],
            [
                'description' => 'Albañil',
            ],
            [
                'description' => 'Animador',
            ],
            [
                'description' => 'Antropólogo',
            ],
            [
                'description' => 'Archivólogo',
            ],
            [
                'description' => 'Arquitecto',
            ],
            [
                'description' => 'Artesano',
            ],
            [
                'description' => 'Barbero',
            ],
            [
                'description' => 'Barrendero',
            ],
            [
                'description' => 'Bibliotecólogo',
            ],
            [
                'description' => 'Biólogo',
            ],
            [
                'description' => 'Botánico',
            ],
            [
                'description' => 'Cajero',
            ],
            [
                'description' => 'Carnicero',
            ],
            [
                'description' => 'Carpintero',
            ],
            [
                'description' => 'Carpintero',
            ],
            [
                'description' => 'Cerrajero',
            ],
            [
                'description' => 'Cocinero',
            ],
            [
                'description' => 'Computista',
            ],
            [
                'description' => 'Contador',
            ],
            [
                'description' => 'Deshollinador',
            ],
            [
                'description' => 'écnico de sonido',
            ],
            [
                'description' => 'Ecólogo',
            ],
            [
                'description' => 'Economista',
            ],
            [
                'description' => 'Editor',
            ],
            [
                'description' => 'Electricista',
            ],
            [
                'description' => 'Enfermero',
            ],
            [
                'description' => 'Escritor',
            ],
            [
                'description' => 'Escultor',
            ],
            [
                'description' => 'Exterminador',
            ],
            [
                'description' => 'Farmacólogo',
            ],
            [
                'description' => 'Filólogo',
            ],
            [
                'description' => 'Filósofo',
            ],
            [
                'description' => 'Físico',
            ],
            [
                'description' => 'Fontanero o plomero',
            ],
            [
                'description' => 'Frutero',
            ],
            [
                'description' => 'Ganadero',
            ],
            [
                'description' => 'Geógrafo',
            ],
            [
                'description' => 'Historiador',
            ],
            [
                'description' => 'Impresor',
            ],
            [
                'description' => 'Ingeniero',
            ],
            [
                'description' => 'Lavandero',
            ],
            [
                'description' => 'Lechero',
            ],
            [
                'description' => 'Leñador',
            ],
            [
                'description' => 'Lingüista',
            ],
            [
                'description' => 'Locutor',
            ],
            [
                'description' => 'Matemático',
            ],
            [
                'description' => 'Mecánico',
            ],
            [
                'description' => 'Médico cirujano',
            ],
            [
                'description' => 'Músico',
            ],
            [
                'description' => 'Obrero',
            ],
            [
                'description' => 'Paleontólogo',
            ],
            [
                'description' => 'Panadero',
            ],
            [
                'description' => 'ParamédicoT',
            ],
            [
                'description' => 'Peletero',
            ],
            [
                'description' => 'Peluquero',
            ],
            [
                'description' => 'Periodista',
            ],
            [
                'description' => 'Pescador',
            ],
            [
                'description' => 'Pintor',
            ],
            [
                'description' => 'Policía',
            ],
            [
                'description' => 'Politólogo',
            ],
            [
                'description' => 'Profesor',
            ],
            [
                'description' => 'Psicoanalista',
            ],
            [
                'description' => 'Psicólogo',
            ],
            [
                'description' => 'Químico',
            ],
            [
                'description' => 'Radiólogo',
            ],
            [
                'description' => 'Repartidor',
            ],
            [
                'description' => 'Sastre',
            ],
            [
                'description' => 'Secretaria',
            ],
            [
                'description' => 'Sociólogo',
            ],
            [
                'description' => 'Soldador',
            ],
            [
                'description' => 'Técnico en turismo',
            ],
            [
                'description' => 'Tornero',
            ],
            [
                'description' => 'Traductor',
            ],
            [
                'description' => 'Vendedor',
            ],
            [
                'description' => 'Vigilante',
            ],
            [
                'description' => 'Otro',
            ],

        ];

        Profession::insert($data);
    }
}
