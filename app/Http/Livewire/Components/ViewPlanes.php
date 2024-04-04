<?php

namespace App\Http\Livewire\Components;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViewPlanes extends Component
{

    protected $listeners = ['deletePaymentMethod', 'defaultPaymentMethod', 'newSubscription', 'resumeSubcription', 'cancelSubscription'];

    public function addPaymentMethod($paymentMethod) {

        auth()->user()->addPaymentMethod($paymentMethod);

        if (!auth()->user()->hasDefaultPaymentMethod()) {

            auth()->user()->updateDefaultPaymentMethod($paymentMethod);
        }
    }

    public function getDefaultPaymentMethodProperty() {

        return auth()->user()->defaultPaymentMethod();
    }

    public function deletePaymentMethod($paymentMethod) {

        auth()->user()->deletePaymentMethod($paymentMethod);
    }

    public function defaultPaymentMethod($paymentMethod) {
        auth()->user()->updateDefaultPaymentMethod($paymentMethod);
    }

    public function newSubscription($plan) {

        $user = Auth::user()->id;

        $plan_name = Plan::where('price_stripe', $plan)->first()->type_plane;

        $type_plan = Plan::where('price_stripe', $plan)->where('role', Auth::user()->role)->first()->type_plane;

        if($type_plan == 'Plan Ilimitado' )
        {
            $type_plane_id = '3';
        }

        if($type_plan == 'Plan Profesional' )
        {
            $type_plane_id = '2';
        }

        if(!auth()->user()->defaultPaymentMethod()) {

            $this->emit('error', 'No tienes un metodo de pago registrado!');

        }

        try {

            if (auth()->user()->subscribed($plan_name)) {

                auth()->user()->subscription($plan_name)->swap($plan);

                User::where('id', $user)
                ->update([
                    'role' => Plan::where('price_stripe', $plan)->where('role', Auth::user()->role)->first()->role,
                    'duration' => Plan::where('price_stripe', $plan)->first()->duration,
                    'type_plane' => $type_plane_id
                    ]);

                auth()->user()->refresh();

                return redirect()->route('Profile');
            }

            auth()->user()->newSubscription($plan_name, $plan)->create($this->defaultPaymentMethod->id);

            User::where('id', $user)
            ->update([
                'role' => Plan::where('price_stripe', $plan)->where('role', Auth::user()->role)->first()->role,
                'duration' => Plan::where('price_stripe', $plan)->first()->duration,
                'type_plane' => $type_plane_id
                ]);

            auth()->user()->refresh();

            return redirect()->route('Profile');

        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function cancelSubscription($plan) {

        $plan_name = Plan::where('price_stripe', $plan)->first()->type_plane;

        auth()->user()->subscription($plan_name)->cancel();

        $user = Auth::user()->id;

            User::where('id', $user)
            ->update([
                'role' => 'temporary',
                'duration' => ''
                ]);

        return redirect()->route('Profile');
    }

    public function resumeSubcription($plan) {

        $plan_name = Plan::where('price_stripe', $plan)->first()->type_plane;

        auth()->user()->subscription($plan_name)->resume();

        $user = Auth::user()->id;

        User::where('id', $user)
        ->update([
            'role' => Plan::where('price_stripe', $plan)->where('role', Auth::user()->role)->first()->role,
            'duration' => Plan::where('price_stripe', $plan)->first()->duration
            ]);

        auth()->user()->refresh();

        return redirect()->route('Profile');
    }

    public function render() {

        return view('livewire.components.view-planes', [
            'intent' => auth()->user()->createSetupIntent(),
            'paymentMethods' => auth()->user()->paymentMethods(),
        ]);
    }
}
