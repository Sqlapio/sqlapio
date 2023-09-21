<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Ubigeo extends Component
{
    /**
     * Create a new component instance.
     */
    public $class;
    public function __construct($class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 div-select")
    {
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ubigeo');
    }
}
