<div>
    <style>
        .logo-bank {
            width: 40%;
            height: auto;
        }

        .logoSq {
            width: 50% !important;
            height: auto;
        }

        .title-card {
            font-size: 20px;
            color: #133837;
            text-align: start;
            font-weight: normal;
        }

        /* .card-plans {
            -webkit-background-size: cover !important;
            -moz-background-size: cover !important;
            -o-background-size: cover !important;
            background-size: cover !important;
            background: url('/img/bg1.jpg') no-repeat center center;
            box-shadow: 0px 0px 11px 0px rgba(120, 116, 116, 0.7);
            border-radius: 20px !important;
            font-size: 13px;
            width: 100%;
            ;
        } */

        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        :root {
            --color-text: #616161;
            --color-text-btn: #ffffff;
            --card1-gradient-color1: #459594;
            --card1-gradient-color2: #95cecd;
        }

        .card-wrap {
            width: 220px;
            background: #fff;
            border-radius: 20px;
            border: 5px solid #fff;
            overflow: hidden;
            color: var(--color-text);
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px,
                rgba(0, 0, 0, 0.23) 0px 6px 6px;
            cursor: pointer;
            transition: all .2s ease-in-out;
        }

        .card-header {
            height: 120px;
            width: 100%;
            background: red;
            border-radius: 100% 0% 100% 0% / 0% 50% 50% 100% !important;
            display: grid;
            place-items: center;

        }

        .card-header i {
            color: #fff;
            font-size: 72px;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 60%;
            margin: 0 auto;
        }

        .card-title-2 {
            text-align: center;
            text-transform: uppercase;
            font-size: 22px;
            margin-top: 10px;
        }

        .card-text {
            text-align: center;
            font-size: 12px;
            margin-bottom: 20px;
        }

        .card-header.one {
            background: linear-gradient(to bottom left, var(--card1-gradient-color1), var(--card1-gradient-color2));
        }


        .count-plan-0 {
            color: red
        }

        .count-plan {
            color: #459594
        }

        .btn-plans {
            justify-content: flex-end;
        }

        @media only screen and (max-width: 576px) {
            .mt-m3 {
                margin-top: 100px
            }

            .logoSq {
                width: 30%;
                height: auto;
            }

            .logo-bank {
                width: 20px;
                margin-left: 20px;
            }

            .btn-plans {
                justify-content: center;
            }
        }
    </style>
    <script>
        let user = @json(Auth::user());

        $(document).ready(() => {

            let data_palnes = [{
                    type_plan: 1,
                    description: "Plan - @lang('messages.label.free')",
                    count_patients: 10,
                    count_ref: 20,
                    count_exam: 20,
                    count_study: 20,
                },
                {
                    type_plan: 2,
                    description: `Plan - @lang('messages.label.profesional') - ${ user.duration }`,
                    count_patients: 40,
                    count_ref: 40,
                    count_exam: 80,
                    count_study: 80,
                },
                {
                    type_plan: 3,
                    description: `Plan - @lang('messages.label.ilimitado') - ${ user.duration }`,
                    count_patients: '@lang('messages.label.ilimitado')',
                    count_ref: '@lang('messages.label.ilimitado')',
                    count_exam: '@lang('messages.label.ilimitado')',
                    count_study: '@lang('messages.label.ilimitado')',
                },
                {
                    type_plan: 4,
                    description: "Plan - ILIMITADO",
                    count_patients: 'ILIMITADO',
                    count_ref: 'ILIMITADO',
                    count_exam: 'ILIMITADO',
                    count_study: 'ILIMITADO',
                },
                {
                    type_plan: 5,
                    description: "Plan - ILIMITADO",
                    count_patients: 'ILIMITADO',
                    count_ref: 'ILIMITADO',
                    count_exam: 'ILIMITADO',
                    count_study: 'ILIMITADO',
                },
                {
                    type_plan: 6,
                    description: "Plan - ILIMITADO",
                    count_patients: 'ILIMITADO',
                    count_ref: 'ILIMITADO',
                    count_exam: 'ILIMITADO',
                    count_study: 'ILIMITADO',
                }
            ];

            if (user.role == "laboratorio") {
                $('#type_rif_pay').val(user.get_laboratorio.rif[0] + "-").change();
            }

            switch_type_plane(user.type_plane);
            hiddenBtn(user.type_plane);
            const data = data_palnes.find((e) => e.type_plan == user.type_plane);

            $('.card-title').text(data.description);
            $('#pacientes').text(`${data.count_patients}`);
            $('#consultas').text(`${data.count_ref}`);
            $('#examenes').text(`${data.count_exam}`);
            $('#estudios').text(`${data.count_study}`);

            $('#form-payment-renew').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    last_name: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    amount: {
                        required: true,
                    },
                    number_id: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    number_card: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,

                    },
                    code_card: {
                        required: true,
                        maxlength: 3,
                    },
                    methodo_payment: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    rif_pay: {
                        required: true,
                    },
                    type_rif_pay: {
                        required: true,
                    },
                    business_name: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "Nombres es obligatorio",
                    },
                    last_name: {
                        required: "Apellidos es obligatorio",
                    },
                    amount: {
                        required: "Monto es obligatorio",
                    },
                    number_id: {
                        required: "Numero de cedula es obligatorio",
                    },
                    number_card: {
                        required: "Numero de tarjeta es obligatorio",
                    },
                    code_card: {
                        required: "Codigo de tarjeta es obligatorio",
                    },
                    methodo_payment: {
                        required: "Debe Selecciones un metodo de pago",
                    },
                    email: {
                        required: "Correo electronico es obligatorio",
                    },
                    type_rif_pay: {
                        required: "Tipo de documento es obligatorio",
                    },
                    rif_pay: {
                        required: "Rif es obligatorio",
                    },
                    business_name: {
                        required: "Razón social es obligatorio",
                    }

                }
            });



            $.validator.addMethod("onlyNumber", function(value, element) {
                var pattern = /^\d+\.?\d*$/;
                return pattern.test(value);
            }, "Campo numérico");

            //envio del formulario
            $("#form-payment-renew").submit(function(event) {
                event.preventDefault();
                $("#form-payment-renew").validate();
                if ($("#form-payment-renew").valid()) {
                    $('#send').hide();
                    $('#spinner2').show();
                    var data = $('#form-payment-renew').serialize();
                    $.ajax({
                        url: "{{ route('pay-plan-renew') }}",
                        type: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#send').show();
                            $('#spinner2').hide();
                            // $("#form-payment-renew").trigger("reset");
                            $(".holder").hide();
                            Swal.fire({
                                icon: 'success',
                                title: response.mjs,
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: '@lang('messages.botton.aceptar')'
                            }).then((result) => {
                                let url = "{{ route('DashboardComponent') }}";
                                window.location.href = url;

                            });
                        },
                        error: function(error) {
                            error.responseJSON.errors.map((elm) => {
                                Swal.fire({
                                    icon: 'error',
                                    title: elm,
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#42ABE2',
                                    confirmButtonText: '@lang('messages.botton.aceptar')'
                                }).then((result) => {
                                    $('#send').show().attr('disabled', true);;
                                    $('#spinner2').hide();
                                    $(".holder").hide();
                                });
                            });
                        }
                    });
                }
            });

        });

        function renew_plan(action, type_plan) {
            $('#planes-content-revew').hide();
            $('#planes-content-revew-select').hide();
            $('#ModalRenewPlanes').modal('show');
            switch_type_plane(type_plan);
            if (action == 1) {
                $('#planes-content-revew').show();
            } else {
                $('#planes-content-revew-select').show();
            }
        }

        function handler_renew_plan(type_plan) {
            $('#planes-content-revew').show();
            $("#change_plan").val(true);
            switch_type_plane(type_plan);
        }

        function hiddenBtn(type_plane) {
            switch (Number(type_plane)) {
                case 1:
                    $('#free-btn').hide();
                    $('#renew-btn').hide();
                    break;
                case 2:
                    $('#free-btn').hide();
                    $('#profesional-btn').hide();
                    break;
                case 3:
                    $('#free-btn').hide();
                    $('#profesional-btn').hide();
                    $('#change-btn').hide();
                    $('#paciente_span').hide();
                    $('#consulta_span').hide();
                    $('#examene_span').hide();
                    $('#estudio_span').hide();
                    break;
            }
        }

        function switch_type_plane(type_plane) {
            switch (Number(type_plane)) {
                case 1:
                    $("#type_plan").val(type_plane);
                    $("#amount").val('0');
                    $("#code_card").attr('disabled', true);
                    $("#number_card").attr('disabled', true);
                    $("#methodo_payment").attr('disabled', true);
                    if (Number(user.patient_counter) >= 10) {
                        $('#paciente_span').attr('class', 'count-plan-0');
                        $('#pacientes').attr('class', 'count-plan-0');
                    }
                    if (Number(user.medical_record_counter) >= 20) {
                        $('#consulta_span').attr('class', 'count-plan-0');
                        $('#consultas').attr('class', 'count-plan-0');
                    }
                    if (Number(user.ref_counter) >= 20) {
                        $('#examene_span').attr('class', 'count-plan-0');
                        $('#examenes').attr('class', 'count-plan-0');
                        $('#estudio_span').attr('class', 'count-plan-0');
                        $('#estudios').attr('class', 'count-plan-0');
                    }
                    $('#free').show();
                    $('#profesional').hide();
                    $('#ilimitado').hide();
                    break;
                case 2:
                    $("#type_plan").val(type_plane);
                    $("#amount").val('$19.99');
                    $("#code_card").attr('disabled', false);
                    $("#number_card").attr('disabled', false);
                    $("#methodo_payment").attr('disabled', false);
                    if (Number(user.patient_counter) >= 40) {
                        $('#paciente_span').attr('class', 'count-plan-0');
                        $('#pacientes').attr('class', 'count-plan-0');

                    }
                    if (Number(user.medical_record_counter) >= 40) {
                        $('#consulta_span').attr('class', 'count-plan-0');
                        $('#consultas').attr('class', 'count-plan-0');

                    }
                    if (Number(user.ref_counter) >= 80) {
                        $('#examene_span').attr('class', 'count-plan-0');
                        $('#estudio_span').attr('class', 'count-plan-0');
                    }
                    $('#free').hide();
                    $('#profesional').show();
                    $('#ilimitado').hide();
                    break;
                case 3:

                    $("#type_plan").val(type_plane);
                    $("#amount").val('$39.99');
                    $("#code_card").attr('disabled', false);
                    $("#number_card").attr('disabled', false);
                    $("#methodo_payment").attr('disabled', false);
                    $('#free').hide();
                    $('#profesional').hide();
                    $('#ilimitado').show();
                    break;
                case 4:
                    $("#type_plan").val(type_plane);
                    $("#amount").val('$39.99');
                    $("#code_card").attr('disabled', false);
                    $("#number_card").attr('disabled', false);
                    $("#methodo_payment").attr('disabled', false);
                    $("#nombre").hide();
                    $("#apellidos").hide();
                    $("#cedula").hide();
                    $("#empresa").show();
                    $("#tipo_rif").show();
                    $("#Rif").show();
                    $('#renew-btn').hide();

                    break;
                case 5:
                    $("#type_plan").val(type_plane);
                    $("#amount").val('$39.99');
                    $("#code_card").attr('disabled', false);
                    $("#number_card").attr('disabled', false);
                    $("#methodo_payment").attr('disabled', false);
                    $("#nombre").hide();
                    $("#apellidos").hide();
                    $("#cedula").hide();
                    $("#empresa").show();
                    $("#tipo_rif").show();
                    $("#Rif").show();
                    break;
                case 6:
                    $("#type_plan").val(type_plane);
                    $("#amount").val('$39.99');
                    $("#code_card").attr('disabled', false);
                    $("#number_card").attr('disabled', false);
                    $("#methodo_payment").attr('disabled', false);
                    $("#nombre").hide();
                    $("#apellidos").hide();
                    $("#cedula").hide();
                    $("#empresa").show();
                    $("#tipo_rif").show();
                    $("#Rif").show();
                    break;

                default:
                    break;
            }
        }

        const handleSelectPlan = () => {
            $("#exampleModal").modal("show");
        }
    </script>
    <div class="row" style="padding: 20px;">
        <h2 class="title-card fw-bold tile-planes-dos card-title mb-3"></h2>
        <hr style="margin-top: 5px">
        <strong>@lang('messages.label.fecha_activacion'):
            {{ \Carbon\Carbon::parse(auth()->user()->date_start_plan)->format('d-m-Y') }}</strong>
        <br>
        <strong class="{{ auth()->user()->expired_plan === 1 ? 'text-danger' : '' }} mt-2">@lang('messages.label.fecha_corte'):
            {{ \Carbon\Carbon::parse(auth()->user()->date_end_plan)->format('d-m-Y') }}</strong>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mt-3" style="display: flex; justify-content: center;">
                    <div class="card-wrap">
                        <div class="card-header one">
                            <img width="80" height="auto" src="{{ asset('/img/icons/patients.png') }}" alt="avatar">
                        </div>
                        <div class="card-content">
                            <h1 class="card-title-2">@lang('messages.label.paciente')</h1>
                            <div style="display: flex">
                                <h3 id="paciente_span" class="count-plan">{{ auth()->user()->patient_counter }}/
                                </h3>
                                <h3 id="pacientes" class="count-plan"></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mt-3" style="display: flex; justify-content: center;">
                    <div class="card-wrap">
                        <div class="card-header one">
                            <img width="80" height="auto" src="{{ asset('/img/icons/medical-report3.png') }}"
                                alt="avatar">
                        </div>
                        <div class="card-content">
                            <h1 class="card-title-2">@lang('messages.label.consulta')</h1>
                            <div style="display: flex">
                                <h3 id="consulta_span" class="count-plan">
                                    {{ auth()->user()->medical_record_counter }}/ </h3>
                                <h3 id="consultas" class="count-plan"></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mt-3"
                    style="display: flex; justify-content: center;">
                    <div class="card-wrap">
                        <div class="card-header one">
                            <img width="80" height="auto" src="{{ asset('/img/icons/medical-report.png') }}"
                                alt="avatar">
                        </div>
                        <div class="card-content">
                            <h1 class="card-title-2">@lang('messages.label.examenes')</h1>
                            <div style="display: flex">
                                <h3 id="examene_span" class="count-plan">{{ auth()->user()->ref_counter }}/ </h3>
                                <h3 id="examenes" class="count-plan"></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mt-3"
                    style="display: flex; justify-content: center;">
                    <div class="card-wrap">
                        <div class="card-header one">
                            <img width="80" height="auto" src="{{ asset('/img/icons/medical1.png') }}"
                                alt="avatar">
                        </div>
                        <div class="card-content">
                            <h1 class="card-title-2">@lang('messages.label.estudios')</h1>
                            <div style="display: flex">
                                <h3 id="estudio_span" class="count-plan">{{ auth()->user()->ref_counter }}/ </h3>
                                <h3 id="estudios" class="count-plan"></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3 mb-3 btn-plans" style="display: flex;">
            <button type="button" onclick="renew_plan(1,{{ Auth::user()->type_plane }})" class="btn btnPrimary" id="renew-btn">@lang('messages.botton.renovar')</button>
            <button type="button" onclick="renew_plan(2,{{ Auth::user()->type_plane }})" class="btn btnSecond" id="change-btn" style="margin-left: 20px">@lang('messages.botton.cambiar_plan')</button>
        </div>
        <hr style="margin-top: 5px">
        <h4>@lang('messages.label.metodos_de_pago')</h4>
        <hr style="margin-bottom: 0; margin-top: 5px">
        <div class="row">
            @foreach ($paymentMethods as $paymentMethod)
                <div id="spinner" wire:target="deletePaymentMethod('{{ $paymentMethod->id }}')" wire:loading >
                    <x-load-spinner />
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xxl-3 mt-3" wire:key="{{ $paymentMethod->id }}">
                    <div class="credit-card {{ $paymentMethod->card->brand }} selectable">
                        <div class="credit-card-last4">
                            {{ $paymentMethod->card->last4 }}
                        </div>
                        <span class="text-capitalize" style="color: #ffffff">{{ $paymentMethod->billing_details->name }}</span>
                        <br>

                        @if (@$this->defaultPaymentMethod->id != $paymentMethod->id)
                            <Button wire:click="$emit('delete_PaymentMethod', '{{ $paymentMethod->id }}')"><i class="bi bi-trash mt-2"></i></Button>
                            <Button wire:click="$emit('default_PaymentMethod', '{{ $paymentMethod->id }}')"><i class="bi bi-star mt-2"></i></Button>
                        @endif
                        <div class="credit-card-expiry">
                            @lang('messages.label.expira'):
                            {{ $paymentMethod->card->exp_month }} / {{ $paymentMethod->card->exp_year }}

                            @if (@$this->defaultPaymentMethod->id == $paymentMethod->id)
                                <span class="badge rounded-pill text-bg-secondary" style="margin-top: 10px">@lang('messages.label.predeterminado')</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 mb-3" style="display: flex; justify-content: end;">
            <button class="btn btnSave send " onclick="handleSelectPlan();" style="margin-left: 20px">  @lang('messages.botton.agregar_tarjeta') </button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="font-size: 12px; justify-content: center"></button>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                        <div class="text-center">
                            <img class="img" src="{{ asset('img/V2/stripe.png') }}" style="width: 110px;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" wire:ignore>
                            <label for="name" class="form-label mt-2" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.nombre_titular')</label>
                            <input class="form-control mt-2" id="card-holder-name" type="text">

                            <!-- Stripe Elements Placeholder -->
                            <label for="number-t" class="form-label mt-2" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.numero_tarjeta')</label>
                            <div class="form-control" id="card-element"></div>
                            <span id="card-error-message" style="color: red; font-size: 12px"></span>

                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 text-center">
                            <button class="btn btnPrimary mt-3 mb-3" id="card-button"
                                data-secret="{{ $intent->client_secret }}">
                                @lang('messages.botton.guardar')
                            </button>
                            <p style="font-size: 11px"> @lang('messages.label.mensaje_pago')</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="justify-content: center">
                    <a href="https://stripe.com/" target="_blank" style="text-decoration: none; color: #1a1a1a80; font-size:13px;">
                        <span>Powered by </span>
                        <img class="img" src="{{ asset('img/V2/stripe2.png') }}" style="width: 45px;">
                    </a>
                    <a href="https://stripe.com/legal/end-users" target="_blank" style="text-decoration: none; color: #1a1a1a80; font-size:13px;">
                        <span>Condiciones</span>
                    </a>
                    <a href="https://stripe.com/privacy" target="_blank" style="text-decoration: none; color: #1a1a1a80; font-size:13px;">
                        <span>Privacidad</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para renovar el plan-->
    <div class="modal fade" id="ModalRenewPlanes" tabindex="-1" aria-labelledby="ModalRenewPlanesLabel" aria-hidden="true" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header title">
                    <i class="bi bi-repeat"></i>
                    <span style="padding-left: 5px">@lang('messages.modal.titulo.renovar_plan')</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 12px;"></button>
                </div>
                <div class="modal-body">
                    <div class="row form-sq">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" id="div-form">
                            <div id="div-content">
                                <div class="container">
                                    <div class="row" style="display: grid; justify-items: center;">
                                        <img class="logoSq" src="{{ asset('img/logo sqlapio variaciones-03.png') }}" alt="">
                                    </div>
                                </div>
                                {{-- seleccionar planes --}}
                                <div class="row justify-content-center mt-3" id="planes-content-revew-select">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: flex; justify-content: space-around;">
                                        {{-- <button id="free-btn" type="button" onclick="handler_renew_plan(1)" class="btn btnPrimary">@lang('messages.label.free')</button> --}}
                                        <button id="profesional-btn" type="button" onclick="handler_renew_plan(2)"class="btn btnPrimary">@lang('messages.label.profesional')</button>
                                        <button id="ILIMITADO-bnt" type="button" onclick="handler_renew_plan(3)"class="btn btnPrimary">@lang('messages.label.ilimitado')</button>
                                    </div>
                                </div>
                                {{-- formulario de pago --}}
                                <div id="planes-content-revew" style="display: none">
                                    <div class="row">
                                        <input type="hidden" name="type_plan" id="type_plan">
                                        <input type="hidden" name="change_plan" id="change_plan">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                            {{-- profesional --}}
                                            <div id="profesional" style="display: none">
                                                <h5 class="fw-bold tile-planes-dos mb-3 text-center">Plan @lang('messages.label.profesional')</h5>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 40 <b>@lang('messages.label.paciente')</b></li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 40 <b>@lang('messages.label.consulta')</b></li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 80 <b>@lang('messages.label.examenes')</b></li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check"  style="color: green;"></i> 80 <b>@lang('messages.label.estudios')</b></li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.estudios_video')</b> </li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.consulta_ia')</b> </li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.publicidad')</b> </li>
                                                </ul>
                                                <div class="d-flex justify-content-center">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 mb-3" style="display: flex; justify-content: center;">
                                                        {{-- mensual - 19,99 --}}
                                                        @if (auth()->user()->subscribedToPrice('price_1P0pQHLoqeBM9Dte329KfBtS', 'Plan Profesional'))
                                                            @if (auth()->user()->subscribedToPrice('price_1P0pQHLoqeBM9Dte329KfBtS', 'Plan Profesional'))
                                                                <button class="btn btnSave" wire:click=" $emit('cancel_Subscription', 'price_1P0pQHLoqeBM9Dte329KfBtS')" wire:target=" $emit('cancel_Subscription', 'price_1P0pQHLoqeBM9Dte329KfBtS')" style="min-width: 70px; margin-top: 10px">
                                                                        @lang('messages.botton.cancelar_plan')
                                                                </button>
                                                                <button class="btn btnSave"  wire:click="$emit('new_Subscription', 'price_1P0pWxLoqeBM9DteJSDhjowR')" style="min-width: 70px; margin-top: 10px; margin-left: 10px"> @lang('messages.botton.suscribirse') a plan anual</button>
                                                            @else
                                                                <button class="btn btnSave"  wire:click="$emit('new_Subscription', 'price_1P0pQHLoqeBM9Dte329KfBtS')" style="min-width: 70px; margin-top: 10px"> @lang('messages.botton.suscribirse') </button>
                                                            @endif
                                                        @endif
                                                        {{-- anual - 199,99 --}}
                                                        @if (auth()->user()->subscribedToPrice('price_1P0pWxLoqeBM9DteJSDhjowR', 'Plan Profesional'))
                                                            @if (auth()->user()->subscribedToPrice('price_1P0pWxLoqeBM9DteJSDhjowR', 'Plan Profesional'))
                                                                <button class="btn btnSave" wire:click=" $emit('cancel_Subscription', 'price_1P0pWxLoqeBM9DteJSDhjowR')" wire:target=" $emit('cancel_Subscription', 'price_1P0pWxLoqeBM9DteJSDhjowR')" style="min-width: 70px; margin-top: 10px">
                                                                        @lang('messages.botton.cancelar_plan')
                                                                </button>
                                                            @else
                                                                <button class="btn btnSave"  wire:click="$emit('new_Subscription', 'price_1P0pWxLoqeBM9DteJSDhjowR')" style="min-width: 70px; margin-top: 10px"> @lang('messages.botton.suscribirse') </button>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                            {{-- ilimitado --}}
                                            <div id="ilimitado" style="display: none">
                                                <h5 class="fw-bold tile-planes-dos mb-3 text-center">Plan @lang('messages.label.ilimitado')</h5>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.paciente')</b> @lang('messages.label.ilimitado')</li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.consulta')</b>  @lang('messages.label.ilimitado')</li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.examenes')</b>  @lang('messages.label.ilimitado')</li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.estudios')</b> @lang('messages.label.ilimitado')</li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 0.10 por Gb <b>@lang('messages.label.estudios_video')</b></li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 300 <b>@lang('messages.label.consulta_ia')</b></li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.publicidad')</b> </li>
                                                </ul>
                                                <div class="d-flex justify-content-center">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 mb-3" style="display: flex; justify-content: center;">
                                                        {{-- mensual - 39,99$ --}}
                                                        @if (auth()->user()->subscribedToPrice('price_1OyKMhLoqeBM9DteVmOZwlrz', 'Plan Ilimitado'))
                                                            @if (auth()->user()->subscribedToPrice('price_1OyKMhLoqeBM9DteVmOZwlrz', 'Plan Ilimitado'))
                                                                <button class="btn btnSave" wire:click=" $emit('cancel_Subscription', 'price_1OyKMhLoqeBM9DteVmOZwlrz')" wire:target=" $emit('cancel_Subscription', 'price_1OyKMhLoqeBM9DteVmOZwlrz')" style="min-width: 70px; margin-top: 10px">
                                                                        @lang('messages.botton.cancelar_plan')
                                                                </button>
                                                                <button class="btn btnSave"  wire:click="$emit('new_Subscription', 'price_1OyKN3LoqeBM9DtewtoXlP0H')" style="min-width: 70px; margin-top: 10px; margin-left: 10px"> @lang('messages.botton.suscribirse_anual')</button>
                                                            @else
                                                                <button class="btn btnSave"  wire:click="$emit('new_Subscription', 'price_1OyKMhLoqeBM9DteVmOZwlrz')" style="min-width: 70px; margin-top: 10px"> @lang('messages.botton.suscribirse') </button>
                                                            @endif
                                                        @endif
                                                        {{-- anual - 399.99$ --}}
                                                        
                                                        @if (auth()->user()->subscribedToPrice('price_1OyKN3LoqeBM9DtewtoXlP0H', 'Plan Ilimitado'))
                                                            @if (auth()->user()->subscribedToPrice('price_1OyKN3LoqeBM9DtewtoXlP0H', 'Plan Ilimitado') || auth()->user()->subscription('Plan Ilimitado')->ended())
                                                                @if (auth()->user()->subscribedToPrice('price_1P0pQHLoqeBM9Dte329KfBtS', 'Plan Profesional') || auth()->user()->subscribedToPrice('price_1P0pWxLoqeBM9DteJSDhjowR', 'Plan Profesional'))
                                                                    {{-- mensual Ilimitado --}}
                                                                    <button class="btn btnSave"  wire:click="$emit('new_Subscription', 'price_1OyKMhLoqeBM9DteVmOZwlrz')" style="min-width: 70px; margin-top: 10px; margin-left: 10px"> @lang('messages.botton.suscribirse_mensual')</button>
                                                                    {{-- anual Ilimitado --}}
                                                                    <button class="btn btnSave"  wire:click="$emit('new_Subscription', 'price_1OyKN3LoqeBM9DtewtoXlP0H')" style="min-width: 70px; margin-top: 10px; margin-left: 10px"> @lang('messages.botton.suscribirse_anual')</button>
                                                                @endif
                                                                <button class="btn btnSave" wire:click=" $emit('cancel_Subscription', 'price_1OyKN3LoqeBM9DtewtoXlP0H')" wire:target=" $emit('cancel_Subscription', 'price_1OyKN3LoqeBM9DtewtoXlP0H')" style="min-width: 70px; margin-top: 10px">
                                                                        @lang('messages.botton.cancelar_plan')
                                                                </button>
                                                            @else
                                                                <button class="btn btnSave"  wire:click="$emit('new_Subscription', 'price_1OyKN3LoqeBM9DtewtoXlP0H')" style="min-width: 70px; margin-top: 10px"> @lang('messages.botton.suscribirse') </button>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const stripe = Stripe( 'pk_live_51OfoXBLoqeBM9DteVzaKA9F5LvICIU43EWtpHoVfhTV1uIXRgY22Id66FvzKkaZd6veVgxblZsXQv5HSleJaIfJc00nqiRXhgF' );
        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');
    </script>

    <script>
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');

        cardButton.addEventListener('click', async (e) => {

            $('#spinner').show();

            const clientSecret = cardButton.dataset.secret;

            const {
                setupIntent,
                error
            } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );


            if (error) {
                $('#spinner').hide();

                let span = document.getElementById('card-error-message');

                span.textContent = error.message;

                Swal.fire({
                    icon: 'error',
                    title: error.message,
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: '@lang('messages.botton.aceptar')'
                })

            } else {
                $('#spinner').hide();

                @this.addPaymentMethod(setupIntent.payment_method);

                let span = document.getElementById('card-error-message');

                Swal.fire({
                    icon: 'success',
                    title: '@lang('messages.alert.operacion_exitosa')',
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: '@lang('messages.botton.aceptar')'
                }).then((result) => {
                    $('#exampleModal').modal('toggle');
                });

                cardElemnt.clear();
                span.textContent = '';

            }
        });
    </script>


