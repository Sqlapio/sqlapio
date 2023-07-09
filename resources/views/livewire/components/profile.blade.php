@extends('layouts.app-auth')
@section('title', 'Perfil')
<script src="{{ asset('assets/jquery.js') }}"></script>
<script src="{{ asset('jquery-validation-1.19.5/dist/jquery.validate.min.js') }}" type="text/javascript"></script>
<style>
    .collapseBtn {
        color: #428bca;
    }

    img {
        margin-left: 10px;
        margin-bottom: 15px;
    }
</style>
<script>
    $(document).ready(() => {
        $("#alert").hide()

        $('#form-profile').validate({
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
                ci: {
                    required: true,
                    minlength: 5,
                    maxlength: 8,
                    onlyNumber: true
                },
                genere: {
                    required: true,
                },
                birthdate: {
                    required: true,
                },
                age: {
                    required: true,
                    onlyNumber: true,
                    minlength: 1,
                    maxlength: 3,
                },
                state: {
                    required: true,
                },
                city: {
                    required: true,
                },
                address: {
                    required: true,
                },
                zip_code: {
                    required: true,
                },
                phone: {
                    required: true,
                }               
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
                ci: {
                    required: "Cedula de identidad es obligatoria",
                    minlength: "Cedula de identidad  debe ser mayor a 5 caracteres",
                    maxlength: "Cedula de identidad  debe ser menor a 8 caracteres",
                    // pattern: "pattern",
                },
                genere: {
                    required: "Genero es obligatorio",
                },
                birthdate: {
                    required: "Fecha de nacimiento es obligatorio",
                },
                age: {
                    required: "Edad es obligatoria",
                    minlength: "Edad debe ser mayor a 1 caracteres",
                    maxlength: "Edad debe ser menor a 3 caracteres",
                },
                state: {
                    required: "Esatdo es obligatoria",
                },
                city: {
                    required: "Ciudad es obligatoria",
                },
                address: {
                    required: "Direccion es obligatoria",
                },
                zip_code: {
                    required: "Codigo de area es obligatorio",
                },
                phone: {
                    required: "Telefono de area es obligatorio",
                },
            },


        })

        $.validator.addMethod("onlyNumber", function(value, element) {
            var pattern = /^\d+\.?\d*$/;
            return pattern.test(value);
        }, "Campo solo numero");

        //envio del formulario
        $("#form-profile").submit(function(event) {
            event.preventDefault();
            $("#form-profile").validate();
            if ($("#form-profile").valid()) {
                $('#send').hide();
                $('#spinner').show();
                var data = $('#form-profile').serialize();
                $.ajax({
                    url: '{{ route('update-profile') }}',
                    type: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#send').show();
                        $('#spinner').hide();
                        $("#alert").show()
                        $("#alert").text("Registro Exitioso");
                        $("#form-profile").trigger("reset");
                        setTimeout(() => {
                            $("#alert").hide();
                        }, 3500);
                    },
                    error: function(error) {
                        $('#send').show();
                        $('#spinner').hide();
                        console.log(error.responseJSON.errors);

                    }
                });
            }
        })
    })
</script>
@section('content')
    <div>
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                    <div class="card">
                        <div class="card-body">
                            <x-sidebar :btns="config('sidebar_item.setting')" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-10 md-10 lg-10 xl-10 xxl-10">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="collapseBtn">Datos personales </h5>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3 Form-edit-user">
                                <form id="form-profile" method="post" action="/">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div id="alert" class="alert alert-success"></div>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                @foreach ($errors->all() as $message)
                                                    <span class="text-danger error-span">
                                                        {{ $message }}</span><br />
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <input autocomplete="off" placeholder="Nombres"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        id="name" name="name" type="text" readonly value="{!! !empty($user) ? $user->name : '' !!}">
                                                    <i class="bi bi-person-circle"></i>
                                                </div>
                                            </diV>
                                        </div>
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <input autocomplete="off" placeholder="Apellidos"
                                                        class="form-control @error('last_name') is-invalid @enderror"
                                                        id="last_name" name="last_name" type="text" readonly value="{!! !empty($user) ? $user->last_name : '' !!}">
                                                    <i class="bi bi-person-circle"></i>
                                                </div>
                                            </diV>
                                        </div>
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <input autocomplete="off" placeholder="Cédula de identidad"
                                                        class="form-control @error('ci') is-invalid @enderror"
                                                        id="ci" name="ci" type="text" value="">
                                                        <i class="bi bi-person-vcard"></i>
                                                </div>
                                            </diV>
                                        </div>
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                            <div class="form-group">
                                                <input autocomplete="off" placeholder="Fecha de  Nacimiento"
                                                    class="form-control @error('birthdate') is-invalid @enderror"
                                                    id="birthdate" name="birthdate" type="date" value="" onchange="calculateAge(event,'age')">
                                            </diV>
                                        </div>
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <input autocomplete="off" placeholder="Edad"
                                                        class="form-control @error('age') is-invalid @enderror"
                                                        id="age" name="age" type="text" value="" readonly>
                                                    <i class="bi bi-geo-alt"></i>
                                                </div>
                                            </diV>
                                        </div>
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <input autocomplete="off" placeholder="Correo electrónico"
                                                        class="form-control @error('username') is-invalid @enderror"
                                                        id="username" name="username" type="text" readonly value="{!! !empty($user) ? $user->email : '' !!}">
                                                        <i class="bi bi-envelope-at"></i>
                                                </div>
                                            </diV>
                                        </div>
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <input autocomplete="off" placeholder="Teléfono"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        id="phone" name="phone" type="text" value="">
                                                        <i class="bi bi-telephone-forward"></i>
                                                </div>
                                            </diV>
                                        </div>
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <input autocomplete="off" placeholder="Dirección"
                                                        class="form-control @error('address') is-invalid @enderror"
                                                        id="address" name="address" type="text" value="">
                                                        <i class="bi bi-geo"></i>
                                                </div>
                                            </diV>
                                        </div>

                                
                                        <x-ubigeo />                                                                           

                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <input autocomplete="off" placeholder="Código de area"
                                                        class="form-control @error('zip_code') is-invalid @enderror"
                                                        id="zip_code" name="zip_code" type="text" value="">
                                                        <i class="bi bi-geo"></i>
                                                </div>
                                            </diV>
                                        </div>

                                        <x-upload-image />

                                        <hr>
                                        <div class="row mt-3 justify-content-md-end">
                                            <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                                <input class="btn btnPrimary send " value="Guardar" type="submit" />

                                            </div>
                                            <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                                <button type="button" class="btn btnSecond btn6">Cancelar</button>

                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
