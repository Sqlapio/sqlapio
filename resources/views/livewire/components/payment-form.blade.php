@extends('layouts.app')
@section('title', 'Pago del plan')
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

        .form-sq-mv {
            align-content: flex-start !important;
        }

        .mt-m3 {
            margin-top: 20px
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

@push('scripts')
    <script>
        let type_plan = @json($type_plan);
        let listPlanes = [1, 2, 3, 4, 5, 6, 7];
        let active = @json($active);
        let token = @json($token);
        let url = ""

        $(document).ready(() => {

            if (active) {
                $('#div-content').show();
                $('#select-plan').show();
                $("#free").hide()
                $("#visitador_medico_id").val(token);

            } else {

                const find = listPlanes.find((e) => e === Number(type_plan));

                if (find == undefined) {
                    $('#div-content').hide();
                    return false;
                }

                handlerPlane(type_plan);
            }


        });

        function handlerPlane(type_plan) {

            $('#type_plan').val(type_plan);

            switch (Number(type_plan)) {
                case 1:

                    // $("#amount").val('0');
                    // $("#code_card").attr('disabled', true)
                    // $("#number_card").attr('disabled', true)
                    // $("#methodo_payment").attr('disabled', true)
                    // $("#div-payment-metodo").hide();
                    // $("#free").show();

                    break;
                case 2:
                    // $("#amount").val('$19.99');
                    $("#free").hide();
                    url = "https://buy.stripe.com/test_00g8zwgyv37Z7le6oo";

                    break;
                case 3: //plan inlimitado
                    // $("#amount").val('$39.99');
                    $("#free").hide();
                    url = "https://buy.stripe.com/test_bIY0309635g7eNG8wx";

                    break;
                case 4:
                    // $("#amount").val('$39.99');
                    // $("#nombre").hide();
                    // $("#apellidos").hide();
                    // $("#cedula").hide();
                    // $("#empresa").show();
                    // $("#tipo_rif").show();
                    // $("#Rif").show();
                    // $("#free").hide();

                    break;
                case 5:
                    // $("#amount").val('$39.99');
                    // $("#nombre").hide();
                    // $("#apellidos").hide();
                    // $("#cedula").hide();
                    // $("#empresa").show();
                    // $("#tipo_rif").show();
                    // $("#Rif").show();
                    // $("#free").hide();
                    // $("#free").hide();


                    break;
                case 6:
                    // $("#amount").val('$39.99');
                    // $("#nombre").hide();
                    // $("#apellidos").hide();
                    // $("#cedula").hide();
                    // $("#empresa").show();
                    // $("#tipo_rif").show();
                    // $("#Rif").show();

                    break;
                case 7:
                    // $("#amount").val('$39.99');
                    // $("#nombre").hide();
                    // $("#apellidos").hide();
                    // $("#cedula").hide();
                    // $("#center").show();
                    // $("#tipo_rif").show();
                    // $("#Rif").show();
                    // $("#div-payment-metodo").hide();
                    // $("#free").hide()

                    break;

                default:
                    break;
            }
        }

        // function handlerSelectPlan(e) {
        //     handlerPlane(e.target.value);
        // }

        // function handlerTypeDoc(e) {
        //     $('#rif').val(e.target.value);
        // }

        const handlerSubmit = () => {

            $('#form-payment').validate({
                rules: {
                    full_name: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    captcha: {
                        required: true,
                    }
                },
                messages: {
                    full_name: {
                        required: "Nombres completo es obligatorio",
                    },
                    email: {
                        required: "Correo es obligatorio",
                    },
                    captcha: {
                        required: "Debe ingresar el codigo",
                    }
                }
            });

            $("#form-payment").validate();

            if ($("#form-payment").valid()) {

                Swal.fire({
                    title: 'Esta seguro de realizar esta acción?',
                    text: "Se enviara un código de verifcación al correo ingresado!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#42ABE2',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {


                    if (result.isConfirmed) {

                        $('#spinner').show();

                        ///solicitar otp
                        $.ajax({
                            url: '{{ route('send_otp_paymet') }}',
                            type: 'POST',
                            dataType: "json",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                email: $('#email').val(),
                                full_name: $('#full_name').val(),
                            },
                            success: function(response) {

                                $('#spinner').hide();

                                Swal.fire({
                                    title: 'Ingrese el código',
                                    input: 'number',
                                    inputAttributes: {
                                        autocorrect: 'on',
                                        max: 6,
                                        maxlength: 6
                                    },
                                    showCancelButton: true,
                                    confirmButtonText: 'Enviar',
                                    showLoaderOnConfirm: true,
                                    inputValidator: (value) => {
                                        if (value === '') {
                                            return "Campo obligatorio"
                                        } else if (value.length > 6) {
                                            return "Campo debe ser de 6 caracteres"

                                        }
                                    },
                                    preConfirm: (login) => {                                        

                                        $.ajax({
                                            url: '{{ route('verify_otp_paymet') }}',
                                            type: 'POST',
                                            dataType: "json",
                                            data: {
                                                "_token": "{{ csrf_token() }}",
                                                cod_update_pass: login,
                                                email: $('#email').val(),
                                                action: "rp",
                                            },
                                            headers: {
                                                'X-CSRF-TOKEN': $(
                                                        'meta[name="csrf-token"]'
                                                    )
                                                    .attr(
                                                        'content')
                                            },
                                            success: function(response) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: response
                                                        .msj,
                                                    allowOutsideClick: false,
                                                    confirmButtonColor: '#42ABE2',
                                                    confirmButtonText: 'Aceptar'
                                                }).then((result) => {
                                                    window
                                                        .location =
                                                        url;

                                                });
                                            },
                                            error: function(error) {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: error
                                                        .responseJSON
                                                        .msj,
                                                    allowOutsideClick: false,
                                                    confirmButtonColor: '#42ABE2',
                                                    confirmButtonText: 'Aceptar'
                                                })
                                            }
                                        });

                                    },
                                    allowOutsideClick: () => !Swal.isLoading()
                                })
                            },
                            error: function(error) {
                                $('#spinner').hide();
                                console.log(error.responseJSON.errors);

                            }
                        });
                        //end
                    }
                });
            }
        }

        const reloadCaptcha = () => {

            $.ajax({
                url: "{{ route('reloadCapchat') }}",
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#span-captcha').html(response);
                }

            });
        }

        const validateCaptcha = (e) => {

            $.ajax({
                url: "{{ route('validateCapchat') }}",
                type: "POST",
                data: {
                    captcha: e.target.value,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(resp) {

                    $('.btnSave').attr('disabled', false);

                    $('#samll-error').hide();
                },
                error: function(error) {

                    $('#samll-error').show();

                    $('#captcha').val('');
                }

            });
        }
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid">
            <div id="spinner" style="display: none">
                <x-load-spinner />
            </div>
            <div class="row form-sq form-sq-mv">
                <div class="col-sm-10 col-md-10 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="card mb-3 mt-m3" id="div-form">
                        <div class="card-body">
                            <div id="div-content">
                                <div class="container">
                                    <div class="row" style="display: grid; justify-items: center;">
                                        <img class="logoSq" src="{{ asset('img/logo sqlapio variaciones-03.png') }}"
                                            alt="">
                                    </div>
                                    <div id="free"
                                        style="display: none; display: flex; justify-content: center; text-align: center;">
                                        <div class="row" style="display: flex; width: 60%; font-size: 14px;">
                                            <ul class="list-group">
                                                <li class="list-group-item"
                                                    style="background-color: #6f6f6e; color: white;">
                                                    <h5>Plan Free</h5></b>
                                                </li>
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
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                        style="color: green;"></i><b>Publicidad</b>
                                                </li>
                                            </ul>
                                        </div>
                                    </diV>


                                </div>
                                {{ Form::open(['url' => '', 'method' => 'post', 'id' => 'form-payment']) }}
                                <div class="row">
                                    {{-- <input type="hidden" name="type_plan" id="type_plan">
                                    <input type="hidden" name="visitador_medico_id" id="visitador_medico_id"
                                        value="">

                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" id="select-plan"
                                        style="display: none">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="center_id" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Seleccione
                                                    tipo de plan</label>
                                                <select onchange="handlerSelectPlan(event)" style="width:100% !important "
                                                    name="center_id" id="center_id" placeholder="Seleccione"
                                                    class="form-control combo-textbox-input select_dos">
                                                    <option value="2">PROFESIONAL</option>
                                                    <option value="3">INLIMITADO</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}


                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2" id="nombre">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="full_name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Nombre
                                                    Completo</label>
                                                <input autocomplete="off" class="form-control mask-text" id="full_name"
                                                    name="full_name" type="text" value="">
                                                <i class="bi bi-person-circle st-icon"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    {{-- <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2" id="apellidos"  style="display: none" >
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Apellidos</label>
                                                <input autocomplete="off"
                                                    class="form-control mask-text @error('last_name') is-invalid @enderror"
                                                    id="last_name" name="last_name" type="text" value="">
                                                <i class="bi bi-person-circle st-icon"></i>
                                            </div>
                                        </diV>
                                    </div> --}}
                                    {{-- <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2" id="cedula" style="display: none" >
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">C.I</label>
                                                <input autocomplete="off" class="form-control" id="ci"
                                                    name="ci" type="text" value="">
                                                <i class="bi bi-person-vcard-fill st-icon"></i>
                                            </div>
                                        </diV>
                                    </div> --}}

                                    {{-- <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" id="empresa"
                                        style="display: none">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Razón
                                                    social</label>
                                                <input autocomplete="off" class="form-control" id="business_name"
                                                    name="business_name" type="text" value="">
                                                <i class="bi bi-person-vcard-fill st-icon"></i>
                                            </div>
                                        </diV>
                                    </div> --}}

                                    {{-- <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" id="center"
                                        style="display: none">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="center_id" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Centro de
                                                    salud</label>
                                                <select style="width:100% !important " name="center_id" id="center_id"
                                                    placeholder="Seleccione"
                                                    class="form-control combo-textbox-input select_dos">
                                                    <option value="">Seleccione...</option>
                                                    @foreach ($centers as $item)
                                                        <option value="{{ $item->id }}">{{ $item->description }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2" id="tipo_rif"
                                        style="display: none">
                                        <div class="form-group">
                                            <label for="name" class="form-label"
                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 2px">Tipo
                                                de documento</label>
                                            <select onchange="handlerTypeDoc(event)" name="type_rif" id="type_rif"
                                                class="form-control">
                                                <option value="">Seleccione</option>
                                                <option value="F-">Firma personal</option>
                                                <option value="J-">Jurídico</option>
                                                <option value="C-">Comuna</option>
                                                <option value="G-">Gubernamental</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-2" id="Rif"
                                        style="display: none">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Número
                                                    de Identificación o RIF</label>
                                                <input autocomplete="off" placeholder=""
                                                    class="form-control mask-rif @error('rif') is-invalid @enderror"
                                                    id="rif" name="rif" type="text" maxlength="17"
                                                    value="">
                                                <i class="bi bi-person-vcard st-icon"></i>
                                            </div>
                                        </diV>
                                    </div> --}}

                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Correo
                                                    eléctronico</label>
                                                <input autocomplete="off" class="form-control" id="email" name="email"
                                                    type="text" value="">
                                                <i class="bi bi-envelope st-icon"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2">
                                        <span id="span-captcha"> {!! Captcha::img('flat') !!}</span>
                                        <button type="button" id="reload" class="btn btn-danger reload"
                                            onclick="reloadCaptcha()">
                                            &#x21bb;
                                        </button>
                                    </div>


                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2">
                                        <div class="form-group">
                                            <input onblur="validateCaptcha(event)" placeholder="Ingrese su codigo"
                                                autocomplete="off" class="form-control" id="captcha" name="captcha"
                                                type="text" value="">
                                            <small id="samll-error" style="display: none" for=""
                                                class="text-danger">Codigo Incorrecto</small style="display: none">
                                        </div>
                                    </div>

                                    {{-- <div class="row" id="div-payment-metodo" style="display: none">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
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
                                        <div class="row mt-2" style="padding-right: 0">
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
                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-2">
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
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
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
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
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
                                    </div> --}}

                                </div>

                                <div class="d-flex justify-content-center">
                                    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl--8 mt-2 mb-3"
                                        style="display: flex; justify-content: center;">
                                        <input disabled class="btn btnSave send " value="Adquiere tu plan"
                                            onclick="handlerSubmit();" style="margin-left: 20px" />
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
@endsection
