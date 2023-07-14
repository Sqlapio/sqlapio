@extends('layouts.app')
@section('title', 'Login')
<style>
    .img {
        width: 50% !important;
        height: auto;
    }
</style>
@push('scripts')
<script>
    $().ready(function() {

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        tooltipTriggerList.forEach(element => {
            new bootstrap.Tooltip(element)
        });
        var regex = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,10}$";
        $('#form-login').validate({
            rules: {
                username: {
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
            },
            messages: {
                username: {
                    required: "Usuario es obligatorio",
                    minlength: "Usuario debe ser mayor a 3 caracteres",
                    maxlength: "Usuario debe ser menor a 50 caracteres",
                    email: "Usuario Formato incorrecto"

                },
                password: {
                    required: "Contraseña es obligatoria",
                    minlength: "Contraseña debe ser mayor a 6 caracteres",
                    maxlength: "Contraseña debe ser menor a 8 caracteres",
                    // pattern: "pattern",
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
    });

    function showPass() {
        let input = $("#password");
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
        <div class="container-fluid text-center">
            <div class="row justify-content-center">
                <div class="col-sm-3 col-md-3	col-lg-3 col-xl-3 col-xxl-3 loginDric">
                    <div class="">
                        {{-- <img class="img" src="{{ asset('img/logo-nav.png') }}" class="logo"> --}}
                        <img class="img" src="{{ asset('img/iniciar-sesion.png') }}" class="">
                    </div>
                    {{ Form::open(['url' => '/login', 'method' => 'post', 'id' => 'form-login']) }}
                    {{ csrf_field() }}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $message)
                                <span class="text-danger error-span"> {{ $message }}</span><br />
                            @endforeach
                        </div>
                    @endif
                    <div class="form-group margin-global">
                        <div class="Icon-inside">
                            <input class="form-control" id="username" placeholder="Usuario" name="username" type="text"
                                value="">
                            <i class="bi bi-person-fill"></i>
                        </div>
                    </diV>
                    <div class="form-group margin-global">
                        <div class="Icon-inside">
                            <input placeholder="Contraseña" autocomplete="off" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-html="true"
                                title="Contraseña debe tener.
                            Letra mayúscula.
                            Letra Minúscula. 
                            Numeros.
                            Mínimo 6 caracteres.
                            Máximo 8 caracteres"
                                class="form-control" id="password" name="password" type="password" value="">
                            <i onclick="showPass();" class="bi bi-eye-fill"></i>
                        </div>
                    </div>
                    <div id="spinner" style="display: none">
                        <x-load-spinner/>
                    </div>
                    <button type="" class="btn btnPrimary"><span class="">Entrar</span></button>
                </div>
                {{ Form::close() }}
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-12	col-lg-12 col-xl-12 col-xxl-12">
                    <a href="{{ route('Register') }}">Registrar Usuario</a>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                    <a href="">Recuperar Contraseña</a>
                </div>
            </div>
        </div>
    </div>
@endsection
