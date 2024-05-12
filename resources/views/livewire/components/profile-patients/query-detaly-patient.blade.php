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

    .avatar {
        border-radius: 50%;
        width: 40px !important;
        height: 40px !important;
        border: 2px solid #44525f;
        object-fit: cover;
    }

    .table-avatar {
        text-align: center;
        vertical-align: middle;
    }


    .wizard>.steps a,
    .wizard>.steps a:hover,
    .wizard>.steps a:active {
        border-radius: 35px !important;
        background: #9dc8e2;
        color: #fff;
        /* height: 117px; */
        font-size: 13px
    }

    .wizard>.content>.body {
        width: 100% !important;
        height: 100% !important;
    }

    .wizard>.steps>ul>li {
        width: 20% !important;
    }

    .wizard>.content>.body ul>li {
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

    /* @media (min-width: 1040px) and (max-width: 2100px) {

        .wizard>.steps a,
        .wizard>.steps a:hover,
        .wizard>.steps a:active {
            height: 70px;
        }
    } */

    @media (min-width: 577px) and (max-width: 768px) {
        .wizard>.steps>ul>li {
            width: 100% !important;
        }
    }

    @media screen and (max-width: 576px) {

        .wizard>.steps>ul>li {
            width: 100% !important;

        }

        .wizard>.steps a,
        .wizard>.steps a:hover,
        .wizard>.steps a:active {
            height: 6%;
            padding: 2px 28px 0px !important;
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

            $.validator.addMethod("onlyNumber", function(value, element) {
                var pattern = /^[0-9-]*$/;
                return pattern.test(value);
            }, "@lang('messages.alert.campo_numerico')");
        })

        const showData = (response) => {

            let family_back = @json($family_back);
            let get_condition = @json($get_condition);
            let non_pathology_back = @json($non_pathology_back);
            let vital_sing = @json($vital_sing);
            let pathology_back = @json($pathology_back);

            //mostar datos el paciente

            $('#div-content').find('#info-pat').empty();
            let ulr_img = "{{ URL::asset('/imgs/') }}";
            let img = ''

            if (response.patient.patient_img != null) {
                img = `${ulr_img}/${response.patient.patient_img}`;
            } else {

                img = (response.patient.genere == 'femenino') ?
                    "{{ URL::asset('/img/avatar/avatar mujer.png') }}" :
                    "{{ URL::asset('/img/avatar/avatar hombre.png') }}";

            }
            let e = `
                                                <div class="col-sm-2 col-md-3 col-lg-2 col-xl-2 col-xxl-2" style="width: 135px;" >
                                                    <img src="${img}" width="125" height="125" alt="Imagen del paciente" class="img-medical">
                                                </div>
        
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 data-medical">
                                                    <strong>@lang('messages.ficha_paciente.nombre'):</strong><span class="text-capitalize"> ${response.patient.name} ${response.patient.last_name}</span>
                                                    <br>
                                                    <strong>@lang('messages.ficha_paciente.fecha_nacimiento'):</strong><span> ${response.patient.birthdate }</span>
                                                    <br>
                                                    <strong>@lang('messages.ficha_paciente.edad'):</strong><span> ${response.patient.age } años</span>
                                                    <br>
                                                    <strong>@lang('messages.ficha_paciente.ci'):</strong><span> ${response.patient.ci} </span>
                                                    <br>
                                                    <strong>@lang('messages.ficha_paciente.genero'):</strong><span class="text-capitalize"> ${response.patient.genere} </span>
                                                    <br>
                                                    <strong>@lang('messages.ficha_paciente.nro_historias'):</strong><span class="text-capitalize"> ${(response.patient.get_history)? response.patient.get_history.cod_history:""} </span>
                                                </div>`;
            $('#div-content').find('#info-pat').append(e);
            // end

            // limpiar item
            $('.family_back').empty();
            $('.ob_family_back').empty();
            $('.pathology_back').empty();
            $('.ob_pathology_back').empty();
            $('.non_pathology_back').empty();
            $('.ob_non_pathology_back').empty();
            $('.gilecologico').empty();
            $('#not-alergias').hide();
            $('.list-alergias').empty();
            $('.ob-alergias').empty();
            $('#not-cirugias').hide();
            $('.list-cirugias').empty();
            $('.ob-cirugias').empty();
            $('#not-medications').hide();
            $('.list-medicamentos').empty();
            $('.ob-medicamentos').empty();
            // end

            if (response.patient.get_history != null) {
                // Antecedentes Personales y Familiares

                family_back.map((value, keyy) => {
                    for (const [key, val] of Object
                        .entries(
                            response.patient.get_history
                        )) {

                        if (key == value.name) {

                            if (val != null) {
                                $('.family_back')
                                    .append(
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
                if (response.patient.get_history.observations_back_family) {
                    $('.ob_family_back').append(
                        `<li class="list-group-item">
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <span class="text-justify">
                                                                    <strong>@lang('messages.label.observaciones'):</strong>
                                                                    <br>
                                                                    <br>
                                                                    ${response.patient.get_history.observations_back_family}
                                                                </span>
                                                            </div>
                                                        </li>`
                    );
                }
                // end

                // Antecedentes personales patológicos

                pathology_back.map((value, keyy) => {
                    for (const [key, val] of Object
                        .entries(
                            response.patient.get_history
                        )) {

                        if (key == value.name) {
                            if (val != null) {

                                $('.pathology_back')
                                    .append(
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

                if (response.patient.get_history.observations_diagnosis) {
                    $('.ob_pathology_back').append(
                        `<li class="list-group-item">
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <span class="text-justify">
                                                                    <strong>@lang('messages.label.observaciones'):</strong>
                                                                    <br>
                                                                    <br>
                                                                    ${response.patient.get_history.observations_diagnosis}
                                                                </span>
                                                            </div>
                                                        </li>`
                    );
                }
                // end

                // historia Antecedentes personales no patológicos

                non_pathology_back.map((value, keyy) => {
                    for (const [key, val] of Object
                        .entries(
                            response.patient.get_history
                        )) {

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

                if (response.patient.get_history.observations_not_pathological) {
                    $('.ob_non_pathology_back').append(
                        `<li class="list-group-item">
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <span class="text-justify">
                                                                    <strong>@lang('messages.label.observaciones'):</strong>
                                                                    <br>
                                                                    <br>
                                                                    ${response.patient.get_history.observations_not_pathological}
                                                                </span>
                                                            </div>
                                                        </li>`
                    );
                }


                // end

                // gilecologico

                if (response.patient.genere === 'femenino') {

                    let gine = `<div class="row p-3">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                                <ul class="list-group" style="border-radius: 8px;">
                                                                    <li class="list-group-item active aa" aria-current="true" style="z-index: 0;">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <h5 style='font-size: 15px;' class="mb-0 text-capitalize">Antecedentes ginecologicos </h5>
                                                                        </div>
                                                                    </li>
        
                                                                    <li class="list-group-item" aria-current="true">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <span><strong>@lang('messages.form.edad_mestruacion'):</strong> ${ response.patient.get_history.edad_primera_menstruation}</span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="list-group-item" aria-current="true">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                        <span><strong>@lang('messages.form.fecha_periodo'):</strong> ${ response.patient.get_history.fecha_ultima_regla}</span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="list-group-item" aria-current="true">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <span><strong>@lang('messages.form.nro_embarazos'):</strong> ${ response.patient.get_history.numero_embarazos}</span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="list-group-item" aria-current="true">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <span><strong>@lang('messages.form.nro_partos'):</strong> ${ response.patient.get_history.numero_partos}</span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="list-group-item" aria-current="true">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <span><strong>@lang('messages.form.nro_cesareas'):</strong> ${response.patient.get_history.cesareas}</span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="list-group-item" aria-current="true">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <span><strong>@lang('messages.form.nro_abortos'):</strong> ${response.patient.get_history.numero_abortos}</span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="list-group-item" aria-current="true">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <span><strong>@lang('messages.form.anticonceptivo'):</strong> ${response.patient.get_history.pregunta}</span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <span class="text-justify">
                                                                                <strong>@lang('messages.label.observaciones'):</strong>
                                                                                <br>
                                                                                <br>
                                                                                ${response.patient.get_history.observations_ginecologica}
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>`

                    $('.gilecologico').append(gine)
                }


                // end

                // alegias

                if (response.allergies.length != 0) {

                    response.allergies.map((e, key) => {
                        $('.list-alergias').append(
                            `<li class=" ${key} list-group-item" aria-current="true">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <span class="text-capitalize">
                                                                        <strong>@lang('messages.form.tipo_alergia'):</strong> ${e.type_alergia},
                                                                        <br>
                                                                        <strong>@lang('messages.form.detalle'):</strong> ${e.detalle_alergia}
                                                                    </span>
                                                                </div>
                                                            </li>`
                        );
                    });


                }
                if (response.patient.get_history.observations_allergies) {
                    $('.ob-alergias').append(
                        `<li class="list-group-item">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <span class="text-justify">
                                                                        <strong>@lang('messages.label.observaciones'):</strong>
                                                                        <br>
                                                                        <br>
                                                                        ${ response.patient.get_history.observations_allergies}
                                                                    </span>
                                                                </div>
                                                            </li>`
                    );
                } else {

                    $('#not-alergias').show();
                }
                // end

                // cirugias

                if (response.patient.get_history.history_surgical != null) {
                    response.history_surgical.map((e, key) => {
                        $('.list-cirugias').append(
                            `<li class=" ${key} list-group-item" aria-current="true">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <span class="text-capitalize">
                                                                        <strong>@lang('messages.form.tipo_cirugia'):</strong> ${e.cirugia},
                                                                        <br>
                                                                        <strong>@lang('messages.form.fecha'):</strong> ${e.datecirugia}
                                                                    </span>
                                                                </div>
                                                            </li>`
                        );

                    });

                }
                if (response.patient.get_history.observations_quirurgicas) {
                    $('.ob-cirugias').append(
                        `<li class="list-group-item">
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <span class="text-justify">
                                                                    <strong>@lang('messages.label.observaciones'):</strong>
                                                                    <br>
                                                                    <br>
                                                                    ${ response.patient.get_history.observations_quirurgicas}
                                                                </span>
                                                            </div>
                                                        </li>`
                    );
                } else {
                    $('#not-cirugias').show();
                }
                // end

                // medicamentos

                if (response.medications_supplements != null) {
                    response.medications_supplements.map((e,
                        key) => {
                        $('.list-medicamentos').append(
                            `<li class=" ${key} list-group-item" aria-current="true">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <span class="text-capitalize" >
                                                                        <strong>@lang('messages.form.medicamento'):</strong> ${e.medicine},
                                                                        <br>
                                                                        <strong>@lang('messages.form.dosis'):</strong> ${e.dose},
                                                                        <br>
                                                                        <strong>@lang('messages.form.patologia'):</strong> ${e.patologi},
                                                                        <br>
                                                                        <strong>@lang('messages.form.duracion_tratamiento'):</strong> ${e.treatmentDuration}
                                                                    </span>
                                                                </div>
                                                            </li>`
                        );
                    });

                }
                if (response.patient.get_history.observations_medication) {
                    $('.ob-medicamentos').append(
                        `<li class="list-group-item">
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <span class="text-justify">
                                                                    <strong>@lang('messages.label.observaciones'):</strong>
                                                                    <br>
                                                                    <br>
                                                                    ${response.patient.get_history.observations_medication}
                                                                </span>
                                                            </div>
                                                        </li>`
                    );
                } else {
                    $('#not-medications').show();

                }
            }
            //end


            // mostrar consultas
            $('#not-medical-record').hide();
            $('.list-con').empty();
            $('.ul-exmen').empty();
            $('.ul-study').empty();
            if (response.medicard_record.length > 0) {

                response.medicard_record.map((e, key) => {
                    let element = '';
                    if ((key % 2) == 0) {
                        element =
                            `<li class="list-group-item mb-3 active ${key}" aria-current="true" style="border-radius: 8px; z-index: 0;">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 class="text-capitalize">@lang('messages.form.medico'): ${e.doctor} </h5><br>
                                                                </div>
                                                                <span><strong>@lang('messages.form.especialidad'):</strong> ${e.specialty}</span>
                                                                <br>
                                                                <br>
                                                                <span><strong>@lang('messages.form.codigo_consulta'):</strong> ${e.record_code}</span>
                                                                <br>
                                                                <br>
                                                                <span><strong>@lang('messages.form.fecha_consulta'):</strong> ${e.record_date}</span>
                                                                <br>
                                                                <br>
                                                                <span class="text-justify"><strong>@lang('messages.form.razon_consulta'):</strong> ${e.razon}</span>
                                                                <br>
                                                                <br>
                                                                <span class="text-justify"><strong>@lang('messages.form.diagnostico'):</strong> ${e.diagnosis}</span>
                                                            </li>`
                    } else {
                        element =
                            `<li class="list-group-item mb-3 ${key}" aria-current="true" style="border-radius: 8px;">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 class="text-capitalize">@lang('messages.form.medico'): ${e.doctor} </h5><br>
                                                                </div>
                                                                <span><strong>@lang('messages.form.especialidad'):</strong> ${e.specialty}</span>
                                                                <br>
                                                                <br>
                                                                <span><strong>@lang('messages.form.codigo_consulta'):</strong> ${e.record_code}</span>
                                                                <br>
                                                                <br>
                                                                <span><strong>@lang('messages.form.fecha_consulta'):</strong> ${e.record_date}</span>
                                                                <br>
                                                                <br>
                                                                <span class="text-justify"><strong>@lang('messages.form.razon_consulta'):</strong> ${e.razon}</span>
                                                                <br>
                                                                <br>
                                                                <span class="text-justify"><strong>@lang('messages.form.diagnostico'):</strong> ${e.diagnosis}</span>
                                                            </li>`
                    }
                    $('.list-con').append(element);


                    // data estudios
                    e.study_medical.map((item, i) => {

                        let et = '';
                        let target =
                            `{{ URL::asset('/imgs/${item.file}') }}`;
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
                        $('.ul-study').append(
                            et);

                        if (et) {
                            $('#not-studie')
                                .hide();
                        }
                    });

                    // end

                    // data examenes
                    e.exam_medical.map((item, e) => {

                        let ett = '';
                        let target =
                            `{{ URL::asset('/imgs/${item.file}') }}`;
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
                                                                                data-bs-content="@lang('messages.alert.no_examenes')">
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
                                                                                data-bs-content="@lang('messages.alert.no_estudios')">
                                                                                <i class="bi bi-filetype-pdf"></i>
                                                                            </button>
                                                                        </a>
                                                                    </li>`
                        }
                        $('.ul-exmen').append(
                            ett);

                        if (ett) {
                            $('#not-exam')
                                .hide();
                        }
                    });
                    // end
                });
            } else {

                $('#not-medical-record').show();

            }
            // end

            // mostrar examnes fisicos
            $('.list-examenes-fisicos').empty();
            $("#not-examenes-fisicos").hide();
            if (response.get_physical_exams.length > 0) {
                response.get_physical_exams.map((e, key) => {

                    let element = '';
                    if ((key % 2) == 0) {
                        element =
                            `<li class="list-group-item mb-3 active ${key}" aria-current="true" style="border-radius: 8px; z-index: 0;">
                                                                <span><strong>@lang('messages.form.peso_1'):</strong> ${e.weight} Kg</span>
                                                                <br>
                                                                <br>
                                                                <span><strong>@lang('messages.form.altura_1'):</strong> ${e.height}</span>
                                                                <br>
                                                                <br>
                                                                <span><strong>@lang('messages.form.presion_arterial_1'):</strong> ${e.strain} </span>
                                                                <br>
                                                                <br>
                                                                <span><strong>@lang('messages.form.temperatura_1'):</strong> ${e.temperature}</span>
                                                                <br>
                                                                <br>
                                                                <span><strong>@lang('messages.form.respiraciones_1'):</strong> ${e.breaths}</span>
                                                                <br>
                                                                <br>
                                                                <span><strong>@lang('messages.form.pulso_1'):</strong> ${e.pulse}</span>
                                                                <br>
                                                                <br>
                                                                <span><strong>@lang('messages.form.saturacion_1'):</strong> ${e.saturation}</span>
                                                                <br>
                                                                <br>
                                                                <span><strong>@lang('messages.form.condicion'):</strong> ${e.condition}</span>
                                                                <br>
                                                                <br>
                                                                <span class="text-justify">
                                                                    <strong>@lang('messages.label.observaciones'):</strong>
                                                                    <br>
                                                                    <br>
                                                                    ${e.observations}
                                                                </span>
                                                            </li>`
                    } else {
                        element =
                            `<li class="list-group-item mb-3 ${key}" aria-current="true" style="border-radius: 8px;">
                                                                <span><strong>@lang('messages.form.peso_1'):</strong> ${e.weight} Kg</span>
                                                                <br>
                                                                <br>
                                                                <span><strong>@lang('messages.form.altura_1'):</strong> ${e.height}</span>
                                                                <br>
                                                                <br>
                                                                <span><strong>@lang('messages.form.presion_arterial_1'):</strong> ${e.strain}/${e.strain_two} </span>
                                                                <br>
                                                                <br>
                                                                <span><strong>@lang('messages.form.temperatura_1'):</strong> ${e.temperature}</span>
                                                                <br>
                                                                <br>
                                                                <span><strong>@lang('messages.form.respiraciones_1'):</strong> ${e.breaths}</span>
                                                                <br>
                                                                <br>
                                                                <span><strong>@lang('messages.form.pulso_1'):</strong> ${e.pulse}</span>
                                                                <br>
                                                                <br>
                                                                <span><strong>@lang('messages.form.saturacion_1'):</strong> ${e.saturation}</span>
                                                                <br>
                                                                <br>
                                                                <span><strong>@lang('messages.form.condicion'):</strong> ${e.condition}</span>
                                                                <br>
                                                                <br>
                                                                <span class="text-justify">
                                                                    <strong>@lang('messages.label.observaciones'):</strong>
                                                                    <br>
                                                                    <br>
                                                                    ${e.observations}
                                                                </span>
                                                            </li`
                    }
                    $('.list-examenes-fisicos').append(
                        element);


                    // end
                });
            } else {
                $("#not-examenes-fisicos").show();
            }

            // end
            $('#div-content').show();


        }

        const searchPatien = (id) => {

            $('#spinner').show();

            let url = "{{ route('search-detaly-patient', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    showData(response);
                    $('#spinner').hide();

                }
            });

        }
    </script>
@endpush
@section('content')
    <div>
        <div id="spinner" style="display: none" class="spinner-md">
            <x-load-spinner show="true" />
        </div>
        <div class="container-fluid body" style="padding: 0 3% 3%">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-11 col-xxl-10">
                    <div class="card mt-2 card-ex">
                        <div class="card-body">

                            <div class="row  justify-content-center mt-3" id="content-table-patient=portal">
                                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 table-responsive">
                                    <hr>
                                    <h5 class="mb-4">@lang('messages.subtitulos.pacientes_registrados')</h5>
                                    <table id="table-info-pacientes-portal" class="table table-pag table-striped table-bordered"
                                        style="width:100%; ">
                                        <thead>
                                            <tr>
                                                <th class="text-center w-image" scope="col" data-orderable="false">
                                                    @lang('messages.tabla.foto')</th>
                                                <th class="text-center w-10" scope="col">@lang('messages.tabla.codigo_paciente')</th>
                                                <th class="text-center w-10" scope="col">@lang('messages.tabla.nombre_apellido')</th>
                                                <th class="text-center w-17" scope="col">@lang('messages.tabla.selecionar')</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($patients as $item)
                                                <tr>
                                                    <td class="table-avatar">
                                                        <img class="avatar"
                                                            src=" {{ $item->patient_img ? asset('/imgs/' . $item->patient_img) : ($item->genere == 'femenino' ? asset('/img/avatar/avatar mujer.png') : asset('/img/avatar/avatar hombre.png')) }}"
                                                            alt="Imagen del paciente">
                                                    </td>
                                                    <td class="text-center text-capitalize"> {{ $item->patient_code }}
                                                    </td>
                                                    <td class="text-center text-capitalize">
                                                        {{ $item->name . ' ' . $item->last_name }}</td>
                                                    <td class="text-center text-capitalize">
                                                        <div class="d-flex">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                                <button onclick="searchPatien({{ $item->id }}); "
                                                                    type="button" data-bs-toggle="tooltip"
                                                                    data-bs-placement="bottom" title="@lang('messages.tooltips.editar')">
                                                                    <img width="40" height="auto"
                                                                        src="{{ asset('/img/icons/user-edit.png') }}"
                                                                        alt="avatar">
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            {{-- conteido de la data --}}
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
                                                            <li class="list-group-item active aa" aria-current="true"
                                                                style="z-index: 0;">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 style="font-size: 15px;"
                                                                        class="mb-0 text-capitalize">Antecedentes Personales
                                                                    </h5>
                                                                </div>
                                                            </li>
                                                            <div class="family_back">
                                                            </div>
                                                            <div class="ob_family_back">
                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>


                                                <div class="row p-3 mt-2">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                        <ul class="list-group" style="border-radius: 8px;">
                                                            <li class="list-group-item active aa" aria-current="true"
                                                                style="z-index: 0;">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 style='font-size: 15px;'
                                                                        class="mb-0 text-capitalize">Antecedentes personales
                                                                        patológicos</h5>
                                                                </div>
                                                            </li>
                                                            <div class="pathology_back ">
                                                            </div>
                                                            <div class="ob_pathology_back ">
                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="row p-3 mt-2">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                        <ul class="list-group" style="border-radius: 8px;">
                                                            <li class="list-group-item active aa" aria-current="true"
                                                                style="z-index: 0;">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 style='font-size: 15px;'
                                                                        class="mb-0 text-capitalize">Antecedentes no
                                                                        patológicos</h5>
                                                                </div>
                                                            </li>
                                                            <div class="non_pathology_back ">
                                                            </div>
                                                            <div class="ob_non_pathology_back">
                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="gilecologico mt-2">

                                                </div>


                                                <div class="row p-3 mt-2">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                        <ul class="list-group" style="border-radius: 8px;">
                                                            <li class="list-group-item active aa" aria-current="true"
                                                                style="z-index: 0;">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 style='font-size: 15px;'
                                                                        class="mb-0 text-capitalize">Antecedentes alérgicos
                                                                    </h5>
                                                                </div>
                                                            </li>
                                                            <div class="list-alergias ">
                                                            </div>
                                                            <div class="ob-alergias">
                                                            </div>
                                                            <div id="not-alergias">
                                                                <li class="list-group-item" aria-current="true">
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
                                                            <li class="list-group-item active aa" aria-current="true"
                                                                style="z-index: 0;">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 style='font-size: 15px;'
                                                                        class="mb-0 text-capitalize">Antecedentes
                                                                        quirúrgicos </h5>
                                                                </div>
                                                            </li>
                                                            <div class="list-cirugias">
                                                            </div>
                                                            <div class="ob-cirugias">
                                                            </div>

                                                            <div id="not-cirugias">
                                                                <li class="list-group-item" aria-current="true">
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
                                                            <li class="list-group-item active aa" aria-current="true"
                                                                style="z-index: 0;">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 style='font-size: 15px;'
                                                                        class="mb-0 text-capitalize">Medicamentos
                                                                    </h5>
                                                                </div>
                                                            </li>
                                                            <div class="list-medicamentos">
                                                            </div>
                                                            <div class="ob-medicamentos">
                                                            </div>
                                                            <div id="not-medications">
                                                                <li class="list-group-item" aria-current="true">
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
                                            <div style="display: none" id='not-medical-record'
                                                class="row justify-content-center mt-2">
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                    <h5 class="card-title" style="text-align: center;">¡Paciente sin
                                                        consulta medica!</h5>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                                    style="display: flex; margin-bottom: 10px; justify-content: center;">
                                                    <img width="150" height="auto"
                                                        src="{{ asset('/img/icons/no-file.png') }}" alt="avatar">
                                                </div>
                                            </div>
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
                                                            <h5 class="card-title"
                                                                style="text-align: center; margin-bottom: 10px;">¡No hay
                                                                estudios para mostrar de este paciente!</h5>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                                            style="display: flex; justify-content: center;">
                                                            <img width="150" height="auto"
                                                                src="{{ asset('/img/icons/no-file.png') }}"
                                                                alt="avatar">
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
                                                            <h5 class="card-title"
                                                                style="text-align: center; margin-bottom: 10px;">¡No hay
                                                                exámenes para mostrar de este paciente!</h5>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                                            style="display: flex; justify-content: center;">
                                                            <img width="150" height="auto"
                                                                src="{{ asset('/img/icons/no-file.png') }}"
                                                                alt="avatar">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <h3>Exámenes Fisicos</h3>
                                        <section>
                                            <div style="display: none" id='not-examenes-fisicos'
                                                class="row justify-content-center mt-2">
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                    <h5 class="card-title" style="text-align: center;">¡Paciente sin
                                                        examenes fisicos!</h5>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                                    style="display: flex; margin-bottom: 10px; justify-content: center;">
                                                    <img width="150" height="auto"
                                                        src="{{ asset('/img/icons/no-file.png') }}" alt="avatar">
                                                </div>
                                            </div>
                                            <div class="list-group list-examenes-fisicos div-overflow">
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
