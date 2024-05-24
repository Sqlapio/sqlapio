<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\ActivityLogController;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViewPlanes extends Component
{

    protected $listeners = ['deletePaymentMethod', 'defaultPaymentMethod', 'newSubscription', 'resumeSubcription', 'cancelSubscription'];

    public function addPaymentMethod($paymentMethod)
    {
        try {
            auth()->user()->addPaymentMethod($paymentMethod);

            if (!auth()->user()->hasDefaultPaymentMethod()) {

                auth()->user()->updateDefaultPaymentMethod($paymentMethod);
            }

            /**Registro la accion de agregar metodo de pago  */
            $action = '26';
            ActivityLogController::store_log($action);

        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function getDefaultPaymentMethodProperty()
    {
        try {
            return auth()->user()->defaultPaymentMethod();

            $this->emit('success', __('messages.alert.operacion_exitosa'));

            /**Registro la accion de metodo de pago por default  */
            $action = '27';
            ActivityLogController::store_log($action);

        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function deletePaymentMethod($paymentMethod)
    {

        try {
            auth()->user()->deletePaymentMethod($paymentMethod);

            $this->emit('success',  __('messages.alert.operacion_exitosa'));

            /**Registro la accion de eliminar metodo de pago  */
            $action = '28';
            ActivityLogController::store_log($action);

        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function defaultPaymentMethod($paymentMethod)
    {
        try {
            auth()->user()->updateDefaultPaymentMethod($paymentMethod);

            $this->emit('success', __('messages.alert.operacion_exitosa'));

             /**Registro la accion de cambiar metodo de pago por defecto  */
             $action = '29';
             ActivityLogController::store_log($action);

        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function newSubscription($plan)
    {

        $user = Auth::user()->id;

        $plan_name = Plan::where('price_stripe', $plan)->first()->type_plane;

        $type_plan = Plan::where('price_stripe', $plan)->where('role', Auth::user()->role)->first()->type_plane;

        if ($type_plan == 'Plan Ilimitado') {
            $type_plane_id = '3';
        }

        if ($type_plan == 'Plan Profesional') {
            $type_plane_id = '2';
        }

        if ($type_plan == 'Plan Ilimitado Dominicana') {
            $type_plane_id = '3';
        }

        if ($type_plan == 'Plan Profesional Dominicana') {
            $type_plane_id = '2';
        }

        if (!auth()->user()->defaultPaymentMethod()) {

            $this->emit('error',  __('messages.alert.no_metodo_de_pago'));
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

                $this->emit('success',  __('messages.alert.operacion_exitosa'));

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

            $this->emit('success',  __('messages.alert.operacion_exitosa'));

            /**Registro la accion de nueva subcripcion */
            $action = '30';
            ActivityLogController::store_log($action);

            return redirect()->route('Profile');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function cancelSubscription($plan)
    {
        try {

            $plan_name = Plan::where('price_stripe', $plan)->first()->type_plane;

            auth()->user()->subscription($plan_name)->cancel();

            $user = Auth::user()->id;

            User::where('id', $user)
                ->update([
                    'role' => 'temporary',
                    'duration' => ''
                ]);

            /**Registro la accion de cancelar subcripcion */
            $action = '31';
            ActivityLogController::store_log($action);

            return redirect()->route('Profile');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function resumeSubcription($plan)
    {

        try {

            $plan_name = Plan::where('price_stripe', $plan)->first()->type_plane;

            auth()->user()->subscription($plan_name)->resume();

            $user = Auth::user()->id;

            User::where('id', $user)
                ->update([
                    'role' => Plan::where('price_stripe', $plan)->where('role', Auth::user()->role)->first()->role,
                    'duration' => Plan::where('price_stripe', $plan)->first()->duration
                ]);

            auth()->user()->refresh();

            /**Registro la accion de cambiar subcripcion */
            $action = '32';
            ActivityLogController::store_log($action);

            return redirect()->route('Profile');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function render()
    {
        $type_plan = Auth::user()->type_plane;

        if ($type_plan == '3') {
            $plan_name = 'Plan Ilimitado';
        }

        if ($type_plan == '2') {
            $plan_name = 'Plan Profesional';
        }

        return view('livewire.components.view-planes', [
            'intent' => auth()->user()->createSetupIntent(),
            'paymentMethods' => auth()->user()->paymentMethods(),
            'current_end' => auth()->user()->subscription($plan_name)->asStripeSubscription()->current_period_end,
            'current_start' => auth()->user()->subscription($plan_name)->asStripeSubscription()->current_period_start,
        ]);
    }
}
