<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Professions extends Component
{
    /**
     * Create a new component instance.
     */
    public $class;
    public function __construct($class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 div-select")
    {
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.professions');
    }
}
