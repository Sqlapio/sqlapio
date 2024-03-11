@extends('layouts.app')
@section('title', 'Registro de Usuario')
<style>
    .mt {
        margin-top: 10rem !important;
    }

    .logoSq {
        width: 50% !important;
        height: auto;
        margin-top: -15% !important;
        margin-bottom: -15% !important;

    }

    .logoCorp {
        width: 50% !important;
        height: auto;
        /* margin-top: -15% !important;
        margin-bottom: -15% !important; */

    }

    .div-col {
        margin-bottom: -85px !important;

    }

    #div-dos {
        margin-right: 110px;
    }

    .btn-bg img {
        display: block;
        width: 350px;
    }

    .btn-bg-lb img {
        display: block;
        width: 350px;
    }

    .btn-bg img:last-of-type {
        opacity: 0;
        position: absolute;
        left: 0px;
        left: -341px;
        right: 0;
        top: 64px;
        bottom: 0;
        margin: auto
    }

    .btn-bg-lb img:last-of-type {
        opacity: 0;
        position: absolute;
        left: 0;
        left: 374px;
        right: 0;
        top: 57px;
        bottom: 0;
        margin: auto
    }

    .btn-bg:hover img {
        opacity: 1;
        /* position: relative; */
    }

    .btn-bg-lb:hover img {
        opacity: 1;
        /* position: relative; */
    }

    .tooltip-inner {
        white-space: pre-line;
    }

    .container-icon {
        width: 715px !important;
    }


    @media only screen and (min-width: 1800px) {
        .col-xxxl {
            width: 20% !important;
        }

    }

    @media only screen and (min-width: 1400px) {
        .col-xxxl {
            width: 21% !important;
        }

    }

    @media only screen and (max-width: 768px) {

        body {
            background: url({{ asset('img/fondo-mobile-rg-v2.jpg') }}) no-repeat top center fixed !important;
        }

        .btn-bg {
            display: flex;
            justify-content: center;
        }

        .btn-bg img {
            width: 255px;
        }

        .btn-bg img:last-of-type {
            display: none
        }

        .btn-bg-lb {
            display: flex;
            justify-content: center;
        }

        .btn-bg-lb img {
            width: 255px;
        }

        .btn-bg-lb img:last-of-type {
            display: none
        }

        .btn2 {
            margin-left: 20px;
        }

        .container-icon {
            width: 0 !important;
        }

        .form-sq-mv {
            align-content: flex-start !important;
        }
    }

    @media only screen and (max-width: 390px) {
        .btn2 {
            margin-left: 20px;
        }

        .logoSq {
            width: 30%;
            height: auto;
            margin-top: -14% !important;
        }

        #div-dos {
            margin-right: 0px;
        }

        .btn-bg {
            display: flex;
            justify-content: center;
        }

        .btn-bg img:last-of-type {
            display: none;
        }

        .btn-bg-lb {
            display: flex;
            justify-content: center;
        }

        .btn-bg-lb img:last-of-type {
            display: none;
        }
    }
