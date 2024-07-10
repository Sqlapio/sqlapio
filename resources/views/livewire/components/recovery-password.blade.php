@extends('layouts.app')
@section('title', 'Recuperación de contraseña')
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

    body {
        font-family: 'Roboto-Regular',  !important;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover !important;
        background: url({{ asset('img/fondo.jpg') }}) no-repeat center center fixed;
    }

    @media only screen and (max-width: 768px) {
        body {
            background: url({{ asset('img/fondo-mobile.jpg') }}) no-repeat center center fixed;
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
    }

    @media only screen and (max-width: 768px) {

        .btn2 {
            margin-left: 20px;
        }

    }
</style>
@push('scripts')
    <script>
        let opt = '';
        $(document).ready(function() {

            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            tooltipTriggerList.forEach(element => {
                new bootstrap.Tooltip(element)
            });

            $('#form-recovery').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                },
                messages: {

                    email: {
                        required: "@lang('messages.alert.correo_obligatorio')",
                        email: "@lang('messages.alert.correo_obligatorio')",
                    }

                }
            });

            //envio del formulario
            $("#form-recovery").submit(function(event) {
                event.preventDefault();
                $("#form-recovery").validate();
                if ($("#form-recovery").valid()) {
                    Swal.fire({
                        title: '@lang('messages.alert.accion')',
                        text: '@lang('messages.alert.envio_codigo')',
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonText: '@lang('messages.botton.cancelar')',
                        confirmButtonColor: '#42ABE2',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '@lang('messages.botton.aceptar')'

                    }).then((result) => {

                        if (result.isConfirmed) {
                            $('#spinner').show();
                            ///solicitar otp
                            $.ajax({
                                url: '{{ route('send_otp_rp') }}',
                                type: 'POST',
                                dataType: "json",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    email: $('#email').val(),
                                    action: "rp"
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                success: function(response) {

                                    $('#spinner').hide();

                                    Swal.fire({
                                        title: '@lang('messages.alert.ingrese_codigo')',
                                        input: 'number',
                                        inputAttributes: {
                                            autocorrect: 'on',
                                            max: 6,
                                            maxlength: 6
                                        },
                                        showCancelButton: true,
                                        cancelButtonText: '@lang('messages.botton.cancelar')',
                                        confirmButtonText: '@lang('messages.botton.enviar')',
                                        showLoaderOnConfirm: true,
                                        inputValidator: (value) => {
                                            if (value === '') {
                                                return '@lang('messages.alert.campo_obligatorio')'
                                            } else if (value.length > 6) {
                                                return '@lang('messages.alert.campo_6_caracteres')'

                                            }
                                        },
                                        preConfirm: (login) => {
                                            opt = login;

                                            $('#content-recovery')
                                                .show();
                                            $('#content-recovery-email')
                                                .hide();
                                        },
                                        allowOutsideClick: () => !Swal
                                            .isLoading()
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
                            //end
                        }
                    });
                }
            });
            //end

            ///formulario form-recovery-password
            $('#form-recovery-password').validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 8,
                    },
                    password_confrimation: {
                        required: true,
                        minlength: 6,
                        maxlength: 8,
                        handlerPass: true
                    }
                },
                messages: {
                    password: {
                        required: "@lang('messages.alert.contraseña_obligatorio')",
                        minlength: "@lang('messages.alert.contraseña_6_caracteres')",
                        maxlength: "@lang('messages.alert.contraseña_8_caracteres')",
                    },
                    password_confrimation: {
                        required: "@lang('messages.alert.ccontraseña_obligatorio')",
                        minlength: "@lang('messages.alert.ccontraseña_6_caracteres')",
                        maxlength: "@lang('messages.alert.ccontraseña_8_caracteres')",
                    }
                }
            });

            $("#form-recovery-password").submit(function(event) {
                event.preventDefault();
                $("#form-recovery-password").validate();
                if ($("#form-recovery-password").valid()) {
                    $('#spinner').show();
                    ///solicitar otp
                    $.ajax({
                        url: '{{ route('verify_otp_rp') }}',
                        type: 'POST',
                        dataType: "json",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            email: $('#email').val(),
                            action: "rp",
                            cod_update_pass: opt,
                            password: $('#password').val(),
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        success: function(response) {
                            $('#spinner').hide();
                            Swal.fire({
                                icon: 'success',
                                title: response.msj,
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: '@lang('messages.botton.aceptar')'
                            }).then((result) => {
                                let url = "/";
                                window.location.href = url;
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
                    //end

                }
            });

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
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid">
            <div id="spinner" style="display: none">
                <x-load-spinner />
            </div>
            <div class="row form-sq" style="position: relative">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6"> </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="row justify-content-center">
                        <div class="col-xs-8 col-sm-8 col-md-5 col-lg-5 col-xl-5 col-xxl-5 loginDric">
                            <div class="">
                                <div class="row mt-2 mb-3" style="display: grid; justify-items: center;">
                                    <img class="img" src="{{ asset('img/RECUPERAR-CONTRASEÑA.png') }}" style="width: 355px;">
                                </div>
                            </div>
                            {{ Form::open(['url' => '', 'method' => 'post', 'id' => 'form-recovery']) }}
                            <div class="row" id="content-recovery-email">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <!-- <label for="name" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.email')</label> -->
                                            <input autocomplete="off" class="form-control" id="email" name="email" type="text" value="" placeholder="@lang('messages.form.email')">
                                            <i class="bi bi-envelope" style="top: 2px !important;"></i>
                                        </div>
                                    </diV>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3 mb-3" style="display: flex; justify-content: space-around;">
                                    <div class="d-flex justify-content-center">
                                        <input class="btn btnPrimary" value="@lang('messages.botton.recuperar')" type="submit" style="margin-top: 0px; margin-right: 20px; "/>
                                        <a href="/"><button type="button" class="btn btnSecond btn2">@lang('messages.botton.cancelar')</button></a>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}

                            {{ Form::open(['url' => '', 'method' => 'post', 'id' => 'form-recovery-password']) }}
                            <div class="row" id="content-recovery" style="display: none">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <label for="name" class="form-label"
                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.login.contraseña')</label>
                                            <input placeholder="@lang('messages.login.contraseña')" autocomplete="off"
                                                {{-- data-bs-toggle="tooltip" data-bs-placement="right"
                                                data-bs-custom-class="custom-tooltip" data-html="true"
                                                title="La contraseña debe contener:
                                                        Al menos una letra mayúscula.
                                                        Al menos una letra minúscula.
                                                        Al menos un número.
                                                        Mínimo 6 carácteres.
                                                        Máximo 8 carácteres" --}}
                                                class="form-control @error('password') is-invalid @enderror" id="password"
                                                name="password" type="password" value="">
                                            <i onclick="showPass();" class="bi bi-eye-fill st-icon"></i>
                                        </div>
                                    </diV>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <label for="name" class="form-label"
                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.login.confirmar')</label>
                                            <input autocomplete="off" placeholder="@lang('messages.login.confirmar')"
                                                class="form-control @error('password_confrimation') is-invalid @enderror"
                                                id="password_confrimation" name="password_confrimation" type="password"
                                                value="">
                                            <i onclick="showPassConfimation();" class="bi bi-eye-fill st-icon"></i>
                                        </div>
                                    </diV>

                                    <div class="d-flex justify-content-center">
                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-2 mb-3"
                                            style="display: flex; justify-content: space-around;">
                                            <input class="btn btnPrimary" value="Guardar" type="submit" />
                                        </div>
                                    </div>
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
