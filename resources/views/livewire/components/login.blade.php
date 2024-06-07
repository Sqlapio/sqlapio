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

    @media only screen and (min-width: 1800px) {
        .col-xxxl {
            width: 20% !important;
        }

    }
</style>
@push('scripts')
    <script>
        let error = @json($error);

        $().ready(function() {

            if (error != null) {
                Swal.fire({
                    icon: 'warning',
                    title: error,
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: '@lang('messages.botton.aceptar')'
                }).then((result) => {
                    window.location.href = '{{ route('Login_home') }}';

                });
            }
            let success = $("#success-input").val();
            if (success) {
                Swal.fire({
                    icon: 'success',
                    title: '@lang('messages.alert.ususario_registrado')',
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: '@lang('messages.botton.aceptar')'
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
                        // minlength: 3,
                        // maxlength: 50,
                        email: true
                    },
                    password: {
                        required: true,
                        // minlength: 6,
                        // maxlength: 8,
                    },
                },
                messages: {
                    username: {
                        required: "@lang('messages.alert.correo_obligatorio')",
                        // minlength: "@lang('messages.alert.usuario_3_caracteres')",
                        // maxlength: "@lang('messages.alert.usuario_50_caracteres')",
                        email: "@lang('messages.alert.correo_incorrecto')"

                    },
                    password: {
                        required: "@lang('messages.alert.contraseña_obligatorio')",
                        // minlength: "Contraseña debe ser mayor a 6 caracteres",
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

        const handleLen = (e) => {
            let url = "{{ route('lang', ':lang') }}";
            url = url.replace(':lang', e.target.value, );
            $.ajax({
                url: url,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    window.location = "{{ route('Login_home') }}"
                },
                error: function(error) {

                }
            });
        }
    </script>
@endpush
 @section('content')
    <div>
        <div class="container-fluid text-center">
            <div id="spinner" style="display: none">
                <x-load-spinner />
            </div>

            <div class="row form-sq" style="position: relative">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6"> </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                        <div class="row justify-content-center mt-2">
                            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xxl-5 loginDric">
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
                                        <input class="form-control" id="username" placeholder="@lang('messages.login.usuario')" name="username"
                                            type="text" value="">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                </diV>
                                <div class="form-group margin-global">
                                    <div class="Icon-inside">
                                        <input placeholder="@lang('messages.login.contraseña')" class="form-control" id="password" name="password"
                                            type="password" value="">
                                        <i onclick="showPass();" class="bi bi-eye-fill"></i>
                                    </div>
                                </div>

                                <button type="" class="btn btnPrimary"><span class="">@lang('messages.login.entrar')</span></button>

                            </div>
                            {{ Form::close() }}
                        </div>
                        <div class="row justify-content-center mt-2">
                            {{-- <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                <a class="links" href="https://system.sqlapio.com/public/payment-form/1">@lang('messages.login.registrate_gratis')</a>
                            </div> --}}
                            {{-- <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                <a class="links" href="{{ config('sidebar_item.var') }}">@lang('messages.login.adquiere_plan')</a>
                            </div> --}}
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-bottom: 4px;">
                                <a class="links" href="{{ route('recovery_password') }}">@lang('messages.login.recuperar_clave')</a>
                            </div>
                            <div class="col-sm-12 col-md-12	col-lg-12 col-xl-12 col-xxl-12" style="display: flex; justify-content: center; align-items: center; }">
                                <img width="40" src="{{ asset('img/language.png') }}" class="">
                                <input onclick="handleLen(event);" class="links" type="button" value="es" style="background: transparent; border:none; text-transform: uppercase; pointer; font-weight: 700; padding: 0 0 0 7px;">
                                <input onclick="handleLen(event);" class="links" type="button" value="en" style="background: transparent; border:none; text-transform: uppercase; pointer; font-weight: 700; padding: 0 0 0 7px;">
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
