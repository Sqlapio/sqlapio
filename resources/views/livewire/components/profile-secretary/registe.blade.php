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

    body .secretary {
        font-family: 'Roboto-Regular',  !important;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover !important;
        background: url({{ asset('img/fondo-secr.jpg') }}) no-repeat top center fixed !important;
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

        .pad-mb {
            padding: 0px 46px;
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

        .pad-mb {
            padding: 0px 46px;
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

            $('#registe-secretary').validate({
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
                    type_rif: {
                        required: true,
                    },

                },
                messages: {
                    name: {
                        required: "@lang('messages.alert.nombre_obligatorio')",
                        minlength: "@lang('messages.alert.nombre_3_caracteres')",
                        maxlength: "@lang('messages.alert.nombre_50_caracteres')",
                    },
                    last_name: {
                        required: "@lang('messages.alert.apellido_obligatorio')",
                        minlength: "@lang('messages.alert.apellido_6_caracteres')",
                        maxlength: "@lang('messages.alert.apellido_8_caracteres')",
                    },

                    email: {
                        required: "@lang('messages.alert.correo_obligatorio')",
                        email: "@lang('messages.alert.correo_incorrecto')"
                    },
                    password: {
                        required: "@lang('messages.alert.contraseña_obligatorio')",
                        minlength: "@lang('messages.alert.contraseña_6_caracteres')",
                    },
                    password_confrimation: {
                        required: "@lang('messages.alert.ccontraseña_obligatorio')",
                        minlength: "@lang('messages.alert.ccontraseña_6_caracteres')",
                    },
                    ci: {
                        required: "@lang('messages.alert.cedula_obligatoria')",
                    },
                    type_rif: {
                        required: "Codigo es obligatorio",
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
            $.validator.addMethod("onlyNumber", function(value, element) {
                var pattern = /^[0-9-]*$/;
                return pattern.test(value);
            }, "@lang('messages.alert.campo_numerico')");

            $.validator.addMethod("handlerPass", function(value, element) {
                let validate = false;
                if (value === $('#password').val()) {
                    validate = true;
                }
                return validate;
            }, "@lang('messages.alert.contraseña_no_coincide')");

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

            $("#registe-secretary").validate();
            if ($("#registe-secretary").valid()) {
                $('#spinner').show();

                let formData = $('#registe-secretary')
                    .serialize();

                $.ajax({
                    url: '{{ route('registe-secretary') }}',
                    type: 'POST',
                    dataType: "json",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $(
                            'meta[name="csrf-token"]'
                        ).attr('content')
                    },
                    success: function(response) {
                        $('#spinner').hide();

                        Swal.fire({
                            icon: 'success',
                            title: response
                                .msj,
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: '@lang('messages.botton.aceptar')'
                        }).then((result) => {
                            window
                                .location =
                                '{{ route('Login_home') }}';

                        });
                    },
                    error: function(error) {
                        $('#spinner').hide();

                        Swal.fire({
                            icon: 'error',
                            title: error
                                .responseJSON
                                .msj,
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: '@lang('messages.botton.aceptar')'
                        })
                    }
                });
            }
        }

        function handlerTypeDoc(e) {

            switch (Number(e.target.value)) {
                case 1:

                    $('#ci').attr("placeholder", '@lang('messages.select.cedula')');
                    $('#div_name').show();
                    $('#div_last_name').show();
                    $('#div_business_name').hide();

                    $("#name").rules('add', {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    });

                    $("#last_name").rules('add', {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    });

                    break;

                case 2:

                    $('#ci').attr("placeholder", "CIE").mask('000-0000000-0');
                    $('#div_name').show();
                    $('#div_last_name').show();
                    $('#div_business_name').hide();

                    $("#name").rules('add', {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    });

                    $("#last_name").rules('add', {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    });

                    break;

                case 3:

                    $('#ci').attr("placeholder", '@lang('messages.select.pasaporte')');
                    $('#div_name').show();
                    $('#div_last_name').show();
                    $('#div_business_name').hide();

                    $("#name").rules('add', {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    });

                    $("#last_name").rules('add', {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    });

                    break;

            }


        }
    </script>
@endpush
@section('content')
    <div class="secretary">
        <div class="container-fluid">
            <div id="spinner" style="display: none">
                <x-load-spinner />
            </div>
            <div class="row form-sq pad-mb">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="row justify-content-center">
                        <div class="col-sm-10 col-md-5 col-lg-5 col-xl-5 col-xxl-5">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                <div class="text-center">
                                    <img class="img" src="{{ asset('img/registro.png') }}" style="width: 200px;">
                                </div>
                            </div>

                            {{ Form::open(['method' => 'post', 'id' => 'registe-secretary']) }}
                            {{ csrf_field() }}
                            <div class="row">
                            <input type="hidden" name="user_id" id="user_id" value="{{$id}}">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3" id="div_name">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            {{-- <label for="name" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.nombre')</label> --}}
                                            <input autocomplete="off" class="form-control mask-text" id="name" name="name"
                                                type="text" value="" placeholder="@lang('messages.form.nombre')">
                                            <i class="bi bi-person-circle"></i>
                                        </div>
                                    </diV>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3" id="div_last_name">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            {{-- <label for="last_name" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.apellido')</label> --}}
                                            <input autocomplete="off" class="form-control mask-text" id="last_name" name="last_name"
                                                type="text" value="" placeholder="@lang('messages.form.apellido')">
                                            <i class="bi bi-person-circle"></i>
                                        </div>
                                    </diV>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                    <div class="form-group">
                                        {{-- <label for="type_rif" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 2px">@lang('messages.form.tipo_documento')</label> --}}
                                        <select onchange="handlerTypeDoc(event)" name="type_rif" id="type_rif"
                                            class="form-control">
                                            <option value="">@lang('messages.form.tipo_documento')</option>
                                            <option value="1">@lang('messages.select.cedula')</option>
                                            <option value="2">@lang('messages.select.CIE')</option>
                                            <option value="3">@lang('messages.select.pasaporte')</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            {{-- <label for="ci" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.label.documento_identidad')</label> --}}
                                            <input autocomplete="off" class="form-control mask-only-number" id="ci"
                                                name="ci" type="text" value="" placeholder="@lang('messages.label.documento_identidad')">
                                            <i class="bi bi-person-circle"></i>
                                        </div>
                                    </diV>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3" style="display: none"
                                    id="div_business_name">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            {{-- <label for="business_name" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.razon_social')</label> --}}
                                            <input autocomplete="off" placeholder="@lang('messages.form.razon_social')" class="form-control mask-text"
                                                id="business_name" name="business_name" type="text" value="">
                                            <i class="bi bi-person-vcard"></i>
                                        </div>
                                    </diV>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            {{-- <label for="email" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.email')</label> --}}
                                            <input autocomplete="off" class="form-control" id="email" name="email"
                                                type="text" value="" placeholder="@lang('messages.form.email')">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                    </diV>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            {{-- <label for="password" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.contraseña')</label> --}}
                                            <input autocomplete="off" class="form-control" id="password" name="password"
                                                type="password" value="" placeholder="@lang('messages.form.contraseña')">
                                            <i onclick="showPass();" class="bi bi-eye-fill"></i>
                                        </div>
                                    </diV>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            {{-- <label for="password_confrimation" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.confirmar_contraseña')</label> --}}
                                            <input autocomplete="off" class="form-control" id="password_confrimation"
                                                name="password_confrimation" type="password" value="" placeholder="@lang('messages.form.confirmar_contraseña')">
                                            <i onclick="showPassConfimation();" class="bi bi-eye-fill"></i>
                                        </div>
                                    </diV>
                                </div>



                            </div>

                            <div class="d-flex justify-content-center">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3 mb-3"
                                    style="display: flex; justify-content: space-around;">
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 d-flex justify-content-center">
                                        <input class="btn btnPrimary" value="@lang('messages.botton.registrar')" onclick="handlerSubmit();"
                                            style="margin-left: 20px" />
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 d-flex justify-content-center">
                                        <a href="/"><button type="button"
                                                class="btn btnSecond btn2">@lang('messages.botton.cancelar')</button></a>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                            {{-- </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6"> </div>
            </div>
        </div>
    </div>
@endsection
