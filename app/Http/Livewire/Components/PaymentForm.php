<?php

namespace App\Http\Livewire\Components;

use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\BilledPlan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PaymentForm extends Component
{


    public function pay_plan(Request $request) 
    {
        try {

            $rules = [
                'type_plan'         => 'required',
                'email'             => 'required',
            ];

            $msj = [
                'type_plan.required'         => 'Campo requerido',
                'email.required'             => 'Campo requerido',
            ];

            $validator = Validator::make($request->all(), $rules, $msj);

            if ($validator->fails()) {
                return response()->json([
                    'success' => 'false',
                    'errors'  => $validator->errors()->all()
                ], 400);
            }

            /**
             * API PASARELA DE PAGO
             * --------------------
             */

            $response = '200';

            if($response == '200')
            {
                /**
                 * Asignar rol al usuario
                 */
                
                if($request->type_plan == '1' || $request->type_plan == '2' || $request->type_plan == '3')
                {
                    $rol = 'medico';
                    $user = new User();
                    $user->name = $request->name;
                    $user->last_name = $request->last_name;
                    $user->ci = $request->number_id;
                    $user->email = $request->email;
                    $user->type_plane = $request->type_plan;
                    $user->role = $rol;
                    $user->save();

                }

                if($request->type_plan == '4' || $request->type_plan == '5' || $request->type_plan == '6')
                {
                    $rol = 'laboratorio';
                    $user = new User();
                    $user->business_name = $request->business_name;
                    $user->email = $request->email;
                    $user->type_plane = $request->type_plan;
                    $user->role = $rol;
                    $user->save();

                }


                $billed_plans = new BilledPlan();
                $billed_plans->user_id = $user->id;
                $billed_plans->type_plan = $request->type_plan;
                $billed_plans->methodo_payment = $request->methodo_payment;
                $billed_plans->number_card = $request->number_card;
                $billed_plans->code_card = $request->code_card;
                $billed_plans->amount = $request->amount;
                $billed_plans->date = date('d-m-Y');
                $billed_plans->save();

                return response()->json([
                    'success' => 'true',
                    'mjs'  => 'El pago fue registrado de forma exitosa',
                    'data' => encrypt($billed_plans->id),
                ], 200);


            }else{
                
                return response()->json([
                    'error' => 'true',
                    'errors'  => 'No se pudo realizar el pago, por favor intente mas tarde'
                ], 400);
            }

        } catch (\Throwable $th) {
            dd($th);
        }

    }

    public function pay_plan_renew(Request $request) 
    {
        $user = Auth::user();

        $billed_plans = new BilledPlan();
        $billed_plans->user_id = $user->id;
        $billed_plans->type_plan = $request->type_plan;
        $billed_plans->amount = $request->amount;
        $billed_plans->date = date('d-m-Y');
        $billed_plans->status = 'renovated';
        $billed_plans->save();

        User::where('id', $user->id)->where('email', $request->email)
            ->update([
                'type_plane' => $request->type_plan,
                'patient_counter' => 0,
                'medical_record_counter' => 0,
                'ref_counter' => 0,
            ]);

        return response()->json([
            'success' => 'true',
            'mjs'  => 'Su plan fue renovado con éxito',
        ], 200);
        
    }

    public function render($type_plan)
    {
        return view('livewire.components.payment-form',compact('type_plan'));
    }
}
