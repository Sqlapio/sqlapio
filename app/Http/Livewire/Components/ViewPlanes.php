<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class ViewPlanes extends Component
{

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

        if(!auth()->user()->defaultPaymentMethod()) {

            $this->emit('error', 'No tienes un metodo de pago registrado!');
            return;
        }

        try {
            if (auth()->user()->subscribed('Plan Ilimitado')) {

                auth()->user()->subscription('Plan Ilimitado')->swap($plan);
                return;
            }

            auth()->user()->newSubscription('Plan Ilimitado', $plan)->create($this->defaultPaymentMethod->id);

            auth()->user()->refresh();

        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function cancelSubscription() {

        auth()->user()->subscription('Plan Ilimitado')->canceled();
    }

    public function resumeSubscription() {

        auth()->user()->subscription('Plan Ilimitado')->resume();
    }

    public function render() {

        return view('livewire.components.view-planes', [
            'intent' => auth()->user()->createSetupIntent(),
            'paymentMethods' => auth()->user()->paymentMethods(),
        ]);
    }
}
