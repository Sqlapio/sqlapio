@extends('layouts.app-auth')
@section('title', 'Pacientes')
<script src="{{ asset('assets/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/locales/bootstrap-datepicker.es.min.js') }}"></script>
<script src="{{ asset('jquery-validation-1.19.5/dist/jquery.validate.min.js') }}" type="text/javascript"></script>
<style>
    body {
        font-family: 'Roboto', 'Inter', "Helvetica Neue", Helvetica, 'Source Sans Pro' !important;
        letter-spacing: -.022em;
        color: #1d1d1f;
    }

    .borde {
        border-radius: 0 !important;

    }

    .patients-div p {
        text-align: justify;
        border-bottom: 1px dotted #ccc;
        font-size: 12px;
        margin: 0;
        padding: 3px;
        border-bottom: 0;
        min-height: 20px;
        margin-bottom: 5px;
    }

    .img img {
        max-height: 220px;
        text-align: left;
        margin-right: 70%;
    }

    .button-patients-padre {
        display: flex
    }

    .button-patients-hijo {
        margin: 5px 5px 5px 5px;
        height: 10px;
        margin-top: 20px;
    }

    .bnt2 {
        height: 10px;
        font-size: 10px !important;
    }

    #table-patients table {
        font-size: 12px;
    }

    @media screen and (max-width: 600px) {
        #btns1 {
            margin: 5px 5px 5px 5px;
        }

        /* #btns2{
            margin: 5px 5px 5px 5px;
        } */
        .btns {
            margin-top: 20px !important;
        }

        #btns4 {
            margin: 5px 19px 5px 5px;
        }

        .btn6 {
            margin-top: 20px !important;
        }

    }
