<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Statistics extends Component
{

    public $listUser;
    
    public function render()
    {

        $this->listUser = [
            0 => [
                "nunHistory" => "1",
                "lastName" => "Bastidas Villegas",
                "names" => "klyener jose",
                "profesional" => "Jhonny Martinez",
                "typeCita" => "Activo",
                "company" => "Calita",
                "diagnostico" => "vdiagnostico",
                "import" => "10",
                "pagado" => "",
                "typePayment" => "",
                "ctaBank" => "",
                "cobra" => "",
            ],
            1 => [
                "nunHistory" => "2",
                "lastName" => "Perez Sulbaran",
                "names" => "Pedro Jose",
                "profesional" => "Jhonny Martinez",
                "typeCita" => "contro",
                "company" => "matrix",
                "diagnostico" => "diagnostico",
                "import" => "100",
                "pagado" => "",
                "typePayment" => "",
                "ctaBank" => "",
                "cobra" => "",
            ]           
       ];

        return view('livewire.components.statistics',['listUser' => $this->listUser]);
    }
}
