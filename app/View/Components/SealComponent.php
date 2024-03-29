<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SealComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $class_one;
    public $class_two;
    public $title;

   
    public function __construct($class_one='col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4',$class_two='col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8',$title="Cargar Imagen")
    {
        $this->class_one = $class_one;
        $this->class_two = $class_two;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.seal-component');
    }
}
