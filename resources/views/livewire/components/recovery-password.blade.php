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
                        minlength: 3,
                        maxlength: 50,
                        email: true
                    },
                },
                messages: {

                    email: {
                        required: "Correo Electrónico es obligatorio",
                        minlength: "Correo Electrónico debe ser mayor a 6 caracteres",
                        maxlength: "Correo Electrónico debe ser menor a 8 caracteres",
                        email: "Correo Electrónico incorrecto"
                    }

                }
            });

            //envio del formulario
            $("#form-recovery").submit(function(event) {
                event.preventDefault();
                $("#form-recovery").validate();
                if ($("#form-recovery").valid()) {
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
                                        confirmButtonText: 'Aceptar'
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
                        required: "Contraseña es obligatoria",
                        minlength: "Contraseña debe ser mayor a 6 caracteres",
                        maxlength: "Contraseña debe ser menor a 8 caracteres",
                    },
                    password_confrimation: {
                        required: "Confirmar Contraseña es obligatoria",
                        minlength: "Confirmar Contraseña debe ser mayor a 6 caracteres",
                        maxlength: "Confirmar Contraseña debe ser menor a 8 caracteres",
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
                            Swal.fire({
                                icon: 'success',
                                title: response.msj,
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: 'Aceptar'
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
                                confirmButtonText: 'Aceptar'
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
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid">
            <div id="spinner" style="display: none">
                <x-load-spinner />
            </div>
            <div class="row form-sq" style="position: relative">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                    <div class="text-center">
                        <img class="img" src="{{ asset('img/recuperar.png') }}" style="width: 355px;">
                    </div>
                </div>
            
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-4">
                        <div class="card" id="div-form">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row mt-3" style="display: grid; justify-items: center;">
                                        <img class="logoSq" src="{{ asset('img/logo sqlapio variaciones-02.png') }}"
                                            alt="">
                                    </div>
                                </div>
                                {{ Form::open(['url' => '', 'method' => 'post', 'id' => 'form-recovery']) }}
                                <div class="row" id="content-recovery-email">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
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
                                    <div class="d-flex justify-content-center">
                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl--8 mt-3 mb-3"
                                            style="display: flex; justify-content: space-around;">
                                            <input class="btn btnPrimary" value="Recuperar" type="submit" />
                                            <a href="/"><button type="button"
                                                    class="btn btnSecond btn2">Cancelar</button></a>
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
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Contraseña</label>
                                                <input placeholder="Contraseña" autocomplete="off" data-bs-toggle="tooltip"
                                                    data-bs-placement="right" data-bs-custom-class="custom-tooltip"
                                                    data-html="true"
                                                    title="La contraseña debe contener:
                                                            Al menos una letra mayúscula.
                                                            Al menos una letra minúscula. 
                                                            Al menos un número.
                                                            Mínimo 6 carácteres.
                                                            Máximo 8 carácteres"
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
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Confirmar
                                                    Contraseña</label>
                                                <input autocomplete="off" placeholder="Confirmar Contraseña"
                                                    class="form-control @error('password_confrimation') is-invalid @enderror"
                                                    id="password_confrimation" name="password_confrimation" type="password"
                                                    value="">
                                                <i onclick="showPassConfimation();" class="bi bi-eye-fill st-icon"></i>
                                            </div>
                                        </diV>

                                        <div class="d-flex justify-content-center">
                                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl--8 mt-3 mb-3"
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
    </div>
@endsection
