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
                        //maxlength: 8,
                    },
                    password_confrimation: {
                        required: true,
                        minlength: 6,
                        //maxlength: 8,
                        handlerPass: true
                    },
                    rol: {
                        required: true,
                    },
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
                        // pattern: "pattern",
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
                       // maxlength: "Contraseña debe ser menor a 8 caracteres",
                    },
                    password_confrimation: {
                        required: "Confirmar Contraseña es obligatoria",
                        minlength: "Confirmar Contraseña debe ser mayor a 6 caracteres",
                        //maxlength: "Confirmar Contraseña debe ser menor a 8 caracteres",
                    },
                    rol: {
                        required: "Rol es obligatorio",
                    },
                },
                invalidHandler: function(event, validator) {

                },
                submitHandler: function(form) {
                    $('#spinner').show();
                    $('.btnPrimary').hide();
                    form.submit();
                }
            });

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

        function handlerRol(val) {
            if (val == 'laboratorio') {
                $('#business-name').show();
                $('#name-input').hide();
                $('#apellidos').hide();

            } else {
                $('#business-name').hide();
            }
            $('#rol').val(val);
            $('#div-form').show();
            $('#btn-rol').hide();
        }
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid">
            <div class="row form-sq">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                    <div class="text-center">
                        <img class="img" src="{{ asset('img/registro.png') }}" style="width: 200px;">
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                    <div class="container container-icon" style="display: flex; justify-content: center;">
                        <div id="btn-rol" class="row justify-content-center">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 btn-bg">
                                <img data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    data-bs-custom-class="custom-tooltip" data-html="true" title="Registrar como médico"
                                    onclick="handlerRol('medico')" src="{{ asset('/img/V2/Boton_medico.png') }}"
                                    height="auto" alt="avatar">
                                <img data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    data-bs-custom-class="custom-tooltip" data-html="true" title="Registrar como médico"
                                    onclick="handlerRol('medico')" src="{{ asset('/img/V2/Boton_medico_bg.png') }}"
                                    height="auto" alt="avatar">
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 btn-bg-lb">
                                <img data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    data-bs-custom-class="custom-tooltip" data-html="true"
                                    title="Registrar como laboratorio" onclick="handlerRol('laboratorio')"
                                    src="{{ asset('/img/V2/Boton_laboratorio.png') }}" height="auto" alt="avatar">
                                <img data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    data-bs-custom-class="custom-tooltip" data-html="true"
                                    title="Registrar como laboratorio" onclick="handlerRol('laboratorio')"
                                    src="{{ asset('/img/V2/Boton_laboratorio_bg.png') }}" height="auto" alt="avatar">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-4">
                    <div class="card" id="div-form" style="display: none">
                        <div class="card-body">
                            <div>
                                <div class="container">
                                    <div class="row mt-3" style="display: grid; justify-items: center;">
                                        <img class="logoSq" src="{{ asset('img/logo sqlapio variaciones-02.png') }}"
                                            alt="">
                                    </div>
                                </div>
                                {{ Form::open(['url' => 'register', 'method' => 'post', 'id' => 'form-register']) }}
                                {{ csrf_field() }}
                                <div class="row">
                                    <div id="name-input" class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Nombres</label>
                                                <input autocomplete="off"
                                                    class="form-control mask-text @error('name') is-invalid @enderror"
                                                    id="name" name="name" type="text" readonly value="{!! !empty($bellied_plan) ? $bellied_plan->get_user->name : '' !!}">
                                                <i class="bi bi-person-circle st-icon"></i>
                                            </div>
                                        </diV>
                                    </div>

                                    <div id="business-name" class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Nombre del
                                                    Laboratorio</label>
                                                <input autocomplete="off"
                                                    class="form-control mask-text @error('business_name') is-invalid @enderror"
                                                    id="business_name" name="business_name" type="text" value="">
                                                <i class="bi bi-person-circle st-icon"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div id="apellidos" class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Apellidos</label>
                                                <input autocomplete="off"
                                                    class="form-control mask-text @error('last_name') is-invalid @enderror"
                                                    id="last_name" name="last_name" readonly type="text" value="{!! !empty($bellied_plan) ? $bellied_plan->get_user->last_name : '' !!}">
                                                <i class="bi bi-person-circle st-icon"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Correo
                                                    Electrónico</label>
                                                <input autocomplete="off" class="form-control" id="email"
                                                    name="email" type="text" readonly value="{!! !empty($bellied_plan) ? $bellied_plan->get_user->email : '' !!}">
                                                <i class="bi bi-envelope st-icon"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: none">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Rol</label>
                                                <input autocomplete="off" placeholder="Rol"
                                                    class="form-control @error('rol') is-invalid @enderror" id="rol"
                                                    name="rol" type="text" value="" readonly="readonly">
                                                <i class="bi bi-caret-down st-icon"></i>
                                            </div>
                                        </diV>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Contraseña</label>
                                                <input placeholder="Contraseña" autocomplete="off"
                                                    {{-- data-bs-toggle="tooltip" data-bs-placement="right"
                                                    data-bs-custom-class="custom-tooltip tooltip-ps" data-html="true"
                                                    title="La contraseña debe contener:
                                                            Al menos una letra mayúscula.
                                                            Al menos una letra minúscula. 
                                                            Al menos un número.
                                                            Mínimo 6 carácteres.
                                                            Máximo 8 carácteres" --}}
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" name="password" type="password" value="">
                                                <i onclick="showPass();" class="bi bi-eye-fill st-icon"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Confirmar
                                                    Contraseña</label>
                                                <input autocomplete="off" placeholder="Confirmar Contraseña"
                                                    class="form-control @error('password_confrimation') is-invalid @enderror"
                                                    id="password_confrimation" name="password_confrimation"
                                                    type="password" value="">
                                                <i onclick="showPassConfimation();" class="bi bi-eye-fill st-icon"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <div id="spinner" style="display: none" class="spinner-md">
                                            <x-load-spinner show="{{ $show }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl--8 mt-3 mb-3"
                                        style="display: flex; justify-content: space-around;">
                                        <button type="" class="btn btnPrimary">Registrar</button>
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
    </div>
@endsection
