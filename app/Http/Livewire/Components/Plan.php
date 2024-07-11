<?php

namespace App\Http\Livewire\Components;

use App\Models\Plan as ModelsPlan;
use Illuminate\Support\Facades\Auth;
use App\Models\Specialty;

use Livewire\Component;

class Plan extends Component
{
    public function render()
    {
        $user = Auth::user();
        $laboratory = $user->get_laboratorio;
        $speciality = Specialty::all();
        $info_plan = ModelsPlan::where('cod_plan', $user->type_plane)->first();

        return view('livewire.components.plan', compact('user', 'laboratory', 'info_plan', 'speciality'));
    }
}
