<?php

namespace App\Http\Livewire\Components\Stripe;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Queue\Listener;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaymentMethod extends Component
{

    protected $listeners = ['deletePaymentMethod', 'defaultPaymentMethod'];


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

        if(!auth()->user()->defaultPaymentMethod()) {

            $this->emit('error', 'No tienes un metodo de pago registrado!');
            return;
        }

        try {

            if (auth()->user()->subscribed($plan_name)) {

                auth()->user()->subscription($plan_name)->swap($plan);

                User::where('id', $user)
                ->update([
                    'role' => 'medico',
                    'duration' => Plan::where('price_stripe', $plan)->first()->duration
                    ]);

                auth()->user()->refresh();

                return redirect()->route('Profile');

                // return;
            }


            auth()->user()->newSubscription($plan_name, $plan)->create($this->defaultPaymentMethod->id);

            User::where('id', $user)
            ->update([
                'role' => 'medico',
                'duration' => Plan::where('price_stripe', $plan)->first()->duration
                ]);

            auth()->user()->refresh();

            return redirect()->route('Profile');

        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function cancelSubscription() {

        auth()->user()->subscription('Plan Ilimitado')->canceled();
    }

    public function resumeSubcription($plan) {

        $plan_name = Plan::where('price_stripe', $plan)->first()->type_plane;

        auth()->user()->subscription($plan_name)->resume();

        $user = Auth::user()->id;

        User::where('id', $user)
        ->update([
            'role' => 'medico',
            'duration' => Plan::where('price_stripe', $plan)->first()->duration
            ]);

        auth()->user()->refresh();

        return redirect()->route('Profile');
    }

    public function render() {

        return view('livewire.components.stripe.payment-method', [
            'intent' => auth()->user()->createSetupIntent(),
            'paymentMethods' => auth()->user()->paymentMethods(),
        ]);
    }
}
