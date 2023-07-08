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
                'description' => 'PUERTO AYACUCHO',
                'state' => 'AMAZONAS',
            ],
            [   
                'state_id' => '2',
                'description' => 'CENTRO MEDICO ZAMBRANO',
                'state' => 'ANZOATEGUI',
            ],
            [   
                'state_id' => '2',
                'description' => 'BARCELONA',
                'state' => 'ANZOATEGUI',
            ],
            [   
                'state_id' => '2',
                'description' => 'PUERTO LA CRUZ',
                'state' => 'ANZOATEGUI',
            ],
            [   
                'state_id' => '2',
                'description' => 'EL TIGRE',
                'state' => 'ANZOATEGUI',
            ],
            [   
                'state_id' => '2',
                'description' => 'ANACO',
                'state' => 'ANZOATEGUI',
            ],
            [   
                'state_id' => '2',
                'description' => 'PUERTO PÍRITU',
                'state' => 'ANZOATEGUI',
            ],
            [   
                'state_id' => '2',
                'description' => 'SAN JOSÉ DE GUANIPA',
                'state' => 'ANZOATEGUI',
            ],
            [   
                'state_id' => '2',
                'description' => 'LECHERÍA',
                'state' => 'ANZOATEGUI',
            ],
            [   
                'state_id' => '2',
                'description' => 'GUANTA',
                'state' => 'ANZOATEGUI',
            ],
            [   
                'state_id' => '2',
                'description' => 'PARIAGUÁN',
                'state' => 'ANZOATEGUI',
            ],
            [   
                'state_id' => '3',
                'description' => 'SAN FERNANDO DE APURE',
                'state' => 'APURE',
            ],
            [   
                'state_id' => '3',
                'description' => 'GUASDUALITO',
                'state' => 'APURE',
            ],
            [   
                'state_id' => '3',
                'description' => 'ACHAGUAS',
                'state' => 'APURE',
            ],
            [   
                'state_id' => '3',
                'description' => 'BIRUACA',
                'state' => 'APURE',
            ],
            [   
                'state_id' => '4',
                'description' => 'MARACAY',
                'state' => 'ARAGURA',
            ],
            [   
                'state_id' => '4',
                'description' => 'TURMERO',
                'state' => 'ARAGURA',
            ],
            [   
                'state_id' => '4',
                'description' => 'LA VICTORIA',
                'state' => 'ARAGURA',
            ],
            [   
                'state_id' => '4',
                'description' => 'SANTA RITA',
                'state' => 'ARAGURA',
            ],
            [   
                'state_id' => '4',
                'description' => 'PALO NEGRO',
                'state' => 'ARAGURA',
            ],
            [   
                'state_id' => '4',
                'description' => 'VILLA DE CURA',
                'state' => 'ARAGURA',
            ],
            [   
                'state_id' => '4',
                'description' => 'CAGUA',
                'state' => 'ARAGURA',
            ],
            [   
                'state_id' => '4',
                'description' => 'EL LIMÓN',
                'state' => 'ARAGURA',
            ],
            [   
                'state_id' => '5',
                'description' => 'BARINAS',
                'state' => 'BARINAS',
            ],
            [   
                'state_id' => '5',
                'description' => 'SOCOPÓ',
                'state' => 'BARINAS',
            ],
            [   
                'state_id' => '5',
                'description' => 'SANTA BÁRBARA (BARINAS)',
                'state' => 'BARINAS',
            ],
            [   
                'state_id' => '6',
                'description' => 'CIUDAD GUAYANA',
                'state' => 'BOLIVAR',
            ],
            [   
                'state_id' => '6',
                'description' => 'CIUDAD BOLÍVAR',
                'state' => 'BOLIVAR',
            ],
            [   
                'state_id' => '6',
                'description' => 'UPATA',
                'state' => 'BOLIVAR',
            ],
            [   
                'state_id' => '6',
                'description' => 'TUMEREMO',
                'state' => 'BOLIVAR',
            ],
            [   
                'state_id' => '6',
                'description' => 'CAICARA DEL ORINOCO',
                'state' => 'BOLIVAR',
            ],
            [   
                'state_id' => '7',
                'description' => 'VALENCIA',
                'state' => 'CARABOBO',
            ],
            [   
                'state_id' => '7',
                'description' => 'TOCUYITO',
                'state' => 'CARABOBO',
            ],
            [   
                'state_id' => '7',
                'description' => 'GUACARA',
                'state' => 'CARABOBO',
            ],
            [   
                'state_id' => '7',
                'description' => 'PUERTO CABELLO',
                'state' => 'CARABOBO',
            ],
            [   
                'state_id' => '7',
                'description' => 'LOS GUAYOS',
                'state' => 'CARABOBO',
            ],
            [   
                'state_id' => '7',
                'description' => 'GÜIGÜE',
                'state' => 'CARABOBO',
            ],
            [   
                'state_id' => '7',
                'description' => 'MARIARA',
                'state' => 'CARABOBO',
            ],
            [   
                'state_id' => '7',
                'description' => 'MORÓN',
                'state' => 'CARABOBO',
            ],
            [   
                'state_id' => '7',
                'description' => 'SAN JOAQUÍN',
                'state' => 'CARABOBO',
            ],
            [   
                'state_id' => '8',
                'description' => 'SAN CARLOS',
                'state' => 'COJEDES',
            ],
            [   
                'state_id' => '8',
                'description' => 'TINAQUILLO',
                'state' => 'COJEDES',
            ],
            [   
                'state_id' => '9',
                'description' => 'TUCUPITA',
                'state' => 'DELTA AMACURO',
            ],
            [   
                'state_id' => '10',
                'description' => 'CARACAS',
                'state' => 'DISTRITO CAPITAL',
            ],
            [   
                'state_id' => '11',
                'description' => 'PUNTO FIJO',
                'state' => 'FALCON',
            ],
            [   
                'state_id' => '11',
                'description' => 'CORO',
                'state' => 'FALCON',
            ],
            [   
                'state_id' => '12',
                'description' => 'SAN JUAN DE LOS MORROS',
                'state' => 'GUARICO',
            ],
            [   
                'state_id' => '12',
                'description' => 'CALABOZO',
                'state' => 'GUARICO',
            ],
            [   
                'state_id' => '12',
                'description' => 'VALLE DE LA PASCUA',
                'state' => 'GUARICO',
            ],
            [   
                'state_id' => '12',
                'description' => 'ZARAZA',
                'state' => 'GUARICO',
            ],
            [   
                'state_id' => '22',
                'description' => 'CATIA LA MAR',
                'state' => 'VARGAS',
            ],
            [   
                'state_id' => '22',
                'description' => 'LA GUAIRA',
                'state' => 'VARGAS',
            ],
            [   
                'state_id' => '13',
                'description' => 'BARQUISIMETO',
                'state' => 'LARA',
            ],
            [   
                'state_id' => '13',
                'description' => 'CARORA',
                'state' => 'LARA',
            ],
            [   
                'state_id' => '13',
                'description' => 'CABUDARE',
                'state' => 'LARA',
            ],
            [   
                'state_id' => '13',
                'description' => 'EL TOCUYO',
                'state' => 'LARA',
            ],
            [   
                'state_id' => '13',
                'description' => 'QUIBOR',
                'state' => 'LARA',
            ],
            [   
                'state_id' => '13',
                'description' => 'SIQUISIQUE',
                'state' => 'LARA',
            ],
            [   
                'state_id' => '14',
                'description' => 'MÉRIDA',
                'state' => 'MERIDA',
            ],
            [   
                'state_id' => '14',
                'description' => 'EL VIGÍA',
                'state' => 'MERIDA',
            ],
            [   
                'state_id' => '14',
                'description' => 'EJIDO',
                'state' => 'MERIDA',
            ],
            [   
                'state_id' => '15',
                'description' => 'GUATIRE',
                'state' => 'MIRANDA',
            ],
            [   
                'state_id' => '15',
                'description' => 'LOS TEQUES',
                'state' => 'MIRANDA',
            ],
            [   
                'state_id' => '15',
                'description' => 'GUARENAS',
                'state' => 'MIRANDA',
            ],
            [   
                'state_id' => '15',
                'description' => 'OCUMARE DEL TUY',
                'state' => 'MIRANDA',
            ],
            [   
                'state_id' => '15',
                'description' => 'CÚA',
                'state' => 'MIRANDA',
            ],
            [   
                'state_id' => '15',
                'description' => 'CHARALLAVE',
                'state' => 'MIRANDA',
            ],
            [   
                'state_id' => '15',
                'description' => 'SANTA LUCÍA',
                'state' => 'MIRANDA',
            ],
            [   
                'state_id' => '15',
                'description' => 'SAN ANTONIO DE LOS ALTOS',
                'state' => 'MIRANDA',
            ],
            [   
                'state_id' => '16',
                'description' => 'MATURÍN',
                'state' => 'MONAGAS',
            ],
            [   
                'state_id' => '16',
                'description' => 'PUNTA DE MATA',
                'state' => 'MONAGAS',
            ],
            [   
                'state_id' => '16',
                'description' => 'CARIPITO',
                'state' => 'MONAGAS',
            ],
            [   
                'state_id' => '17',
                'description' => 'PORLAMAR',
                'state' => 'NUEVA ESPARTA',
            ],
            [   
                'state_id' => '17',
                'description' => 'LA ASUNCIÓN',
                'state' => 'NUEVA ESPARTA',
            ],
            [   
                'state_id' => '17',
                'description' => 'EL VALLE DEL ESPIRITU SANTO',
                'state' => 'NUEVA ESPARTA',
            ],
            [   
                'state_id' => '17',
                'description' => 'PAMPATAR',
                'state' => 'NUEVA ESPARTA',
            ],
            [   
                'state_id' => '18',
                'description' => 'GUANARE',
                'state' => 'PORTUGUESA',
            ],
            [   
                'state_id' => '18',
                'description' => 'ACARIGUA',
                'state' => 'PORTUGUESA',
            ],
            [   
                'state_id' => '18',
                'description' => 'ARAURE',
                'state' => 'PORTUGUESA',
            ],
            [   
                'state_id' => '19',
                'description' => 'CUMANÁ',
                'state' => 'SUCRE',
            ],
            [   
                'state_id' => '19',
                'description' => 'CARÚPANO',
                'state' => 'SUCRE',
            ],
            [   
                'state_id' => '20',
                'description' => 'SAN CRISTÓBAL',
                'state' => 'TACHIRA',
            ],
            [   
                'state_id' => '20',
                'description' => 'TÁRIBA',
                'state' => 'TACHIRA',
            ],
            [   
                'state_id' => '20',
                'description' => 'RUBIO',
                'state' => 'TACHIRA',
            ],
            [   
                'state_id' => '20',
                'description' => 'LA GRITA',
                'state' => 'TACHIRA',
            ],
            [   
                'state_id' => '20',
                'description' => 'SAN JUAN DE COLÓN',
                'state' => 'TACHIRA',
            ],
            [   
                'state_id' => '21',
                'description' => 'VALERA',
                'state' => 'TRUJILLO',
            ],
            [   
                'state_id' => '21',
                'description' => 'TRUJILLO',
                'state' => 'TRUJILLO',
            ],
            [   
                'state_id' => '21',
                'description' => 'BOCONÓ',
                'state' => 'TRUJILLO',
            ],
            [   
                'state_id' => '23',
                'description' => 'SAN FELIPE',
                'state' => 'YARACUY',
            ],
            [   
                'state_id' => '23',
                'description' => 'YARITAGUA',
                'state' => 'YARACUY',
            ],
            [   
                'state_id' => '23',
                'description' => 'CHIVACOA',
                'state' => 'YARACUY',
            ],
            [   
                'state_id' => '23',
                'description' => 'NIRGUA',
                'state' => 'YARACUY',
            ],
            [   
                'state_id' => '24',
                'description' => 'MARACAIBO',
                'state' => 'ZULIA',
            ],
            [   
                'state_id' => '24',
                'description' => 'CABIMAS',
                'state' => 'ZULIA',
            ],
            [   
                'state_id' => '24',
                'description' => 'CIUDAD OJEDA',
                'state' => 'ZULIA',
            ],
            [   
                'state_id' => '24',
                'description' => 'MACHIQUES',
                'state' => 'ZULIA',
            ],
            [   
                'state_id' => '24',
                'description' => 'CAJA SECA',
                'state' => 'ZULIA',
            ],
            [   
                'state_id' => '24',
                'description' => 'SANTA BÁRBARA DEL ZULIA',
                'state' => 'ZULIA',
            ],
            [   
                'state_id' => '24',
                'description' => 'SANTA RITA',
                'state' => 'ZULIA',
            ],
            [   
                'state_id' => '24',
                'description' => 'BACHAQUERO',
                'state' => 'ZULIA',
            ],
        ];

        City::insert($data);

    }
}
