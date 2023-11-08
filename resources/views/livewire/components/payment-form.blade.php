@extends('layouts.app')
@section('title', 'Pago del plan')
<style>
    .binance {
        width: 110% !important;
        height: auto;
        margin-top: -15% !important;
        margin-bottom: -15% !important;

    }
</style>
@push('scripts')
    <script>
        let type_plan = @json($type_plan);
        let listPlanes = [1, 2, 3];

        $(document).ready(() => {
            const find = listPlanes.find((e) => e === Number(type_plan));
            if (find == undefined) {
                $('#div-content').hide();
                return false;
            }
            $('#type_plan').val(type_plan);

            switch (Number(type_plan)) {
                case 1:

                    $("#amount").val('0');

                    break;
                case 2:
                    $("#amount").val('$19.99');

                    break;
                case 3:
                    $("#amount").val('$39.99');

                    break;

                default:
                    break;
            }

            $('#form-payment').validate({
                ignore: [],
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
                    amount: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    number_id: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    number_card: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,

                    },
                    code_card: {
                        required: true,
                        maxlength: 3,
                    },
                    methodo_payment: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    name: {
                        required: "Nombres es obligatorio",
                    },
                    last_name: {
                        required: "Apellidos es obligatorio",
                    },
                    amount: {
                        required: "Monto es obligatorio",
                    },
                    number_id: {
                        required: "Numero de cedula es obligatorio",
                    },
                    number_card: {
                        required: "Numero de tarjeta es obligatorio",
                    },
                    code_card: {
                        required: "Codigo de tarjeta es obligatorio",
                    },
                    methodo_payment: {
                        required: "Debe Selecciones un metodo de pago",
                    },
                    email: {
                        required: "Correo electronico es obligatorio",
                    },
                }
            });



            $.validator.addMethod("onlyNumber", function(value, element) {
                var pattern = /^\d+\.?\d*$/;
                return pattern.test(value);
            }, "Campo solo numero");

            //envio del formulario
            $("#form-payment").submit(function(event) {
                event.preventDefault();
                $("#form-payment").validate();
                if ($("#form-payment").valid()) {
                    $('#send').hide();
                    $('#spinner2').show();
                    var data = $('#form-payment').serialize();
                    $.ajax({
                        url: "{{ route('pay-plan') }}",
                        type: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#send').show();
                            $('#spinner2').hide();
                            // $("#form-payment").trigger("reset");
                            $(".holder").hide();
                            Swal.fire({
                                icon: 'success',
                                title: 'Operacion exitosa!',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: 'Aceptar'
                            }).then((result) => {

                            });
                        },
                        error: function(error) {
                            error.responseJSON.errors.map((elm) => {
                                Swal.fire({
                                    icon: 'error',
                                    title: elm,
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#42ABE2',
                                    confirmButtonText: 'Aceptar'
                                }).then((result) => {
                                    $('#send').show().attr('disabled', true);;
                                    $('#spinner2').hide();
                                    $(".holder").hide();
                                });
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid">
            <div id="spinner" style="display: none">
                <x-load-spinner />
            </div>
            <div class="row form-sq">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-4">
                    <div class="card" id="div-form">
                        <div class="card-body">
                            <div id="div-content">
                                <div class="container">
                                    <div class="row mt-3" style="display: grid; justify-items: center;">
                                        <img class="logoSq" src="{{ asset('img/logo sqlapio variaciones-02.png') }}"
                                            alt="">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <img class="binance" src="{{ asset('img/binance-logo.jpeg') }}" alt="">
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <img class="binance" src="{{ asset('img/zelle-logo.png') }}" alt="">
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <img class="binance" src="{{ asset('img/banca-amiga-logo.png') }}" alt="">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <img class="binance" src="{{ asset('img/banco-mercantil-logo.jpeg') }}"
                                            alt="">
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <img class="binance" src="{{ asset('img/banco-venezuela-logo.png') }}"
                                            alt="">
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <img class="binance" src="{{ asset('img/banesco-logo.png') }}" alt="">
                                    </div>
                                </div>
                                {{ Form::open(['url' => '', 'method' => 'post', 'id' => 'form-payment']) }}
                                <div class="row">
                                    <input type="hidden" name="type_plan" id="type_plan">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="methodo_payment" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Duración
                                                    de tratamiento</label>
                                                <select name="methodo_payment" id="methodo_payment"
                                                    placeholder="Seleccione"class="form-control"
                                                    class="form-control combo-textbox-input">
                                                    <option value="">Seleccione...</option>
                                                    <option value="1">Banco de Venezuela</option>
                                                    <option value="2">Banco Mercantil</option>
                                                    <option value="3">Banco Banesco</option>
                                                    <option value="4">Bancamiga</option>
                                                    <option value="5">Zelle</option>
                                                </select>
                                                <i class="bi bi-calendar-range st-icon"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Nombres</label>
                                                <input autocomplete="off"
                                                    class="form-control mask-text @error('name') is-invalid @enderror"
                                                    id="name" name="name" type="text" value="">
                                                <i class="bi bi-person-circle st-icon"></i>
                                            </div>
                                        </diV>
                                    </div>


                                    <div id="apellidos" class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Apellidos</label>
                                                <input autocomplete="off"
                                                    class="form-control mask-text @error('last_name') is-invalid @enderror"
                                                    id="last_name" name="last_name" type="text" value="">
                                                <i class="bi bi-person-circle st-icon"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Numero de
                                                    cedula</label>
                                                <input autocomplete="off" class="form-control" id="number_id"
                                                    name="number_id" type="text" value="">
                                                <i class="bi bi-envelope st-icon"></i>
                                            </div>
                                        </diV>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Correo
                                                    electronico</label>
                                                <input autocomplete="off" class="form-control" id="email"
                                                    name="email" type="text" value="">
                                                <i class="bi bi-envelope st-icon"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Numero de
                                                    tarjeta</label>
                                                <input autocomplete="off" class="form-control" id="number_card"
                                                    name="number_card" type="text" value="">
                                                <i class="bi bi-envelope st-icon"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Codigo de
                                                    tarjeta</label>
                                                <input autocomplete="off" class="form-control" id="code_card"
                                                    name="code_card" type="text" value="">
                                                <i class="bi bi-envelope st-icon"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Monto</label>
                                                <input readonly autocomplete="off" class="form-control" id="amount"
                                                    name="amount" type="text" value="">
                                                <i class="bi bi-envelope st-icon"></i>
                                            </div>
                                        </diV>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl--8 mt-3 mb-3"
                                        style="display: flex; justify-content: space-around;">
                                        <input class="btn btnSave send " value="Pagar" type="submit"
                                            style="margin-left: 20px" />
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