</style>
<script>
    let pathologiesArray = [];
    $(document).ready(() => {
        $("#alert").hide()

        $('#form-patients').validate({
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
                // pathologies: {
                //     required: true,
                // },
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
            },


        })

        $.validator.addMethod("onlyNumber", function(value, element) {
            var pattern = /^\d+\.?\d*$/;
            return pattern.test(value);
        }, "Campo solo numero");

        //envio del formulario
        $("#form-patients").submit(function(event) {
            event.preventDefault();
            $("#form-patients").validate();
            if ($("#form-patients").valid()) {
                $('#send').hide();
                $('#spinner').show();
                var data = $('#form-patients').serialize();
                $.ajax({
                    url: '{{ route('register-patients') }}',
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
    let active = true;
    $('#datepicker').datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        autoclose: true
    });

    function showTable() {
        if (active) {
            $('#grip-patients').hide();
            $('#table-patients').show();
            $('#btns1').show();
            $('#btns2').show();
            $('#btns2').show();
            $('#btns4').show();
            $('#btnShow').text('Ver listados');
            active = false;
        } else {
            $('#table-patients').hide();
            $('#grip-patients').show();
            $('#btnShow').text('Vista Tarjetas');
            $('#btns1').hide();
            $('#btns2').hide();
            $('#btns2').hide();
            $('#btns4').hide();
            active = true;
        }
    }

    function handlerPhandlerPatologia(e, id) {
        if ($(`#${id}`).is(':checked')) {
            pathologiesArray.push(e.target.value);
            console.log(pathologiesArray);
            $('#pathologies').val(pathologiesArray);
        } else {
            pathologiesArray = pathologiesArray.filter(elem => elem !== e.target.value);
            $('#pathologies').val(pathologiesArray);
        }
    }
</script>

@section('content')
    <div>
        <div class="container-fluid text-center body">
            <div class="row">
                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header">
                            <span>Aseguradoras</span>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-control" style="display: flex">
                                    <div style="margin-right: 15px;">
                                        <input checked="checked" name="chkSociedades[]" type="checkbox" id="Soc0">
                                    </div>
                                    <div>
                                        <span style="font-size: 15px;">Todas</span><br>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10 md-10 lg-10 xl-10 xxl-10" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header collapseBtn">
                            <i class="bi bi-search"></i>
                            <span>Búsqueda de pacientes</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3 collapseBtn">
                                    <label style="font-size: 15px;"> Introduzca un criterio de búsqueda: </label>
                                </div>
                                <div class="col-sm-7 md-7 lg-7 xl-7 xxl-7">
                                    <div id="divFloatingGroupPacienteBuscador" class="floating-label-group margin-top-0">
                                        <input id="txtBuscador" type="text" class="form-control ui-autocomplete-input"
                                            placeholder="Apellidos, NIF, Teléfono, Nº Historia" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-1 md-1 lg-1 xl-1 xxl-1 btns">
                                    <button id="BtnBuscar" type="button" class="btn btnPrimary"><span
                                            class="glyphicon glyphicon-search"></span> Buscar </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-end">
                <div class="col-sm-10 md-10 lg-10 xl-10 xxl-10" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header collapseBtn">
                            <i class="bi bi-plus-lg"></i>
                            <button class="" data-bs-toggle="collapse" data-bs-target="#collapseExample"
                                aria-expanded="false" aria-controls="collapseExample">
                                Nuevo paciente. Datos mínimos
                            </button>
                        </div>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body borde">
                                <form id="form-patients" method="post" action="/">
                                    {{ csrf_field() }}
                                    <div class="row">

                                        <div id="alert" class="alert alert-success">

                                        </div>
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
                                                        id="name" name="name" type="text" value="">
                                                    <i class="bi bi-person-circle"></i>
                                                </div>
                                            </diV>
                                        </div>
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <input autocomplete="off" placeholder="Apellidos"
                                                        class="form-control @error('last_name') is-invalid @enderror"
                                                        id="last_name" name="last_name" type="text" value="">
                                                    <i class="bi bi-person-circle"></i>
                                                </div>
                                            </diV>
                                        </div>
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <input autocomplete="off" placeholder="Cedula de indentidad"
                                                        class="form-control @error('ci') is-invalid @enderror"
                                                        id="ci" name="ci" type="text" value="">
                                                    <i class="bi bi-telephone"></i>
                                                </div>
                                            </diV>
                                        </div>
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                            <div class="floating-label-group">
                                                <input placeholder="Fecha de Nacimiento" class="form-control "
                                                    id="birthdate" id="datepicker" name="birthdate" type="date"
                                                    value="">
                                            </div>
                                        </diV>
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                            <div class="floating-label-group">
                                                <div class="Icon-inside">
                                                    <select name="genere" id="genere"
                                                        placeholder="Seleccione"class="form-control @error('genere') is-invalid @enderror"
                                                        class="form-control combo-textbox-input">
                                                        <option value="">Seleccione Genero</option>
                                                        <option value="femenino"> Femenino</option>
                                                        <option value="masculino">Masculino</option>
                                                    </select>
                                                    <i class="bi bi-gender-ambiguous"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <input autocomplete="off" placeholder="Correo Electronico"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="email" name="email" type="text" value="">
                                                    <i class="bi bi-person-circle"></i>
                                                </div>
                                            </diV>
                                        </div>


                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <input autocomplete="off" placeholder="Edad"
                                                        class="form-control @error('age') is-invalid @enderror"
                                                        id="age" name="age" type="text" value="">
                                                    <i class="bi bi-person-circle"></i>
                                                </div>
                                            </diV>
                                        </div>

                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                            <div class="floating-label-group">
                                                <div class="Icon-inside">
                                                    <select name="state" id="state" class="form-control">
                                                        <option value="">Seleccione el estado</option>
                                                        <option value="distro_captial">Distro Captial</option>
                                                        <option value="aragua">Aragua</option>
                                                        <option value="carabobo">Carabobo</option>
                                                    </select>
                                                    <i class="bi bi-gender-ambiguous"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                            <div class="floating-label-group">
                                                <div class="Icon-inside">
                                                    <select name="city" id="city" class="form-control">
                                                        <option value="">Seleccione la ciudad</option>
                                                        <option value="Caracas">Caracas</option>
                                                        <option value="valencia">valencia</option>
                                                        <option value="valencia">Maracay</option>
                                                    </select>
                                                    <i class="bi bi-gender-ambiguous"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <input autocomplete="off" placeholder="Dirección"
                                                        class="form-control @error('address') is-invalid @enderror"
                                                        id="address" name="address" type="text" value="">
                                                    <i class="bi bi-person-circle"></i>
                                                </div>
                                            </diV>
                                        </div>

                                        <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <input autocomplete="off" placeholder="Codigo de Area"
                                                        class="form-control @error('zip_code') is-invalid @enderror"
                                                        id="zip_code" name="zip_code" type="text" value="">
                                                    <i class="bi bi-person-circle"></i>
                                                </div>
                                            </diV>
                                        </div>

                                        <input type="hidden" name="pathologies[]" id="pathologies" value="">

                                        <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                            <div class="floating-label-group">
                                                <div class="form-check" style="display: flex; ">
                                                    <div style="margin-right: 30px;">
                                                        <input onclick="handlerPhandlerPatologia(event,'Diabete');"
                                                            class="form-check" name="checked" type="checkbox"
                                                            id="Diabete" value="Diabete">
                                                    </div>
                                                    <div>
                                                        <label style="font-size: 15px;" class="form-check-label"
                                                            for="flexCheckDefault">
                                                            Diabete
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-check" style="display: flex; ">
                                                    <div style="margin-right: 30px;">
                                                        <input onclick="handlerPhandlerPatologia(event,'Himpertencion');"
                                                            value="Himpertencion" class="form-check" name="checked"
                                                            type="checkbox" id="Himpertencion">
                                                    </div>
                                                    <div>
                                                        <label style="font-size: 15px;" class="form-check-label"
                                                            for="flexCheckDefault">
                                                            Hipertensión
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-check" style="display: flex; ">
                                                    <div style="margin-right: 30px;">
                                                        <input onclick="handlerPhandlerPatologia(event,'Dermatología');"
                                                            value="Dermatología" class="form-check" name="checked"
                                                            type="checkbox" id="Dermatología">
                                                    </div>
                                                    <div>
                                                        <label style="font-size: 15px;" class="form-check-label"
                                                            for="flexCheckDefault">
                                                            Dermatología
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-check" style="display: flex; ">
                                                    <div style="margin-right: 30px;">
                                                        <input onclick="handlerPhandlerPatologia(event,'Osteoporozis');"
                                                            value="Osteoporozis" class="form-check" name="checked"
                                                            type="checkbox" id="Osteoporozis">
                                                    </div>
                                                    <div>
                                                        <label style="font-size: 15px;" class="form-check-label"
                                                            for="flexCheckDefault">
                                                            Osteoporosis 
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-check" style="display: flex; ">
                                                    <div style="margin-right: 30px;">
                                                        <input onclick="handlerPhandlerPatologia(event,'Fiebre_Amarilla');" value="Fiebre_Amarilla"
                                                            class="form-check" name="checked" type="checkbox"
                                                            id="Fiebre_Amarilla">
                                                    </div>
                                                    <div>
                                                        <label style="font-size: 15px;" class="form-check-label"
                                                            for="flexCheckDefault">
                                                            Fiebre Amarilla
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div style="margin-top: 20px;" class="row">
                                        <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                            <div id="spinner" style="display: none">
                                                <x-load-spinner show="true" />
                                            </div>
                                            <input class="btn btnPrimary send " value="Enviar" type="submit" />

                                        </div>
                                        <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                            <button type="button" class="btn btnSecond">Cancelar</button>

                                        </div>
                                    </div>
                                </form>

                            </diV>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-end">
                <div class="col-sm-10 md-10 lg-10 xl-10 xxl-10" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header collapseBtn">
                            <i class="bi bi-card-list"></i>
                            <span>Resultados de la búsqueda:</span>
                        </div>
                        <div class="card-body">
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <select id="" name="FiltroPacientes" class="form-control"
                                            style="width: 250px !important">
                                            <option value="25">25 Registros máximos a recuperar</option>
                                            <option value="50">50 Registros máximos a recuperar</option>
                                            <option value="100" selected="">100 Registros máximos a recuperar
                                            </option>
                                            <option value="1000">1.000 Registros máximos a recuperar</option>
                                            <option value="5000">5.000 Registros máximos a recuperar</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-8 md-8 lg-8 xl-8 xxl-8 btns" style="font-size:10px;">
                                        <button style="display:none" type="button" class="btn btnPrimary"
                                            id="btns1"><i class="bi bi-card-list"></i> Seleccione</button>
                                        <button style="display:none" type="button" class="btn btnPrimary"
                                            id="btns2"><i class="bi bi-card-list"></i> Exportar todos los ccv</button>
                                        <button id="btns4" style="display:none" type="button"
                                            class="btn btnPrimary" id="btns3"><i class="bi bi-card-list"></i>
                                            Exportar vistas los ccv</button>
                                        <button type="button" id="btnShow" class="btn btnPrimary"
                                            onclick="showTable()"><i class="bi bi-card-list"></i> Ver
                                            listados</button>
                                    </div>

                                </div>

                                <hr>

                                <div class="row" id="grip-patients">
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4" style="margin-top: 20px:">
                                        <div class="patients-div">
                                            <p style="margin-top: 20px;" class="tabF"><a href="#">Gustavo
                                                    Camacho</a></p>
                                            <div class="img">
                                                <img id="imgPaciente2"
                                                    src="{{ asset('img/People-Client-Male-icon.png') }}"
                                                    alt="Imagen del paciente" class="img-responsive"
                                                    style="width:85px; height:64px;">
                                            </div>
                                            <p>Tef: 04127018390</p>
                                            <p>Male</p>
                                            <p>Nº Historia: 2</p>
                                            <p>Private patient</p>
                                            <p>F.Nac: domingo, 1 de enero de 1984</p>
                                            <p>No eMail</p>
                                            <hr>
                                            <div class="button-patients-padre">
                                                <div class="button-patients-hijo">
                                                    <button type="button" class="btn  bnt2 btnPrimary">Citar
                                                        Paciente</button>
                                                </div>
                                                <div class="button-patients-hijo">
                                                    <a href="{{ route('MedicalRecord') }}">
                                                        <button type="button" class="btn bnt2 btnPrimary">Más
                                                            información</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4" style="margin-top: 20px:">
                                        <div class="patients-div">
                                            <p style="margin-top: 20px;" class="tabF"><a href="#">Pdero
                                                    Perez</a></p>
                                            <div class="img">
                                                <img id="imgPaciente2"
                                                    src="{{ asset('img/People-Client-Male-icon.png') }}"
                                                    alt="Imagen del paciente" class="img-responsive"
                                                    style="width:85px; height:64px;">
                                            </div>
                                            <p>Tef: 04127018390</p>
                                            <p>Male</p>
                                            <p>Nº Historia: 2</p>
                                            <p>Private patient</p>
                                            <p>F.Nac: domingo, 1 de enero de 1984</p>
                                            <p>No eMail</p>
                                            <hr>

                                            <div class="button-patients-padre">
                                                <div class="button-patients-hijo">
                                                    <button type="button" class="btn  bnt2 btnPrimary">Citar
                                                        Paciente</button>
                                                </div>
                                                <div class="button-patients-hijo">
                                                    <a href="{{ route('MedicalRecord') }}">
                                                        <button type="button" class="btn bnt2 btnPrimary">Más
                                                            información</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4" style="margin-top: 20px;">
                                        <div class="patients-div">
                                            <p class="tabF"><a href="#">Wilfredo
                                                    Palencia</a>
                                            </p>
                                            <div class="img">
                                                <img id="imgPaciente2"
                                                    src="{{ asset('img/People-Client-Male-icon.png') }}"
                                                    alt="Imagen del paciente" class="img-responsive"
                                                    style="width:85px; height:64px;">
                                            </div>
                                            <p>Tef: 04127018390</p>
                                            <p>Male</p>
                                            <p>Nº Historia: 2</p>
                                            <p>Private patient</p>
                                            <p>F.Nac: domingo, 1 de enero de 1984</p>
                                            <p>No eMail</p>
                                            <hr>
                                            <div class="button-patients-padre">
                                                <div class="button-patients-hijo">
                                                    <button type="button" class="btn  bnt2 btnPrimary">Citar
                                                        Paciente</button>
                                                </div>
                                                <div class="button-patients-hijo">
                                                    <a href="{{ route('MedicalRecord') }}">
                                                        <button type="button" class="btn bnt2 btnPrimary">Más
                                                            información</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row" style="display: none" id="table-patients">
                                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12" style="margin-top: 20px:">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Nº Historia</th>
                                                    <th scope="col">Aseguradora</th>
                                                    <th scope="col">Teléfono 1</th>
                                                    <th scope="col">Género</th>
                                                    <th scope="col">Fecha de Nacimiento </th>
                                                    <th scope="col">NIF</th>
                                                    <th scope="col">Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Gustavo Camacho</td>
                                                    <td>1</td>
                                                    <td>Private patient</td>
                                                    <td>04127018390</td>
                                                    <td>Male</td>
                                                    <td>domingo, 1 de enero de 1984</td>
                                                    <td>16413109</td>
                                                    <td>wilfredopalenciabb@gmail.com</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Jhonny Martinez</td>
                                                    <td>2</td>
                                                    <td>Private patient</td>
                                                    <td>04127018390</td>
                                                    <td>Male</td>
                                                    <td>domingo, 1 de enero de 1984</td>
                                                    <td>16413109</td>
                                                    <td>wilfredopalenciabb@gmail.com</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td>Wilfredo Palencia</td>
                                                    <td>3</td>
                                                    <td>Matrix</td>
                                                    <td>04127018390</td>
                                                    <td>Male</td>
                                                    <td>domingo, 1 de enero de 1984</td>
                                                    <td>16413109</td>
                                                    <td>wilfredopalenciabb@gmail.com</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row">

                                    <div style="margin-top: 50px; " class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="alert alert-info" role="alert">
                                            <p>Número total de pacientes recuperados: 3</p>
                                        </div>
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
