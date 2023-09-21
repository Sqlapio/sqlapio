<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CityList extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [   
                'state_id' => '1',
                'description' => 'Puerto Ayacucho',
                'state' => 'Amazonas',
            ],
            [   
                'state_id' => '2',
                'description' => 'Centro Medico Zambrano',
                'state' => 'Anzoategui',
            ],
            [   
                'state_id' => '2',
                'description' => 'Barcelona',
                'state' => 'Anzoategui',
            ],
            [   
                'state_id' => '2',
                'description' => 'Puerto La Cruz',
                'state' => 'Anzoategui',
            ],
            [   
                'state_id' => '2',
                'description' => 'El Tigre',
                'state' => 'Anzoategui',
            ],
            [   
                'state_id' => '2',
                'description' => 'Anaco',
                'state' => 'Anzoategui',
            ],
            [   
                'state_id' => '2',
                'description' => 'Puerto Píritu',
                'state' => 'Anzoategui',
            ],
            [   
                'state_id' => '2',
                'description' => 'San José De Guanipa',
                'state' => 'Anzoategui',
            ],
            [   
                'state_id' => '2',
                'description' => 'Lechería',
                'state' => 'Anzoategui',
            ],
            [   
                'state_id' => '2',
                'description' => 'Guanta',
                'state' => 'Anzoategui',
            ],
            [   
                'state_id' => '2',
                'description' => 'Pariaguán',
                'state' => 'Anzoategui',
            ],
            [   
                'state_id' => '3',
                'description' => 'San Fernando De Apure',
                'state' => 'Apure',
            ],
            [   
                'state_id' => '3',
                'description' => 'Guasdualito',
                'state' => 'Apure',
            ],
            [   
                'state_id' => '3',
                'description' => 'Achaguas',
                'state' => 'Apure',
            ],
            [   
                'state_id' => '3',
                'description' => 'Biruaca',
                'state' => 'Apure',
            ],
            [   
                'state_id' => '4',
                'description' => 'Maracay',
                'state' => 'Aragura',
            ],
            [   
                'state_id' => '4',
                'description' => 'Turmero',
                'state' => 'Aragura',
            ],
            [   
                'state_id' => '4',
                'description' => 'La Victoria',
                'state' => 'Aragura',
            ],
            [   
                'state_id' => '4',
                'description' => 'Santa Rita',
                'state' => 'Aragura',
            ],
            [   
                'state_id' => '4',
                'description' => 'Palo Negro',
                'state' => 'Aragura',
            ],
            [   
                'state_id' => '4',
                'description' => 'Villa De Cura',
                'state' => 'Aragura',
            ],
            [   
                'state_id' => '4',
                'description' => 'Cagua',
                'state' => 'Aragura',
            ],
            [   
                'state_id' => '4',
                'description' => 'El Limón',
                'state' => 'Aragura',
            ],
            [   
                'state_id' => '5',
                'description' => 'Barinas',
                'state' => 'Barinas',
            ],
            [   
                'state_id' => '5',
                'description' => 'Socopó',
                'state' => 'Barinas',
            ],
            [   
                'state_id' => '5',
                'description' => 'Santa Bárbara (Barinas)',
                'state' => 'Barinas',
            ],
            [   
                'state_id' => '6',
                'description' => 'Ciudad Guayana',
                'state' => 'Bolivar',
            ],
            [   
                'state_id' => '6',
                'description' => 'Ciudad Bolívar',
                'state' => 'Bolivar',
            ],
            [   
                'state_id' => '6',
                'description' => 'Upata',
                'state' => 'Bolivar',
            ],
            [   
                'state_id' => '6',
                'description' => 'Tumeremo',
                'state' => 'Bolivar',
            ],
            [   
                'state_id' => '6',
                'description' => 'Caicara Del Orinoco',
                'state' => 'Bolivar',
            ],
            [   
                'state_id' => '7',
                'description' => 'Valencia',
                'state' => 'Carabobo',
            ],
            [   
                'state_id' => '7',
                'description' => 'Tocuyito',
                'state' => 'Carabobo',
            ],
            [   
                'state_id' => '7',
                'description' => 'Guacara',
                'state' => 'Carabobo',
            ],
            [   
                'state_id' => '7',
                'description' => 'Puerto Cabello',
                'state' => 'Carabobo',
            ],
            [   
                'state_id' => '7',
                'description' => 'Los Guayos',
                'state' => 'Carabobo',
            ],
            [   
                'state_id' => '7',
                'description' => 'Güigüe',
                'state' => 'Carabobo',
            ],
            [   
                'state_id' => '7',
                'description' => 'Mariara',
                'state' => 'Carabobo',
            ],
            [   
                'state_id' => '7',
                'description' => 'Morón',
                'state' => 'Carabobo',
            ],
            [   
                'state_id' => '7',
                'description' => 'San Joaquín',
                'state' => 'Carabobo',
            ],
            [   
                'state_id' => '8',
                'description' => 'San Carlos',
                'state' => 'Cojedes',
            ],
            [   
                'state_id' => '8',
                'description' => 'Tinaquillo',
                'state' => 'Cojedes',
            ],
            [   
                'state_id' => '9',
                'description' => 'Tucupita',
                'state' => 'Delta Amacuro',
            ],
            [   
                'state_id' => '10',
                'description' => 'Caracas',
                'state' => 'Distrito Capital',
            ],
            [   
                'state_id' => '11',
                'description' => 'Punto Fijo',
                'state' => 'Falcon',
            ],
            [   
                'state_id' => '11',
                'description' => 'Coro',
                'state' => 'Falcon',
            ],
            [   
                'state_id' => '12',
                'description' => 'San Juan De Los Morros',
                'state' => 'Guarico',
            ],
            [   
                'state_id' => '12',
                'description' => 'Calabozo',
                'state' => 'Guarico',
            ],
            [   
                'state_id' => '12',
                'description' => 'Valle De La Pascua',
                'state' => 'Guarico',
            ],
            [   
                'state_id' => '12',
                'description' => 'Zaraza',
                'state' => 'Guarico',
            ],
            [   
                'state_id' => '22',
                'description' => 'Catia La Mar',
                'state' => 'Vargas',
            ],
            [   
                'state_id' => '22',
                'description' => 'La Guaira',
                'state' => 'Vargas',
            ],
            [   
                'state_id' => '13',
                'description' => 'Barquisimeto',
                'state' => 'Lara',
            ],
            [   
                'state_id' => '13',
                'description' => 'Carora',
                'state' => 'Lara',
            ],
            [   
                'state_id' => '13',
                'description' => 'Cabudare',
                'state' => 'Lara',
            ],
            [   
                'state_id' => '13',
                'description' => 'El Tocuyo',
                'state' => 'Lara',
            ],
            [   
                'state_id' => '13',
                'description' => 'Quibor',
                'state' => 'Lara',
            ],
            [   
                'state_id' => '13',
                'description' => 'Siquisique',
                'state' => 'Lara',
            ],
            [   
                'state_id' => '14',
                'description' => 'Mérida',
                'state' => 'Merida',
            ],
            [   
                'state_id' => '14',
                'description' => 'El Vigía',
                'state' => 'Merida',
            ],
            [   
                'state_id' => '14',
                'description' => 'Ejido',
                'state' => 'Merida',
            ],
            [   
                'state_id' => '15',
                'description' => 'Guatire',
                'state' => 'Miranda',
            ],
            [   
                'state_id' => '15',
                'description' => 'Los Teques',
                'state' => 'Miranda',
            ],
            [   
                'state_id' => '15',
                'description' => 'Guarenas',
                'state' => 'Miranda',
            ],
            [   
                'state_id' => '15',
                'description' => 'Ocumare Del Tuy',
                'state' => 'Miranda',
            ],
            [   
                'state_id' => '15',
                'description' => 'Cúa',
                'state' => 'Miranda',
            ],
            [   
                'state_id' => '15',
                'description' => 'Charallave',
                'state' => 'Miranda',
            ],
            [   
                'state_id' => '15',
                'description' => 'Santa Lucía',
                'state' => 'Miranda',
            ],
            [   
                'state_id' => '15',
                'description' => 'San Antonio De Los Altos',
                'state' => 'Miranda',
            ],
            [   
                'state_id' => '16',
                'description' => 'Maturín',
                'state' => 'Monagas',
            ],
            [   
                'state_id' => '16',
                'description' => 'Punta De Mata',
                'state' => 'Monagas',
            ],
            [   
                'state_id' => '16',
                'description' => 'Caripito',
                'state' => 'Monagas',
            ],
            [   
                'state_id' => '17',
                'description' => 'Porlamar',
                'state' => 'Nueva Esparta',
            ],
            [   
                'state_id' => '17',
                'description' => 'La Asunción',
                'state' => 'Nueva Esparta',
            ],
            [   
                'state_id' => '17',
                'description' => 'El Valle Del Espiritu Santo',
                'state' => 'Nueva Esparta',
            ],
            [   
                'state_id' => '17',
                'description' => 'Pampatar',
                'state' => 'Nueva Esparta',
            ],
            [   
                'state_id' => '18',
                'description' => 'Guanare',
                'state' => 'Portuguesa',
            ],
            [   
                'state_id' => '18',
                'description' => 'Acarigua',
                'state' => 'Portuguesa',
            ],
            [   
                'state_id' => '18',
                'description' => 'Araure',
                'state' => 'Portuguesa',
            ],
            [   
                'state_id' => '19',
                'description' => 'Cumaná',
                'state' => 'Sucre',
            ],
            [   
                'state_id' => '19',
                'description' => 'Carúpano',
                'state' => 'Sucre',
            ],
            [   
                'state_id' => '20',
                'description' => 'San Cristóbal',
                'state' => 'Tachira',
            ],
            [   
                'state_id' => '20',
                'description' => 'Táriba',
                'state' => 'Tachira',
            ],
            [   
                'state_id' => '20',
                'description' => 'Rubio',
                'state' => 'Tachira',
            ],
            [   
                'state_id' => '20',
                'description' => 'La Grita',
                'state' => 'Tachira',
            ],
            [   
                'state_id' => '20',
                'description' => 'San Juan De Colón',
                'state' => 'Tachira',
            ],
            [   
                'state_id' => '21',
                'description' => 'Valera',
                'state' => 'Trujillo',
            ],
            [   
                'state_id' => '21',
                'description' => 'Trujillo',
                'state' => 'Trujillo',
            ],
            [   
                'state_id' => '21',
                'description' => 'Boconó',
                'state' => 'Trujillo',
            ],
            [   
                'state_id' => '23',
                'description' => 'San Felipe',
                'state' => 'Yaracuy',
            ],
            [   
                'state_id' => '23',
                'description' => 'Yaritagua',
                'state' => 'Yaracuy',
            ],
            [   
                'state_id' => '23',
                'description' => 'Chivacoa',
                'state' => 'Yaracuy',
            ],
            [   
                'state_id' => '23',
                'description' => 'Nirgua',
                'state' => 'Yaracuy',
            ],
            [   
                'state_id' => '24',
                'description' => 'Maracaibo',
                'state' => 'Zulia',
            ],
            [   
                'state_id' => '24',
                'description' => 'Cabimas',
                'state' => 'Zulia',
            ],
            [   
                'state_id' => '24',
                'description' => 'Ciudad Ojeda',
                'state' => 'Zulia',
            ],
            [   
                'state_id' => '24',
                'description' => 'Machiques',
                'state' => 'Zulia',
            ],
            [   
                'state_id' => '24',
                'description' => 'Caja Seca',
                'state' => 'Zulia',
            ],
            [   
                'state_id' => '24',
                'description' => 'Santa Bárbara Del Zulia',
                'state' => 'Zulia',
            ],
            [   
                'state_id' => '24',
                'description' => 'Santa Rita',
                'state' => 'Zulia',
            ],
            [   
                'state_id' => '24',
                'description' => 'Bachaquero',
                'state' => 'Zulia',
            ],
        ];

        City::insert($data);

    }
}
