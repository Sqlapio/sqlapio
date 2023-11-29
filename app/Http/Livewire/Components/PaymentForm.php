<?php

namespace App\Http\Livewire\Components;

use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\BilledPlan;
use App\Models\Laboratory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PaymentForm extends Component
{


    public function pay_plan(Request $request)
    {
        try {

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

                 $date_today = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
                 $date_today = $date_today->addDay(30)->format('Y-m-d');

                if($request->type_plan == '1' || $request->type_plan == '2' || $request->type_plan == '3')
                {
                    $rules = [
                        'type_plan'         => 'required',
                        'ci'         => 'required|unique:users',
                        'email'             => 'required|email|unique:users',
                    ];

                    $msj = [
                        'type_plan.required' => 'Campo requerido',
                        'email.required'     => 'Campo requerido',
                        'email.unique'       => 'El correo electrónico ya se encuentra registrado. Intente con un nuevo correo',
                        'ci.unique'   => 'La cédula de identidad ya se encuentra registrado. Intente con una diferente',
                    ];

                    $validator = Validator::make($request->all(), $rules, $msj);

                    if ($validator->fails()) {
                        return response()->json([
                            'success' => 'false',
                            'errors'  => $validator->errors()->all()
                        ], 400);
                    }

                    $rol = 'medico';
                    $user = new User();
                    $user->name = $request->name;
                    $user->last_name = $request->last_name;
                    $user->ci = $request->ci;
                    $user->email = $request->email;
                    $user->type_plane = $request->type_plan;
                    $user->role = $rol;
                    $user->date_start_plan = date('Y-m-d');
                    $user->date_end_plan = $date_today;
                    $user->save();

                }

                if($request->type_plan == '4' || $request->type_plan == '5' || $request->type_plan == '6' || $request->type_plan == '7' )
                {
                    $rules = [
                        'type_plan'         => 'required',
                        'rif'               => 'required|unique:laboratories',
                        'email'             => 'required|email|unique:users',
                    ];

                    $msj = [
                        'type_plan.required' => 'Campo requerido',
                        'email.required'     => 'Campo requerido',
                        'email.unique'       => 'El correo electrónico ya se encuentra registrado. Intente con un nuevo correo',
                        'rif.unique'         => 'La RIF ya se encuentra registrado. Intente con una diferente',
                    ];

                    $validator = Validator::make($request->all(), $rules, $msj);

                    if ($validator->fails()) {
                        return response()->json([
                            'success' => 'false',
                            'errors'  => $validator->errors()->all()
                        ], 400);


                    }

                    $rol = ($request->type_plan=="7") ? 'corporativo' :'laboratorio';
                    $user = new User();
                    $user->business_name = $request->business_name;
                    $user->email = $request->email;
                    $user->type_plane = $request->type_plan;
                    $user->role = $rol;
                    $user->date_start_plan = $user->date_start_plan = date('Y-m-d');
                    $user->date_end_plan = $date_today;
                    $user->center_id = $request->center_id;
                    $user->token_corporate = Crypt::encryptString($request->center_id);
                    $user->save();

                    /**
                     * Solicitamos el id del laboratorio
                     * para almacenar en la tabla laboratorios
                     */
                    Laboratory::create([
                        'user_id'           => $user->id,
                        'business_name' 	=> $request->business_name,
                        'rif' 	            => $request->rif,
                        'email' 			=> $request->email,
                    ]);

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

        $date_today = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
        $date_today = $date_today->addDay(30)->format('Y-m-d');

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
                'date_start_plan' => date('Y-m-d'),
                'date_end_plan' => $date_today,
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
