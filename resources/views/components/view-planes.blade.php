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

    .card-plans {
        /* background-color: #ffffff !important; */
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
    }

    .count-plan-0 {
        color: red
    }

    .count-plan {
        color: #459594
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
                description: "Plan - FREE",
                count_patients: 10,
                count_ref: 20,
                count_exam: 20,
                count_study: 20,
            },
            {
                type_plan: 2,
                description: "Plan - PROFESIONAL",
                count_patients: 40,
                count_ref: 40,
                count_exam: 80,
                count_study: 80,
            },
            {
                type_plan: 3,
                description: "Plan - ILIMITADO",
                count_patients: 'ILIMITADO',
                count_ref: 'ILIMITADO',
                count_exam: 'ILIMITADO',
                count_study: 'ILIMITADO',
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
                            confirmButtonText: 'Aceptar'
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
</script>
<div>
    <div class="row" style="padding: 20px;">
        <h2 class="title-card fw-bold tile-planes-dos card-title mb-3"></h2>
        <strong>{{ 'Fecha de activación: ' . \Carbon\Carbon::parse(auth()->user()->date_start_plan)->format('d-m-Y') }}</strong>
        <br>
        <strong
            class="{{ auth()->user()->expired_plan === 1 ? 'text-danger' : '' }} mt-2">{{ 'Fecha de corte: ' . \Carbon\Carbon::parse(auth()->user()->date_end_plan)->format('d-m-Y') }}</strong>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3"
                    style="display: flex; justify-content: center;">
                    <div class="card mt-3 card-plans">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <h5 class="fw-bold" style="color: #133837">Pacientes</h5>
                                    <div style="display: flex">
                                        <h3 id="paciente_span" class="count-plan">{{ auth()->user()->patient_counter }}/
                                        </h3>
                                        <h3 id="pacientes" class="count-plan"></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3"
                    style="display: flex; justify-content: center;">
                    <div class="card mt-3 card-plans">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <h5 class="fw-bold" style="color: #133837">Consultas</h5>

                                    <div style="display: flex">
                                        <h3 id="consulta_span" class="count-plan">
                                            {{ auth()->user()->medical_record_counter }}/</h3>
                                        <h3 id="consultas" class="count-plan"></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3"
                    style="display: flex; justify-content: center;">
                    <div class="card mt-3 card-plans">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <h5 class="fw-bold" style="color: #133837">Exámenes</h5>

                                    <div style="display: flex">
                                        <h3 id="examene_span" class="count-plan">{{ auth()->user()->ref_counter }}/</h3>
                                        <h3 id="examenes" class="count-plan"></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3"
                    style="display: flex; justify-content: center;">
                    <div class="card mt-3 card-plans">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <h5 class="fw-bold" style="color: #133837">Estudios </h5>
                                    <div style="display: flex">
                                        <h3 id="estudio_span" class="count-plan">{{ auth()->user()->ref_counter }}/</h3>
                                        <h3 id="estudios" class="count-plan"></h3>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3 mb-1"
            style="display: flex; justify-content: flex-end;">
            <button type="button" onclick="renew_plan(1,{{ Auth::user()->type_plane }})" class="btn btnPrimary"
                id="renew-btn">Renovar</button>
            <button type="button" onclick="renew_plan(2,{{ Auth::user()->type_plane }})" class="btn btnSecond"
                id="change-btn" style='margin-left: 20px'>Cambiar de plan</button>
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
                    <i class="bi bi-repeat"></i>
                    <span style="padding-left: 5px">Renovar plan</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="font-size: 12px;"></button>
                </div>
                <div class="modal-body">
                    <div class="row form-sq">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" id="div-form">
                            <div id="div-content">
                                <div class="container">
                                    <div class="row" style="display: grid; justify-items: center;">
                                        <img class="logoSq" src="{{ asset('img/logo sqlapio variaciones-03.png') }}"
                                            alt="">
                                    </div>
                                </div>
                                {{-- seleccionar planes --}}
                                <div class="row justify-content-center mt-3" id="planes-content-revew-select">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                        style="display: flex; justify-content: space-around;">
                                        <button id="free-btn" type="button" onclick="handler_renew_plan(1)"
                                            class="btn btnPrimary">FREE</button>
                                        <button id="profesional-btn" type="button"
                                            onclick="handler_renew_plan(2)"class="btn btnPrimary">PROFESIONAL</button>
                                        <button id="ILIMITADO"-bnt type="button"
                                            onclick="handler_renew_plan(3)"class="btn btnPrimary">ILIMITADO</button>
                                    </div>
                                </div>
                                {{-- formulario de pago --}}
                                <div id="planes-content-revew" style="display: none">
                                    {{ Form::open(['url' => '', 'method' => 'post', 'id' => 'form-payment-renew']) }}
                                    <div class="row">
                                        <input type="hidden" name="type_plan" id="type_plan">
                                        <input type="hidden" name="change_plan" id="change_plan">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                            <div id="free" style="display: none">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                            style="color: green;"></i> 10 <b>Pacientes</b></li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                            style="color: green;"></i> 20 <b>Consultas</b></li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                            style="color: green;"></i> 20 <b>Exámenes</b></li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                            style="color: green;"></i> 20 <b>Estudios</b></li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                            style="color: red;"></i> <b
                                                            style="text-decoration: line-through;">Estudios con
                                                            videos</b></li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                            style="color: red;"></i> <b
                                                            style="text-decoration: line-through;">Consultas en IA</b>
                                                    </li>
                                                    <li class="list-group-item text-capitalize"><i class="fa fa-check"
                                                            aria-hidden="true"
                                                            style="color: green;"></i><b>Publicidad</b>
                                                    </li>

                                                </ul>
                                            </diV>
                                            <div id="profesional" style="display: none">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                            style="color: green;"></i> 40 <b>Pacientes</b></li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                            style="color: green;"></i> 40 <b>Consultas</b></li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                            style="color: green;"></i> 80 <b>Exámenes</b></li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                            style="color: green;"></i> 80 <b>Estudios</b></li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                            style="color: red;"></i> <b
                                                            style="text-decoration: line-through;">Estudios con
                                                            videos</b></li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                            style="color: red;"></i> <b
                                                            style="text-decoration: line-through;">Consultas en IA</b>
                                                    </li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                            style="color: red;"></i> <b
                                                            style="text-decoration: line-through;">Publicidad</b>
                                                    </li>
                                                </ul>
                                            </diV>
                                            <div id="ilimitado" style="display: none">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                            style="color: green;"></i> <b>Pacientes</b> Ilimitados</li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                            style="color: green;"></i> <b>Consultas</b> Ilimitados</li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                            style="color: green;"></i> <b>Exámenes</b> Ilimitados</li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                            style="color: green;"></i> <b>Estudios</b> Ilimitados</li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                            style="color: green;"></i> 0.10 por Gb <b>Estudios con
                                                            videos</b></li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                            style="color: green;"></i> 300 <b>Consultas en IA</b></li>
                                                    <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                            style="color: red;"></i> <b
                                                            style="text-decoration: line-through;">Publicidad</b>
                                                    </li>
                                                </ul>
                                            </diV>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3"
                                            id="nombre">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="name" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Nombres</label>
                                                    <input readonly autocomplete="off" class="form-control mask-text"
                                                        id="name" name="name" type="text"
                                                        value="{{ Auth::user()->name }}">
                                                    <i class="bi bi-person-circle st-icon"></i>
                                                </div>
                                            </diV>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3"
                                            id="apellidos">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="name" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Apellidos</label>
                                                    <input readonly autocomplete="off" class="form-control mask-text"
                                                        id="last_name" name="last_name" type="text"
                                                        value="{{ Auth::user()->last_name }}">
                                                    <i class="bi bi-person-circle st-icon"></i>
                                                </div>
                                            </diV>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3"
                                            id="cedula">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="name" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">C.I</label>
                                                    <input readonly autocomplete="off" class="form-control"
                                                        id="number_id" name="number_id" type="text"
                                                        value="{{ Auth::user()->ci }}">
                                                    <i class="bi bi-person-vcard-fill st-icon"></i>
                                                </div>
                                            </diV>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3"
                                            id="empresa" style="display: none">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="name" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Razón
                                                        social</label>
                                                    <input readonly autocomplete="off" class="form-control"
                                                        id="business_name" name="business_name" type="text"
                                                        value="{{ Auth::user()->business_name }}">
                                                    <i class="bi bi-person-vcard-fill st-icon"></i>
                                                </div>
                                            </diV>
                                        </div>


                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3" id="tipo_rif"
                                            style="display: none">
                                            <div class="form-group">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 2px">Tipo
                                                    de documento</label>
                                                <select readonly onchange="handlerTypeDoc(event)" name="type_rif_pay"
                                                    id="type_rif_pay" class="form-control">
                                                    <option value="">Seleccione</option>
                                                    <option value="F-">Firma personal</option>
                                                    <option value="J-">Jurídico</option>
                                                    <option value="C-">Comuna</option>
                                                    <option value="G-">Gubernamental</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-3" id="Rif"
                                            style="display: none">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="name" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Número
                                                        de Identificación o RIF</label>
                                                    <input readonly autocomplete="off" placeholder=""
                                                        class="form-control mask-rif" id="rif_pay" name="rif_pay"
                                                        type="text" maxlength="17"
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
                                                    <input readonly autocomplete="off" class="form-control"
                                                        id="email" name="email" type="text"
                                                        value="{{ Auth::user()->email }}">
                                                    <i class="bi bi-envelope-ats st-icon"></i>
                                                </div>
                                            </diV>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="methodo_payment" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Método
                                                        de
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
                                                    <img class="logo-bank"
                                                        src="{{ asset('img/mercantil-icon.jpg') }}" alt="">
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
                                                    <img class="logo-bank"
                                                        src="{{ asset('img/bancamiga-icon.png') }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-3">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="name" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Número
                                                        de
                                                        tarjeta</label>
                                                    <input autocomplete="off" class="form-control" id="number_card"
                                                        name="number_card" type="number" value="">
                                                    <i class="bi bi-credit-card st-icon"></i>
                                                </div>
                                            </diV>
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="name" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">CVC/CVV</label>
                                                    <input autocomplete="off" class="form-control" id="code_card"
                                                        name="code_card" type="number" value="">
                                                    <i class="bi bi-credit-card st-icon"></i>
                                                </div>
                                            </diV>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="name" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Monto</label>
                                                    <input readonly autocomplete="off" class="form-control"
                                                        id="amount" name="amount" type="text" value="">
                                                    <i class="bi bi-currency-dollar st-icon"></i>
                                                </div>
                                            </diV>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-3 mb-3"
                                            style="display: flex; justify-content: center;">
                                            <input class="btn btnSave send " value="Adquiere tu plan" type="submit"
                                                style="margin-left: 20px" />
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
