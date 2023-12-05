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

    .aa.list-group-item.active {
        background-color: #748b4e !important;
        border-color: #748b4e !important;
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


            let family_back = @json($family_back);
            let get_condition = @json($get_condition);
            let non_pathology_back = @json($non_pathology_back);
            let vital_sing = @json($vital_sing);
            let pathology_back = @json($pathology_back);


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
                                            <br>
                                            <small>Nº Historial:</small><span class="text-capitalize"> ${ response[0].cod_history} </span>                                          
                                        </div>`;
                                    $('#div-content').find('#info-pat').append(e);
                                    //end   

                                    // Examen fisico 
                                    $('.Examen_fisico').empty();
                                    let Examen_fisico = `
                                    <div class="row p-3">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                <ul class="list-group list-group-flush overflow-auto">
                                                    <a href="#" class="list-group-item aa list-group-item-action  active"
                                                        aria-current="true">
                                                        <div class="d-flex w-100 justify-content-between">
                                                        <h5 class="mb- text-capitalize">Examen Físico</h5>                                   
                                                        </div>
                                                    </a>

                                                    <a href="#" class="list-group-item list-group-item-action"
                                                        aria-current="true">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <small>Peso:</small><span >${ response[0].weight}</span>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="list-group-item list-group-item-action"
                                                        aria-current="true">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <small>Altura :</small><span >${ response[0].height}</span>   
                                                        </div>
                                                    </a>
                                                    <a href="#" class="list-group-item list-group-item-action"
                                                        aria-current="true">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <small>Presión arterial:</small><span >${ response[0].strain}</span>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="list-group-item list-group-item-action"
                                                        aria-current="true">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <small>Tempetura:</small><span >${ response[0].temperature}</span>   
                                                        </div>
                                                    </a>
                                                    <a href="#" class="list-group-item list-group-item-action"
                                                        aria-current="true">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <small>Respiraciones:</small><span >${ response[0].breaths}</span>   
                                                        </div>
                                                    </a>
                                                    <a href="#" class="list-group-item list-group-item-action"
                                                        aria-current="true">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <small>Pulso:</small><span >${ response[0].pulse}</span>   
                                                        </div>
                                                    </a>
                                                    <a href="#" class="list-group-item list-group-item-action"
                                                        aria-current="true">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <small>Saturación:</small><span >${ response[0].saturation}</span>   
                                                        </div>
                                                    </a>
                                                    <a href="#" class="list-group-item list-group-item-action"
                                                        aria-current="true">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <small>Condición genera:</small><span >${ response[0].condition}</span>   
                                                        </div>
                                                    </a>
                                                    <a href="#" class="list-group-item list-group-item-action"
                                                        aria-current="true">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <small>Motivo de la consulta:</small><span >${ response[0].reason}</span>   
                                                        </div>
                                                    </a>
                                                    <a href="#" class="list-group-item list-group-item-action"
                                                        aria-current="true">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <small>Enfermedad Actual:</small><span >${ response[0].current_illness}</span>   
                                                        </div>
                                                    </a>                                             

                                                </ul>
                                            </div>
                                        </div>
                                    `
                                    $('.Examen_fisico').append(Examen_fisico);
                                    // end

                                    // Antecedentes Personales y Familiares
                                    $('.family_back').empty();
                                    family_back.map((value, keyy) => {
                                        for (const [key, val] of Object.entries(
                                                response[0])) {

                                            if (key == value.name) {
                                                if (val != null) {
                                                    $('.family_back').append(
                                                        `<a href="#" class="${key} list-group-item list-group-item-action" aria-current="true"> <div class="d-flex w-100 justify-content-between"><small>${value.text}</small></div></a>`
                                                    );
                                                }
                                            };
                                        }
                                    });
                                    //end

                                    // Antecedentes personales patológicos
                                    $('.pathology_back').empty();
                                    pathology_back.map((value, keyy) => {
                                        for (const [key, val] of Object.entries(
                                                response[0])) {

                                            if (key == value.name) {
                                                if (val != null) {

                                                    $('.pathology_back').append(
                                                        `<a href="#" class="list-group-item list-group-item-action" aria-current="true"> <div class="d-flex w-100 justify-content-between"><small>${value.text}</small></div></a>`
                                                    );
                                                }

                                            };
                                        }
                                    });
                                    // end

                                    // historia Antecedentes personales no patológicos
                                    $('.non_pathology_back').empty();
                                    non_pathology_back.map((value, keyy) => {
                                        for (const [key, val] of Object.entries(
                                                response[0])) {

                                            if (key == value.name) {
                                                if (val != null) {
                                                    $('.non_pathology_back')
                                                        .append(
                                                            `<a href="#" class="list-group-item list-group-item-action" aria-current="true"> <div class="d-flex w-100 justify-content-between"><small>${value.text}</small></div></a>`
                                                        );
                                                }
                                            };
                                        }
                                    });
                                    // end

                                    /// gilecologico
                                    $('.gilecologico').empty()

                                    let gine = `<div class="row p-3">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <ul class="list-group list-group-flush overflow-auto">
                                    <a href="#" class="list-group-item aa list-group-item-action  active"
                                    aria-current="true">
                                    <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb- text-capitalize">Antecedentes ginecologicos (si aplica) </h5>                                   
                                    </div>
                                    </a>

                                    <a href="#" class="list-group-item list-group-item-action"
                                    aria-current="true">
                                    <div class="d-flex w-100 justify-content-between">
                                    <small>Edad de primera menstruación:</small><span >${ response[0].edad_primera_menstruation}</span>
                                    </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action"
                                    aria-current="true">
                                    <div class="d-flex w-100 justify-content-between">
                                    <small>Fecha último periodo :</small><span >${ response[0].fecha_ultima_regla}</span>   
                                    </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action"
                                    aria-current="true">
                                    <div class="d-flex w-100 justify-content-between">
                                    <small>Número de embarazos:</small><span >${ response[0].numero_embarazos}</span>
                                    </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action"
                                    aria-current="true">
                                    <div class="d-flex w-100 justify-content-between">
                                    <small>Número de partos:</small><span >${ response[0].numero_embarazos}</span>   
                                    </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action"
                                    aria-current="true">
                                    <div class="d-flex w-100 justify-content-between">
                                    <small>Número de cesáreas:</small><span >${ response[0].cesareas}</span>   
                                    </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action"
                                    aria-current="true">
                                    <div class="d-flex w-100 justify-content-between">
                                    <small>Número de abortos:</small><span >${ response[0].numero_abortos}</span>   
                                    </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action"
                                    aria-current="true">
                                    <div class="d-flex w-100 justify-content-between">
                                    <small>Utiliza algún método anticonceptivo, ¿Cual?:</small><span >${ response[0].pregunta}</span>   
                                    </div>
                                    </a>        
                                    </ul>
                                    </div>
                                    </div>`

                                    $('.gilecologico').append(gine)

                                    //// end

                                    /// alegias
                                    $('.list-alergias').empty();
                                    response[0].allergies.map((e, key) => {
                                        $('.list-alergias').append(
                                            `<a href="#" class=" ${key} list-group-item list-group-item-action" aria-current="true"> <div class="d-flex w-100 justify-content-between"><small>${e.type_alergia} ,${e.detalle_alergia}</small></div></a>`
                                            );
                                    });

                                    //end

                                    /// cirugias
                                    $('.list-cirugias').empty();
                                    response[0].history_surgical.map((e, key) => {
                                        $('.list-cirugias').append(
                                            `<a href="#" class=" ${key} list-group-item list-group-item-action" aria-current="true"> <div class="d-flex w-100 justify-content-between"><small>${e.cirugia} ,${e.datecirugia}</small></div></a>`
                                            );

                                    });
                                    //end

                                    /// medicamentos
                                    $('.list-medicamentos').empty();
                                    response[0].medications_supplements.map((e,
                                        key) => {
                                        $('.list-medicamentos').append(
                                            `<a href="#" class=" ${key} list-group-item list-group-item-action" aria-current="true"> <div class="d-flex w-100 justify-content-between"><small>${e.dose} ,${e.medicine}, ${e.patologi} , ${e.viaAdmin} , ${e.dateIniTreatment} , ${e.dateEndTreatment} , ${e.treatmentDuration}</small></div></a>`
                                            );
                                    });
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
                                        <br>
                                        <small>Razón de la  consulta:</small> <strong>${e.razon}</strong>
                                        <br>
                                        <small>Diagnostico:</small> <strong>${e.diagnosis}</strong>
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
                                        <br>
                                        <small>Razón de la  consulta:</small> <strong>${e.razon}</strong>
                                        <br>
                                        <small>Diagnostico:</small> <strong>${e.diagnosis}</strong>
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
                                            <div class="div-overflow">

                                                <div class="Examen_fisico"></div>

                                                <div class="row p-3 mt-3">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                        <ul class="list-group list-group-flush overflow-auto">
                                                            <a href="#"
                                                                class=" 0 list-group-item aa list-group-item-action  active"
                                                                aria-current="true">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 class="mb- text-capitalize">Antecedentes
                                                                        Personales y Familiares</h5>
                                                                </div>
                                                            </a>
                                                            <div class="family_back">

                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>


                                                <div class="row p-3 mt-3">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                        <ul class="list-group list-group-flush overflow-auto">
                                                            <a href="#"
                                                                class=" 0 list-group-item aa list-group-item-action  active"
                                                                aria-current="true">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 class="mb- text-capitalize">Antecedentes
                                                                        personales patológicos</h5>
                                                                </div>
                                                            </a>
                                                            <div class="pathology_back ">

                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="row p-3 mt-3">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                        <ul class="list-group list-group-flush overflow-auto">
                                                            <a href="#"
                                                                class=" 0 list-group-item aa list-group-item-action  active"
                                                                aria-current="true">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 class="mb- text-capitalize">Antecedentes no
                                                                        patológicos</h5>
                                                                </div>
                                                            </a>
                                                            <div class="non_pathology_back ">

                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="gilecologico mt-3">

                                                </div>


                                                <div class="row p-3 mt-3">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                        <ul class="list-group list-group-flush overflow-auto">
                                                            <a href="#"
                                                                class=" 0 list-group-item aa list-group-item-action  active"
                                                                aria-current="true">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 class="mb- text-capitalize">Antecedentes alérgicos
                                                                    </h5>
                                                                </div>
                                                            </a>
                                                            <div class="list-alergias ">

                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="row p-3 mt-3">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                        <ul class="list-group list-group-flush overflow-auto">
                                                            <a href="#"
                                                                class=" 0 list-group-item aa list-group-item-action  active"
                                                                aria-current="true">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 class="mb- text-capitalize">Antecedentes quirúrgicos
                                                                    </h5>
                                                                </div>
                                                            </a>
                                                            <div class="list-cirugias">

                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="row p-3 mt-3">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                        <ul class="list-group list-group-flush overflow-auto">
                                                            <a href="#"
                                                                class=" 0 list-group-item aa list-group-item-action  active"
                                                                aria-current="true">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 class="mb- text-capitalize">Medicamentos
                                                                    </h5>
                                                                </div>
                                                            </a>
                                                            <div class="list-medicamentos">

                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>


                                        </section>
                                        <h3>Consultas medicas</h3>
                                        <section>
                                            <div class="list-group list-con div-overflow">
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
