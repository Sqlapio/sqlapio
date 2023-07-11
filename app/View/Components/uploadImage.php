<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UploadImage extends Component
{
    public $classOne;
    public $classTwo;
    public $title;


    /**
     * Create a new component instance.
     */
    public function __construct($classOne='col-sm-4 md-4 lg-4 xl-4 xxl-4',$classTwo='col-sm-8 md-8 lg-8 xl-8 xxl-8',$title="Cargar Imagen")
    {
        $this->classOne = $classOne;
        $this->classTwo = $classTwo;
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
