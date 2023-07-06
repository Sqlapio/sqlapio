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
                'description' => 'PUERTO AYACUCHO',
                'state' => 'AMAZONAS',
            ],
            [
                'description' => 'CENTRO MEDICO ZAMBRANO',
                'state' => 'ANZOATEGUI',
            ],
            [
                'description' => 'BARCELONA',
                'state' => 'ANZOATEGUI',
            ],
            [
                'description' => 'PUERTO LA CRUZ',
                'state' => 'ANZOATEGUI',
            ],
            [
                'description' => 'EL TIGRE',
                'state' => 'ANZOATEGUI',
            ],
            [
                'description' => 'ANACO',
                'state' => 'ANZOATEGUI',
            ],
            [
                'description' => 'PUERTO PÍRITU',
                'state' => 'ANZOATEGUI',
            ],
            [
                'description' => 'SAN JOSÉ DE GUANIPA',
                'state' => 'ANZOATEGUI',
            ],
            [
                'description' => 'LECHERÍA',
                'state' => 'ANZOATEGUI',
            ],
            [
                'description' => 'GUANTA',
                'state' => 'ANZOATEGUI',
            ],
            [
                'description' => 'PARIAGUÁN',
                'state' => 'ANZOATEGUI',
            ],
            [
                'description' => 'SAN FERNANDO DE APURE',
                'state' => 'APURE',
            ],
            [
                'description' => 'GUASDUALITO',
                'state' => 'APURE',
            ],
            [
                'description' => 'ACHAGUAS',
                'state' => 'APURE',
            ],
            [
                'description' => 'BIRUACA',
                'state' => 'APURE',
            ],
            [
                'description' => 'MARACAY',
                'state' => 'ARAGURA',
            ],
            [
                'description' => 'TURMERO',
                'state' => 'ARAGURA',
            ],
            [
                'description' => 'LA VICTORIA',
                'state' => 'ARAGURA',
            ],
            [
                'description' => 'SANTA RITA',
                'state' => 'ARAGURA',
            ],
            [
                'description' => 'PALO NEGRO',
                'state' => 'ARAGURA',
            ],
            [
                'description' => 'VILLA DE CURA',
                'state' => 'ARAGURA',
            ],
            [
                'description' => 'CAGUA',
                'state' => 'ARAGURA',
            ],
            [
                'description' => 'EL LIMÓN',
                'state' => 'ARAGURA',
            ],
            [
                'description' => 'BARINAS',
                'state' => 'BARINAS',
            ],
            [
                'description' => 'SOCOPÓ',
                'state' => 'BARINAS',
            ],
            [
                'description' => 'SANTA BÁRBARA (BARINAS)',
                'state' => 'BARINAS',
            ],
            [
                'description' => 'CIUDAD GUAYANA',
                'state' => 'BOLIVAR',
            ],
            [
                'description' => 'CIUDAD BOLÍVAR',
                'state' => 'BOLIVAR',
            ],
            [
                'description' => 'UPATA',
                'state' => 'BOLIVAR',
            ],
            [
                'description' => 'TUMEREMO',
                'state' => 'BOLIVAR',
            ],
            [
                'description' => 'CAICARA DEL ORINOCO',
                'state' => 'BOLIVAR',
            ],
            [
                'description' => 'VALENCIA',
                'state' => 'CARABOBO',
            ],
            [
                'description' => 'TOCUYITO',
                'state' => 'CARABOBO',
            ],
            [
                'description' => 'GUACARA',
                'state' => 'CARABOBO',
            ],
            [
                'description' => 'PUERTO CABELLO',
                'state' => 'CARABOBO',
            ],
            [
                'description' => 'LOS GUAYOS',
                'state' => 'CARABOBO',
            ],
            [
                'description' => 'GÜIGÜE',
                'state' => 'CARABOBO',
            ],
            [
                'description' => 'MARIARA',
                'state' => 'CARABOBO',
            ],
            [
                'description' => 'MORÓN',
                'state' => 'CARABOBO',
            ],
            [
                'description' => 'SAN JOAQUÍN',
                'state' => 'CARABOBO',
            ],
            [
                'description' => 'SAN CARLOS',
                'state' => 'COJEDES',
            ],
            [
                'description' => 'TINAQUILLO',
                'state' => 'COJEDES',
            ],
            [
                'description' => 'TUCUPITA',
                'state' => 'DELTA AMACURO',
            ],
            [
                'description' => 'CARACAS',
                'state' => 'DISTRITO CAPITAL',
            ],
            [
                'description' => 'PUNTO FIJO',
                'state' => 'FALCON',
            ],
            [
                'description' => 'CORO',
                'state' => 'FALCON',
            ],
            [
                'description' => 'SAN JUAN DE LOS MORROS',
                'state' => 'GUARICO',
            ],
            [
                'description' => 'CALABOZO',
                'state' => 'GUARICO',
            ],
            [
                'description' => 'VALLE DE LA PASCUA',
                'state' => 'GUARICO',
            ],
            [
                'description' => 'ZARAZA',
                'state' => 'GUARICO',
            ],
            [
                'description' => 'CATIA LA MAR',
                'state' => 'VARGAS',
            ],
            [
                'description' => 'LA GUAIRA',
                'state' => 'VARGAS',
            ],
            [
                'description' => 'BARQUISIMETO',
                'state' => 'LARA',
            ],
            [
                'description' => 'CARORA',
                'state' => 'LARA',
            ],
            [
                'description' => 'CABUDARE',
                'state' => 'LARA',
            ],
            [
                'description' => 'EL TOCUYO',
                'state' => 'LARA',
            ],
            [
                'description' => 'QUIBOR',
                'state' => 'LARA',
            ],
            [
                'description' => 'SIQUISIQUE',
                'state' => 'LARA',
            ],
            [
                'description' => 'MÉRIDA',
                'state' => 'MERIDA',
            ],
            [
                'description' => 'EL VIGÍA',
                'state' => 'MERIDA',
            ],
            [
                'description' => 'EJIDO',
                'state' => 'MERIDA',
            ],
            [
                'description' => 'GUATIRE',
                'state' => 'MIRANDA',
            ],
            [
                'description' => 'LOS TEQUES',
                'state' => 'MIRANDA',
            ],
            [
                'description' => 'GUARENAS',
                'state' => 'MIRANDA',
            ],
            [
                'description' => 'OCUMARE DEL TUY',
                'state' => 'MIRANDA',
            ],
            [
                'description' => 'CÚA',
                'state' => 'MIRANDA',
            ],
            [
                'description' => 'CHARALLAVE',
                'state' => 'MIRANDA',
            ],
            [
                'description' => 'SANTA LUCÍA',
                'state' => 'MIRANDA',
            ],
            [
                'description' => 'SAN ANTONIO DE LOS ALTOS',
                'state' => 'MIRANDA',
            ],
            [
                'description' => 'MATURÍN',
                'state' => 'MONAGAS',
            ],
            [
                'description' => 'PUNTA DE MATA',
                'state' => 'MONAGAS',
            ],
            [
                'description' => 'CARIPITO',
                'state' => 'MONAGAS',
            ],
            [
                'description' => 'PORLAMAR',
                'state' => 'NUEVA ESPARTA',
            ],
            [
                'description' => 'LA ASUNCIÓN',
                'state' => 'NUEVA ESPARTA',
            ],
            [
                'description' => 'EL VALLE DEL ESPIRITU SANTO',
                'state' => 'NUEVA ESPARTA',
            ],
            [
                'description' => 'PAMPATAR',
                'state' => 'NUEVA ESPARTA',
            ],
            [
                'description' => 'GUANARE',
                'state' => 'PORTUGUESA',
            ],
            [
                'description' => 'ACARIGUA',
                'state' => 'PORTUGUESA',
            ],
            [
                'description' => 'ARAURE',
                'state' => 'PORTUGUESA',
            ],
            [
                'description' => 'CUMANÁ',
                'state' => 'SUCRE',
            ],
            [
                'description' => 'CARÚPANO',
                'state' => 'SUCRE',
            ],
            [
                'description' => 'SAN CRISTÓBAL',
                'state' => 'TACHIRA',
            ],
            [
                'description' => 'TÁRIBA',
                'state' => 'TACHIRA',
            ],
            [
                'description' => 'RUBIO',
                'state' => 'TACHIRA',
            ],
            [
                'description' => 'LA GRITA',
                'state' => 'TACHIRA',
            ],
            [
                'description' => 'SAN JUAN DE COLÓN',
                'state' => 'TACHIRA',
            ],
            [
                'description' => 'VALERA',
                'state' => 'TRUJILLO',
            ],
            [
                'description' => 'TRUJILLO',
                'state' => 'TRUJILLO',
            ],
            [
                'description' => 'BOCONÓ',
                'state' => 'TRUJILLO',
            ],
            [
                'description' => 'SAN FELIPE',
                'state' => 'YARACUY',
            ],
            [
                'description' => 'YARITAGUA',
                'state' => 'YARACUY',
            ],
            [
                'description' => 'CHIVACOA',
                'state' => 'YARACUY',
            ],
            [
                'description' => 'NIRGUA',
                'state' => 'YARACUY',
            ],
            [
                'description' => 'MARACAIBO',
                'state' => 'ZULIA',
            ],
            [
                'description' => 'CABIMAS',
                'state' => 'ZULIA',
            ],
            [
                'description' => 'CIUDAD OJEDA',
                'state' => 'ZULIA',
            ],
            [
                'description' => 'MACHIQUES',
                'state' => 'ZULIA',
            ],
            [
                'description' => 'CAJA SECA',
                'state' => 'ZULIA',
            ],
            [
                'description' => 'SANTA BÁRBARA DEL ZULIA',
                'state' => 'ZULIA',
            ],
            [
                'description' => 'SANTA RITA',
                'state' => 'ZULIA',
            ],
            [
                'description' => 'BACHAQUERO',
                'state' => 'ZULIA',
            ],
        ];

        City::insert($data);

    }
}
