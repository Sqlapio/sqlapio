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

                    break;
                case 2:
                    $("#free").hide();
                    url = "https://buy.stripe.com/test_00g8zwgyv37Z7le6oo";

                    break;
                case 3: //plan inlimitado
                    $("#free").hide();
                    url = "https://buy.stripe.com/test_bIY0309635g7eNG8wx";

                    break;
                case 4:


                    break;
                case 5:


                    break;
                case 6:


                    break;
                case 7:


                    break;

                default:
                    break;
            }
        }


        const handlerSubmit = () => {

            $('#form-payment').validate({
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
                    email: {
                        required: true,
                        email: true
                    },
                    captcha: {
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
                                name: $('#name').val(),
                                last_name: $('#last_name').val(),
                                type_plan: type_plan
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
                                                full_name: $('#full_name')
                                                    .val(),
                                                action: "rp",
                                                type_plan: type_plan
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
                                Swal.fire({
                                    icon: 'error',
                                    title: error.responseJSON.errors,
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#42ABE2',
                                    confirmButtonText: 'Aceptar'
                                })

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

                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2" id="nombre">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Nombres</label>
                                                <input autocomplete="off" class="form-control mask-text" id="name"
                                                    name="name" type="text" value="">
                                                <i class="bi bi-person-circle st-icon"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2" id="nombre">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="last_name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Apellidos</label>
                                                <input autocomplete="off" class="form-control mask-text" id="last_name"
                                                    name="last_name" type="text" value="">
                                                <i class="bi bi-person-circle st-icon"></i>
                                            </div>
                                        </diV>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Correo
                                                    eléctronico</label>
                                                <input autocomplete="off" class="form-control" id="email" name="email"
                                                    type="text" value="kleynervillegas@gmial.com">
                                                <i class="bi bi-envelope st-icon"></i>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Ingrese su
                                                    codigo</label>
                                                <input onblur="validateCaptcha(event)" placeholder="" autocomplete="off"
                                                    class="form-control" id="captcha" name="captcha" type="text"
                                                    value="">
                                                <i class="bi bi-envelope st-icon"></i>
                                            </div>
                                        </div>
                                        <small id="samll-error" style="display: none" for=""
                                            class="text-danger">Codigo Incorrecto</small style="display: none">
                                    </div>
                                </div>


                                <div class="d-flex justify-content-center">
                                    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl--8 mt-2 mb-3"
                                        style="display: flex; justify-content: center;">
                                        <span id="span-captcha"> {!! Captcha::img('flat') !!}</span>
                                        <button type="button" id="reload" class="btn btn-danger reload"
                                            onclick="reloadCaptcha()">
                                            &#x21bb;
                                        </button>
                                    </div>

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
