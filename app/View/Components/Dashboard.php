<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dashboard extends Component
{

    public $classText;
    public $classRow;
    public $showItem;
    public $width;
    public $showFormation;


    /**
     * Create a new component instance.
     */
    public function __construct($classRow = "row", $classText = 'col-2 p-3', $showItem = true, $width = '50',$showFormation=true)
    {
        $this->classRow = $classRow;
        $this->classText = $classText;
        $this->showItem = $showItem;
        $this->width = $width;
        $this->showFormation = $showFormation;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard');
    }
}
