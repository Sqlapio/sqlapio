<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectDos extends Component
{
    /**
     * Create a new component instance.
     */
    public $data;
    public $callBack;
    
    public function __construct($data=[],$callBack="dairy")
    {
        $this->data = $data;
        $this->callBack = $callBack;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-dos',[
            'data'=>$this->data,
            'callBack'=>$this->callBack,
        
        ]);        
    }
}
