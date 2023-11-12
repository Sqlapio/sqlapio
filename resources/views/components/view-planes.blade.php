<style>
    .logo-bank {
        width: 40%;
        height: auto;
    }

    .logoSq {
        width: 50% !important;
        height: auto;
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

    }
</style>
<script>
    let user = @json(Auth::user());

    $(document).ready(() => {

        let data_palnes = [{
                type_plan: 1,
                description: "Mi plan FREE",
                count_patients: 10,
                count_ref: 20,
                count_exam: 20,
                count_study: 20,
            },
            {
                type_plan: 2,
                description: "Mi plan PROFESIONAL",
                count_patients: 40,
                count_ref: 80,
                count_exam: 80,
                count_study: 80,
            },
            {
                type_plan: 3,
                description: "Mi plan ILIMITADO",
                count_patients: 'ILIMITADO',
                count_ref: 'ILIMITADO',
                count_exam: 'ILIMITADO',
                count_study: 'ILIMITADO',
            },
            {
                type_plan: 4,
                description: "Mi plan ILIMITADO",
                count_patients: 'ILIMITADO',
                count_ref: 'ILIMITADO',
                count_exam: 'ILIMITADO',
                count_study: 'ILIMITADO',
            },
            {
                type_plan: 5,
                description: "Mi plan ILIMITADO",
                count_patients: 'ILIMITADO',
                count_ref: 'ILIMITADO',
                count_exam: 'ILIMITADO',
                count_study: 'ILIMITADO',
            },
            {
                type_plan: 6,
                description: "Mi plan ILIMITADO",
                count_patients: 'ILIMITADO',
                count_ref: 'ILIMITADO',
                count_exam: 'ILIMITADO',
                count_study: 'ILIMITADO',
            }
        ];

        if(user.role=="laboratorio"){
            $('#type_rif_pay').val(user.get_laboratorio.rif[0] + "-").change();
        }

        switch_type_plane(user.type_plane);

        const data = data_palnes.find((e) => e.type_plan == user.type_plane);

        $('.card-title').text(data.description);
        $('.pacientes').text(`${data.count_patients} Pacientes`);
        $('.consultas').text(`${data.count_ref} Consultas`);
        $('.examenes').text(`${data.count_exam} Examenes`);
        $('.estudios').text(`${data.count_study} Estudios`);

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
                business_name:{
                    required: "Razon social es obligatorio",
                }

            }
        });



        $.validator.addMethod("onlyNumber", function(value, element) {
            var pattern = /^\d+\.?\d*$/;
            return pattern.test(value);
        }, "Campo solo numero");

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
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            let url ="{{ route('DashboardComponent') }}";
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
                                confirmButtonText: 'Aceptar'
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

    function switch_type_plane(type_plane) {

        switch (Number(type_plane)) {
            case 1:
                $("#type_plan").val(type_plane);
                $("#amount").val('0');
                $("#code_card").attr('disabled', true);
                $("#number_card").attr('disabled', true);
                $("#methodo_payment").attr('disabled', true);
                if (Number(user.patient_counter) >= 10) {
                    $('#paciente_span').attr('class', 'badge bg-danger rounded-pill');
                }
                if (Number(user.medical_record_counter) >= 40) {
                    $('#consulta_span').attr('class', 'badge bg-danger rounded-pill');
                }
                break;
            case 2:
                $("#type_plan").val(type_plane);
                $("#amount").val('$19.99');
                $("#code_card").attr('disabled', false);
                $("#number_card").attr('disabled', false);
                $("#methodo_payment").attr('disabled', false);
                     if (Number(user.patient_counter) >= 40) {
                    $('#paciente_span').attr('class', 'badge bg-danger rounded-pill');
                }
                if (Number(user.medical_record_counter) >= 80) {
                    $('#consulta_span').attr('class', 'badge bg-danger rounded-pill');
                }
                break;
            case 3:
                $("#type_plan").val(type_plane);
                $("#amount").val('$39.99');
                $("#code_card").attr('disabled', false);
                $("#number_card").attr('disabled', false);
                $("#methodo_payment").attr('disabled', false);
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
</script>
<div>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title tile-planes-dos"></h1>
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold tile-planes pacientes"></div>
                                Cupos consumidos:
                            </div>
                            <span id="paciente_span"
                                class="badge bg-success rounded-pill">{{ auth()->user()->patient_counter }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold tile-planes consultas"></div>
                                Cupos consumidos:
                            </div>
                            <span id="consulta_span"
                                class="badge bg-success rounded-pill">{{ auth()->user()->medical_record_counter }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold tile-planes examenes"></div>
                                Cupos consumidos:
                            </div>
                            <span id="examene_span"
                                class="badge bg-success rounded-pill">{{ auth()->user()->ref_counter }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold tile-planes estudios"></div>
                                Cupos consumidos:
                            </div>
                            <span id="estudio_span"
                                class="badge bg-success rounded-pill">{{ auth()->user()->ref_counter }}</span>
                        </li>
                    </ol>
                    <div class="row justify-content-center mt-3">
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                            <button type="button" onclick="renew_plan(1,{{ Auth::user()->type_plane }})"
                                class="btn btnPrimary">Renovar</button>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                            <button type="button"
                                onclick="renew_plan(2,{{ Auth::user()->type_plane }})"class="btn btnSecond">Cambiar
                                plan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para renover el plan-->
<div class="modal fade" id="ModalRenewPlanes" tabindex="-1" aria-labelledby="ModalRenewPlanesLabel" aria-hidden="true"
    id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
    <div id="spinner" style="display: none">
        <x-load-spinner show="true" />
    </div>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header title">
                    <i class="bi bi-calendar-week"></i>
                    <span style="padding-left: 5px">Pagar plan</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="font-size: 12px;"></button>
                </div>
                <div class="modal-body">
                    <div class="row form-sq">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card mb-3 mt-m3" id="div-form">
                                <div class="card-body">
                                    <div id="div-content">
                                        <div class="container">
                                            <div class="row" style="display: grid; justify-items: center;">
                                                <img class="logoSq"
                                                    src="{{ asset('img/logo sqlapio variaciones-03.png') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                        {{-- seleccionar planes --}}
                                        <div class="row justify-content-center mt-3" id="planes-content-revew-select">
                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                <button type="button" onclick="handler_renew_plan(1)"
                                                    class="btn btnPrimary">FREE</button>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                <button type="button"
                                                    onclick="handler_renew_plan(2)"class="btn btnPrimary">PROFESIONAL</button>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                <button type="button"
                                                    onclick="handler_renew_plan(3)"class="btn btnPrimary">ILIMITADO</button>
                                            </div>
                                        </div>
                                        {{-- formulario de pago --}}
                                        <div id="planes-content-revew" style="display: none">
                                            {{ Form::open(['url' => '', 'method' => 'post', 'id' => 'form-payment-renew']) }}
                                            <div class="row">
                                                <input type="hidden" name="type_plan" id="type_plan">
                                                <input type="hidden" name="change_plan" id="change_plan">

                                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3" id="nombre">
                                                    <div class="form-group">
                                                        <div class="Icon-inside">
                                                            <label for="name" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Nombres</label>
                                                            <input readonly autocomplete="off"
                                                                class="form-control mask-text"
                                                                id="name" name="name" type="text"
                                                                value="{{Auth::user()->name}}">                                                                
                                                            <i class="bi bi-person-circle st-icon"></i>
                                                        </div>
                                                    </diV>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3" id="apellidos">
                                                    <div class="form-group">
                                                        <div class="Icon-inside">
                                                            <label for="name" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Apellidos</label>
                                                            <input  readonly autocomplete="off"
                                                                class="form-control mask-text"
                                                                id="last_name" name="last_name" type="text" value="{{Auth::user()->last_name}}">
                                                            <i class="bi bi-person-circle st-icon"></i>
                                                        </div>
                                                    </diV>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3" id="cedula">
                                                    <div class="form-group">
                                                        <div class="Icon-inside">
                                                            <label for="name" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">C.I</label>
                                                            <input readonly autocomplete="off" class="form-control" id="number_id"
                                                                name="number_id" type="text" value="{{Auth::user()->ci}}">
                                                            <i class="bi bi-person-vcard-fill st-icon"></i>
                                                        </div>
                                                    </diV>
                                                </div>
            
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3" id="empresa" style="display: none">
                                                    <div class="form-group">
                                                        <div class="Icon-inside">
                                                            <label for="name" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Razon social</label>
                                                            <input readonly autocomplete="off" class="form-control" id="business_name"
                                                                name="business_name" type="text" value="{{Auth::user()->business_name}}">
                                                            <i class="bi bi-person-vcard-fill st-icon"></i>
                                                        </div>
                                                    </diV>
                                                </div>
                                              
            
                                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3" id="tipo_rif" style="display: none">
                                                    <div class="form-group">
                                                        <label for="name" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 2px">Tipo
                                                            de documento</label>
                                                        <select  readonly onchange="handlerTypeDoc(event)" name="type_rif_pay"
                                                            id="type_rif_pay" class="form-control">
                                                            <option value="">Seleccione</option>
                                                            <option value="F-">Firma personal</option>
                                                            <option value="J-">Jurídico</option>
                                                            <option value="C-">Comuna</option>
                                                            <option value="G-">Gubernamental</option>
                                                        </select>
                                                    </div>
                                                </div>
            
                                                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-3" id="Rif" style="display: none">
                                                    <div class="form-group">
                                                        <div class="Icon-inside">
                                                            <label for="name" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Número
                                                                de Identificación o RIF</label>
                                                            <input readonly autocomplete="off" placeholder=""
                                                                class="form-control mask-rif"
                                                                id="rif_pay" name="rif_pay" type="text" maxlength="17"
                                                                value="{!! !empty(Auth::user()->get_laboratorio != null) ? Auth::user()->get_laboratorio->rif : '' !!}">
                                                            <i class="bi bi-person-vcard" style="top: 30px"></i>
                                                        </div>
                                                    </diV>
                                                </div>
            
                                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                                    <div class="form-group">
                                                        <div class="Icon-inside">
                                                            <label for="name" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Correo
                                                                eléctronico</label>
                                                            <input readonly  autocomplete="off" class="form-control" id="email" name="email"
                                                                type="text" value="{{Auth::user()->email}}">
                                                            <i class="bi bi-envelope-ats st-icon"></i>
                                                        </div>
                                                    </diV>
                                                </div>
            
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                                    <div class="form-group">
                                                        <div class="Icon-inside">
                                                            <label for="methodo_payment" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Método de
                                                                pago</label>
                                                            <select name="methodo_payment" id="methodo_payment"
                                                                placeholder="Seleccione"class="form-control"
                                                                class="form-control combo-textbox-input">
                                                                <option value="">Seleccione...</option>
                                                                <option value="1">Banco de Venezuela</option>
                                                                <option value="2">Banco Mercantil</option>
                                                                <option value="3">Banco Banesco</option>
                                                                <option value="4">Bancamiga</option>
                                                                <option value="5">Zelle</option>
                                                            </select>
                                                            <i class="bi bi-credit-card st-icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3" style="padding-right: 0">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                                        style="display: flex; align-items: center;
                                                    justify-content: flex-end; text-align: end; padding-right: 0">
                                                        <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 col-xxl-1">
                                                            <img class="logo-bank" src="{{ asset('img/mercantil-icon.jpg') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 col-xxl-1">
                                                            <img class="logo-bank" src="{{ asset('img/banesco-icon.png') }}"
                                                                alt="">
                                                        </div>
            
            
                                                        <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 col-xxl-1">
                                                            <img class="logo-bank" src="{{ asset('img/zelle-icon.png') }}"
                                                                alt="">
                                                        </div>
            
                                                        <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 col-xxl-1">
                                                            <img class="logo-bank" src="{{ asset('img/bdv-icon.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 col-xxl-1">
                                                            <img class="logo-bank" src="{{ asset('img/bancamiga-icon.png') }}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-3">
                                                    <div class="form-group">
                                                        <div class="Icon-inside">
                                                            <label for="name" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Número de
                                                                tarjeta</label>
                                                            <input autocomplete="off" class="form-control" id="number_card"
                                                                name="number_card" type="text" value="">
                                                            <i class="bi bi-credit-card st-icon"></i>
                                                        </div>
                                                    </diV>
                                                </div>
                                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                                    <div class="form-group">
                                                        <div class="Icon-inside">
                                                            <label for="name" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Código de
                                                                tarjeta</label>
                                                            <input autocomplete="off" class="form-control" id="code_card"
                                                                name="code_card" type="text" value="">
                                                            <i class="bi bi-credit-card st-icon"></i>
                                                        </div>
                                                    </diV>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                                    <div class="form-group">
                                                        <div class="Icon-inside">
                                                            <label for="name" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Monto</label>
                                                            <input readonly autocomplete="off" class="form-control" id="amount"
                                                                name="amount" type="text" value="">
                                                            <i class="bi bi-currency-dollar st-icon"></i>
                                                        </div>
                                                    </diV>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-center">
                                                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl--8 mt-3 mb-3"
                                                    style="display: flex; justify-content: center;">
                                                    <input class="btn btnSave send " value="Adquiere tu plan"
                                                        type="submit" style="margin-left: 20px" />
                                                </div>
                                            </div>
                                            {{ Form::close() }}
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
