<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Centers extends Component
{
    public $listUser;

    public function render()
    {

        $this->listUser = [
            0 => [
                "hr" => "10:15 am",
                "patient" => "kleyner Villegas",
                "aseguradora" => "Matrix",
                "typeVisit" => "Emergencia",
                "status" => "Activo",
                "phone" => "04242231238",
                "contact" => "",
                "lastVisit" => "13-05-2023",
                "action" => "Clinica",
            ],
            1 => [
                "hr" => "11:15 am",
                "patient" => "Diego Villegas",
                "aseguradora" => "Cualita",
                "typeVisit" => "Control",
                "status" => "Inactivo",
                "phone" => "04242231238",
                "contact" => "",
                "lastVisit" => "14-05-2023",
                "action" => "Clinica",
            ]           
       ];
        return view('livewire.components.centers', ['listUser' => $this->listUser]);
    }
}
