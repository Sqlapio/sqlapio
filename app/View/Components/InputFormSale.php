<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputFormSale extends Component
{
    /**
     * Create a new component instance.
     */
    public $hash;
    public $user;

    public function __construct($hash=null,$user=null)
    {
        $this->hash = $hash;
        $this->user = $user;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('livewire.components.sales-forces.register-user-sales-forces');

    }
}
