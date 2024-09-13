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

        background-color: #a0a9b3 !important;
        border-color: #a0a9b3 !important;
    }

    .aa.list-group-item.active {
        background-color: #459594 !important;
        border-color: #459594 !important;
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

            console.log(response)

            let family_back = @json($family_back);
            let get_condition = @json($get_condition);
            let non_pathology_back = @json($non_pathology_back);
            let vital_sing = @json($vital_sing);
            let pathology_back = @json($pathology_back);
            let mental_healths = @json($mental_healths);
            let inmunizations = @json($inmunizations);
            let medical_devices = @json($medical_devices);

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
            $('.mental_healths').empty();
            $('.ob_mental_healths').empty();
            $('.inmunizations').empty();
            $('.covid').empty();
            $('.ob_inmunizations').empty();
            $('.medical_device').empty();
            $('.ob_medical_devices').empty();
            $('.gilecologico').empty();
            $('#not-alergias').hide();
            $('.list-alergias').empty();
            $('.ob-alergias').empty();
            $('#not-cirugias').hide();
            $('.list-cirugias').empty();
            // $('#table-info-cirugias').empty();
            $('.ob-cirugias').empty();
            $('#not-medications').hide();
            $('.list-medicamentos').empty();
            $('.ob-medicamentos').empty();
            // end

            if (response.patient.get_history != null) {


                $('#div-history').show();
                $('#not-history').hide();

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
                                            `<small>${value.name === 'FB_C' ? '<strong> ✔ </strong>'+value.text+ ' ( ' +response.patient.get_history.FB_C_input+ ' )' : '<strong> ✔ </strong>'+value.text}.</small>`

                                        );
                                }
                            };
                        }
                    });
                    if (response.patient.get_history.observations_back_family) {
                        $('.ob_family_back').append(
                            `<div class="d-flex w-100 justify-content-between">
                                <span class="text-justify mt-3">
                                    <h6 class="mb-0 text-capitalize">
                                        @lang('messages.label.observaciones'):
                                    </h6>
                                    <small>${response.patient.get_history.observations_back_family}</small>
                                </span>
                            </div>`
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
                                        `<small><strong> ✔ </strong>${value.text}. </small>`
                                    );
                            }

                        };
                    }
                    });

                    if (response.patient.get_history.observations_diagnosis) {
                        $('.ob_pathology_back').append(
                            `<li class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <span class="text-justify mt-3">
                                        <h6 class="mb-0 text-capitalize">
                                            @lang('messages.label.observaciones'):
                                        </h6>
                                        <small>${response.patient.get_history.observations_diagnosis}</small>
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
                                        `<small><strong> ✔ </strong>${value.name === 'NPB_NA' ? value.text : value.text+ ': SI'}.</small>`
                                    );
                            }
                        };
                    }
                    });

                    if (response.patient.get_history.observations_not_pathological) {
                        $('.ob_non_pathology_back').append(
                            `<li class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <span class="text-justify mt-3">
                                        <h6 class="mb-0 text-capitalize">
                                            @lang('messages.label.observaciones'):
                                        </h6>
                                        <small>${response.patient.get_history.observations_not_pathological}</small>
                                    </span>
                                </div>
                            </li>`
                        );
                    }

                // end

                // historia Salud mental

                    mental_healths.map((value, keyy) => {
                        for (const [key, val] of Object
                            .entries(
                                response.patient.get_history
                            )) {

                            if (key == value.name) {
                                if (val != null) {
                                    $('.mental_healths')
                                        .append(
                                            `<small><strong> ✔ </strong>${value.text}.</small>`
                                        );
                                }
                            };
                        }
                    });

                    if (response.patient.get_history.observations_mental_healths) {
                        $('.ob_mental_healths').append(
                            `<li class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <span class="text-justify mt-3">
                                        <h6 class="mb-0 text-capitalize">
                                            @lang('messages.label.observaciones'):
                                        </h6>
                                        <small>${response.patient.get_history.observations_mental_healths}</small>
                                    </span>
                                </div>
                            </li>`
                        );
                    }

                // end

                // historia Inmunizacion

                    inmunizations.map((value, keyy) => {
                        for (const [key, val] of Object
                            .entries(
                                response.patient.get_history
                            )) {

                            if (key == value.name) {
                                if (val != null) {
                                    $('.inmunizations')
                                        .append(
                                            `<small>${value.name === 'IM_O' ? '<strong> ✔ </strong>' +value.text+ ' ( ' +response.patient.get_history.IM_V_input+ ' )' : '<strong> ✔ </strong>'+value.text}.</small>`
                                        );
                                }
                            };
                        }
                    });

                    if (response.patient.get_history.IMC19_covid === '1') {
                        $('.covid').append(
                            `<hr class="mt-1" style="margin-bottom: 0;">
                            <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                @lang('messages.form.IMC19_covid')</h6>
                            <hr style="margin-bottom: 0;">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive"  id="table-info-consulta">
                                <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                    <thead>
                                        <tr>
                                            <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.IMC19_dosis')</th>
                                            <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.IMC19_fecha_ultima_dosis')</th>
                                            <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.IMC19_marca')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center text-capitalize"> ${response.patient.get_history.IMC19_dosis} </td>
                                            <td class="text-center text-capitalize"> ${response.patient.get_history.IMC19_fecha_ultima_dosis} </td>
                                            <td class="text-center text-capitalize"> ${response.patient.get_history.IMC19_marca} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>`
                        );
                    }

                    if (response.patient.get_history.observations_inmunization) {
                        $('.ob_inmunizations').append(
                            `<li class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <span class="text-justify mt-3">
                                        <h6 class="mb-0 text-capitalize">
                                            @lang('messages.label.observaciones'):
                                        </h6>
                                        <small>${response.patient.get_history.observations_inmunization}</small>
                                    </span>
                                </div>
                            </li>`
                        );

                    }

                // end

                // historia dispositivos medicos

                    medical_devices.map((value, keyy) => {
                        for (const [key, val] of Object
                            .entries(
                                response.patient.get_history
                            )) {

                            if (key == value.name) {
                                if (val != null) {
                                    $('.medical_device')
                                        .append(
                                            `<small><strong> ✔ </strong>${value.description}. </small>`
                                        );
                                }
                            };
                        }
                    });
                    if (response.patient.get_history.observations_medical_devices) {
                        $('.ob_medical_devices').append(
                            `<li class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <span class="text-justify mt-3">
                                        <h6 class="mb-0 text-capitalize">
                                            @lang('messages.label.observaciones'):
                                        </h6>
                                        <small>${response.patient.get_history.observations_medical_devices}</small>
                                    </span>
                                </div>
                            </li>`
                        );
                    }

                // end

                // gilecologico

                    if (response.patient.genere === 'femenino') {

                        let gine = `<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                            <div class="row">
                                <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_gine')</h6>
                                <hr style="margin-top: 5px">
                                <div class="row">
                                    <hr class="mt-1" style="margin-bottom: 0;">
                                    <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                        @lang('messages.subtitulos.ginecologicos')</h6>
                                    <hr style="margin-bottom: 0;">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                        <div id="table-info-consulta">
                                            <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.edad_mestruacion')</th>
                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.fecha_periodo')</th>
                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.ciclo_menstrual')</th>
                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.infecciones')</th>
                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.exam_previos')</th>
                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.anticonceptivo')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center text-capitalize"> ${ response.patient.get_history.GINE_menarquia}</td>
                                                        <td class="text-center text-capitalize"> ${ response.patient.get_history.GINE_fecha_ultimo_pe}</td>
                                                        <td class="text-center text-capitalize"> ${ response.patient.get_history.GINE_duracion}</td>
                                                        <td class="text-center text-capitalize"> ${ response.patient.get_history.GINE_infecciones}</td>
                                                        <td class="text-center text-capitalize"> ${ response.patient.get_history.GINE_ex_gine_previos}</td>
                                                        <td class="text-center text-capitalize"> ${ response.patient.get_history.GINE_metodo_anti}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr class="mt-3" style="margin-bottom: 0;">
                                    <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                        @lang('messages.subtitulos.obstetricos')</h6>
                                    <hr style="margin-bottom: 0;">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                    <div id="table-info-consulta">
                                            <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.nro_embarazos')</th>
                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.nro_partos')</th>
                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.nro_cesareas')</th>
                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.nro_abortos')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center text-capitalize"> ${ response.patient.get_history.OBSTE_gravides}</td>
                                                        <td class="text-center text-capitalize"> ${ response.patient.get_history.OBSTE_partos}</td>
                                                        <td class="text-center text-capitalize"> ${ response.patient.get_history.OBSTE_cesareas}</td>
                                                        <td class="text-center text-capitalize"> ${ response.patient.get_history.OBSTE_abortos}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr class="mt-3" style="margin-bottom: 0;">
                                    <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                        @lang('messages.subtitulos.menopausia')</h6>
                                    <hr style="margin-bottom: 0;">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                        <div id="table-info-consulta">
                                            <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.MENOSPA_fecha_ini')</th>
                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.MENOSPA_sintomas')</th>
                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.MENOSPA_tratamiento')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center text-capitalize"> ${ response.patient.get_history.MENOSPA_fecha_ini}</td>
                                                        <td class="text-center text-capitalize"> ${ response.patient.get_history.MENOSPA_sintomas}</td>
                                                        <td class="text-center text-capitalize"> ${ response.patient.get_history.MENOSPA_tratamiento}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr class="mt-3" style="margin-bottom: 0;">
                                    <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                        @lang('messages.subtitulos.act_sexual')</h6>
                                    <hr style="margin-bottom: 0;">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                        <div id="table-info-consulta">
                                            <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.ACTSEX_activo')</th>
                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.ACTSEX_enfermedades_ts')</th>
                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.MENOSPA_tratamiento')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center text-capitalize"> ${ response.patient.get_history.ACTSEX_activo === '1' ? "Activo" : "Inactivo"}</td>
                                                        <td class="text-center text-capitalize"> ${ response.patient.get_history.ACTSEX_enfermedades_ts}</td>
                                                        <td class="text-center text-capitalize"> ${ response.patient.get_history.MENOSPA_tratamiento}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <span class="text-justify mt-3">
                                            <h6 class="mb-0 text-capitalize">
                                                @lang('messages.label.observaciones'):
                                            </h6>
                                            <small>${ response.patient.get_history.observations_ginecologica }</small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>`

                        $('.gilecologico').append(gine)
                    }

                // end

                // alegias

                    if (response.allergies.length != 0) {
                        $('#div_allergies').show();
                        response.allergies.map((e, key) => {

                            let row = `
                            <tr>
                                <td class="text-center">${e.type_alergia}</td>
                                <td class="text-center"> ${e.detalle_alergia}</td>
                            </tr>`;

                            $('#table-info-allergies').find('tbody').append(row);

                        });
                    }
                    if (response.patient.get_history.observations_allergies) {
                        $('.ob-alergias').append(
                            `<li class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <span class="text-justify mt-3">
                                        <h6 class="mb-0 text-capitalize">
                                            @lang('messages.label.observaciones'):
                                        </h6>
                                        <small>${ response.patient.get_history.observations_allergies}</small>
                                    </span>
                                </div>
                            </li>`
                        );
                    }
                // end

                // cirugias

                    if (response.history_surgical.length != 0) {
                        $('#div_cirugias').show();
                        response.history_surgical.map((e, key) => {

                            let row = `
                            <tr>
                                <td class="text-center">${e.cirugia}</td>
                                <td class="text-center"> ${e.datecirugia}</td>
                            </tr>`;

                            $('#table-info-cirugias').find('tbody').append(row);

                        });
                    }
                    if (response.patient.get_history.observations_quirurgicas) {
                        $('.ob-cirugias').append(
                            `<li class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <span class="text-justify mt-3">
                                        <h6 class="mb-0 text-capitalize">
                                            @lang('messages.label.observaciones'):
                                        </h6>
                                        <small>${response.patient.get_history.observations_quirurgicas}</small>
                                    </span>
                                </div>
                            </li>`
                        );
                    }
                // end

                // medicamentos

                    if (response.medications_supplements.length != 0) {
                        $('#div_medicamentos').show();
                        response.medications_supplements.map((e, key) => {

                        let row = `
                            <tr>
                            <td class="text-center">${e.medicine}</td>
                            <td class="text-center"> ${e.dose}</td>
                            <td class="text-center">${e.patologi}</td>
                            <td class="text-center">${e.effectiveness}</td>
                            <td class="text-center"> ${e.treatmentDuration}</td>
                            </tr>`;

                            $('#table-info-medicines').find('tbody').append(row);

                        });
                    }
                    if (response.patient.get_history.observations_medication) {
                        $('.ob-medicamentos').append(
                        `<li class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <span class="text-justify mt-3">
                                    <h6 class="mb-0 text-capitalize">
                                        @lang('messages.label.observaciones'):
                                    </h6>
                                    <small>${response.patient.get_history.observations_medication}</small>
                                </span>
                            </div>
                        </li>`
                    );
                    }
                    } else {

                        $('#not-history').show();
                        $('#div-history').hide();

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
                                    <h5 class="text-capitalize">@lang('messages.form.fecha_consulta'): ${e.record_date}</h5>
                                    <br>
                                </div>
                                <div id="table-info-consulta">
                                    <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                        <thead>
                                            <tr>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.medico')</th>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.especialidad')</th>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.codigo_consulta')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center text-capitalize"> ${e.doctor}</td>
                                                <td class="text-center text-capitalize"> ${e.specialty} </td>
                                                <td class="text-center text-capitalize"> ${e.record_code}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <span class="text-justify"><strong>@lang('messages.form.razon_consulta')
                                <br>
                                </strong> ${e.razon}</span>
                                <br>
                                <hr style="margin-top: 16px">
                                <span class="text-justify"><strong>@lang('messages.form.diagnostico')
                                <br>
                                </strong> ${e.diagnosis}</span>
                            </li>`
                    } else {
                        element =
                            `<li class="list-group-item mb-3 ${key}" aria-current="true" style="border-radius: 8px;">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="text-capitalize">@lang('messages.form.fecha_consulta'): ${e.record_date}</h5>
                                    <br>
                                </div>
                                <div id="table-info-consulta">
                                    <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                        <thead>
                                            <tr>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.medico')</th>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.especialidad')</th>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.codigo_consulta')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center text-capitalize"> ${e.doctor}</td>
                                                <td class="text-center text-capitalize"> ${e.specialty} </td>
                                                <td class="text-center text-capitalize"> ${e.record_code}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <span class="text-justify"><strong>@lang('messages.form.razon_consulta')
                                <br>
                                </strong> ${e.razon}</span>
                                <br>
                                <hr style="margin-top: 16px">
                                <span class="text-justify"><strong>@lang('messages.form.diagnostico')
                                <br>
                                </strong> ${e.diagnosis}</span>
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
                        } else {
                            $('#not-studie')
                                .show();
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
                        } else {
                            $('#not-exam')
                                .show();
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
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="text-capitalize">@lang('messages.form.fecha_examen'): ${e.date}</h5>
                                    <br>
                                </div>
                                <div id="table-info-consulta">
                                    <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                        <thead>
                                            <tr>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.peso_1')</th>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.altura_1')</th>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.presion_arterial_1')</th>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.temperatura_1')</th>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.respiraciones_1')</th>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.pulso_1')</th>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.saturacion_1')</th>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.condicion')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center text-capitalize"> ${e.weight}</td>
                                                <td class="text-center text-capitalize"> ${e.height}</td>
                                                <td class="text-center text-capitalize"> ${e.strain}</td>
                                                <td class="text-center text-capitalize"> ${e.temperature}</td>
                                                <td class="text-center text-capitalize"> ${e.breaths}</td>
                                                <td class="text-center text-capitalize"> ${e.pulse}</td>
                                                <td class="text-center text-capitalize"> ${e.saturation}</td>
                                                <td class="text-center text-capitalize"> ${e.condition}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <span class="text-justify">
                                    <strong>@lang('messages.label.observaciones'):</strong>
                                    <br>
                                    ${e.observations}
                                </span>
                            </li>`
                    } else {
                        element =
                            `<li class="list-group-item mb-3 ${key}" aria-current="true" style="border-radius: 8px;">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="text-capitalize">@lang('messages.form.fecha_examen'): ${e.date}</h5>
                                    <br>
                                </div>
                                <div id="table-info-consulta">
                                    <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                        <thead>
                                            <tr>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.peso_1')</th>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.altura_1')</th>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.presion_arterial_1')</th>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.temperatura_1')</th>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.respiraciones_1')</th>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.pulso_1')</th>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.saturacion_1')</th>
                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.condicion')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center text-capitalize"> ${e.weight}</td>
                                                <td class="text-center text-capitalize"> ${e.height}</td>
                                                <td class="text-center text-capitalize"> ${e.strain}</td>
                                                <td class="text-center text-capitalize"> ${e.temperature}</td>
                                                <td class="text-center text-capitalize"> ${e.breaths}</td>
                                                <td class="text-center text-capitalize"> ${e.pulse}</td>
                                                <td class="text-center text-capitalize"> ${e.saturation}</td>
                                                <td class="text-center text-capitalize"> ${e.condition}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <span class="text-justify">
                                    <strong>@lang('messages.label.observaciones'):</strong>
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

        function logout() {
            var url = "{{ route('logout-patient') }}";
            location.href = url;
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

                            <div class="row justify-content-end mt-3">
                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                    <button onclick="logout()" class="mt-text">
                                        Salir
                                        <img width="40" height="auto" src="{{ asset('/img/icons/log-out.png') }}" alt="avatar">
                                    </button>
                                </div>
                            </div>

                            @if (count($patients) > 1)
                                <div class="row justify-content-center mt-3" id="content-table-patient-portal">
                                    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 table-responsive">
                                        <hr>
                                        <h5 class="mb-4">@lang('messages.subtitulos.pacientes_registrados')</h5>
                                        <table id="table-info-pacientes-portal" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                            <thead>
                                                <tr>
                                                    <th class="text-center w-image" scope="col" data-orderable="false">@lang('messages.tabla.foto')</th>
                                                    <th class="text-center w-10" scope="col">@lang('messages.tabla.codigo_paciente')</th>
                                                    <th class="text-center w-10" scope="col">@lang('messages.tabla.nombre_apellido')</th>
                                                    <th class="text-center w-17" scope="col">@lang('messages.tabla.seleccionar')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    @foreach ($patients as $item)
                                                        <tr>
                                                            <td class="table-avatar">
                                                                <img class="avatar" src=" {{ $item->patient_img ? asset('/imgs/' . $item->patient_img) : ($item->genere == 'femenino' ? asset('/img/avatar/avatar mujer.png') : asset('/img/avatar/avatar hombre.png')) }}" alt="Imagen del paciente">
                                                            </td>
                                                            <td class="text-center text-capitalize"> {{ $item->patient_code }} </td>
                                                            <td class="text-center text-capitalize"> {{ $item->name . ' ' . $item->last_name }}</td>
                                                            <td class="text-center text-capitalize">
                                                                <div class="d-flex" style="justify-content: center;">
                                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                                        <button onclick="searchPatien({{ $item->id }});" type="button" data-bs-toggle="tooltip"data-bs-placement="bottom" title="@lang('messages.tooltips.editar')" >
                                                                            <img width="40" height="auto" src="{{ asset('/img/icons/user-check.png') }}" alt="avatar">
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

                                {{-- contenido de la data --}}
                                <div class="row mt-5" id="div-content" style="display: none">
                                    <hr>
                                    <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8">
                                        <div class="d-flex" style="align-items: center;" id="info-pat"></div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-cd mt-4">
                                        <div id="wizard">
                                            <h3>@lang('messages.pacientes.historia_clinica')</h3>
                                            <section>
                                                <div style="display: none" id='not-history' class="row justify-content-center mt-2">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                        <h5 class="card-title" style="text-align: center;">
                                                            @lang('messages.pacientes.paciente_sin_hist')
                                                        </h5>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: flex; margin-bottom: 10px; justify-content: center;">
                                                        <img width="150" height="auto" src="{{ asset('/img/icons/no-file.png') }}" alt="avatar">
                                                    </div>
                                                </div>
                                                <div class="div-overflow" id='div-history'>
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                        <div class="row">
                                                            <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_per')</h6>
                                                            <hr style="margin-top: 5px">
                                                            <div class="family_back"> </div>
                                                            <div class="ob_family_back"> </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                        <div class="row">
                                                            <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_per_pa')</h6>
                                                            <hr style="margin-top: 5px">
                                                            <div class="pathology_back"> </div>
                                                            <div class="ob_pathology_back"> </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                        <div class="row">
                                                            <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_per_no_pa')</h6>
                                                            <hr style="margin-top: 5px">
                                                            <div class="non_pathology_back"> </div>
                                                            <div class="ob_non_pathology_back"> </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                        <div class="row">
                                                            <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_salud')</h6>
                                                            <hr style="margin-top: 5px">
                                                            <div class="mental_healths"> </div>
                                                            <div class="ob_mental_healths"> </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                        <div class="row">
                                                            <h6 style="font-size: 18px">@lang('messages.acordion.inmunizaciones')</h6>
                                                            <hr style="margin-top: 5px">
                                                            <div class="inmunizations"> </div>
                                                            <div class="covid"> </div>
                                                            <div class="ob_inmunizations"> </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                        <div class="row">
                                                            <h6 style="font-size: 18px">@lang('messages.acordion.dispositivos_medicos')</h6>
                                                            <hr style="margin-top: 5px">
                                                            <div class="medical_device"> </div>
                                                            <div class="ob_medical_devices"> </div>
                                                        </div>
                                                    </div>
                                                    <div class="gilecologico mt-2"></div>
                                                    <div id="div_allergies" class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 mb-3" style="display: none; border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                        <div class="row">
                                                            <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_alerg')</h6>
                                                            <hr style="margin-top: 5px">
                                                            <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12 mt-2 table-responsive" id="table-info-allergies">
                                                                <table class="table table-striped table-bordered table-info-allergies" id="table-info-allergies">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center" scope="col" data-orderable="false">@lang('messages.form.tipo_alergia')</th>
                                                                            <th class="text-center" scope="col" data-orderable="false">@lang('messages.form.detalle')</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="ob-alergias"> </div>
                                                        </div>
                                                    </div>
                                                    <div id="div_cirugias" class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 mb-3" style="display: none; border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                        <div class="row">
                                                            <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_qx')</h6>
                                                            <hr style="margin-top: 5px">
                                                            <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12 mt-2 table-responsive" id="table-info-cirugias">
                                                                <table class="table table-striped table-bordered table-info-cirugias" id="table-info-cirugias">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center" scope="col" data-orderable="false">@lang('messages.form.tipo_cirugia')</th>
                                                                            <th class="text-center" scope="col" data-orderable="false">@lang('messages.form.fecha')</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="ob-cirugias"> </div>
                                                        </div>
                                                    </div>
                                                    <div id="div_medicamentos" class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 mb-3" style="display: none; border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                        <div class="row">
                                                            <h6 style="font-size: 18px">@lang('messages.acordion.medicamentos')</h6>
                                                            <hr style="margin-top: 5px">
                                                            <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12 mt-2 table-responsive" id="table-info-medicines">
                                                                <table class="table table-striped table-bordered table-info-medicines" id="table-info-medicines">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center" scope="col" data-orderable="false">@lang('messages.form.medicamento')</th>
                                                                            <th class="text-center" scope="col" data-orderable="false">@lang('messages.form.dosis')</th>
                                                                            <th class="text-center" scope="col" data-orderable="false">@lang('messages.form.patologia')</th>
                                                                            <th class="text-center" scope="col" data-orderable="false">@lang('messages.tabla.efectividad')</th>
                                                                            <th class="text-center" scope="col" data-orderable="false">@lang('messages.form.duracion_tratamiento')</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="ob-medicamentos"> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <h3>@lang('messages.pacientes.consulta_medica')</h3>
                                            <section>
                                                <div style="display: none" id='not-medical-record' class="row justify-content-center mt-2">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                        <h5 class="card-title" style="text-align: center;">
                                                            @lang('messages.pacientes.paciente_sin_cons')
                                                        </h5>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: flex; margin-bottom: 10px; justify-content: center;">
                                                        <img width="150" height="auto" src="{{ asset('/img/icons/no-file.png') }}" alt="avatar">
                                                    </div>
                                                </div>
                                                <div class="list-group list-con div-overflow"> </div>
                                            </section>
                                            <h3>@lang('messages.pacientes.estudios_realizado')</h3>
                                            <section>
                                                <div class="row p-3 div-overflow">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 pmv-0">
                                                        <ul class="list-group ul-study list-group-flush overflow-auto">
                                                        </ul>
                                                        <div id='not-studie' class="row justify-content-center">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                                <h5 class="card-title" style="text-align: center; margin-bottom: 10px;">
                                                                    @lang('messages.pacientes.no_estudios')
                                                                </h5>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: flex; justify-content: center;">
                                                                <img width="150" height="auto" src="{{ asset('/img/icons/no-file.png') }}" alt="avatar">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <h3>@lang('messages.pacientes.examenes_realizado')</h3>
                                            <section>
                                                <div class="row p-3 div-overflow">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 pmv-0">
                                                        <ul class="list-group ul-exmen list-group-flush overflow-auto"> </ul>
                                                        <div id='not-exam' class="row justify-content-center">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                                <h5 class="card-title" style="text-align: center; margin-bottom: 10px;">
                                                                    @lang('messages.pacientes.no_examenes')
                                                                </h5>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: flex; justify-content: center;">
                                                                <img width="150" height="auto" src="{{ asset('/img/icons/no-file.png') }}" alt="avatar">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <h3>@lang('messages.pacientes.examenes_fisico')</h3>
                                            <section>
                                                <div style="display: none" id='not-examenes-fisicos' class="row justify-content-center mt-2">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                        <h5 class="card-title" style="text-align: center;">
                                                            @lang('messages.pacientes.no_examenes')
                                                        </h5>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: flex; margin-bottom: 10px; justify-content: center;">
                                                        <img width="150" height="auto" src="{{ asset('/img/icons/no-file.png') }}" alt="avatar">
                                                    </div>
                                                </div>
                                                <div class="list-group list-examenes-fisicos div-overflow"> </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>

                            @else
                                @foreach ($patients as $item)
                                    {{-- {{ dd($patients, count($item->get_physical_exams)) }} --}}
                                    <div class="row mt-5" id="div-content">
                                        <hr>
                                        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8">
                                            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8 d-flex" style="align-items: center;">
                                                <div class="col-sm-2 col-md-3 col-lg-2 col-xl-2 col-xxl-2" style="width: 135px;" >
                                                    <img src="{{ $item->patient_img ? asset('/imgs/' . $item->patient_img) : ($item->genere == 'femenino' ? asset('/img/avatar/avatar mujer.png') : asset('/img/avatar/avatar hombre.png')) }}" width="125" height="125" alt="Imagen del paciente" class="img-medical">
                                                </div>

                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 data-medical">
                                                    <strong>@lang('messages.ficha_paciente.nombre'):</strong><span class="text-capitalize">  {{ $item->name . ' ' . $item->last_name }}</span>
                                                    <br>
                                                    <strong>@lang('messages.ficha_paciente.fecha_nacimiento'):</strong><span> {{ $item->birthdate }}</span>
                                                    <br>
                                                    <strong>@lang('messages.ficha_paciente.edad'):</strong><span> {{ $item->age }} años</span>
                                                    <br>
                                                    <strong>@lang('messages.ficha_paciente.ci'):</strong><span> {{ $item->ci }} </span>
                                                    <br>
                                                    <strong>@lang('messages.ficha_paciente.genero'):</strong><span class="text-capitalize"> {{ $item->genere }} </span>
                                                    <br>
                                                    <strong>@lang('messages.ficha_paciente.nro_historias'):</strong><span class="text-capitalize"> {{ $item->get_history ? $item->get_history->cod_history : '' }} </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-cd mt-4">
                                            <div id="wizard">
                                                <h3>@lang('messages.pacientes.historia_clinica')</h3>
                                                <section>
                                                    @if ($item->get_history !== null)
                                                        <div class="div-overflow" id='div-history'>
                                                            {{-- antecedentes personales  --}}
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                                <div class="row">
                                                                    <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_per')</h6>
                                                                    <hr style="margin-top: 5px">
                                                                    <span style="font-size: 13px">{{ $item->get_history->FB_EC === '1' ? '✔ Enfermedad Coronaria.' : null }}
                                                                    {{ $item->get_history->FB_HA  === '1' ? '✔ Hipertension Arterial.' : null }}
                                                                    {{ $item->get_history->FB_D   === '1' ? '✔ Diabetes.' : null }}
                                                                    {{ $item->get_history->FB_C   === '1' ? '✔ Cancer ('. $item->get_history->FB_C_input .')' : null }}
                                                                    {{ $item->get_history->FB_AL  === '1' ? '✔ Alzheimer.' : null }}
                                                                    {{ $item->get_history->FB_EM  === '1' ? '✔ Esclerosis Multiple.' : null }}
                                                                    {{ $item->get_history->FB_EDP === '1' ? '✔ Enfermedad de Parkinson.' : null }}
                                                                    {{ $item->get_history->FB_TSM === '1' ? '✔ Transtornos de Salud Mental.' : null }}
                                                                    {{ $item->get_history->FB_AR  === '1' ? '✔ Artritis Reumatoide.' : null }}
                                                                    {{ $item->get_history->FB_LES === '1' ? '✔ Lupus Eritematoso Sistemico.' : null }}
                                                                    {{ $item->get_history->FB_EHC === '1' ? '✔ Enfermedades Hepaticas cronicas.' : null }}
                                                                    {{ $item->get_history->FB_TDT === '1' ? '✔ Transtornos de la Tiroides.' : null }}
                                                                    {{ $item->get_history->FB_ER  === '1' ? '✔ Enfermedades Respiratorias.' : null }}
                                                                    {{ $item->get_history->FB_DM  === '1' ? '✔ Distrofia Muscular.' : null }}
                                                                    {{ $item->get_history->FB_NA  === '1' ? '✔ Niega.' : null }}</span>

                                                                    <div class="d-flex w-100 justify-content-between">
                                                                        <span class="text-justify mt-3">
                                                                            <strong>@lang('messages.label.observaciones'):</strong>
                                                                            <br>
                                                                           {{ $item->get_history->observations_back_family}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- antecedentes personales patologicos  --}}
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                                <div class="row">
                                                                    <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_per_pa')</h6>
                                                                    <hr style="margin-top: 5px">
                                                                    <span style="font-size: 13px">
                                                                        {{ $item->get_history->PB_HA    === '1' ? '✔ Hipertensión Arterial.' : null }}
                                                                        {{ $item->get_history->PB_EC    === '1' ? '✔ Enfermedad Coronaria.' : null }}
                                                                        {{ $item->get_history->PB_A     === '1' ? '✔ Asma.' : null }}
                                                                        {{ $item->get_history->PB_EPOC  === '1' ? '✔ Enfermedad Pulmonar Obstructiva Cronica (EPOC).' : null }}
                                                                        {{ $item->get_history->PB_ADS   === '1' ? '✔ Apnea del Sueño.' : null }}
                                                                        {{ $item->get_history->PB_D     === '1' ? '✔ Diabetes.' : null }}
                                                                        {{ $item->get_history->PB_H     === '1' ? '✔ Hipercolesterolemia.' : null }}
                                                                        {{ $item->get_history->PB_C     === '1' ? '✔ Cancer ('. $item->get_history->PB_C_input .')' : null }}
                                                                        {{ $item->get_history->PB_P     === '1' ? '✔ Parkinson.' : null }}
                                                                        {{ $item->get_history->PB_AL    === '1' ? '✔ Alzheimer.' : null }}
                                                                        {{ $item->get_history->PB_M     === '1' ? '✔ Migraña.' : null }}
                                                                        {{ $item->get_history->PB_AR    === '1' ? '✔ Artritis Reumatoide.' : null }}
                                                                        {{ $item->get_history->PB_EM    === '1' ? '✔ Esclerosis Multiple.' : null }}
                                                                        {{ $item->get_history->PB_U     === '1' ? '✔ Ulceras.' : null }}
                                                                        {{ $item->get_history->PB_G     === '1' ? '✔ Gastitris.' : null }}
                                                                        {{ $item->get_history->PB_SII   === '1' ? '✔ Sindrome del Intestino Irritable (SII).' : null }}
                                                                        {{ $item->get_history->PB_TDT   === '1' ? '✔ Transtornos de la tiroides.' : null }}
                                                                        {{ $item->get_history->PB_EHC   === '1' ? '✔ Efermedades hepaticas cronicas.' : null }}
                                                                        {{ $item->get_history->PB_ERC   === '1' ? '✔ Enfermedad Renal Cronica (ERC).' : null }}
                                                                        {{ $item->get_history->PB_OO    === '1' ? '✔ Osteoartritis / Osteoporosis.' : null }}
                                                                        {{ $item->get_history->PB_FA    === '1' ? '✔ Fracturas Anteriores.' : null }}
                                                                        {{ $item->get_history->PB_GLA   === '1' ? '✔ Glaucoma.' : null }}
                                                                        {{ $item->get_history->PB_PCODC === '1' ? '✔ Problemas circulatorios / de coagulación.' : null }}
                                                                        {{ $item->get_history->PB_TS    === '1' ? '✔ Ha recibido transfusiones sanguineas? - Si. ' : null }}
                                                                        {{ $item->get_history->PB_NA    === '1' ? '✔ Niega.' : null }}
                                                                    </span>
                                                                    <div class="d-flex w-100 justify-content-between">
                                                                        <span class="text-justify mt-3">
                                                                            <strong>@lang('messages.label.observaciones'):</strong>
                                                                            <br>
                                                                           {{ $item->get_history->observations_diagnosis}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- antecedentes personales no patologicos  --}}
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                                <div class="row">
                                                                    <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_per_no_pa')</h6>
                                                                    <hr style="margin-top: 5px">
                                                                    <span style="font-size: 13px">
                                                                        {{ $item->get_history->NPB_CA     === '1' ? '✔ Cosume alcohol? Si.' : null }}
                                                                        {{ $item->get_history->NPB_CFGYPL === '1' ? '✔ Cosume frecuentemente grasas y productos lacteos? Si.' : null }}
                                                                        {{ $item->get_history->NPB_CFAAA  === '1' ? '✔ Cosume frecuentemente alimentos procesados y altos en azúcar?. Si' : null }}
                                                                        {{ $item->get_history->NPB_CC     === '1' ? '✔ Consume cigarrillos: Puros, Pipas, Tabaco de mascar o Vapper?. Si' : null }}
                                                                        {{ $item->get_history->NPB_CCD    === '1' ? '✔ Cosume o a Consumido drogas. Si' : null }}
                                                                        {{ $item->get_history->NPB_UFMVL  === '1' ? '✔ Usa frecuentemente medicamento de venta libre?. Si' : null }}
                                                                        {{ $item->get_history->NPB_EF     === '1' ? '✔ Se ejercita frecuentemente?. Si' : null }}
                                                                        {{ $item->get_history->NPB_SIPD   === '1' ? '✔ Sufre de Insomio o problemas para dormir? Si' : null }}
                                                                        {{ $item->get_history->NPB_NA     === '1' ? '✔ Niega.' : null }}
                                                                    </span>
                                                                    <div class="d-flex w-100 justify-content-between">
                                                                        <span class="text-justify mt-3">
                                                                            <strong>@lang('messages.label.observaciones'):</strong>
                                                                            <br>
                                                                           {{ $item->get_history->observations_not_pathological}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- antecedentes de salud mental  --}}
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                                <div class="row">
                                                                    <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_salud')</h6>
                                                                    <hr style="margin-top: 5px">
                                                                    <span style="font-size: 13px">
                                                                        {{ $item->get_history->EM_DMR   === '1' ? '✔ Depresión mayor recurrente.' : null }}
                                                                        {{ $item->get_history->EM_TB    === '1' ? '✔ Trastorno bipolar.' : null }}
                                                                        {{ $item->get_history->EM_TAG   === '1' ? '✔ Trastorno de ansiedad generalizada (TAG).' : null }}
                                                                        {{ $item->get_history->EM_TCO   === '1' ? '✔ Trastorno obsesivo-compulsivo (TOC).' : null }}
                                                                        {{ $item->get_history->EM_TP    === '1' ? '✔ Trastorno de pánico.' : null }}
                                                                        {{ $item->get_history->EM_TEPT  === '1' ? '✔ Trastorno de estrés postraumático (TEPT).' : null }}
                                                                        {{ $item->get_history->EM_E     === '1' ? '✔ Esquizofrenia.' : null }}
                                                                        {{ $item->get_history->EM_TLP   === '1' ? '✔ Trastorno de la personalidad límite (TLP).' : null }}
                                                                        {{ $item->get_history->EM_TAAB  === '1' ? '✔ Trastorno de alimentación (anorexia bulimia).' : null }}
                                                                        {{ $item->get_history->EM_TCS   === '1' ? '✔ Trastorno por consumo de sustancias.' : null }}
                                                                        {{ $item->get_history->EM_NA    === '1' ? '✔ Niega.' : null }}
                                                                    </span>
                                                                    <div class="d-flex w-100 justify-content-between">
                                                                        <span class="text-justify mt-3">
                                                                            <strong>@lang('messages.label.observaciones'):</strong>
                                                                            <br>
                                                                           {{ $item->get_history->observations_mental_healths}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- historia Inmunizacion --}}
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                                <div class="row">
                                                                    <h6 style="font-size: 18px">@lang('messages.acordion.inmunizaciones')</h6>
                                                                    <hr style="margin-top: 5px">
                                                                    <span style="font-size: 13px">
                                                                        {{ $item->get_history->IM_BCG     === '1' ? '✔ BCG (Bacillus Calmette-Guérin).' : null }}
                                                                        {{ $item->get_history->IM_HB      === '1' ? '✔ Hepatitis B.' : null }}
                                                                        {{ $item->get_history->IM_DTP     === '1' ? '✔ DTP (Difteria, Tétanos, Pertussis).' : null }}
                                                                        {{ $item->get_history->IM_IPV_OPV === '1' ? '✔ Poliomielitis (IPV u OPV).' : null }}
                                                                        {{ $item->get_history->IM_HIB     === '1' ? '✔ Hib (Haemophilus influenzae tipo B).' : null }}
                                                                        {{ $item->get_history->IM_PCV     === '1' ? '✔ Neumococo (PCV).' : null }}
                                                                        {{ $item->get_history->IM_R       === '1' ? '✔ Rotavirus.' : null }}
                                                                        {{ $item->get_history->IM_MMR     === '1' ? '✔ Sarampión, Paperas y Rubéola (MMR).' : null }}
                                                                        {{ $item->get_history->IM_V       === '1' ? '✔ Varicela.' : null }}
                                                                        {{ $item->get_history->IM_I       === '1' ? '✔ Influenza.' : null }}
                                                                        {{ $item->get_history->IM_HA      === '1' ? '✔ Hepatitis A.' : null }}
                                                                        {{ $item->get_history->IM_M       === '1' ? '✔ Meningococo (MenACWY y MenB).' : null }}
                                                                        {{ $item->get_history->IM_VPH     === '1' ? '✔ Virus del Papiloma Humano (VPH).' : null }}
                                                                        {{ $item->get_history->IM_N       === '1' ? '✔ Neumococo (PCV13 y PPSV23).' : null }}
                                                                        {{ $item->get_history->IM_HZ      === '1' ? '✔ Herpes Zóster (Shingrix).' : null }}
                                                                        {{ $item->get_history->IM_O       === '1' ? '✔ Otros ('. $item->get_history->IM_V_input .')' : null }}
                                                                        {{ $item->get_history->IM_NA      === '1' ? '✔ Niega.' : null }}
                                                                    </span>
                                                                        @if ($item->get_history->IMC19_covid === '1')
                                                                            <hr class="mt-1" style="margin-bottom: 0;">
                                                                            <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                                                                @lang('messages.form.IMC19_covid')</h6>
                                                                            <hr style="margin-bottom: 0;">
                                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive"  id="table-info-consulta">
                                                                                <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.IMC19_dosis')</th>
                                                                                            <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.IMC19_fecha_ultima_dosis')</th>
                                                                                            <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.IMC19_marca')</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="text-center text-capitalize"> {{ $item->get_history->IMC19_dosis}}</td>
                                                                                            <td class="text-center text-capitalize"> {{ $item->get_history->IMC19_fecha_ultima_dosis}}</td>
                                                                                            <td class="text-center text-capitalize"> {{ $item->get_history->IMC19_marca}} </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        @endif
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                        <span class="text-justify mt-3">
                                                                            <strong>@lang('messages.label.observaciones'):</strong>
                                                                            <br>
                                                                           {{ $item->get_history->observations_inmunization}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- historia dispositivos medicos --}}
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                                <div class="row">
                                                                    <h6 style="font-size: 18px">@lang('messages.acordion.dispositivos_medicos')</h6>
                                                                    <hr style="margin-top: 5px">
                                                                    <span style="font-size: 13px">
                                                                        {{ $item->get_history->MD_MP   === '1' ? '✔ Marcapasos.' : null }}
                                                                        {{ $item->get_history->MD_DAI  === '1' ? '✔ Desfibriladores Automáticos Implantables (DAI).' : null }}
                                                                        {{ $item->get_history->MD_IC   === '1' ? '✔ Implantes Cocleares.' : null }}
                                                                        {{ $item->get_history->MD_SC   === '1' ? '✔ Stents Coronarios.' : null }}
                                                                        {{ $item->get_history->MD_PCR  === '1' ? '✔ Prótesis de Cadera y Rodilla.' : null }}
                                                                        {{ $item->get_history->MD_BI   === '1' ? '✔ Bombas de Insulina.' : null }}
                                                                        {{ $item->get_history->MD_CVC  === '1' ? '✔ Catéteres Venosos Centrales (Port-a-Cath).' : null }}
                                                                        {{ $item->get_history->MD_VC   === '1' ? '✔ Válvulas Cardíacas.' : null }}
                                                                        {{ $item->get_history->MD_ID   === '1' ? '✔ Implantes Dentales.' : null }}
                                                                        {{ $item->get_history->MD_NEME === '1' ? '✔ Neuromoduladores (Estimulación de la Médula Espinal).' : null }}
                                                                        {{ $item->get_history->MD_IR   === '1' ? '✔ Implantes de Retina.' : null }}
                                                                        {{ $item->get_history->MD_DFV  === '1' ? '✔ Dispositivos de Fusión Vertebral.' : null }}
                                                                        {{ $item->get_history->MD_MQ   === '1' ? '✔ Mallas Quirúrgicas.' : null }}
                                                                        {{ $item->get_history->MD_DII  === '1' ? '✔ Dispositivos de Infusión Intratecal.' : null }}
                                                                        {{ $item->get_history->MD_NA   === '1' ? '✔ Niega.' : null }}
                                                                    </span>
                                                                    <div class="d-flex w-100 justify-content-between">
                                                                        <span class="text-justify mt-3">
                                                                            <strong>@lang('messages.label.observaciones'):</strong>
                                                                            <br>
                                                                           {{ $item->get_history->observations_medical_devices}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- historia ginecologica --}}
                                                            @if ($item->genere == 'femenino')
                                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                                    <div class="row">
                                                                        <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_gine')</h6>
                                                                        <hr style="margin-top: 5px">
                                                                        <div class="row">
                                                                            <hr class="mt-1" style="margin-bottom: 0;">
                                                                            <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                                                                @lang('messages.subtitulos.ginecologicos')</h6>
                                                                            <hr style="margin-bottom: 0;">
                                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                                                <div id="table-info-consulta">
                                                                                    <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.edad_mestruacion')</th>
                                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.fecha_periodo')</th>
                                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.ciclo_menstrual')</th>
                                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.infecciones')</th>
                                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.exam_previos')</th>
                                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.anticonceptivo')</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td class="text-center text-capitalize"> {{ $item->get_history->GINE_menarquia}}</td>
                                                                                                <td class="text-center text-capitalize"> {{ $item->get_history->GINE_fecha_ultimo_pe}}</td>
                                                                                                <td class="text-center text-capitalize"> {{ $item->get_history->GINE_duracion}}</td>
                                                                                                <td class="text-center text-capitalize"> {{ $item->get_history->GINE_infecciones}}</td>
                                                                                                <td class="text-center text-capitalize"> {{ $item->get_history->GINE_ex_gine_previos}}</td>
                                                                                                <td class="text-center text-capitalize"> {{ $item->get_history->GINE_metodo_anti}}</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                            <hr class="mt-3" style="margin-bottom: 0;">
                                                                            <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                                                                @lang('messages.subtitulos.obstetricos')</h6>
                                                                            <hr style="margin-bottom: 0;">
                                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                                            <div id="table-info-consulta">
                                                                                    <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.nro_embarazos')</th>
                                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.nro_partos')</th>
                                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.nro_cesareas')</th>
                                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.nro_abortos')</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td class="text-center text-capitalize"> {{ $item->get_history->OBSTE_gravides}}</td>
                                                                                                <td class="text-center text-capitalize"> {{ $item->get_history->OBSTE_partos}}</td>
                                                                                                <td class="text-center text-capitalize"> {{ $item->get_history->OBSTE_cesareas}}</td>
                                                                                                <td class="text-center text-capitalize"> {{ $item->get_history->OBSTE_abortos}}</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                            <hr class="mt-3" style="margin-bottom: 0;">
                                                                            <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                                                                @lang('messages.subtitulos.menopausia')</h6>
                                                                            <hr style="margin-bottom: 0;">
                                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                                                <div id="table-info-consulta">
                                                                                    <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.MENOSPA_fecha_ini')</th>
                                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.MENOSPA_sintomas')</th>
                                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.MENOSPA_tratamiento')</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td class="text-center text-capitalize"> {{ $item->get_history->MENOSPA_fecha_ini}}</td>
                                                                                                <td class="text-center text-capitalize"> {{ $item->get_history->MENOSPA_sintomas}}</td>
                                                                                                <td class="text-center text-capitalize"> {{ $item->get_history->MENOSPA_tratamiento}}</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                            <hr class="mt-3" style="margin-bottom: 0;">
                                                                            <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                                                                @lang('messages.subtitulos.act_sexual')</h6>
                                                                            <hr style="margin-bottom: 0;">
                                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                                                <div id="table-info-consulta">
                                                                                    <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.ACTSEX_activo')</th>
                                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.ACTSEX_enfermedades_ts')</th>
                                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.MENOSPA_tratamiento')</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td class="text-center text-capitalize"> {{ $item->get_history->ACTSEX_activo === '1' ? "Activo" : "Inactivo"}}</td>
                                                                                                <td class="text-center text-capitalize"> {{ $item->get_history->ACTSEX_enfermedades_ts}}</td>
                                                                                                <td class="text-center text-capitalize"> {{ $item->get_history->MENOSPA_tratamiento}}</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                            <div class="d-flex w-100 justify-content-between">
                                                                                <span class="text-justify mt-3">
                                                                                    <strong>@lang('messages.label.observaciones'):</strong>
                                                                                    <br>
                                                                                    {{ $item->get_history->observations_ginecologica }}
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            {{-- alergias --}}
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                                <div class="row">
                                                                    <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_alerg')</h6>
                                                                    <hr style="margin-top: 5px">
                                                                    @if ($item->get_history->allergies != 'null')
                                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                                            <div id="table-info-consulta">
                                                                                <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.tipo_alergia')</th>
                                                                                            <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.detalle')</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @php

                                                                                            $dataAllergies = json_decode($item->get_history->allergies, true);
                                                                                            // dd($dataAllergies);
                                                                                        @endphp
                                                                                        @foreach (collect($dataAllergies) as $key => $items)
                                                                                            <tr>
                                                                                                <td class="text-center text-capitalize"> {{ $items['type_alergia'] }}</td>
                                                                                                <td class="text-center text-capitalize"> {{ $items['detalle_alergia'] }}</td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    <div class="d-flex w-100 justify-content-between">
                                                                        <span class="text-justify mt-3">
                                                                            <strong>@lang('messages.label.observaciones'):</strong>
                                                                            <br>
                                                                        {{ $item->get_history->observations_allergies}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- quirurgicos --}}
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                                <div class="row">
                                                                    <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_qx')</h6>
                                                                    <hr style="margin-top: 5px">
                                                                    @if ($item->get_history->history_surgical != 'null')
                                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                                            <div id="table-info-consulta">
                                                                                <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.tipo_cirugia')</th>
                                                                                            <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.fecha')</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @php

                                                                                            $dataSurgical = json_decode($item->get_history->history_surgical, true);
                                                                                            // dd($dataSurgical);
                                                                                        @endphp
                                                                                        @foreach (collect($dataSurgical) as $key => $items)
                                                                                            <tr>
                                                                                                <td class="text-center text-capitalize"> {{ $items['cirugia'] }}</td>
                                                                                                <td class="text-center text-capitalize"> {{ $items['datecirugia'] }}</td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    <div class="d-flex w-100 justify-content-between">
                                                                        <span class="text-justify mt-3">
                                                                            <strong>@lang('messages.label.observaciones'):</strong>
                                                                            <br>
                                                                        {{ $item->get_history->observations_quirurgicas}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- medicamentos --}}
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                                <div class="row">
                                                                    <h6 style="font-size: 18px">@lang('messages.acordion.medicamentos')</h6>
                                                                    <hr style="margin-top: 5px">
                                                                    @if ($item->get_history->medications_supplements != 'null')
                                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                                            <div id="table-info-consulta">
                                                                                <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.medicamento')</th>
                                                                                            <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.dosis')</th>
                                                                                            <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.patologia')</th>
                                                                                            <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.efectividad')</th>
                                                                                            <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.duracion_tratamiento')</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @php

                                                                                            $dataMedications = json_decode($item->get_history->medications_supplements, true);
                                                                                        @endphp
                                                                                        @foreach (collect($dataMedications) as $key => $items)
                                                                                            <tr>
                                                                                                <td class="text-center text-capitalize"> {{ $items['medicine'] }}</td>
                                                                                                <td class="text-center text-capitalize"> {{ $items['dose'] }}</td>
                                                                                                <td class="text-center text-capitalize"> {{ $items['patologi'] }}</td>
                                                                                                <td class="text-center text-capitalize"> {{ $items['effectiveness'] }}</td>
                                                                                                <td class="text-center text-capitalize"> {{ $items['treatmentDuration'] }}</td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    <div class="d-flex w-100 justify-content-between">
                                                                        <span class="text-justify mt-3">
                                                                            <strong>@lang('messages.label.observaciones'):</strong>
                                                                            <br>
                                                                        {{ $item->get_history->observations_medication}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div id='not-history' class="row justify-content-center mt-2">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                                <h5 class="card-title" style="text-align: center;">
                                                                    @lang('messages.pacientes.paciente_sin_hist')
                                                                </h5>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: flex; margin-bottom: 10px; justify-content: center;">
                                                                <img width="150" height="auto" src="{{ asset('/img/icons/no-file.png') }}" alt="avatar">
                                                            </div>
                                                        </div>
                                                    @endif

                                                </section>
                                                <h3>@lang('messages.pacientes.consulta_medica')</h3>
                                                <section>

                                                    @if ($item->get_medicard_record != [])
                                                        <div class="list-group div-overflow">
                                                            @foreach ($item->get_medicard_record->sortByDesc('created_at') as $key => $item)
                                                                @if (($key % 2) == 0)
                                                                    <li class="list-group-item mb-3 active {{ $key }}" aria-current="true" style="border-radius: 8px; z-index: 0;">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <h5 class="text-capitalize">@lang('messages.form.fecha_consulta'): {{ $item['record_date'] }}</h5>
                                                                            <br>
                                                                        </div>
                                                                        <div id="table-info-consulta">
                                                                            <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.medico')</th>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.especialidad')</th>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.codigo_consulta')</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="text-center text-capitalize"> {{ $item['doctor'] }}</td>
                                                                                        <td class="text-center text-capitalize"> {{ $item['specialty'] }} </td>
                                                                                        <td class="text-center text-capitalize"> {{ $item['record_code'] }}</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <br>
                                                                        <span class="text-justify"><strong>@lang('messages.form.razon_consulta')
                                                                        <br>
                                                                        </strong> {{ $item['razon'] }}</span>
                                                                        <br>
                                                                        <hr style="margin-top: 16px">
                                                                        <span class="text-justify"><strong>@lang('messages.form.diagnostico')
                                                                        <br>
                                                                        </strong> {{ $item['diagnosis'] }}</span>
                                                                    </li>
                                                                @else
                                                                    <li class="list-group-item mb-3 {{ $key }}" aria-current="true" style="border-radius: 8px; z-index: 0;">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <h5 class="text-capitalize">@lang('messages.form.fecha_consulta'): {{ $item['record_date'] }}</h5>
                                                                            <br>
                                                                        </div>
                                                                        <div id="table-info-consulta">
                                                                            <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.medico')</th>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.especialidad')</th>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.codigo_consulta')</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="text-center text-capitalize"> {{ $item['doctor'] }}</td>
                                                                                        <td class="text-center text-capitalize"> {{ $item['specialty'] }} </td>
                                                                                        <td class="text-center text-capitalize"> {{ $item['record_code'] }}</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <br>
                                                                        <span class="text-justify"><strong>@lang('messages.form.razon_consulta')
                                                                        <br>
                                                                        </strong> {{ $item['razon'] }}</span>
                                                                        <br>
                                                                        <hr style="margin-top: 16px">
                                                                        <span class="text-justify"><strong>@lang('messages.form.diagnostico')
                                                                        <br>
                                                                        </strong> {{ $item['diagnosis'] }}</span>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <div id='not-medical-record' class="row justify-content-center mt-2">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                                <h5 class="card-title" style="text-align: center;">
                                                                    @lang('messages.pacientes.paciente_sin_cons')
                                                                </h5>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: flex; margin-bottom: 10px; justify-content: center;">
                                                                <img width="150" height="auto" src="{{ asset('/img/icons/no-file.png') }}" alt="avatar">
                                                            </div>
                                                        </div>
                                                    @endif

                                                </section>
                                                <h3>@lang('messages.pacientes.estudios_realizado')</h3>
                                                <section>
                                                    <div class="row p-3 div-overflow">

                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 pmv-0">
                                                            <ul class="list-group ul-study list-group-flush overflow-auto">
                                                            </ul>
                                                            <div id='not-studie' class="row justify-content-center">
                                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                                    <h5 class="card-title" style="text-align: center; margin-bottom: 10px;">
                                                                        @lang('messages.pacientes.no_estudios')
                                                                    </h5>
                                                                </div>
                                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: flex; justify-content: center;">
                                                                    <img width="150" height="auto" src="{{ asset('/img/icons/no-file.png') }}" alt="avatar">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <h3>@lang('messages.pacientes.examenes_realizado')</h3>
                                                <section>
                                                    <div class="row p-3 div-overflow">
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 pmv-0">
                                                            <ul class="list-group ul-exmen list-group-flush overflow-auto"> </ul>
                                                            {{ $item->get_study_medical }}

                                                            {{-- @if ($item->get_study_medical)
                                                                @php
                                                                    $target = `{{ URL::asset('/imgs/${item.file}') }}`;
                                                                @endphp

                                                            @endif
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
                                                            } --}}
                                                            <div id='not-exam' class="row justify-content-center">
                                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                                    <h5 class="card-title" style="text-align: center; margin-bottom: 10px;">
                                                                        @lang('messages.pacientes.no_examenes')
                                                                    </h5>
                                                                </div>
                                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: flex; justify-content: center;">
                                                                    <img width="150" height="auto" src="{{ asset('/img/icons/no-file.png') }}" alt="avatar">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <h3>@lang('messages.pacientes.examenes_fisico')</h3>
                                                <section>
                                                    @if ($item->get_physical_exams)
                                                        <div class="list-group div-overflow">
                                                            @foreach ($item->get_physical_exams->sortByDesc('created_at') as $key => $item)
                                                                @if (($key % 2) == 0)
                                                                    <li class="list-group-item mb-3 active {{ $key }}" aria-current="true" style="border-radius: 8px; z-index: 0;">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <h5 class="text-capitalize">@lang('messages.form.fecha_consulta'): {{ $item['date'] }}</h5>
                                                                            <br>
                                                                        </div>
                                                                        <div id="table-info-consulta">
                                                                            <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.peso_1')</th>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.altura_1')</th>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.presion_arterial_1')</th>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.temperatura_1')</th>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.respiraciones_1')</th>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.pulso_1')</th>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.saturacion_1')</th>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.condicion')</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="text-center text-capitalize"> {{ $item['weight'] }}</td>
                                                                                        <td class="text-center text-capitalize"> {{ $item['height'] }}</td>
                                                                                        <td class="text-center text-capitalize"> {{ $item['strain'] }}</td>
                                                                                        <td class="text-center text-capitalize"> {{ $item['temperature'] }}</td>
                                                                                        <td class="text-center text-capitalize"> {{ $item['breaths'] }}</td>
                                                                                        <td class="text-center text-capitalize"> {{ $item['pulse'] }}</td>
                                                                                        <td class="text-center text-capitalize"> {{ $item['saturation'] }}</td>
                                                                                        <td class="text-center text-capitalize"> {{ $item['condition'] }}</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <br>
                                                                        <span class="text-justify"><strong>@lang('messages.label.observaciones')
                                                                        <br>
                                                                        </strong> {{ $item['observations'] }}</span>
                                                                        <br>
                                                                    </li>
                                                                @else
                                                                    <li class="list-group-item mb-3 {{ $key }}" aria-current="true" style="border-radius: 8px; z-index: 0;">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <h5 class="text-capitalize">@lang('messages.form.fecha_consulta'): {{ $item['date'] }}</h5>
                                                                            <br>
                                                                        </div>
                                                                        <div id="table-info-consulta">
                                                                            <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.peso_1')</th>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.altura_1')</th>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.presion_arterial_1')</th>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.temperatura_1')</th>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.respiraciones_1')</th>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.pulso_1')</th>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.saturacion_1')</th>
                                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.condicion')</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="text-center text-capitalize"> {{ $item['weight'] }}</td>
                                                                                        <td class="text-center text-capitalize"> {{ $item['height'] }}</td>
                                                                                        <td class="text-center text-capitalize"> {{ $item['strain'] }}</td>
                                                                                        <td class="text-center text-capitalize"> {{ $item['temperature'] }}</td>
                                                                                        <td class="text-center text-capitalize"> {{ $item['breaths'] }}</td>
                                                                                        <td class="text-center text-capitalize"> {{ $item['pulse'] }}</td>
                                                                                        <td class="text-center text-capitalize"> {{ $item['saturation'] }}</td>
                                                                                        <td class="text-center text-capitalize"> {{ $item['condition'] }}</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <br>
                                                                        <span class="text-justify"><strong>@lang('messages.label.observaciones')
                                                                        <br>
                                                                        </strong> {{ $item['observations'] }}</span>
                                                                        <br>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <div id='not-examenes-fisicos' class="row justify-content-center mt-2">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                                <h5 class="card-title" style="text-align: center;">
                                                                    @lang('messages.pacientes.no_examenes')
                                                                </h5>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: flex; margin-bottom: 10px; justify-content: center;">
                                                                <img width="150" height="auto" src="{{ asset('/img/icons/no-file.png') }}" alt="avatar">
                                                            </div>
                                                        </div>
                                                    @endif
                                                </section>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach

                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
