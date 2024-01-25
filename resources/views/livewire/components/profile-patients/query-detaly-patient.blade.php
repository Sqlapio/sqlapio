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
        overflow-x: hidden
    }

    .img-medical {
        border-radius: 20px;
        border: 3px solid #47525e;
        object-fit: cover;
    }

    .wizard>.steps a,
    .wizard>.steps a:hover,
    .wizard>.steps a:active {
        border-radius: 35px !important;
        background: #9dc8e2;
        color: #fff;
        height: 117px;
        font-size: 15px
    }

    .wizard>.content>.body {
        width: 100% !important;
        height: 100% !important;
    }

    .wizard > .content > .body ul > li {
        display: flex !important;
        padding: 7px 22px;
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

    @media (min-width: 1040px) and (max-width: 2100px) {

        .wizard>.steps a,
        .wizard>.steps a:hover,
        .wizard>.steps a:active {
            height: 70px;
        }
    }

    /* @media (min-width: 577px) and (max-width: 885px) {

        .wizard>.steps a,
        .wizard>.steps a:hover,
        .wizard>.steps a:active {
            height: 87px;
        }
    } */

    @media screen and (max-width: 576px) {

        .wizard>.steps>ul>li {
            width: 100% !important;
        }

        .wizard>.steps a,
        .wizard>.steps a:hover,
        .wizard>.steps a:active {
            height: 8%;
            padding: 9px 28px 13px !important;
        }

        .pmv-0 {
            padding: 0 !important;
        }

        .data-medical {
            width: 222px !important;
            font-size: 13px;
        }

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
                    $('#spinner').show();
                    $.ajax({
                        url: "{{ route('search-detaly-patient') }}",
                        type: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.length > 0) {
                                $('#spinner').hide();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Resultado exitoso!',
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
                                    let e = ` 
                                        <div class="col-sm-2 col-md-3 col-lg-2 col-xl-2 col-xxl-2" style="width: 135px;" >
                                            <img src="${img}" width="125" height="125" alt="Imagen del paciente" class="img-medical">
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 data-medical">
                                            <strong>Nombre Completo:</strong><span class="text-capitalize"> ${response[0].full_name}</span>
                                            <br>
                                            <strong>Fecha de Nacimiento:</strong><span> ${response[0].birthdate }</span>
                                            <br>
                                            <strong>Edad:</strong><span> ${response[0].age } años</span>
                                            <br>
                                            <strong>C.I:</strong><span> ${response[0].ci} </span>
                                            <br>
                                            <strong>Genero:</strong><span class="text-capitalize"> ${response[0].genere} </span>  
                                            <br>
                                            <strong>Nº Historial:</strong><span class="text-capitalize"> ${response[0].cod_history} </span>                                          
                                        </div>`;
                                    $('#div-content').find('#info-pat').append(e);
                                    //end   

                                    // Examen fisico 
                                    $('.Examen_fisico').empty();
                                    let Examen_fisico = `
                                    <div class="row p-3">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <ul class="list-group" style="border-radius: 8px;">
                                                <li class="list-group-item active aa" aria-current="true">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h5 style='font-size: 15px;' class="mb-0 text-capitalize">Examen Físico</h5>
                                                    </div>    
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <small>Peso:</small><span >${ response[0].weight} Kg</span>
                                                    </div>                                                
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <small>Altura:</small><span >${ response[0].height}</span>   
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <small>Presión arterial:</small><span >${ response[0].strain}</span>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <small>Tempetura:</small><span >${ response[0].temperature}</span>   
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <small>Respiraciones:</small><span >${ response[0].breaths}</span>   
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <small>Pulso:</small><span >${ response[0].pulse}</span>   
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <small>Saturación:</small><span >${ response[0].saturation}</span>   
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <small>Condición general:</small><span >${ response[0].condition}</span>   
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <small>Motivo de la consulta:</small><span >${ response[0].reason}</span>   
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <small>Enfermedad Actual:</small><span >${ response[0].current_illness}</span>   
                                                    </div>
                                                </li>                                   
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
                                                        `<li class="${key} list-group-item" aria-current="true" > 
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <small>${value.text}</small>
                                                            </div>
                                                        </li>`
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
                                                        `<li class="list-group-item" aria-current="true"j> 
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <small>${value.text}</small>
                                                            </div>
                                                        </li>`
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
                                                            `<li class="list-group-item" aria-current="true">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <small>${value.text}</small>
                                                                </div>
                                                            </li>`
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
                                        <ul class="list-group" style="border-radius: 8px;">
                                            <li class="list-group-item active aa" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 style='font-size: 15px;' class="mb-0 text-capitalize">Antecedentes ginecologicos (si aplica) </h5>                                   
                                                </div>
                                            </li>

                                            <li class="list-group-item" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <small>Edad de primera menstruación:</small><span >${ response[0].edad_primera_menstruation}</span>
                                                </div>
                                            </li>
                                            <li class="list-group-item"
                                                aria-current="true">
                                                    <div class="d-flex w-100 justify-content-between">
                                                <small>Fecha último periodo :</small><span >${ response[0].fecha_ultima_regla}</span>   
                                            </div>
                                            </li>
                                            <li class="list-group-item"
                                                aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <small>Número de embarazos:</small><span >${ response[0].numero_embarazos}</span>
                                                </div>
                                            </li>
                                            <li class="list-group-item"
                                                aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <small>Número de partos:</small><span >${ response[0].numero_embarazos}</span>   
                                                </div>
                                            </li>
                                            <li class="list-group-item"
                                                aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <small>Número de cesáreas:</small><span >${ response[0].cesareas}</span>   
                                                </div>
                                            </li>
                                            <li class="list-group-item"
                                                aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <small>Número de abortos:</small><span >${ response[0].numero_abortos}</span>   
                                                </div>
                                            </li>
                                            <li class="list-group-item"
                                                aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <small>Utiliza algún método anticonceptivo, ¿Cual?:</small><span>${response[0].pregunta}</span>   
                                                </div>
                                            </li>       
                                        </ul>
                                    </div>`

                                    $('.gilecologico').append(gine)

                                    //// end

                                    /// alegias
                                    $('.list-alergias').empty();
                                    response[0].allergies.map((e, key) => {
                                        $('.list-alergias').append(
                                            `<li class=" ${key} list-group-item" aria-current="true"> 
                                                <div class="d-flex w-100 justify-content-between">
                                                    <small class="text-capitalize"><strong>Tipo de Alergia:</strong> ${e.type_alergia}, <strong>Detalle:</strong> ${e.detalle_alergia}</small>
                                                </div>
                                            </li>`
                                        );
                                    });
                                                
                                    if (response[0].allergies.length === 0) {
                                        $('#not-alergias').show();
                                    } else {
                                        $('#not-alergias').hide();
                                    }

                                    //end

                                    /// cirugias
                                    $('.list-cirugias').empty();
                                    response[0].history_surgical.map((e, key) => {
                                        $('.list-cirugias').append(
                                            `<li class=" ${key} list-group-item" aria-current="true"> 
                                                <div class="d-flex w-100 justify-content-between">
                                                    <small class="text-capitalize"><strong>Tipo de cirugía:</strong> ${e.cirugia}, <strong>Fecha:</strong> ${e.datecirugia}</small>
                                                </div>
                                            </li>`
                                        );

                                    });

                                    if (response[0].history_surgical.length === 0) {
                                        $('#not-cirugias').show();
                                    } else {
                                        $('#not-cirugias').hide();
                                    }
                                    //end

                                    /// medicamentos
                                    $('.list-medicamentos').empty();
                                    response[0].medications_supplements.map((e,
                                        key) => {
                                        $('.list-medicamentos').append(
                                            `<li class=" ${key} list-group-item" aria-current="true"> 
                                                <div class="d-flex w-100 justify-content-between">
                                                    <small class="text-capitalize"><strong>Medicamento:</strong> ${e.medicine}, <strong>Dosis:</strong> ${e.dose}, <strong>Patología:</strong> ${e.patologi}, <strong>Duración del tratamiento:</strong> ${e.treatmentDuration}</small>
                                                </div>
                                            </li>`
                                        );
                                    });

                                    if (response[0].medications_supplements.length === 0) {
                                        $('#not-medications').show();
                                    } else {
                                        $('#not-medications').hide();
                                    }
                                    //end

                                    //mostrar consultas
                                    $('#div-content').show();
                                    $('.list-con').empty();
                                    $('.ul-exmen').empty();
                                    $('.ul-study').empty();

                                    response[0].info_medical_record.map((e, key) => {
                                        let element = '';
                                        if ((key % 2) == 0) {
                                            element =
                                        `<li class="list-group-item mb-3 active ${key}" aria-current="true" style="border-radius: 8px;">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="text-capitalize">Médico: ${e.doctor} </h5><br>
                                            </div>
                                            <small>Especialidad:</small> <strong>${e.specialty}</strong>
                                            <br>
                                            <small>Código de consulta:</small> <strong>${e.record_code}</strong>
                                            <br>
                                            <small>Fecha de consulta:</small> <strong>${e.record_date}</strong>
                                            <br>
                                            <small>Razón de la  consulta:</small> <strong>${e.razon}</strong>
                                            <br>
                                            <small>Diagnostico:</small> <strong>${e.diagnosis}</strong>
                                        </li>`
                                        } else {
                                            element = 
                                        `<li class="list-group-item mb-3 ${key}" aria-current="true" style="border-radius: 8px;">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="text-capitalize">Médico: ${e.doctor} </h5><br>
                                            </div>
                                            <small>Especialidad:</small> <strong>${e.specialty}</strong><br>
                                            <small>Código de consulta:</small> <strong>${e.record_code}</strong>
                                            <br>
                                            <small>Fecha de consulta:</small> <strong>${e.record_date}</strong>
                                            <br>
                                            <small>Razón de la  consulta:</small> <strong>${e.razon}</strong>
                                            <br>
                                            <small>Diagnostico:</small> <strong>${e.diagnosis}</strong>
                                        </li>`
                                        }
                                        $('.list-con').append(element);
                                        /// data estudios
                                        
                                            e.study_medical.map((item, i) => {
                                                
                                                let et = '';
                                                let target = `{{ URL::asset('/imgs/${item.file}') }}`;
                                                    if ((i % 2) == 0) {
                                                        et = `<li style="padding: 10px 24px 10px 24px; background-color: #02bdbb; color: white; border-radius: 35px; margin-bottom: 3px; display: flex;
                                                                justify-content: space-between;" class="list-group-item  ${i}" aria-current="true"> ${item.description} ${item.record_code}
                                                                <a target="_blank" href="${target}" style="color: white; text-decoration: none; font-size: 20px;"> 
                                                                    <button type="button"
                                                                        class="refresf btn-idanger rounded-circle">
                                                                        <i class="bi bi-filetype-pdf"></i>
                                                                    </button>
                                                                </a>   
                                                            </li>`
                                                    } else {
                                                        et = `<li style="padding: 10px 24px 10px 24px; background-color: #02bdbb; color: white; border-radius: 35px; margin-bottom: 3px; display: flex;
                                                                justify-content: space-between;"  class="list-group-item ${i}"" aria-current="true">${item.description} ${item.record_code}
                                                                <a target="_blank" href="${target}" style="color: white; text-decoration: none; font-size: 20px;"> 
                                                                    <button type="button"
                                                                        class="refresf btn-idanger rounded-circle">
                                                                        <i class="bi bi-filetype-pdf"></i>
                                                                    </button>
                                                                </a>
                                                            </li>`
                                                    }
                                                    $('.ul-study').append(et);

                                                    if (et) {
                                                    $('#not-studie').hide();
                                                }
                                            });
                                        
                                        //end

                                        /// data examenes
                                            e.exam_medical.map((item, e) => {

                                                let ett = '';
                                                let target = `{{ URL::asset('/imgs/${item.file}') }}`;
                                                if ((e % 2) == 0) {
                                                    ett =
                                                        `<li style="padding: 10px 24px 10px 24px; background-color: #4eb6b4; color: white; border-radius: 35px; margin-bottom: 3px; display: flex;
                                                            justify-content: space-between;" class="list-group-item ${e}" aria-current="true">${item.description} ${item.record_code}
                                                            <a target="_blank" href="${target}"  style="color: white; text-decoration: none; font-size: 20px;"> 
                                                                <button type="button"
                                                                    class="refresf btn-idanger rounded-circle"
                                                                    data-bs-container="body"
                                                                    data-bs-toggle="popover"
                                                                    data-bs-custom-class="custom-popover"
                                                                    data-bs-placement="bottom"
                                                                    data-bs-content="No hay estudios cargados">
                                                                    <i class="bi bi-filetype-pdf"></i>
                                                                </button>
                                                            </a>
                                                        </li>`
                                                } else {
                                                    ett =
                                                        `<li style="padding: 10px 24px 10px 24px; background-color: #4eb6b4; color: white; border-radius: 35px; margin-bottom: 3px; display: flex;
                                                            justify-content: space-between;" class="list-group-item ${e}" aria-current="true">${item.description} ${item.record_code}
                                                            <a target="_blank" href="${target}"  style="color: white; text-decoration: none; font-size: 20px;"> 
                                                                <button type="button"
                                                                    class="refresf btn-idanger rounded-circle"
                                                                    data-bs-container="body"
                                                                    data-bs-toggle="popover"
                                                                    data-bs-custom-class="custom-popover"
                                                                    data-bs-placement="bottom"
                                                                    data-bs-content="No hay estudios cargados">
                                                                    <i class="bi bi-filetype-pdf"></i>
                                                                </button>
                                                            </a>
                                                        </li>`
                                                }
                                                $('.ul-exmen').append(ett);

                                                if (ett) {
                                                    $('#not-exam').hide();
                                                }
                                            });


                                        //end
                                    });
                                    //end

                                });
                            } else {
                                $('#spinner').hide();
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
                                    $('#spinner').hide();
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
        <div id="spinner" style="display: none" class="spinner-md">
            <x-load-spinner show="true" />
        </div>
        <div class="container-fluid body" style="padding: 0 3% 3%">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-12 col-lg-11 col-xl-11 col-xxl-10">
                    <div class="card mt-2 card-ex">
                        <div class="card-body">
                            <form id="form-detaly-patient" method="post" action="">
                                {{ csrf_field() }}

                                <div class="row mt-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <h5 style='font-size: 15px;'>Historia del paciente</h5>

                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <div class="form-group">
                                            <label for="ci"
                                                class="form-label"style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Ingrese
                                                número de cédula</label>
                                            <input maxlength="10" type="text" class="form-control mask-only-number"
                                                id="ci" name="ci" placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <div class="form-group">
                                            <label for="phone" class="form-label"
                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Fecha de
                                                Nacimiento</label>
                                            <input class="form-control date-bd" id="birthdate" name="birthdate"
                                                type="date" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2"
                                        style="display: flex; align-items: flex-end;">
                                        <input class="btn btnSave send" id="btn-save" value="Consultar" type="submit"
                                            style="margin-left: 10px; margin-bottom: 4px;" />
                                    </div>
                                </div>
                            </form>
                            <div class="row mt-5" id="div-content" style="display: none">
                                <hr>
                                <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8">
                                    <div class="d-flex" style="align-items: center;" id="info-pat"></div>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-cd mt-4">
                                    <div id="wizard">
                                        <h3>Historia clinica</h3>
                                        <section>
                                            <div class="div-overflow">

                                                <div class="Examen_fisico"></div>

                                                <div class="row p-3 mt-2">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                        <ul class="list-group" style="border-radius: 8px;">
                                                            <li class="list-group-item active aa" aria-current="true">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 style='font-size: 15px;' class="mb-0 text-capitalize">Antecedentes Personales y Familiares</h5>
                                                                </div>
                                                            </li>
                                                            <div class="family_back">

                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>


                                                <div class="row p-3 mt-2">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                        <ul class="list-group" style="border-radius: 8px;">
                                                            <li class="list-group-item active aa" aria-current="true">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 style='font-size: 15px;' class="mb-0 text-capitalize">Antecedentes personales patológicos</h5>
                                                                </div>
                                                            </li>
                                                            <div class="pathology_back ">

                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="row p-3 mt-2">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                        <ul class="list-group" style="border-radius: 8px;">
                                                            <li class="list-group-item active aa" aria-current="true">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 style='font-size: 15px;' class="mb-0 text-capitalize">Antecedentes no patológicos</h5>
                                                                </div>
                                                            </li>
                                                            <div class="non_pathology_back ">

                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="gilecologico mt-2">

                                                </div>


                                                <div class="row p-3 mt-2">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                        <ul class="list-group" style="border-radius: 8px;">
                                                            <li class="list-group-item active aa" aria-current="true">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 style='font-size: 15px;' class="mb-0 text-capitalize">Antecedentes alérgicos</h5>
                                                                </div>
                                                            </li>
                                                            <div class="list-alergias ">
                                                            </div>
                                                            <div id="not-alergias">
                                                                <li  class="list-group-item" aria-current="true"> 
                                                                    <div class="d-flex w-100 justify-content-between">
                                                                        <strong>No hay información para mostrar</strong>
                                                                    </div>
                                                                </li>
                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="row p-3 mt-2">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                        <ul class="list-group" style="border-radius: 8px;">
                                                            <li class="list-group-item active aa" aria-current="true">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 style='font-size: 15px;' class="mb-0 text-capitalize">Antecedentes quirúrgicos </h5>
                                                                </div>
                                                            </li>
                                                            <div class="list-cirugias">
                                                            </div>
                                                            <div id="not-cirugias">
                                                                <li  class="list-group-item" aria-current="true"> 
                                                                    <div class="d-flex w-100 justify-content-between">
                                                                        <strong>No hay información para mostrar</strong>
                                                                    </div>
                                                                </li>
                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="row p-3 mt-2">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                        <ul class="list-group" style="border-radius: 8px;">
                                                            <li class="list-group-item active aa" aria-current="true">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 style='font-size: 15px;' class="mb-0 text-capitalize">Medicamentos
                                                                    </h5>
                                                                </div>
                                                            </li>
                                                            <div class="list-medicamentos">
                                                            </div>
                                                            <div id="not-medications">
                                                                <li  class="list-group-item" aria-current="true"> 
                                                                    <div class="d-flex w-100 justify-content-between">
                                                                        <strong>No hay información para mostrar</strong>
                                                                    </div>
                                                                </li>
                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <h3>Consultas médicas</h3>
                                        <section>
                                            <div class="list-group list-con div-overflow">
                                            </div>
                                        </section>
                                        <h3>Estudios Realizados</h3>
                                        <section>
                                            <div class="row p-3 div-overflow">
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 pmv-0">
                                                    <ul class="list-group ul-study list-group-flush overflow-auto">
                                                    </ul>
                                                    <div id='not-studie' class="row justify-content-center">
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">                                            
                                                            <h5 class="card-title" style="text-align: center; margin-bottom: 10px;">¡No hay estudios para mostrar de este paciente!</h5>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: flex; justify-content: center;">                                            
                                                            <img width="150" height="auto"
                                                            src="{{ asset('/img/icon-warning.png') }}" alt="avatar">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <h3>Exámenes Realizados</h3>
                                        <section>
                                            <div class="row p-3 div-overflow">
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 pmv-0">
                                                    <ul class="list-group ul-exmen list-group-flush overflow-auto">
                                                    </ul>
                                                    <div id='not-exam' class="row justify-content-center">
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">                                            
                                                            <h5 class="card-title" style="text-align: center; margin-bottom: 10px;">¡No hay exámenes para mostrar de este paciente!</h5>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: flex; justify-content: center;">                                            
                                                            <img width="150" height="auto"
                                                            src="{{ asset('/img/icon-warning.png') }}" alt="avatar">
                                                        </div>
                                                    </div>
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
