@extends('layouts.app')
@section('title', 'Registro de Usuario')
<style>
    .mt {
        margin-top: 15rem !important;
    }

    .logoSq {
        width: 30%;
        height: auto;
        margin-top: -10% !important;
    }

    .div-col {
        margin-bottom: -85px !important;

    }
</style>
<script src="{{ asset('assets/jquery.js') }}"></script>
<script src="{{ asset('jquery-validation-1.19.5/dist/jquery.validate.min.js') }}" type="text/javascript"></script>
<script>
    $().ready(function() {
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
                    maxlength: 8,
                },
                password_confrimation: {
                    required: true,
                    minlength: 6,
                    maxlength: 8,
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
                    maxlength: "Contraseña debe ser menor a 8 caracteres",
                },
                password_confrimation: {
                    required: "Confirmar Contraseña es obligatoria",
                    minlength: "Confirmar Contraseña debe ser mayor a 6 caracteres",
                    maxlength: "Confirmar Contraseña debe ser menor a 8 caracteres",
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
</script>
@section('content')
    <div>
        <div class="container-fluid">
            <div class="row justify-content-center mt">
                <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                    <div class="card">
                        <div class="card-header collapseBtn text-center">
                            <span>Registro de usuario</span>
                        </div>
                        <div class="card-body">
                            {{ Form::open(['url' => 'register', 'method' => 'post', 'id' => 'form-register']) }}
                            {{ csrf_field() }}
                            <div class="row">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $message)
                                            <span class="text-danger error-span">
                                                {{ $message }}</span><br />
                                        @endforeach
                                    </div>
                                @endif
                                <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <input autocomplete="off" placeholder="Nombres"
                                                class="form-control @error('name') is-invalid @enderror" id="name"
                                                name="name" type="text" value="">
                                            <i class="bi bi-person-circle"></i>
                                        </div>
                                    </diV>
                                </div>
                                <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <input autocomplete="off" placeholder="Apellidos"
                                                class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                                                name="last_name" type="text" value="">
                                            <i class="bi bi-person-circle"></i>
                                        </div>
                                    </diV>
                                </div>
                                <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <input autocomplete="off" placeholder="Correo Electrónico"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                name="email" type="text" value="">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                    </diV>
                                </div>
                                <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <input autocomplete="off" placeholder="Rol"
                                                class="form-control @error('rol') is-invalid @enderror" id="rol"
                                                name="rol" type="text" value="médico" readonly="readonly">
                                            <i class="bi bi-caret-down"></i>
                                        </div>
                                    </diV>
                                </div>

                                <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <input autocomplete="off" placeholder="Contraseña"
                                                class="form-control @error('password') is-invalid @enderror" id="password"
                                                name="password" type="password" value="">
                                            <i onclick="showPass();" class="bi bi-eye-fill"></i>
                                        </div>
                                    </diV>
                                </div>
                                <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <input autocomplete="off" placeholder="Confirmar Contraseña"
                                                class="form-control @error('password_confrimation') is-invalid @enderror"
                                                id="password_confrimation" name="password_confrimation" type="password"
                                                value="">
                                            <i onclick="showPassConfimation();" class="bi bi-eye-fill"></i>
                                        </div>
                                    </diV>
                                </div>
                                <div style="display: none">
                                    <x-load-spinner show="{{ $show }}" />
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2 mt-3" style="margin-left: 7%">
                                        <button type="" class="btn btnPrimary">Registrar</button>
                                    </div>
                                    <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2 mt-3">                                        
                                        <button type="button" class="btn btnSecond">Cancelar</button>
                                    </div>
                                </div>                               
                                {{ Form::close() }}                              
                                <div class="d-flex  mt-3">
                                    <div class="col div-col mt-3">
                                        <img class="logoSq" src="{{ asset('img/logo sqlapio variaciones-02.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