@push('js')
    <script>
        Livewire.on('error', function (message) {
            $('#spinner').hide();
            Swal.fire({
                icon: 'error',
                title: message,
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: '@lang('messages.botton.aceptar')'
            })
        });

        Livewire.on('delete_PaymentMethod', paymentMethodId => {
            Swal.fire({
                title: '@lang('messages.alert.eliminar_tarjeta')',
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#42ABE2',
                cancelButtonColor: '#d33',
                confirmButtonText: '@lang('messages.botton.aceptar')',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deletePaymentMethod', paymentMethodId)
                    Swal.fire({
                        title: '@lang('messages.alert.tarjeta_eliminada')',
                        icon: "success"
                    });
                }
            });
        });

        Livewire.on('default_PaymentMethod', paymentMethodId => {
            Swal.fire({
                title: '@lang('messages.alert.predeterminar_tarjeta')',
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#42ABE2',
                cancelButtonColor: '#d33',
                confirmButtonText: '@lang('messages.botton.aceptar')'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('defaultPaymentMethod', paymentMethodId)
                    Swal.fire({
                        title: '@lang('messages.alert.tarjeta_predeterminada')',
                        icon: "success"
                    });
                }
            });
        });

        Livewire.on('new_Subscription', priceId => {
            Swal.fire({
                title: '@lang('messages.alert.cambiar_plan')',
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#42ABE2',
                cancelButtonColor: '#d33',
                confirmButtonText: '@lang('messages.botton.aceptar')'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('newSubscription', priceId)
                    Swal.fire({
                        title: '@lang('messages.alert.plan_cambiado')',
                        icon: "success"
                    });
                }
            });
        });

        Livewire.on('cancel_Subscription', priceId => {
            Swal.fire({
                title: '@lang('messages.botton.cancelar')',
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#42ABE2',
                cancelButtonColor: '#d33',
                confirmButtonText: '@lang('messages.botton.aceptar')'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('cancelSubscription', priceId)
                    Swal.fire({
                        title: '@lang('messages.alert.plan_cancelado')',
                        icon: "success"
                    });
                }
            });
        });

    </script>
@endpush
</div>
