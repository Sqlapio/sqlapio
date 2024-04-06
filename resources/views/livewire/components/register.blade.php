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
                    },
                    business_name: {
                        required: true,
                    }
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
                        minlength: "Correo Electrónico debe ser mayor a 6 caracteres",
                        maxlength: "Correo Electrónico debe ser menor a 8 caracteres",
                        email: "@lang('messages.alert.correo_incorrecto')"
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
                        required: "@lang('messages.alert.cedula_obligatoria')",
                    },
                    captcha: {
                        required: "Codigo es obligatorio",
                    },
                    business_name: {
                        required: "@lang('messages.alert.campo_obligatorio')",
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
                var pattern = /^[0-9-]*$/;
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
                    confirmButtonText: '@lang('messages.botton.aceptar')'
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
                                                    confirmButtonText: '@lang('messages.botton.aceptar')'
                                                }).then((result) => {
                                                    window
                                                        .location =
                                                        '{{ route('Login_home') }}';

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
                                                    confirmButtonText: '@lang('messages.botton.aceptar')'
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
                                    confirmButtonText: '@lang('messages.botton.aceptar')'
                                })

                            }
                        });
                        //end
                    }
                });
            }
        }

        // const reloadCaptcha = () => {

        //     $.ajax({
        //         url: "{{ route('reloadCapchat') }}",
        //         type: 'GET',
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         success: function(response) {
        //             $('#span-captcha').html(response);
        //         }

        //     });
        // }

        function handlerTypeDoc(e) {

            switch (Number(e.target.value)) {
                case 1:

                    $('#ci').attr("placeholder", "Cedula de indentidad");
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

                    $('#ci').attr("placeholder", "RCN").mask('000-0000000-0');
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

                    $('#ci').attr("placeholder", "Pasaporte");
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

                case 4:

                    $('#ci').attr("placeholder", "Firma Personal");
                    $('#div_name').hide();
                    $('#div_last_name').hide();
                    $('#div_business_name').show();

                    $("#name").rules('remove');
                    $("#last_name").rules('remove');

                    break;

                case 5:

                    $('#ci').attr("placeholder", "Juridico");
                    $('#div_name').hide();
                    $('#div_last_name').hide();
                    $('#div_business_name').show();


                    $("#name").rules('remove');
                    $("#last_name").rules('remove');

                    break;
                case 6:

                    $('#ci').attr("placeholder", "Comuna");
                    $('#div_name').hide();
                    $('#div_last_name').hide();
                    $('#div_business_name').show();


                    $("#name").rules('remove');
                    $("#last_name").rules('remove');

                    break;

                case 7:

                    $('#ci').attr("placeholder", "Gubernalmental");
                    $('#div_name').hide();
                    $('#div_last_name').hide();
                    $('#div_business_name').show();


                    $("#name").rules('remove');
                    $("#last_name").rules('remove');

                    break;
            }


        }
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid">
            <div id="spinner" style="display: none">
                <x-load-spinner />
            </div>
            <div class="row form-sq pad-mb">
                <div class="col-sm-10 col-md-5 col-lg-5 col-xl-4 col-xxl-3">
                    {{-- <div class="card mb-3 mt-m3" id="div-form">
                        <div class="card-body"> --}}

                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                <div class="text-center">
                                    <img class="img" src="{{ asset('img/registro.png') }}" style="width: 200px;">
                                </div>
                            </div>

                            {{ Form::open(['method' => 'post', 'id' => 'form-register']) }}
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" id="div_name">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <label for="name" class="form-label"
                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.nombre')</label>
                                            <input autocomplete="off" class="form-control mask-text" id="name"
                                                name="name" type="text" value="">
                                            <i class="bi bi-person-circle st-icon"></i>
                                        </div>
                                    </diV>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" id="div_last_name">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <label for="name" class="form-label"
                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.apellido')</label>
                                            <input autocomplete="off" class="form-control mask-text" id="last_name"
                                                name="last_name" type="text" value="">
                                            <i class="bi bi-person-circle st-icon"></i>
                                        </div>
                                    </diV>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                    <div class="form-group">
                                        <label for="name" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 2px">@lang('messages.form.tipo_documento')</label>
                                        <select onchange="handlerTypeDoc(event)" name="type_rif" id="type_rif" class="form-control">
                                            <option value="">@lang('messages.placeholder.seleccione')</option>
                                            <option value="1">@lang('messages.select.cedula')</option>
                                            <option value="2">@lang('messages.select.RCN')</option>
                                            <option value="3">@lang('messages.select.pasaporte')</option>
                                            <option value="4">@lang('messages.select.firma_personal')</option>
                                            <option value="5">@lang('messages.select.juridico')</option>
                                            <option value="6">@lang('messages.select.comuna')</option>
                                            <option value="7">@lang('messages.select.gubernamental')</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <label for="name" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.label.documento_identidad')</label>
                                            <input autocomplete="off" class="form-control mask-only-number" id="ci" name="ci" type="text" value="" placeholder="">
                                            <i class="bi bi-person-circle st-icon"></i>
                                        </div>
                                    </diV>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="display: none"
                                    id="div_business_name">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <label for="name" class="form-label"
                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.razon_social')</label>
                                            <input autocomplete="off" placeholder="" class="form-control mask-text"
                                                id="business_name" name="business_name" type="text" value="">
                                            <i class="bi bi-person-vcard st-icon"></i>
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

                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <label for="name" class="form-label"
                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Contraseña</label>
                                            <input placeholder="Contraseña" autocomplete="off" class="form-control"
                                                id="password" name="password" type="password" value="">
                                            <i onclick="showPass();" class="bi bi-eye-fill st-icon"></i>
                                        </div>
                                    </diV>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <label for="name" class="form-label"
                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Confirmar
                                                Contraseña</label>
                                            <input autocomplete="off" placeholder="Confirmar Contraseña"
                                                class="form-control" id="password_confrimation"
                                                name="password_confrimation" type="password" value="">
                                            <i onclick="showPassConfimation();" class="bi bi-eye-fill st-icon"></i>
                                        </div>
                                    </diV>
                                </div>

                                {{-- Input hidden for type plan --}}
                                <input id="type_plan" name="type_plan" type="hidden" value="{{ $type_plan }}">

                                {{-- <div class="col-sm-12 col-md-12 col-lg-12 col-xl-21 col-xxl-12 mt-2">
                                    <div class="row mt-3" style="display: flex; justify-content: center;">
                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3" style="display: flex; justify-content: center;">
                                            <span id="span-captcha"> {!! Captcha::img('flat') !!}</span>
                                            <button type="button" id="reload" class="btn btn-danger reload"
                                                onclick="reloadCaptcha()">
                                                &#x21bb;
                                            </button>
                                        </div>

                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-2">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="name" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Ingrese
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
                                </div> --}}

                            </div>



                            <div class="d-flex justify-content-center">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3 mb-3" style="display: flex; justify-content: space-around;">
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 d-flex justify-content-center">
                                        <input class="btn btnPrimary" value="Registrar" onclick="handlerSubmit();" style="margin-left: 20px" />
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 d-flex justify-content-center">
                                        <a href="/"><button type="button" class="btn btnSecond btn2">@lang('messages.botton.cancelar')</button></a>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        {{-- </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