</style>
@push('scripts')
    <script>

        $(document).ready(function() {

            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            tooltipTriggerList.forEach(element => {
                new bootstrap.Tooltip(element)
            });

            $('#form-register').validate({
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
                        minlength: 3,
                        maxlength: 50,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6,
                    },
                    password_confrimation: {
                        required: true,
                        minlength: 6,
                        handlerPass: true
                    },
                    ci: {
                        required: true,
                        onlyNumber: true
                    },
                    captcha: {
                        required: true,
                        // validateCaptcha: true,
                    }
                },
                messages: {
                    name: {
                        required: "Nombres es obligatorio",
                        minlength: "Nombres debe ser mayor a 3 caracteres",
                        maxlength: "Nombres debe ser menor a 50 caracteres",
                    },
                    last_name: {
                        required: "Apellidos es obligatorio",
                        minlength: "Apellidos debe ser mayor a 6 caracteres",
                        maxlength: "Apellidos debe ser menor a 8 caracteres",
                    },

                    email: {
                        required: "Correo Electrónico es obligatorio",
                        minlength: "Correo Electrónico debe ser mayor a 6 caracteres",
                        maxlength: "Correo Electrónico debe ser menor a 8 caracteres",
                        email: "Correo Electrónico incorrecto"
                    },
                    password: {
                        required: "Contraseña es obligatoria",
                        minlength: "Contraseña debe ser mayor a 6 caracteres",
                    },
                    password_confrimation: {
                        required: "Confirmar Contraseña es obligatoria",
                        minlength: "Confirmar Contraseña debe ser mayor a 6 caracteres",
                    },
                    ci: {
                        required: "Campo es obligatorio",
                    },
                    captcha: {
                        required: "Codigo es obligatorio",
                    }
                },
                invalidHandler: function(event, validator) {

                },
                submitHandler: function(form) {
                    $('#spinner').show();
                    $('.btnPrimary').hide();
                    form.submit();
                }
            });
            $.validator.addMethod("onlyNumber", function(value, element) {
                var pattern = /^\d+\.?\d*$/;
                return pattern.test(value);
            }, "Campo numérico");

            $.validator.addMethod("handlerPass", function(value, element) {
                let validate = false;
                if (value === $('#password').val()) {
                    validate = true;
                }
                return validate;
            }, "Contraseña no coinciden");   

        });

        function showPass() {
            let input = $("#password");
            if (input[0].type === "password") {
                input[0].type = "text";
            } else {
                input[0].type = "password";
            }
        }

        function showPassConfimation() {
            let input = $("#password_confrimation");
            if (input[0].type === "password") {
                input[0].type = "text";
            } else {
                input[0].type = "password";
            }
        }

        const handlerSubmit = () => {

            $("#form-register").validate();

            if ($("#form-register").valid()) {

                Swal.fire({
                    title: 'Informacion',
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
                            url: '{{ route('send_otp_global') }}',
                            type: 'POST',
                            dataType: "json",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                email: $('#email').val(),
                                name: $('#name').val(),
                                last_name: $('#last_name').val(),
                                document_number: $('#ci').val(),
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

                                        let formData = $('#form-register')
                                            .serializeArray();
                                        let data = {};
                                        formData.map((item) => {
                                            data[item.name] = item.value
                                        });
                                        data.code = login;
                                        $.ajax({
                                            url: '{{ route('Register-create') }}',
                                            type: 'POST',
                                            dataType: "json",
                                            data: data,
                                            headers: {
                                                'X-CSRF-TOKEN': $(
                                                    'meta[name="csrf-token"]'
                                                ).attr('content')
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
                                                        .location = '{{route('Login_home')}}';

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
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid">
            <div id="spinner" style="display: none">
                <x-load-spinner />
            </div>
            <div class="row form-sq form-sq-mv">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-4">
                    <div class="card mb-3 mt-m3" id="div-form">
                        <div class="card-body">

                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                <div class="text-center">
                                    <img class="img" src="{{ asset('img/registro.png') }}" style="width: 200px;">
                                </div>
                            </div>

                            {{ Form::open(['method' => 'post', 'id' => 'form-register']) }}
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <label for="name" class="form-label"
                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Nombres</label>
                                            <input autocomplete="off"
                                                class="form-control mask-text @error('name') is-invalid @enderror"
                                                id="name" name="name" type="text" value="">
                                            <i class="bi bi-person-circle st-icon"></i>
                                        </div>
                                    </diV>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
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
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <label for="name" class="form-label"
                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">documento
                                                de
                                                indentidad</label>
                                            <input autocomplete="off" class="form-control mask-only-number" id="ci"
                                                name="ci" type="text" value="">
                                            <i class="bi bi-person-circle st-icon"></i>
                                        </div>
                                    </diV>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <label for="name" class="form-label"
                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Correo
                                                Electrónico</label>
                                            <input autocomplete="off" class="form-control" id="email" name="email"
                                                type="text" value="">
                                            <i class="bi bi-envelope st-icon"></i>
                                        </div>
                                    </diV>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <label for="name" class="form-label"
                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Contraseña</label>
                                            <input placeholder="Contraseña" autocomplete="off"
                                                class="form-control @error('password') is-invalid @enderror" id="password"
                                                name="password" type="password" value="">
                                            <i onclick="showPass();" class="bi bi-eye-fill st-icon"></i>
                                        </div>
                                    </diV>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <label for="name" class="form-label"
                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Confirmar
                                                Contraseña</label>
                                            <input autocomplete="off" placeholder="Confirmar Contraseña"
                                                class="form-control @error('password_confrimation') is-invalid @enderror"
                                                id="password_confrimation" name="password_confrimation" type="password"
                                                value="">
                                            <i onclick="showPassConfimation();" class="bi bi-eye-fill st-icon"></i>
                                        </div>
                                    </diV>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <label for="name" class="form-label"
                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Ingrese
                                                su
                                                codigo</label>
                                            <input placeholder="" autocomplete="off" class="form-control" id="captcha"
                                                name="captcha" type="text" value="">
                                            <i class="bi bi-envelope st-icon"></i>
                                        </div>
                                    </div>
                                    <small id="samll-error" style="display: none" for=""
                                        class="text-danger">Codigo
                                        Incorrecto</small style="display: none">
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
                                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl--8 mt-3 mb-3"
                                    style="display: flex; justify-content: space-around;">
                                    <input class="btn btnPrimary" value="Registrar" onclick="handlerSubmit();"
                                        style="margin-left: 20px" />
                                    <a href="/"><button type="button"
                                            class="btn btnSecond btn2">Cancelar</button></a>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
