<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use App\Http\Controllers\UtilsController;
use Illuminate\Support\Facades\Auth;


class Dashboard extends Component
{
    public function render()
    {

        $id= (Auth::user()->role=="secretary")?Auth::user()->master_corporate_id :Auth::user()->id;

        $patients = UtilsController::get_table_medical_record($id);

        return view(
            'livewire.components.profile_corporate.dashboard',
            compact(
                'patients'
            )
        );
    }
}
