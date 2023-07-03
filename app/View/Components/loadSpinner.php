<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class loadSpinner extends Component
{
    
    public $show;
    /**
     * Create a new component instance.
     */
    public function __construct( $show=false)
    {
        $this->show= $show;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.load-spinner');
    }
}
