<?php

namespace App\Http\Livewire\Components\Stripe;

use Livewire\Component;

class PaymentMethod extends Component
{

    public function addPaymentMethod($paymentMethod)
    {
        auth()->user()->addPaymentMethod($paymentMethod);

        auth()->user()->updateDefaultPaymentMethod($paymentMethod);

    }

    public function getDefaultPaymentMethodProperty()
    {
        return auth()->user()->defaultPaymentMethod();
    }

    public function newSubscription($plan)
    {
        if(!$this->defaultPaymentMethod()) {

            $this->emit('error', 'No tienes un metodo de pago por defecto');

            return;
        }

        try {
            auth()->user()->newSubscription('Plan Ilimitado', $plan)->create($this->defaultPaymentMethod->id);

        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage())
        }


    }


    public function render()
    {
        return view('livewire.components.stripe.payment-method', [
            'intent' => auth()->user()->createSetupIntent(),
            'paymentMethods' => auth()->user()->paymentMethods(),
        ]);
    }
}
