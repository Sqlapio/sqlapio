<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class phoneComponent extends Component
{


    public $phone;
    public $id;

    /**
     * Create a new component instance.
     */
    public function __construct($phone=null, $id='phone')
    {
        $this->phone= $phone;
        $this->id= $id;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.phone_component');
    }
}
