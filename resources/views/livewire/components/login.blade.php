@extends('layouts.app')
@section('title', 'Login')
<style>
    .img {
        width: 70% !important;
        height: auto;
    }

    .links {
        text-decoration: none;
        color: #6c757d
    }

    .links:hover {
        color: #42abe2;
    }

</style>
@push('scripts')
    <script>
        
        let error = @json($error);

        console.log(error);
        $().ready(function() {

            if(error!=null){
                Swal.fire({
                    icon: 'warning',
                    title:  error ,
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    window.location.href = '{{route('Login_home')}}';

                });  
            }
            let success = $("#success-input").val();
            if (success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Usuario regitrado exitosamente!',
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: 'Aceptar'
                });
            }
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
                       // maxlength: 8,
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
                        //maxlength: "Contraseña debe ser menor a 8 caracteres",
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
            <div id="spinner" style="display: none">
                <x-load-spinner />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: flex; justify-content: flex-end; padding-right: 22px;">
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnEn" id="btnEn1" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="btnEn1" style="padding: 8px">EN</label>
                    
                    <input type="radio" class="btn-check" name="btnEs" id="btnEs2" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnEs2" style="padding: 8px">ES</label>
                </div>
            </div>
            <div class="row form-sq" style="position: relative">
                <div class="col-xs-10 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3 loginDric">
                    <div class="">
                        <img class="img" src="{{ asset('img/iniciar-sesion.png') }}" class="">
                    </div>
                    {{ Form::open(['url' => '/login', 'method' => 'post', 'id' => 'form-login']) }}
                    {{ csrf_field() }}
                    @if (session('success'))
                        <input type="hidden" id="success-input" value="{{ session('success') }}">
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
                            <input class="form-control" id="username" placeholder="Usuario" name="username" type="text" value="">
                            <i class="bi bi-person-fill"></i>
                        </div>
                    </diV>
                    <div class="form-group margin-global">
                        <div class="Icon-inside">
                            <input placeholder="Contraseña" class="form-control" id="password" name="password" type="password" value="">
                            <i onclick="showPass();" class="bi bi-eye-fill"></i>
                        </div>
                    </div>
                    
                    <button type="" class="btn btnPrimary"><span class="">Entrar</span></button>
                    
                </div>
                {{ Form::close() }}
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-12	col-lg-12 col-xl-12 col-xxl-12">
                        <a class="links" href="https://system.sqlapio.com/public/payment-form/1">Registrate Gratis</a>
                    </div>
                    <div class="col-sm-12 col-md-12	col-lg-12 col-xl-12 col-xxl-12">
                        <a class="links" href="{{ config('sidebar_item.var') }}">Adquiere un Plan</a>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                        <a class="links" href="{{route('recovery_password')}}">Recuperar Contraseña</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection
