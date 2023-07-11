<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UploadImage extends Component
{
    public $class_one;
    public $class_two;
    public $title;


    /**
     * Create a new component instance.
     */
    public function __construct($class_one='col-sm-4 md-4 lg-4 xl-4 xxl-4',$class_two='col-sm-8 md-8 lg-8 xl-8 xxl-8',$title="Cargar Imagen")
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
        return view('components.upload-image');
    }
}
