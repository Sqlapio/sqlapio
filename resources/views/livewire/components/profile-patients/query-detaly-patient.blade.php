@extends('layouts.app')
@section('title', 'Gestión paciente')
<style>
    body {
        /* font-family: 'Roboto', 'Inter', "Helvetica Neue", Helvetica, 'Source Sans Pro' !important; */
        letter-spacing: -.022em;
        color: #1d1d1f;
    }
    .div-overflow {
        overflow: scroll;
        height: 100%;
    }

    ul {
        list-style-type: none;
    }

    .data-medical small {
        font-size: 66%
    }

    .list-group-item.active {

        background-color: #47525E !important;
        border-color: #47525E !important;
    }
</style>
@push('scripts')
    <script>
        $(document).ready(() => {
            $("#wizard").steps({
                headerTag: "h3",
                cssClass: "wizard",
                bodyTag: "section",
                transitionEffect: "slideLeft",
                autoFocus: true,
                enableAllSteps: true,
                enablePagination: false,
            });
            ////
            $('#form-detaly-patient').validate({
                rules: {
                    ci: {
                        required: true,
                        minlength: 5,
                        maxlength: 8,
                        onlyNumber: true
                    },

                    birthdate: {
                        required: true,
                    },

                },
                messages: {

                    ci: {
                        required: "Cédula de identidad es obligatoria",
                        minlength: "Cédula de identidad  debe ser mayor a 5 caracteres",
                        maxlength: "Cédula de identidad  debe ser menor a 8 caracteres",
                    },

                    birthdate: {
                        required: "Fecha de nacimiento es obligatorio",
                    }
                }
            });

            $.validator.addMethod("onlyNumber", function(value, element) {
                var pattern = /^\d+\.?\d*$/;
                return pattern.test(value);
            }, "Campo numérico");


            //envio del formulario
            $("#form-detaly-patient").submit(function(event) {
                event.preventDefault();
                $("#form-detaly-patient").validate();
                if ($("#form-detaly-patient").valid()) {

                    var data = $('#form-detaly-patient').serialize();
                    $.ajax({
                        url: "{{ route('search-detaly-patient') }}",
                        type: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {

                            if (response.length > 0) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Paciente registrado exitosamente!',
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#42ABE2',
                                    confirmButtonText: 'Aceptar'
                                }).then((result) => {
                                    //mostar datos el paciente 
                                    $('#div-content').find('#info-pat').empty();
                                    let ulr_img = "{{ URL::asset('/imgs/') }}";
                                    let img = ''
                                    if (response[0].img != null) {
                                        img = `${ulr_img}/${response[0].img}`;
                                    } else {

                                        img = (response[0].genere == 'femenino') ?
                                            "{{ URL::asset('/img/avatar/avatar mujer.png') }}" :
                                            "{{ URL::asset('/img/avatar/avatar hombre.png') }}";

                                    }
                                    let e = ` <div class="col-sm-2 col-md-3 col-lg-2 col-xl-2 col-xxl-2" style="width: 162px;">
                                            <img src="${img}"
                                                width="150" height="150" alt="Imagen del paciente" class="img-medical">
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 data-medical">
                                            <small>Nombre Completo:</small><span class="text-capitalize">
                                                ${ response[0].full_name}</span>
                                            <br>
                                            <small>Fecha de Nacimiento:</small><br><span>${response[0].birthdate }</span>
                                            <br>
                                            <small>Edad:</small><span> ${ response[0].age } años</span>
                                            <br>
                                            <small>C.I:</small><span> ${ response[0].ci} </span>
                                            <br>
                                            <small>Genero:</small><span class="text-capitalize"> ${ response[0].genere} </span>                                           
                                        </div>`;
                                    $('#div-content').find('#info-pat').append(e);
                                    //end   
                                    //mostar resumen de la historia
                                    $('#numero-hist').text(response[0].cod_history);
                                    $('#peso').text(response[0].weight);
                                    $('#altura').text(response[0].height);
                                    $('#presion').text(response[0].strain);

                                    //end

                                    //mostrar consultas
                                    $('#div-content').show();
                                    $('.list-con').empty();
                                    $('.ul-exmen').empty();
                                    $('.ul-study').empty();

                                    response[0].info_medical_record.map((e, key) => {
                                        let element = '';
                                        if ((key % 2) == 0) {
                                            element = `<a href="#" class="list-group-item list-group-item-action  active ${key}"
                                        aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb- text-capitalize">Médico: ${e.doctor} </h5><br>
                                        </div>
                                        <small>Especialidad:</small> <strong>${e.specialty}</strong><br>
                                        <small>Código de consulta:</small> <strong>${e.record_code}</strong>
                                        <br>
                                        <small>Fecha de consulta:</small> <strong>${e.record_date}</strong>
                                        </a>`
                                        } else {
                                            element = `<a href="#" class="list-group-item list-group-item-action  ${key}"
                                        aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb- text-capitalize">Médico: ${e.doctor} </h5><br>
                                        </div>
                                        <small>Especialidad:</small> <strong>${e.specialty}</strong><br>
                                        <small>Código de consulta:</small> <strong>${e.record_code}</strong>
                                        <br>
                                        <small>Fecha de consulta:</small> <strong>${e.record_date}</strong>
                                        </a>`
                                        }
                                        $('.list-con').append(element);
                                        /// data estudios

                                        e.study_medical.map((item, i) => {
                                            let et = '';
                                            if ((i % 2) == 0) {
                                                et = `<li style="padding: 10px 10px 10px 10px" class="list-group-item  ${i}" aria-current="true">${item.description} ${item.record_code}</li>`
                                            } else {
                                                et = `<li style="padding: 10px 10px 10px 10px"  class="list-group-item ${i}"" aria-current="true">${item.description} ${item.record_code}</li>`
                                            }
                                            $('.ul-study').append(et);
                                        });
                                        //end

                                        /// data examenes

                                        e.exam_medical.map((item, e) => {
                                            let ett = '';
                                            if ((e % 2) == 0) {
                                                ett =
                                                    `<li style="padding: 10px 10px 10px 10px"  class="list-group-item  ${e}" aria-current="true">${item.description} ${item.record_code}</li>`
                                            } else {
                                                ett =
                                                    `<li style="padding: 10px 10px 10px 10px"  class="list-group-item ${e}" aria-current="true">${item.description} ${item.record_code}</li>`
                                            }
                                            $('.ul-exmen').append(ett);
                                        });
                                        //end
                                    });
                                    //end

                                });
                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Paciente no encontrado!',
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#42ABE2',
                                    confirmButtonText: 'Aceptar'
                                });
                            }
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
                                    $('#btn-save').attr('disabled', false);
                                    $('#spinner2').hide();
                                    $(".holder").hide();
                                });
                            });
                        }
                    });
                }
            });
        })
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid body" style="padding: 0 3% 3%">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                    <div class="card mt-3 card-ex">
                        <div class="card-body">
                            <form id="form-detaly-patient" method="post" action="">
                                {{ csrf_field() }}

                                <div class="row mt-3">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <h5>Consultar Historial del paciente</h5>

                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                        <div class="form-group">
                                            <label for="ci"
                                                class="form-label"style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Ingrese
                                                número de identificación</label>
                                            <input maxlength="10" type="text" class="form-control mask-only-number"
                                                id="ci" name="ci" placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                        <div class="form-group">
                                            <label for="phone" class="form-label"
                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Fecha
                                                de
                                                Nacimiento</label>
                                            <input class="form-control date-bd" id="birthdate" name="birthdate"
                                                type="date" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                        <input class="btn btnSave send" id="btn-save" value="Consultar" type="submit"
                                            style="margin-left: 10px; margin-top: 9%" />
                                    </div>
                                </div>
                            </form>


                            <div class="row mt-5" id="div-content" style="display: none">
                                <hr>
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mb-cd">
                                    <div class="row justify-content-center" id="info-pat"></div>
                                </div>

                                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mb-cd">
                                    <div id="wizard">
                                        <h3>Historia clinica</h3>
                                        <section>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 data-medical">
                                                    <strong>Numero de historia: </strong><span class="text-capitalize"
                                                        id="numero-hist"></span>
                                                    <br>
                                                    <strong>Peso: </strong><span class="text-capitalize"
                                                        id="peso"></span>
                                                    <br>
                                                    <strong>Altura: </strong><span id="altura"></span>
                                                    <br>
                                                    <strong>Presion artirial: </strong><span id="presion"></span>
                                                </div>
                                            </div>
                                        </section>
                                        <h3>Consultas medicas</h3>
                                        <section>
                                            <div class="list-group list-con ">
                                            </div>
                                        </section>
                                        <h3>Estudios Realizados</h3>
                                        <section>
                                            <div class="row p-3 div-overflow">
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                    <ul class="list-group ul-study list-group-flush overflow-auto">
                                                    </ul>
                                                </div>
                                            </div>
                                        </section>
                                        <h3>Examenes Realizados</h3>
                                        <section>
                                            <div class="row p-3 div-overflow">
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                    <ul class="list-group ul-exmen list-group-flush overflow-auto">
                                                    </ul>
                                                </div>
                                            </div>
                                        </section>
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
