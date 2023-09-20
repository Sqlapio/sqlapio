<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateList extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            [
                'description' => 'Amazonas',
            ],
            [
                'description' => 'Anzoátegui',
            ],
            [
                'description' => 'Apure',
            ],
            [
                'description' => 'Aragua',
            ],
            [
                'description' => 'Barinas',
            ],
            [
                'description' => 'Bolívar',
            ],
            [
                'description' => 'Carabobo',
            ],
            [
                'description' => 'Cojedes',
            ],
            [
                'description' => 'Delta Amacuro',
            ],
            [
                'description' => 'Distrito Capital',
            ],
            [
                'description' => 'Falcón',
            ],
            [
                'description' => 'Guárico',
            ],
            [
                'description' => 'Lara',
            ],
            [
                'description' => 'Mérida',
            ],
            [
                'description' => 'Miranda',
            ],
            [
                'description' => 'Monagas',
            ],
            [
                'description' => 'Nueva Esparta',
            ],
            [
                'description' => 'Portuguesa',
            ],
            [
                'description' => 'Sucre',
            ],
            [
                'description' => 'Táchira',
            ],
            [
                'description' => 'Trujillo',
            ],
            [
                'description' => 'Vargas',
            ],
            [
                'description' => 'Yaracuy',
            ],
            [
                'description' => 'Zulia',
            ]
        ];

        State::insert($data);
    }
}
