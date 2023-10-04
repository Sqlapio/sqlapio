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
</style>
@push('scripts')
    <script>
        $(document).ready(function() {
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
                        text: "Se enviara una contraseña temporal al correo ingresado!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#42ABE2',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar'

                    }).then((result) => {

                        var data = $('#form-recovery').serialize();

                        $.ajax({
                            url: '{{ route('create_password_temporary') }}',
                            type: 'POST',
                            data: data,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Contraseña enviada exitosamente!',
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#42ABE2',
                                    confirmButtonText: 'Aceptar'
                                }).then((result) => {
                                    let url = "/";
                                    window.location.href = url;
                                });
                            },
                            error: function(error) {
                                error.responseJSON.errors.map((elm) => {
                                    Swal.fire({
                                        icon: 'error',
                                        title: elm,
                                        allowOutsideClick: false,
                                        confirmButtonColor: '#42ABE2',
                                        confirmButtonText: 'Click para salir'
                                    }).then((result) => {

                                    });
                                });
                            }
                        });
                    });
                }
            });
        });
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid">
            <div class="row justify-content-center mt">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                    <div class="text-center">
                        <img class="img" src="{{ asset('img/registro.png') }}" class="">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-4">
                    <div class="card" id="div-form">
                        <div class="card-body">
                            <div>
                                <div class="container">
                                    <div class="row mt-3" style="display: grid; justify-items: center;">
                                        <img class="logoSq" src="{{ asset('img/logo sqlapio variaciones-02.png') }}"
                                            alt="">
                                    </div>
                                </div>
                                {{ Form::open(['url' => '', 'method' => 'post', 'id' => 'form-recovery']) }}
                                <div class="row">
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
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl--8 mt-3 mb-3"
                                        style="display: flex; justify-content: space-around;">
                                        <input class="btn btnPrimary" value="Recuperar" type="submit" />
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
