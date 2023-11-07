<?php

namespace App\Http\Livewire\Components;

use GuzzleHttp\Psr7\Request;
use Livewire\Component;

class PaymentForm extends Component
{


    public function pay_plan(Request $request) {
        
        dd(Request()->all());

    }

    public function render($type_plan)
    {
        return view('livewire.components.payment-form',compact('type_plan'));
    }
}
