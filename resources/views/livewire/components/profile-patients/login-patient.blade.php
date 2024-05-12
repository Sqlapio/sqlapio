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
        $().ready(function() {

            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            tooltipTriggerList.forEach(element => {
                new bootstrap.Tooltip(element)
            });

            $('#form-login-patient').validate({
                rules: {
                    username: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                },
                messages: {
                    username: {
                        required: "@lang('messages.alert.correo_obligatorio')",
                    },
                    password: {
                        required: "@lang('messages.alert.contraseña_obligatorio')",
                    },
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

        const handlerSubmit = () => {

            $("#form-login-patient").validate();

            if ($("#form-login-patient").valid()) {

                $.ajax({
                    url: '{{ route('login-patient') }}',
                    type: 'POST',
                    dataType: "json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "username": $("#username").val(),
                        "password": $("#password").val()
                    },
                    success: function(response) {

                        console.log(@json(auth()->user()));

                        window
                            .location =
                            '{{ route('view-patient') }}';
                    },
                    error: function(error) {
                        console.log(@json(auth()->user()));


                        // Swal.fire({
                        //     icon: 'error',
                        //     title: error
                        //         .responseJSON
                        //         .msj,
                        //     allowOutsideClick: false,
                        //     confirmButtonColor: '#42ABE2',
                        //     confirmButtonText: '@lang('messages.botton.aceptar')'
                        // })
                    }
                });
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
            <div class="row form-sq" style="position: relative">
                <div class="col-xs-10 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3 col-xxxl loginDric">
                    <div class="">
                        <img class="img" src="{{ asset('img/iniciar-sesion.png') }}" class="">
                    </div>
                    {{ Form::open(['method' => 'post', 'id' => 'form-login-patient']) }}
                    {{ csrf_field() }}
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
                    <input class="btn btnPrimary" value="@lang('messages.login.entrar')" onclick="handlerSubmit();" />
                </div>
                {{ Form::close() }}

            </div>
        </div>
    </div>
@endsection
