<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class User extends Component
{
    public $listUser;

    public function render()
    {

        $this->listUser = [
            0 => [
                "names" => "Diego",
                "lastName" => "villlegas Guerra",
                "phone" => "24545454",
                "user" => "Diegov",
                "rol" => "admin/doc/pa",
                "email" => "Diegov@gmail.com",
                "province" => "provinceDiegov",
                "languaje" => "Ingles",
                "country" => "Venezuela",
                "dateNac" => "01/08/2223",
                "nif" => "nif",
                "adress" => "adressDiegov",

            ],
            1 => [
                "names" => "Camila",
                "lastName" => "Villegas guerra",
                "phone" => "24545454",
                "user" => "Camilav",
                "rol" => "admin/doc/pa",
                "email" => "24545454@gmail.com",
                "province" => "provinceCamilav",
                "languaje" => "Espanol",
                "country" => "Venezuela",
                "dateNac" => "01/08/2223",
                "nif" => "nif",
                "adress" => "adressCamilav",

            ],
            2 => [
                "names" => "Ashly",
                "lastName" => "Villegas Lopez",
                "phone" => "24545454",
                "user" => "SettingAshly",
                "rol" => "admin/doc/pa",
                "email" => "Ashly@gmail.com",
                "province" => "provinceAshly",
                "languaje" => "arabe",
                "country" => "Venezuela",
                "dateNac" => "01/08/2223",
                "nif" => "nif",
                "adress" => "adressAshly",


            ],
            3 => [
                "names" => "Kleyner",
                "lastName" => "villlegs Bastidas",
                "phone" => "24545454",
                "user" => "Setting",
                "rol" => "admin/doc/pa",
                "email" => "Kleyner@gmail.com",
                "province" => "province",
                "languaje" => "languaje",
                "country" => "Venezuela",
                "dateNac" => "01/08/2223",
                "nif" => "nif",
                "adress" => "adress",

            ],

            4 => [
                "names" => "Pedro",
                "lastName" => "Perez",
                "phone" => "24545454",
                "user" => "Setting",
                "rol" => "admin/doc/pa",
                "email" => "Pedro@gmail.com",
                "province" => "provincePedro",
                "languaje" => "Pedro",
                "country" => "Venezuela",
                "dateNac" => "01/08/2223",
                "nif" => "nif",
                "adress" => "adressPedro",

            ]
        ];

        return view('livewire.components.user', ['listUser' => $this->listUser]);
    }
}
